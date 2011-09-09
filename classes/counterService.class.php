<?php
/**
* @package jediCounter
* @author    Florian Lonqueu-Brochard
* @copyright 2011 Florian Lonqueu-Brochard
* @license    MIT
*/

class counterService{
    
    protected static $daoName = 'jediCounter~counter';
    protected static $daoAlreadyName = 'jediCounter~already';
    
    protected $fieldname_uid= 'id';
    protected $dbprofil = '';
    
    function __construct(){
        if(isset($GLOBALS['gJConfig']->jediCounter['fieldname_uid']))
            $this->fieldname_uid = $GLOBALS['gJConfig']->jediCounter['fieldname_uid'];
            
        if(isset($GLOBALS['gJConfig']->jediCounter['profile']))
            $this->dbprofil = $GLOBALS['gJConfig']->jediCounter['profile'];
    }
    
    
    /**
     * Increment the counter, if it doesn't exist, create it
     * @return boolean    True if the counter have been incremented, false if it haven't
     */
    public function increment($subject_id, $scope){
        
        //must be authenticated
        if(!jAuth::isConnected()){
            return false;
        }
        
        $dao = jDao::get(self::$daoName, $this->dbprofil);
        $record = $dao->getCounter($subject_id, $scope);
        
        $fieldname_uid = $this->fieldname_uid;
        $uid = jAuth::getUserSession()->$fieldname_uid;
        
        if(!$record){
            $record = jDao::createRecord(self::$daoName, $this->dbprofil);
            $record->subject_id = $subject_id;
            $record->scope = $scope;
            $record->value=1;
            
            $dao->insert($record);
        }
        else{
            if($this->alreadySubmitted($uid, $record->id_counter))
                return false;
        
            $dao->incrementCounter($subject_id, $scope);
        }
        
        $this->hasSubmitted($uid, $record->id_counter);
            
        return true;
        
    }
    
    /**
     * @return int  The counter actual value, 0 if the counter doesn't exist
     */
    public function get($subject_id, $scope){
        $record = jDao::get(self::$daoName, $this->dbprofil)->getCounter($subject_id, $scope);
        
        if($record)
            return $record->value;
        else
            return 0;
    }
    
    /**
     * Current user does have already submitted this counter ?
     * @return boolean
     */
    public function alreadySubmitted($uid, $id_counter){
        if(jDao::get(self::$daoAlreadyName, $this->dbprofil)->get($uid, $id_counter))
            return true;
        else
            return false;
    }
    
    /**
     * Create and insert a record in the already table
     * @return Type    Description
     */
    private function hasSubmitted($uid, $id_counter){
        $already = jDao::createRecord(self::$daoAlreadyName, $this->dbprofil);
        $already->id_user = $uid;
        $already->id_counter = $id_counter;
        jDao::get(self::$daoAlreadyName, $this->dbprofil)->insert($already);
    }
    
    
}