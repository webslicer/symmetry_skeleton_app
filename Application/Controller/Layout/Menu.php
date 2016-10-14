<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Controller\Layout;
use Symmetry\Controller;
/**
 * Description of Menu
 *
 * @author cdesully
 */
class Menu extends Controller
{
    /**
     * 
     * @param type $selected
     * @return type
     */
    public function getMenu($selected=null){
        //read controller functions for docblock @menu attribute and cache
        //match calling class/fx to cached results and build menu array.
        $menuArr = [];
        $path = realpath(__DIR__.'/..');
        foreach (new \RecursiveIteratorIterator(
           new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::KEY_AS_PATHNAME), \RecursiveIteratorIterator::CHILD_FIRST) as $file => $info) {
            if ($info->isFile())
            {
                $classStr = '\Application\\'.substr($file,strpos($file, 'Controller'));
                $classStr = substr($classStr,0,strpos($classStr,'.php'));
                $classStr = str_replace('/', '\\', $classStr);
                $refl = new \ReflectionClass($classStr);
                if($refl->isInstantiable()){
                    $methods = $refl->getMethods(\ReflectionMethod::IS_PUBLIC);
                    foreach($methods as $method){
                        $docComment = $method->getDocComment();
                        $expr = "/@menu\s(.+)(?:\r|\n|\r\n)?/";
                        preg_match_all($expr, $docComment, $matches);
                        $filters = $matches[1];
                        foreach($filters as $key=>$filter){
                            $filters[$key] = preg_replace(array("/(?:\r\n)|\r|\n/","/\s+(?:\*\s+)?/"),array('',' '),$filter);
                        }
                        if(!empty($filters)){
                            $text = $filters[0];
                            $class = substr($refl->getName(), strlen('Application\Controller\\'));
                            $link = \Symmetry\Request::toUrlForm($class.'\\'.$method->getName());
                            $menuArr[$link] = $text;
                        }
                    }
                }
            }
        }
        
        if(!empty($selected) && isset($menuArr[$selected])){
            $text = $menuArr[$selected];
            $menuArr[$selected] = ['selected'=>$text];
        }
        return ['categories'=>$menuArr];
    }
}
