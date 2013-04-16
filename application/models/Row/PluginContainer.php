<?php
/**
 * Description of Layout
 *
 * @author 
 */

class Model_Row_PluginContainer extends Centurion_Db_Table_Row_Abstract {
    
    private $plugin = null;
    
    /**
     * 
     * @return Model_Rowset_Plugin
     */
    function get_plugin() {
        
       if(!$this->plugin) {
            $this->plugin = $this->findParentRow('Model_Row_Plugin');
        }
        return $this->plugin;
    }
}