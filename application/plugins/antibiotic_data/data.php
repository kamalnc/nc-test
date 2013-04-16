<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class antibiotic_data extends Resource_Plugin_Abstract{

	private $abDataString = '';
	
 function init() {
		//$this->retrieveTimeGiven();
		//$this->retrieveAbName();
		//$this->retrieveDose();
	}
	
	private function retrieveTimeGiven(){
//		if ($this->operation->getState() == OperationState::NULL_OPERATION) {
//			$this->time = '';
//		}
//		$operationID = $this->operation->getId();
//		try {
//			$statement = $this->db->prepare('SELECT pia.gift_ts FROM powi_info_ab pia
//												INNER JOIN powi_info pi 
//												ON pia.powi_ID = pi.ID
//												WHERE pi.operation_ID = :operation
//											    ORDER BY pia.gift_ts DESC');
//			$statement->bindParam(':operation', $operationID, PDO::PARAM_INT);
//			$statement->execute();
//			$i = 0;
//			while($row = $statement->fetch()){
//				if($i < 3){
//					$timeAbGiven = new DateTime('@' . $row['gift_ts']);
//					$dbTime = $timeAbGiven->format('H:i');
//					$this->abDataString .= '<div id=\'time_given' . $i . '\'>' .$dbTime. '</div>';
//				}
//				$i++;
//			}
//		} catch (PDOException $ex) {
//			exit($ex);
//		}
	}
	
	private function retrieveAbName(){
//		if ($this->operation->getState() == OperationState::NULL_OPERATION) {
//			$this->abName = '';
//		}
//		$operationID = $this->operation->getId();
//		try {
//			$statement = $this->db->prepare('SELECT pa.antibioticum_type FROM powi_antibioticum pa
//												INNER JOIN powi_info_ab pia 
//												ON pa.ID = pia.antibioticum_ID
//												INNER JOIN powi_info pi 
//												ON pia.powi_ID = pi.ID
//												WHERE pi.operation_ID = :operation
//												ORDER BY pia.gift_ts DESC');
//			$statement->bindParam(':operation', $operationID, PDO::PARAM_INT);
//			$statement->execute();
//			$i = 0;
//			while ($row = $statement->fetch()) {
//				if($i < 3){
//					$abDbName = ($row['antibioticum_type']);
//					$this->abDataString .= '<div id=\'antibiotic_name' . $i . '\'>' .$abDbName. '</div>';
//				}
//				$i++;
//			}
//		} catch (PDOException $ex) {
//			exit($ex);
//		}
	}
	
	private function retrieveDose() {
//		if ($this->operation->getState() == OperationState::NULL_OPERATION) {
//			$this->dose = '';
//		}
//		$operationID = $this->operation->getId();
//		try {
//			$statement = $this->db->prepare('SELECT pia.dose FROM powi_info_ab pia
//												INNER JOIN powi_info pi 
//												ON pia.powi_ID = pi.ID
//												WHERE pi.operation_ID = :operation 
//												ORDER BY pia.gift_ts DESC ');
//			$statement->bindParam(':operation', $operationID, PDO::PARAM_INT);
//			$statement->execute();
//			$i = 0;
//			while ($row = $statement->fetch()) {
//					if ($i < 3) {
//						$abDose = $row['dose'];
//						$this->abDataString .= '<div id=\'dose' . $i . '\'>' .$abDose. ' mg</div>';
//					}
//				$i++;
//			}
//		} catch (PDOException $ex) {
//			exit($ex);
//		}
	}
	
	public function extractData() {
		//return array('abDataString' => $this->abDataString);
	}

}
?>
