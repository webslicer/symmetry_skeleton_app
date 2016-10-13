<?php 
date_default_timezone_set('UTC');

include __DIR__ . '/Application/config/config.php';
include __DIR__ . '/Application/Library/Symmetry/Setup.php';

try{
    //setup framework options
    Symmetry\Setup::init($config);
    
    //setup application options
    Application\Bootstrap::setConfig($config);
    $result = Application\Bootstrap::run();
}catch(Exception $e){
    $result = $e->getMessage();
}
echo $result;