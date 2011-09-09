<?php
/**
* @package jediCounter
* @author    Florian Lonqueu-Brochard
* @copyright 2011 Florian Lonqueu-Brochard
* @license   MIT
*/

class incrementCounterZone extends jZone {
    protected $_tplname='zone.incCounter';

    private static $default_text = '+1';


    protected function _prepareTpl(){

        $subject_id = $this->param('subject_id');
        $scope =$this->param('scope');
        $text = !$this->param('text') ? self::$default_text : $this->param('text');
        
        $this->_tpl->assign('subject_id', $subject_id);
        $this->_tpl->assign('scope', $scope);
        $this->_tpl->assign('text', $text);
        $this->_tpl->assign('action_to_return', $GLOBALS['gJCoord']->moduleName . '~' . $GLOBALS['gJCoord']->actionName);
    
        
    }
    
    
}
