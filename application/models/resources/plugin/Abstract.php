<?php

abstract class Resource_Plugin_Abstract implements Resource_Plugin_Interface 
{
    /**
     *
     * @var Centurion_Db_Adapter_Abstract
     */
    protected $_db = null;
    
    public function __construct() {
        if(!$this->_db) {
            $this->_db = Zend_Registry::get("db");            
        }
        $this->init();
    }   
    
    protected function init() {
        
    }
    
    protected function getRoomID() {
        $fc = Zend_Controller_Front::getInstance();
        return $fc->getRequest()->getParam('room');
    }
    
    protected function getLastOperation($roomID) {
       return Model_DbTable_Operation::getLastOperation($roomID);
    }
    
}

