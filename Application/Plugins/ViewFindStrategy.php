<?php
namespace Application\Plugins;
//use Application\Application as App;

class ViewFindStrategy implements \Symmetry\Interfaces\ViewFindInterface {
    
    public function __construct(){
        
    }
    
    /**
     * search for view file by theme, role, or default
     * @param type $viewPathArr
     * @return boolean|string
     */
    public function getFile($viewPathArr){
        //1. theme_role_name
        //2. role_name
        //3. theme_name
        //4. name
        $origMethod = $viewPathArr['method'].'.'.$viewPathArr['media'].'.'.$viewPathArr['suffix'];
        $role = '';
        if(!empty($_SESSION['role'])){
            switch($_SESSION['role']){
                case 'user':
                    $role = 'u';
                    break;
                case 'manager':
                    $role = 'm';
                    break;
                case 'admin':
                    $role = 'a';
                    break;
            }
        }
        $pathOptions = [$role.'_'.$origMethod];
		/*
		alternative file spellings to look for added to pathOptions
		*/
		
        //prepend class directory to paths
        foreach($pathOptions as $key=>$path){
            $pathOptions[$key] = $viewPathArr['class'].'/'.$path;
        }
        
        foreach($pathOptions as $path){
            $viewPath = $viewPathArr['directory'].'/'. $path;
            if(file_exists($viewPath)){
                return $viewPath;
            }
        }
        return false;
    }
}