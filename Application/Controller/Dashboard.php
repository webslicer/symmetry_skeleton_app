<?php
namespace Application\Controller;
use Symmetry\Controller,
Application\Bootstrap as App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 * 
 * @author cdesully
 */
class Dashboard extends Controller
{
    /**
     * @menu Dashboard
     */
    public function index(){
        $dashResponses = [];
        $dashResponses[] = $this->call('roll','Dashboard\Rock',['context'=>'widg']);
        $dashResponses[] = $this->call('hard','Dashboard\Party',['context'=>'widg']);
        return ['subviews'=>$dashResponses];
    }
    
    /**
     *
     * @param type $jsonBurst
     * @return type
     */
    public function ajaxBurst($jsonBurst)
    {
        $burstArr = (array) $jsonBurst;
        $callBack = [];
        foreach ($burstArr as $cbFx => $fx) {
            if (isset($fx['url'])) {
                $params = null;
                if (isset($fx['params'])) {
                    $params = $fx['params'];
                }
                $callBack[$cbFx] = $this->call(new \Symmetry\Request\UrlRequest($fx['url'], $params));
            } else {
                $callBack[$cbFx] = false;
            }
        }
        return ['callback' => $callBack];
    }
}
