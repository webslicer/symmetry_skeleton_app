<?php
namespace Application\Controller;
use Symmetry\Controller;
//use Application\Bootstrap as App;
//use Application\Model\Users;

class Account extends Controller{
    
    /**
     * 
     * @param unknown $email {
     *     filter="FILTER_VALIDATE_EMAIL,array(
     *         'options'=>array('default' => null))"
     *     }
     * @param $password
     */
    public function login($email,$password){
        $errMsg = '';
        if(!empty($email) && !empty($password)){
            $user = false;
            if(!empty($password)){
                //$user = Users::verify($email, $password);
            } 
            if($user){
                /*
                $_SESSION['user_id'] = $user->getUserId();
                App::$user = $user;
                //record details for customer login
                $user->getInfo()->timestampLogin();
                 */
                if($this->response->context == 'json'){
                    return ['redirectUrl'=>$this->getUrl('index', 'Index')];
                }
                $this->redirect('index','Index');
            } else {
                $errMsg = 'Email and/or password does not match our records.';
            }
        } else {
            $errMsg = 'Please provide email and password.';
        }
        return ['email'=>$email, 'errmsg'=>$errMsg];
    }
    
    public function logout(){
        $_SESSION['user_id'] = null;
        unset($_SESSION['user_id']);
        if($this->response->context == 'json'){
            return ['redirectUrl'=>$this->getUrl('index', 'Index')];
        }
        $this->redirect('index','Index');
    }
    
}