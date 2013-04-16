<?php

class Model_DbTable_Plugin extends Centurion_Db_Table_Abstract {
    
    /**
     * The table name
     * 
     * @var string
     */
    protected $_name = 'okp_plugin';
    
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
    protected $_rowClass  = 'Model_Row_Plugin';
    
    /**
     * Simple array of class names of tables that are "children" of the current table.
     * 
     * @var array
     */
    protected $_dependentTables = array('Model_DbTable_PluginContainer');
    
    
}
