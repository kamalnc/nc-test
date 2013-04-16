<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ab_time extends Resource_Plugin_Abstract {

    private $maxValue;
    private $minValue;
    private $currValue;

    function init() {
        $this->setMinValue();
        $this->setMaxValue();
        $this->setCurrentValue();
    }

    private function setMinValue() {
            $sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
              $this->minValue = $this->_db->fetchOne($sql, 'ab_time_min');
    }

    private function setMaxValue() {
            $sql = 'SELECT `value` FROM `okp_config` WHERE `name` = ?';
              $this->maxValue = $this->_db->fetchOne($sql, 'ab_time_max');
    }

    private function setCurrentValue() {
        $sql = 'SELECT pi.gift_ts_delta FROM powi_info pi
					INNER JOIN operations o 
					ON pi.operation_ID = o.ID
					WHERE pi.operation_ID = ?';
        //todo echte data
         $ab_delta = $this->_db->fetchOne($sql, 598);
         if ($ab_delta == null) {
                    $this->currValue = '-';
         }else{
                $ab_delta_time = new DateTime('@' .  $ab_delta);
                    $minutes = $ab_delta_time->format('i');
                    $hours = $ab_delta_time->format('H');
                    $this->currValue = (($hours * 60) + $minutes);
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
