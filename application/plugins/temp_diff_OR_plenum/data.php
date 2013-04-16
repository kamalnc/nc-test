<?php

class temp_diff_OR_plenum extends Resource_Plugin_Abstract {
	
		private $maxValue;
		private $minValue;
		private $currValue;
	
	function init(){
		$this->setMinValue();
		$this->setMaxValue();
		$this->setCurrentValue();
	}
	
	private function setMinValue(){
		$sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                $this->minValue = $this->_db->fetchOne($sql, 'temp_diff_ok_min');
	}
	
	private function setMaxValue(){
		$sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                $this->maxValue = $this->_db->fetchOne($sql, 'temp_diff_ok_max');
	}
	
	private function setCurrentValue(){
		$sql = 'SELECT data
			 FROM sensor_delta_temperature_events AS g
			 LEFT JOIN sensors s
			ON g.sensorID = s.sensorID
			LEFT JOIN places p
			ON s.place = p.ID
			LEFT JOIN rooms r
			ON p.room = r.ID
			WHERE r.ID = ?
			AND g.insert_date >=  ?
			AND s.active = 1
			ORDER BY g.insert_date DESC
			LIMIT 1';
                //todo echte data
		$placeholders = array(4, '2013-03-03 14:00:00');    
                 $room_temp_diff = $this->_db->fetchOne($sql, $placeholders); //room nog ophalen 		
		$this->currValue = round($room_temp_diff, 2);
				
	}
	
	public function extractData() {
        return array(
            'maxValue' => $this->maxValue,
            'minValue' => $this->minValue ,
            'currValue' => $this->currValue);
    }
	
}
?>
