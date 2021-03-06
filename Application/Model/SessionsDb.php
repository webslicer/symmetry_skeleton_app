<?php
namespace Application\Model;
use Application\Bootstrap as App;

/**
 * Sessions
 *
 * @Table(name="sessions")
 * @Entity
 */
class SessionsDb {
    public static $lifetime = 7200;
    
    /**
     * @var string $sesskey
     *
     * @Column(name="sesskey", type="string", length=32, nullable=false)
     * @Id
     */
    private $sesskey;
    
    /**
     * @var integer $expiry
     *
     * @Column(name="expiry", type="integer", nullable=false)
     */
    private $expiry;

    /**
     * @var text $value
     *
     * @Column(name="value", type="text", nullable=false)
     */
    private $value;
    
    public function __construct(){
        session_set_save_handler(
                array('Application\Model\Sessions', 'open'),
                array('Application\Model\Sessions', 'close'),
                array('Application\Model\Sessions', 'read'),
                array('Application\Model\Sessions', 'write'),
                array('Application\Model\Sessions', 'destroy'),
                array('Application\Model\Sessions', 'gc')
        );
        register_shutdown_function('session_write_close');
    }
    
    public function setSesskey($id){
        $this->sesskey = $id;
        return $this;
    }
    
    public function setExpiry($time){
        $this->expiry = $time;
        return $this;
    }
    
    public function setValue($value){
        $this->value = $value;
        return $this;
    }
    
    /**
     * Destructor
     *
     * @return void
     */
    public function __destruct()
    {
        //session_write_close();
    }
    
    /**
     * Open Sessions
     *
     * @param string $save_path
     * @param string $name
     * @return boolean
     */
    public static function open($save_path, $name)
    {
        return true;
    }
    
    /**
     * Close session
     *
     * @return boolean
     */
    public static function close()
    {
        return true;
    }
    
    /**
     * Read session data
     *
     * @param string $id
     * @return string
     */    
    public static function read($id)
    {
        $return = '';
        $escId = App::$db->real_escape_string($id);
        $result = App::$db->query("SELECT sesskey, expiry, value FROM sessions WHERE sesskey = '$escId'");
        if ($result !== false && $result->num_rows > 0) {
            $record = $result->fetch_assoc();
            if ($record['expiry'] > time()) {
                $return = $record['value'];
            } else {
                self::destroy($id);
            }
        }
        return $return;
    }
    
    /**
     * Write session data
     *
     * @param string $id
     * @param string $data
     * @return boolean
     */
    public static function write($id, $data)
    {
        $escId = App::$db->real_escape_string($id);
        $result = App::$db->query("SELECT sesskey, expiry, value FROM sessions WHERE sesskey = '$escId'");
        $expiry = time() + self::$lifetime;
        $success = false;
        $escData = App::$db->real_escape_string($data);
        if ($result !== false && $result->num_rows > 0) {
            //update db entry
            $success = App::$db->query("UPDATE sessions SET expiry=$expiry, value='$escData' WHERE sesskey = '$escId'");
        } else {
            //new db entry
            $success = App::$db->query("INSERT INTO sessions VALUES ('$escId',$expiry,'$escData')");
        }
        
        return $success;
    }
    
    /**
     * Destroy session
     *
     * @param string $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $escId = App::$db->real_escape_string($id);
        $success = App::$db->query("DELETE FROM sessions WHERE sesskey = '$escId'");
        
        if (isset($_COOKIE[session_name()])) {
            $cookie_params = session_get_cookie_params();
        
            setcookie(
                    session_name(),
                    false,
                    315554400, // strtotime('1980-01-01'),
                    $cookie_params['path'],
                    $cookie_params['domain'],
                    $cookie_params['secure']
            );
        }
        return $success;
    }
    
    /**
     * Garbage Collection
     *
     * @param int $maxlifetime
     * @return true
     */
    public static function gc($maxlifetime)
    {
        $maxTime = time() - $maxlifetime;
        $success = App::$db->query("DELETE FROM sessions WHERE expiry < $maxTime");
        return $success;
    }
}


