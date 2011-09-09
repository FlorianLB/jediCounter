<?php
/**
* @package jediCounter
* @author    Florian Lonqueu-Brochard
* @copyright 2011 Florian Lonqueu-Brochard
* @license    MIT
*/

class saveCtrl extends jController {
    
    /**
    * Classic save with redirection
    */
    function index() {
        
        $subject_id = $this->param('subject_id');
        $scope =$this->param('scope');
        
        
        $counterService = jClasses::getService("jediCounter~counterService");
        $counterService->increment($subject_id, $scope);



        $rep = $this->getResponse('redirect');
        $rep->action = $this->param('action_to_return');
        return $rep;
    }
    
    protected function increment($subject_id, $scope){
        
        
    }
    
    
    
    
}

