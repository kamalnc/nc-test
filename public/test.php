<?php
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

$date = new Zend_Date();

$date->add('12:00:00', Zend_Date::TIMES);

echo "Date via get() = ", $date->get(Zend_Date::W3C), "\n";