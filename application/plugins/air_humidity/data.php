<?php
/**
 * 
 */
class air_humidity extends Resource_Plugin_Abstract {

    private $maxValue;
    private $minValue;
    private $currValue;

    function init() {
        $this->setMaxValue();
        $this->setMinValue();
        $this->setCurrValue();
    }

   
    /**
     * 
     */
    public function setMaxValue() {
        $sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
        $this->maxValue = $this->_db->fetchOne($sql, 'humidity_max');
    }

   
    /**
     * 
     */
    public function setMinValue() {
        $sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
        $this->minValue = $this->_db->fetchOne($sql, 'humidity_min');
    }

   
    /**
     * 
     */
    public function setCurrValue() {
       $sql = 'SELECT data as humidity_delta
							 FROM sensor_humidity_events AS g
							 LEFT JOIN sensors s
								ON g.sensorID = s.sensorID
							 LEFT JOIN places p
								ON s.place = p.ID
							 LEFT JOIN rooms r
								ON p.room = r.ID
							 WHERE r.ID = ?
							 AND g.insert_date > ?
							 AND s.active = 1
							 AND s.type = 4
							 ORDER BY g.insert_date DESC';
       $this->currValue = '-';
       $room_id = $this->getRoomID();
       
       if($room_id) {
        
        $operation = $this->getLastOperation($room_id);
      
           
        $placeholders = array($room_id, null);    
        $this->currValue = $this->_db->fetchOne($sql, $placeholders); //room nog ophalen 
        
       }
       
        
    }
    
    /**
     * 
     * @return type
     */
    public function extractData() {
        return array(
            'maxValue' => $this->maxValue,
            'minValue' => $this->minValue ,
            'currValue' => $this->currValue);
    }

}