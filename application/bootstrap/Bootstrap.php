<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * @var Zend_Log
     */
    protected $_logger;

    /**
     * @var Zend_Application_Module_Autoloader
     */
    protected $_resourceLoader;

    /**
     * @var Zend_Controller_Front
     */
    public $frontController;

    protected function _initLogging() {
        $this->bootstrap('frontController');
        $logger = new Zend_Log();

        $writer = 'production' == $this->getEnvironment() ?
                new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/app.log') :
                new Zend_Log_Writer_Firebug();
        $logger->addWriter($writer);

        if ('production' == $this->getEnvironment()) {
            $filter = new Zend_Log_Filter_Priority(Zend_Log::CRIT);
            $logger->addFilter($filter);
        }

        $this->_logger = $logger;
        Zend_Registry::set('log', $logger);
    }

    /**
     * Loads app-wide constants from config file
     */
    protected function _initDefineConstants() {
        $ncConstants = $this->getOption('ncConstants');
        foreach ($ncConstants as $key => $value) {
            if (!defined($key))
                define($key, $value);
        }
    }

    /**
     * Init the db metadata and paginator caches
     */
    protected function _initDbCaches() {
        // Metadata cache for Zend_Db_Table
        $frontendOptions = array(
            'automatic_serialization' => true
        );
        $backendOptions = array(
            'cache_dir' => APPLICATION_PATH . '/../data/cache/meta'
        );

        $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions
        );
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
    }

    protected function _initResourceLoader() {

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'namespace' => '',
                    'basePath' => APPLICATION_PATH,
                ));
        $resourceLoader->addResourceType('model', 'models/', 'Model');
        $resourceLoader->addResourceType('form', 'forms/', 'Form');
        $resourceLoader->addResourceTypes(array(
            'modelResource' => array(
                'path' => 'models/resources',
                'namespace' => 'Resource',
            )
        ));

        return $resourceLoader;
    }

    protected function _initErrorDisplay() {
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->throwExceptions(true);
    }

    protected function _initDb() {
        $resource = $this->getPluginResource('db');
        $db = $resource->getDbAdapter();
        Zend_Registry::set("db", $db);
    }

    /**
     * Setup the database profiling
     */
    protected function _initDbProfiler() {

        if ('development' == $this->getEnvironment()) {
            $this->bootstrap('db');
            $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
            $profiler->setEnabled(true);
            $this->getPluginResource('db')->getDbAdapter()->setProfiler($profiler);
        }
    }

}

