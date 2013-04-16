<?php
/**
 * Description of data
 *
 * @author Bastiaan
 */
class temp_patient extends Resource_Plugin_Abstract{

	private $maxValue;
	private $minValue;
	private $currValue;
	
	public function init() {
		$this->setMinValue();
		$this->setMaxValue();
		$this->setCurrentValue();
	}
	
	public function setMinValue(){
		$sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                $this->minValue = $this->_db->fetchOne($sql, 'temp_patient_min');
	}
	
	public function setMaxValue(){
		$sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
                $this->maxValue = $this->_db->fetchOne($sql, 'temp_patient_max');
	}
	
	public function setCurrentValue(){
            //if(geen eindtijd)
		$sql = 'SELECT temp_holding
				FROM powi_info
				WHERE operation_ID 
				= ?';
            //else(wel eindtijd)
		//$sql = 'SELECT temp_ok
		//	FROM powi_info
		//	WHERE operation_ID 
                  //      = :operation';
                //todo echte data
               // $this->currValue = $this->_db->fetchOne($sql, 598); //room nog ophalen 	
                $this->currValue = 37;
	}
	
	public function extractData() {
        return array(
            'maxValue' => $this->maxValue,
            'minValue' => $this->minValue ,
            'currValue' => $this->currValue);
    }
	

}

?>
