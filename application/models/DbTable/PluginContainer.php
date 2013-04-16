<?php

class Model_DbTable_PluginContainer extends Centurion_Db_Table_Abstract {
    
    /**
     * The table name
     * 
     * @var string
     */
    protected $_name = 'okp_plugin_container';
    
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
    protected $_rowClass  = 'Model_Row_PluginContainer';
    
    /**
     * Classname for rowset
     * 
     * @var string
     */
    protected $_rowsetClass  = 'Model_Rowset_PluginContainer';
 
    /**
     * Simple array of class names of tables that are "children" of the current table.
     * 
     * @var array
     */
    protected $_dependentTables = array();
    
    
    protected $_referenceMap    = array(
        'Layout' => array(
            'columns'           => 'layout_ID',
            'refTableClass'     => 'Model_DbTable_Layout',
            'refColumns'        => 'ID'
                ),
        'Plugin' => array(
            'columns'           => 'plugin_ID',
            'refTableClass'     => 'Model_DbTable_Plugin',
            'refColumns'        => 'ID'
                )
        );
    
    
    
    
   
    
    
}
