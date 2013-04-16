<?php
class Resource_Dashboard_Item {

    public $height;
    public $width;
    public $popup;
    public $popuptext;
    public $plugin_name;
    public $plugin_class;
    public $data_object;

    function __construct(Model_Row_PluginContainer $plugin_container) {

        $this->height = $plugin_container->height;
        $this->width = $plugin_container->width;
        $plugin = $plugin_container->get_plugin();        
        if ($plugin instanceof Model_Row_Plugin) {
            $this->plugin_name = $plugin->name;
            $this->plugin_class = $plugin->class;
            $this->popup = $plugin->popup;
            $this->popuptext    = $plugin->popuptext;
            $this->data_object = $plugin->get_resource();
        }
    }

}
