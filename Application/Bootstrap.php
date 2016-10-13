<?php
namespace Application;

use Symmetry\Setup,
    Symmetry\Response,
    Symmetry\Request;

class Bootstrap {
    public static $config = null;
    
    public static $db = null;
    
    public static $plugins = array();
    
    /**
     * @var \Application\Model\Users
     */
    public static $user = null;
        
    /**
     * @var \Doctrine\Common\Cache\FilesystemCache
     */
    public static $cache = null;
    
    const PATH = __DIR__;
    
    public static function setConfig($config){
        self::$config = $config;
        if(isset($config['db'])){
            //anchor database instance here
            //self::$db = new Database($config['db']);
        }
        
        self::$plugins[] = new \Application\Plugins\Security();
        Setup::registerViewFinder(new \Application\Plugins\ViewFindStrategy());
        Setup::registerParentFinder(new \Application\Plugins\ParentFindStrategy());
        
        //self::$cache = new \Doctrine\Common\Cache\FilesystemCache(sys_get_temp_dir());
        //self::$cache = new \Doctrine\Common\Cache\ApcCache();
        //Setup::registerCache(new \Application\Library\DoctrineCacheWrapper(self::$cache),10);
        
        //Other App setup, ORM?
    }
    
    public static function run($request = null){
        if(empty($request)){
            if(defined('STDIN')){
                //for possible cron jobs
                $response = Response::getInstance(new Request\ConsoleRequest());
            } else {
                //normal web traffic
                $response = Response::getInstance(new Request\UrlRequest(),self::$plugins);
            }
        } else if($request instanceof Request){
            $response = Response::getInstance($request, self::$plugins);
        } else if(is_array($request)){
            $response = Response::getInstance($request[0],$request[1]);
        } else {
            throw new \Exception('Request unknown.');
        }
        return $response;
    }
}