<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of data
 *
 * @author Bastiaan
 */
class start_incision extends Resource_Plugin_Abstract {

	private $start_incision_time;

	
	function init(){
		$this->retrieveStartIncisionTime();
	}
	
	private function retrieveStartIncisionTime(){
                $this->start_incision_time = 'N.K.';
		//todo
	}
	
	public function extractData() {
        return array(
           'start_incision_time'  => $this->start_incision_time  );
    }


}

?>
