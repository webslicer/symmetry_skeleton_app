<?php
namespace Application\Controller\Dashboard;
use Symmetry\Controller,
Application\Bootstrap as App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subview1
 *
 * @author cdesully
 */
class Party extends Controller
{
    /**
     * @menu Party
     */
    public function hard(){
        $str = "Party Hard Whooo!!";
        $extraData = [1,1,2,3,5,8,13];
        return ['motto'=>$str, 'fib'=>$extraData];
    }
    
    public function add($number){
        return ['number'=>$number+1];
    }
}
