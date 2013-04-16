<?php
/**
 * Description of data
 *
 * @author Bastiaan
 */
class expected_endtime extends Resource_Plugin_Abstract {
	
	private $endTime;
	
	function init(){
		$this->retrieveExpectedEndTime();
	}
	
	private function retrieveExpectedEndTime(){
            //todo goed maken
//		$sql = 'SELECT o.avg_op_time FROM operations o WHERE o.ID = ? ';
//                $avgTime = $this->_db->fetchOne($sql, $this->operation_id);
//                if($avgTime == null || $avgTime == 0){
//				$this->endTime = 'N.n.b.';
//			}else{
//				$timeTemp = new DateTime($avgTime);
//				$hour = $timeTemp->format('H');
//				$min =	$timeTemp->format('i');
//				$timeStart = $this->operation->getStart();
//				$newTime = $timeStart->add(new DateInterval('PT' .$hour. 'H' .$min. 'M'));
//				$this->endTime = $newTime->format('%i');
//		}		
	}
	
	public function extractData() {
		return array('end_time' => $this->endTime);
		
	}
	

}

?>
