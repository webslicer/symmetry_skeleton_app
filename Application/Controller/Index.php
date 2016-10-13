<?php
namespace Application\Controller;
use Symmetry\Controller,
Application\Bootstrap as App;

class Index extends Controller{

    /**
     * @menu Main
     * @param string $fxParam
     * @param \Application\Helpers\Input\GenericForm $test
     * @return type
     */
    public function index($fxParam, \Application\Helpers\Input\ExampleForm $form){
        
		if(!empty($fxParam)){
			$fxParam .= ' altered';
		}
        if(!$this->isPost()){
            $form->resetErrors();
        } else if(!$form->hasError()){
            $this->forward('feedback', ['msg'=>'fantastic, you pass.']);
            return;
        }
        
		return ['fxParam'=>$fxParam,'form'=>$form];
    }   
    
    public function feedback($msg){
        return ['success'=>true, 'msg'=>$msg];
    }
    
    /**
     * @menu Construction Zone
     */
    public function underconstruction(){
        $this->trigger('pagetitle',['title'=>'constr zone']);
    }
        
    public function __call($method,$params){
        $this->forward('underconstruction');
    }
}