<?php
/**
* @package jediCounter
* @author    Florian Lonqueu-Brochard
* @copyright 2011 Florian Lonqueu-Brochard
* @license    MIT
*/

class demoCtrl extends jController {
    /**
    *
    */
    function index() {
        $rep = $this->getResponse('html');

        $rep->addStyle('code', 'background: #f3f3f3; padding:5px;');

        $counterService = jClasses::getService("jediCounter~counterService");

        $counter1 = $counterService->get(5, 'like');

        $content = '<h2>Classic usage</h2>';
        $content .= "<code>jZone::get('jediCounter~incrementCounter', array('subject_id' => 5, 'scope' => 'like'))</code>";
        $content .= '<p>Valeur du compteur : '. $counter1 .'</p>';
        $content .= jZone::get('jediCounter~incrementCounter', array('subject_id' => 5, 'scope' => 'like'));


        $counter2 = $counterService->get(3, 'use');
        
        $content .= '<h2>With custom text</h2>';
        $content .= "<code>jZone::get('jediCounter~incrementCounter', array('subject_id' => 3, 'scope' => 'use', 'text' => 'I use this plugin'))</code>";
        $content .= "<p>Nombre d'utilisateurs de ce plugin: ". $counter2.'</p>';
        $content .= jZone::get('jediCounter~incrementCounter', array('subject_id' => 3, 'scope' => 'use', 'text' => 'I use this plugin'));


        $counter3 = $counterService->get(1, 'use');

        $content .= '<h2>Easily CSS customisable</h2>';
        $content .= "<code>jZone::get('jediCounter~incrementCounter', array('subject_id' => 1, 'scope' => 'use', 'text' => 'I use it'))</code>";
        $content .= "<p>Nombre d'utilisateurs de ce module: ". $counter3.'</p>';
        $content .= jZone::get('jediCounter~incrementCounter', array('subject_id' => 1, 'scope' => 'use', 'text' => "I use it"));
        
        $rep->addStyle('#jedicounter-1-use', 'background-color:#dff4ff; border:1px solid #c2e1ef;color:#336699; padding:5px 10px 6px 7px; font-weight:bold; cursor:pointer;');
        $rep->addStyle('#jedicounter-1-use:hover, #jedicounter-1-use:focus', 'background-color:#6299c5;border:1px solid #6299c5;color:#fff;');
        
        $rep->body->assign('MAIN', $content);

        return $rep;
    }
}

