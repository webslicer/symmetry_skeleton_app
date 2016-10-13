<?php
namespace Application\Helpers\Input;
use Symmetry\Request\Form as Form;

//example class for accepting user input and all input
class ExampleForm extends Form implements \Symmetry\Interfaces\ResponseInterface {
    
    public $name;
    
    public $address = 'preset';
    
    public $state;
    
    public $errMsg;
    
    public function init(){
        $this->resetErrors();
        if($this->name != 'John'){
            $this->errMsg['name'] = 'Please enter "John" as the value.';
            $this->error = true;
        }
        if($this->address != '55 Main'){
            $this->errMsg['address'] = 'Please enter "55 Main" as the value.';
            $this->error = true;
        }
        if($this->state != 'OR'){
            $this->errMsg['state'] = 'Please enter "OR" as the value.';
            $this->error = true;
        }
    }
    
    public function resetErrors(){
        $this->errMsg = ['name'=>'','address'=>'','state'=>''];
        $this->error = false;
    }
    
    public function getResponse()
    {
        $view = 'forms/example.html.php';
        if(!empty($this->request->params['context']) && $this->request->params['context'] == 'json'){
            $view = 'json';
        }
        return \Symmetry\Response::getInstance($view, $this);
    }
}