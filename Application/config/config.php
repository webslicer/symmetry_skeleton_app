<?php
error_reporting(E_ALL);
$env = 'dev';
$config = array(
    'db'=>array(
            //local
            'host'=>'127.0.0.1',
            'username'=>'root',
            'password'=>'root',
            'database'=>'dbname'
            ),
    
    /*
    //if root directory is http://host/pathtoadd/controller/action then add the base_path config
    'base_path'=>'/pathtoadd'
    */
    'request'=>array(
        'base_path'=>'',        
        'enable_https'=>false,
        'default_method'=>'index',
        'default_class'=>'Index',
        'default_namespace'=>'Application\\Controller\\'
        ),
    'response'=>[
            'default_parent'=>'Layout/menuLayout',
            'view_directory'=> realpath(__DIR__.'/../view'),
            'exception_view'=>'error/error.php'
        ],
        
    'autoload'=>['Application'=>realpath(__DIR__.'/..'),
            'Doctrine\Common\Cache'=>realpath(__DIR__.'/../Library/Doctrine/Common/Cache')],
        
    'dev_mode'=>true
);

$config['request']['https_base_path'] = '';//if different than non-https base path
if(!empty($_SERVER['HTTPS'])){
    $config['request']['base_path'] = $config['request']['https_base_path'];
}
