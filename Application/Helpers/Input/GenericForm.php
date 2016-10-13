<?php
namespace Application\Helpers\Input;
use Symmetry\Request\Form as Form;

//example class for accepting user input and all input
class GenericForm extends Form{
    /**
     * Test docblock for filtering
     * @var $test
     * @filter="FILTER_VALIDATE_INT,array('options'=>array('default' => 5,'min_range' => 0))"
     */
    public $test=0;
    
    public $test2;
    
    public function init(){
        //for establishing user values not existing in the GenericInput object
        //normally Input objects would be predefined by properties
        foreach ($this->request->params as $key=>$param){
            //for the following, params can't be filtered because nature of value is unknown
            $this->$key = $param;
        }
    }
}