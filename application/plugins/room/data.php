<?php

/**
 * Description of 
 *
 * @author slyo
 */
class Room extends Resource_Plugin_Abstract {

	private $roomName;

	function init() {
		$this->retrieveRoomNameFromDB();
	}

	private function retrieveRoomNameFromDB() {
		$sql = 'SELECT name FROM rooms WHERE ID = ?';
                //todo echte data
		$this->roomName = $this->_db->fetchOne($sql, 4);
	}

	public function extractData() {
		return array(
                'roomName' => $this->roomName);
        }
	

}

?>
