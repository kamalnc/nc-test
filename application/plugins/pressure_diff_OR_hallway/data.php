<?php

class pressure_diff_OR_hallway extends Resource_Plugin_Abstract {
	
	private $maxValue;
	private $minValue;
	private $currValue;
	
	function init(){
		$this->setMinValue();
		$this->setMaxValue();
		$this->setCurrentValue();
	}
	
	public function setMinValue(){
		$sql =  'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                  $this->minValue = $this->_db->fetchOne($sql, 'ok_pressure_min');
	}
	
	public function setMaxValue(){
		$sql =  'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                  $this->maxValue = $this->_db->fetchOne($sql, 'ok_pressure_max');
	}
	
	public function setCurrentValue(){
		$sql = 'SELECT data as delta_pressure
						FROM sensor_delta_pressure_events AS g
						LEFT JOIN sensors s
						ON g.sensorID = s.sensorID
						LEFT JOIN places p
                                                ON s.place = p.ID
						LEFT JOIN rooms r
						ON p.room = r.ID
						WHERE r.ID = ?
						AND g.insert_date > ?
						AND s.active = 1
						AND s.type = 2
						ORDER BY g.insert_date DESC';
                //todo echte data
                $placeholders = array(4, '2013-03-03 14:00:00');    
                $pressure = $this->_db->fetchOne($sql, $placeholders); //room nog ophalen    
		if($pressure == null){
                    $this->currValue = '-';
                }else{
                    $this->currValue = round($pressure, 2);
                }
	}
	
	public function extractData() {
		return array(
            'maxValue' => $this->maxValue,
            'minValue' => $this->minValue ,
            'currValue' => $this->currValue);
    }
	
}
?>
