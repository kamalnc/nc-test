<?php
/**
 * Description of Model_Row_Plugin
 *
 * @author 
 */
class Model_Row_Plugin extends Centurion_Db_Table_Row_Abstract {

    //private $plugin_rowset = null;

    private $rs_data_object = null;

  
    /**
     * 
     * @return \class
     */
   public function get_resource() {
       
        $rs_data_object = null;
        if (!$this->rs_data_object) {
            $class = $this->name;
            $dir = $this->get_resource_dir();
            if(false !== $dir && file_exists($dir . '/data.php')) {
                if (!class_exists($class)) {
                    require_once $dir . '/data.php';
                }
                $rs_data_object = new $class();
            }
        }
        $this->rs_data_object = $rs_data_object;
        return $rs_data_object;
    }
    
    
 

    /**
     * Classes are named spaced using their plugin name
     * this returns that plugin name or the first class name segment.
     *
     * @return string This class namespace
     */
    private function _getNamespace() {
        $ns = explode('_', get_class($this));
        return $ns[0];
    }
    
    /**
     * 
     * @return string plugin path
     */
    private function get_resource_dir() {
        $dir =  PLUGINS_PATH . "/" . $this->name;
        return is_dir($dir)? $dir: false;
    }

    /**
     * Get a resource
     *
     * @param string $name
     * @return SF_Model_Resource_Interface 
     */
    public function getResource($name) {
        if (!isset($this->_resources[$name])) {
            $class = join('_', array(
                $this->_getNamespace(),
                'Resource',
                $this->_getInflected($name)
                    ));
            $this->_resources[$name] = new $class();
        }
        return $this->_resources[$name];
    }

}