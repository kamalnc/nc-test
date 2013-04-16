<?php

class Zend_View_Helper_JavascriptHelper extends Zend_View_Helper_Abstract {

    function javascriptHelper($plugins = array()) {
        $js = 'var moduleScripts = {};' . PHP_EOL;
        foreach ($plugins as $plugin) {
            //@todo: legacy code...

            $jsPath = PLUGINS_PATH . "/" . $plugin . '/script.js';

            if (file_exists($jsPath)) {
                $jsUnparsed = file_get_contents($jsPath);
                if (!empty($jsUnparsed)) {
                    $js .= 'moduleScripts.' . $plugin . ' = ';
                    $pattern = '/var.*{/';
                    $jsParsed = trim(preg_replace($pattern, '{', $jsUnparsed));
                    if (substr($jsParsed, -1) == ';') {
                        $jsParsed = substr($jsParsed, 0, strlen($jsParsed) - 1);
                    }
                    $js .= $jsParsed;
                    $pattern = '/\(\'#(?!' . $plugin . ')(.+)\'\)/';
                    // prefix the # selectors with the module's name
                    //  $js = preg_replace($pattern, '(\'#' . $plugin . '_$1\')', $js);
                    $js .= ';' . PHP_EOL;
                }
            }
        }
        $this->view->headScript()->appendScript($js);
    }

}
