<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Controller;

use Symmetry\Controller;

/**
 * Description of Layout
 *
 * @author cdesully
 * @parent layout/top-layout.php
 */
class Layout extends Controller
{
    public function menuLayout(){
        $title = 'symmetry skeleton';
        $this->listen('pagetitle', function($e) use (&$title){
            if(!empty($e->params['title'])){
                $title = $e->params['title'];
            }
            return false;
        });
        $this->response->parent = \Symmetry\Response::getInstance($this->response->parent,['content'=>$this->response, 'title'=>$title]);
        $currReq = $this->request->getInitRequest();
        $link = \Symmetry\Request::toUrlForm($currReq->class.'/'.$currReq->method);
        return ['leftMenu'=>$this->call('getMenu', 'Layout\Menu', ['selected'=>$link])];
    }
    
    /**
     * @parent layout/menu-layout
     */
    public function crumbBar(){
        
    }
    
    public function changeLayout($role, $currCat){
        $_SESSION['role'] = $role;
        $this->redirect($currCat);
    }
    
    public function commonFooter(){
        return ['msg'=>'This footer is MVC derived from within the primary MVC view rendering process.'];
    }
}
