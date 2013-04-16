<?php

class Model_DbTable_Room extends Centurion_Db_Table_Abstract {
    
    /**
     * The table name
     * 
     * @var string
     */
    protected $_name = 'rooms';
    
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
    protected $_dependentTables = array();
    
    
    protected $_referenceMap    = array(
        'Unit' => array(
            'columns'           => 'unit',
            'refTableClass'     => 'Model_DbTable_Unit',
            'refColumns'        => 'ID'
                )
        );
    
   
    
    public function getRooms() {
        return  $this->getAdapter()->fetchAll('SELECT r.ID, r.name as name, u.name as unit, l.name as location
					FROM rooms r
			                LEFT JOIN units u ON r.unit = u.ID
					LEFT JOIN locations l ON u.location = l.ID
			                WHERE r.active = 1
					ORDER BY u.name, r.name ASC');
    }
    
    
}