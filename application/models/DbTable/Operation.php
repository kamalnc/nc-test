<?php

class Model_DbTable_Operation extends Centurion_Db_Table_Abstract {
    
    /**
     * The table name
     * 
     * @var string
     */
    protected $_name = 'operations';
    
     /**
     * The primary key column or columns
     * 
     * @var mixed
     */
    protected $_primary = array('ID');
 
    /**
     * Classname for row
     * 
     * @var string
     */    
    protected $_rowClass = 'Model_Row_Operation';
    
    /**
     *
     * @var type 
     */
    protected static $_lastOperation = null;
    
    public static function getLastOperation($roomID) {
        if(null === self::$_lastOperation) {
            $table = new self();
            self::$_lastOperation = $table->fetchRow($table->select()->where('room = ?', $roomID)->order('ID DESC'));
            //self::$_lastOperation = $model->find(1)->current();
            
        }
        return self::$_lastOperation;
    }
    
}