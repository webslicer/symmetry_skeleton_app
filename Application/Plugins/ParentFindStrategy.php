<?php
namespace Application\Plugins;
use Application\Bootstrap as App;

class ParentFindStrategy implements \Symmetry\Interfaces\ParentFindInterface {
    
    public function __construct(){
        
    }

    public function getParent($class, $method)
    {
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
        $method = $role.'_'.$method;
        $parentArr = ['class'=>
                        ['method'=>'parentStr',
                         'methodArr'=>['parentStr','content'],
                         '224_method'=>'specialParentStr'],
                      'Application\Controller\Index'=>
                        ['m_index'=>'layout/crumb-bar']
                    ];
        if(isset($parentArr[$class])){
            $classArr = $parentArr[$class];
            if(isset($classArr[$method])){
                return $classArr[$method];
            }
        }
        return false;
    }
}