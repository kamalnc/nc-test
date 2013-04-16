<?php

class Zend_View_Helper_CssHelper extends Zend_View_Helper_Abstract {

    function cssHelper($plugins = array()) {

        $stylesheet = '';
        foreach ($plugins as $plugin) {
                $cssPath = PLUGINS_PATH . "/" . $plugin  . '/stylesheet.css';
                if (file_exists($cssPath)) {
                    $css = file_get_contents($cssPath);
                    // look for any # selector, except the module's name
                    //$pattern = '/#(?!' . $plugin . ')(.+)\s*{/';
                    // prefix the # selector with the module's name
                    $stylesheet .= $css;
                }
        }
        $this->view->headStyle()->appendStyle($stylesheet);
        return $this->view->headStyle();
    }

}