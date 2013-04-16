<?php

class Model_Dashboard implements SeekableIterator, Countable, ArrayAccess {

    /**
     * The dashboard item objects
     *
     * @var array
     */
    protected $_items = array();
    protected $_layout_row = null;

    /**
     * Constructor
     *
     * @param 
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Constructor extensions
     */
    public function setLayout($layout) {

        if ($layout instanceof Model_Row_Layout) {
            $this->_layout_row = $layout;
            return true;
        }
        return false;
    }

    public function addPlugins() {
        if (null !== $this->_layout_row) {
            $plugincontainer_rowset = $this->_layout_row->get_plugincontainer_rowset();

            foreach ($plugincontainer_rowset as $row) {

                $this->addItem($row);
            }
        }
    }

    public function getPlugins() {
        return $this->_items;
    }
    
    public function getPluginsNames(){
        $names = array();
        foreach($this->_items as $item){
           $names[] = $item->plugin_name;
        }
        return $names;
    }

    /**
     *
     */
    private function addItem(Model_Row_PluginContainer $plugin_container) {
        $item = new Resource_Dashboard_Item($plugin_container);
        $this->_items[] = $item;
    }

    /**
     * Does the given offset exist?
     *
     * @param string|int $key key
     * @return boolean offset exists?
     */
    public function offsetExists($key) {
        return isset($this->_items[$key]);
    }

    /**
     * Returns the given offset.
     *
     * @param string|int $key key
     * @return mixed
     */
    public function offsetGet($key) {
        return $this->_items[$key];
    }

    /**
     * Sets the value for the given offset.
     *
     * @param string|int $key
     * @param mixed $value
     */
    public function offsetSet($key, $value) {
        return $this->_items[$key] = $value;
    }

    /**
     * Unset the given element.
     *
     * @param string|int $key
     */
    public function offsetUnset($key) {
        unset($this->_items[$key]);
    }

    /**
     * Returns the current row.
     *
     * @return array|boolean current row 
     */
    public function current() {
        return current($this->_items);
    }

    /**
     * Returns the current key.
     *
     * @return array|boolean current key
     */
    public function key() {
        ;
        return key($this->_items);
    }

    /**
     * Moves the internal pointer to the next item and
     * returns the new current item or false.
     *
     * @return array|boolean next item
     */
    public function next() {
        return next($this->_items);
    }

    /**
     * Reset to the first item and return.
     *
     * @return array|boolean first item or false
     */
    public function rewind() {
        return reset($this->_items);
    }

    /**
     * Is the pointer set to a valid item?
     *
     * @return boolean valid item?
     */
    public function valid() {
        return current($this->_items) !== false;
    }

    /**
     * Seek to the given index.
     *
     * @param int $index seek index
     */
    public function seek($index) {
        $this->rewind();
        $position = 0;

        while ($position < $index && $this->valid()) {
            $this->next();
            $position++;
        }

        if (!$this->valid()) {
            throw new Centurion_Model_Exception('Invalid seek position');
        }
    }

    /**
     * Count the dashboard items
     *
     * @return int row count
     */
    public function count() {
        return count($this->_items);
    }

}