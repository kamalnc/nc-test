<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Layout
 *
 * @author Hunter
 */
class Model_Row_Layout extends Centurion_Db_Table_Row_Abstract {
    
    private $plugin_rowset = null;
    
    /**
     * 
     * @return Model_Rowset_Plugin
     */
    function get_plugincontainer_rowset() {
        
        if(!$this->plugin_rowset) {
            $this->plugin_rowset = $this->findDependentRowset('Model_DbTable_PluginContainer');
        }
        return $this->plugin_rowset;
    }

}