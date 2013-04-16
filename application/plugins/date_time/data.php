<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class date_time  extends Resource_Plugin_Abstract {

	private $date;
	private $day;
	private $time;

	function __construct() {
		$currentTime = new DateTime();
		$dateFormatter = new IntlDateFormatter('nl_NL', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
		$timeFormatter = new IntlDateFormatter('nl_NL', IntlDateFormatter::NONE, IntlDateFormatter::SHORT);
		$this->date = $dateFormatter->format($currentTime);
		$this->time = $timeFormatter->format($currentTime);

		$dateFormatter->setPattern('EEEE');
		$this->day = ucfirst($dateFormatter->format($currentTime));
	}

	public function extractData() {
		return array(
                'day' => $this->day, 
                'time' => $this->time, 
                'date' => $this->date);
        }

}

?>
