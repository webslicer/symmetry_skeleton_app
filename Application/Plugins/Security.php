<?php
namespace Application\Plugins;
use Symmetry\Interfaces\PluginInterface,
    Application\Bootstrap as App,
    Symmetry\Request;

class Security implements PluginInterface{
    
    public function __construct(){
        
    }
    
    public function applicationEntry($app){
        if(empty($_SERVER['HTTPS']) && Request::$useHttps === true){
            if(strpos($_SERVER['REQUEST_URI'], App::$config['https_base_path']) !== false){
                $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            } else {
                $url = 'https://'.$_SERVER['HTTP_HOST'].App::$config['https_base_path'].$_SERVER['REQUEST_URI'];
            }
            header('Location: '.$url);
            exit;
        }
        //new \Application\Model\Sessions();
        session_start();
        if(empty($_SESSION['role'])){
            $_SESSION['role'] = 'user';
        }
    }
    
    public function classEntry(&$request, $app){
        
        if(empty(App::$user)){
            if(!$this->isPublic($request)){
                //$params = array_merge($request->params,['errMsg'=>'not logged in']);
                //$request = new Request('login','Account',$params);
            }
        } else {
            if($request->method == 'login' && $request->class == 'Account'){
                $request = new Request('index','Index',$request->params);
            }
        }
    }
    
    public function classExit(&$response, $app){
        
    }
    
    public function applicationExit(&$response, $app){
        
    }
    
    private function isPublic($request){
        if(strpos($request->nsClassName, 'Application\\Controller\\Open\\') !== false){
            return true;
        }
        if($request->class == 'Account' && ($request->method == 'login' || $request->method == 'logout')){
            return true;
        }
        return false;
    }
}