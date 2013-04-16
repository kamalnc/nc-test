<?php

/**
 * Description of module_4Data
 *
 * @author slyo
 */
class choose_or extends Resource_Plugin_Abstract  {

	private $randomNumber;

	public function __construct() {
		$this->randomNumber = rand(0, 10);
	}

	 public function extractData() {
		return array(
                'roomNumber' => $this->randomNumber);
        }
}

?>
