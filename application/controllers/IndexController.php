<?php

class IndexController extends Zend_Controller_Action {

    /**
     * @var Zend_Log
     */
    private $logger;

    public function init() {
        /* Initialize action controller here */
        $this->logger = Zend_Registry::get('log');
        $this->view->plugins = array();
    }

    public function indexAction() {
        $room = new Model_DbTable_Room();

        $this->view->rooms = $room->getRooms();
    }

    private function getDashboardByLayout($layout) {
        $dashboard = null;
        if ($layout) {
            $dashboard = new Model_Dashboard();
            $dashboard->setLayout($layout);
            $dashboard->addPlugins();
        }
        return $dashboard;
    }

    private function getLayoutByRoomID($room_id) {
        $layout = null;
        if ($room_id) {
            $layout_model = new Model_DbTable_Layout();
            $layout = $layout_model->getLayoutByRoomID($room_id);
        }
        return $layout;
    }

    public function updateAction() {

        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout->disableLayout();

        $room_id = $this->getRequest()->getParam('room', null);
        $data = array();
        if ($room_id) {
            $layout = $this->getLayoutByRoomID($room_id);
            $dashboard = $this->getDashboardByLayout($layout);
            $items = $dashboard->getPlugins();
            foreach ($items as $item) {
                if (method_exists($item->data_object, 'extractData')) {
                    $data[$item->plugin_name] = $item->data_object->extractData();
                }
            }
        }
        echo Zend_Json::encode($data);
    }

    public function showroomAction() {
        $room_id = $this->getRequest()->getParam('room', null);
        if ($room_id) {
            $layout = $this->getLayoutByRoomID($room_id);
            $dashboard = $this->getDashboardByLayout($layout);
            $this->view->plugins = $dashboard->getPluginsNames();
            $this->view->items = $dashboard->getPlugins();
            $this->view->layout = $layout;
            $this->view->room_id = $room_id;
        }
    }

}

