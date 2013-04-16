<?php

/**
 * Description of data
 *
 * @author Bastiaan
 */
class doorcounter extends Resource_Plugin_Abstract {

	private $doorcount;
	private $standard;

	function init() {
		$this->retrieveStandard();
		$this->retrieveDoorcount();
	}

	private function retrieveStandard() {
		$sql = 'SELECT o.norm FROM operations o WHERE o.ID = ?';
                   // todo echte data
                $this->standard = $this->_db->fetchOne($sql, 598);
	}

	private function retrieveDoorcount() {
		$sql = 'SELECT SUM(step) as door_movements
							 FROM sensor_door_movement_events AS g
							 LEFT JOIN sensors s
								ON g.sensorID = s.sensorID
							 LEFT JOIN places p
								ON s.place = p.ID
							 LEFT JOIN rooms r
								ON p.room = r.ID
							 WHERE r.ID = ?
							 AND g.`timestamp` > ?
							 AND g.alive = 1
							 AND s.active = 1
							 AND s.type = 1';
                //todo echte data
                 $placeholders = array(4, '2013-03-03 14:00:00');    
                $this->doorcount = $this->_db->fetchOne($sql, $placeholders);
	}
	
	public function extractData() {
		return array('current_value' => $this->doorcount,
                               'standard' => $this->standard);
		
	}
	
}
?>
