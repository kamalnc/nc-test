<?php

class Model_DbTable_Layout extends Centurion_Db_Table_Abstract {
    
    /**
     * The table name
     * 
     * @var string
     */
    protected $_name = 'okp_layout';
    
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
    //protected $_rowClass = 'Model_Row_PowiInfo';
 
    /**
     * Simple array of class names of tables that are "children" of the current table.
     * 
     * @var array
     */
    protected $_dependentTables = array('Model_DbTable_PluginContainer');
    
    protected $_rowClass = 'Model_Row_Layout';
    
    
    public function getLayoutByRoomID($room_ID) {
        $room_ids = array(0, $room_ID);
        return $this->fetchRow(
                        $this->select()->where('room_ID IN (?)', $room_ids)->order('room_ID DESC')
                    );
    }
    
}