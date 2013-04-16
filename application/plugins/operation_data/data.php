<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class operation_data extends Resource_Plugin_Abstract{
	
	private $specialist_name;
	private $operation_name;
	
	function init() {
		$this->retrieveSpecialistName();
		$this->retrieveOperationName();
	}
	
	private function retrieveSpecialistName() {
		$sql = 'SELECT s.name FROM specialist s INNER JOIN operations o ON s.ID = o.specialist 
			WHERE o.ID = ?';
                //todo echte data
                $this->specialist_name = $this->_db->fetchOne($sql, 598);
	}
	
	private function retrieveOperationName(){
		$sql = 'SELECT ctgd.name FROM ctg_description ctgd INNER JOIN operations o ON ctgd.ID = o.ctg_description
                        WHERE o.ID = ?';
                //todo echte data
                 $this->operation_name = $this->_db->fetchOne($sql, 598);
	}
		
         public function extractData() {
        return array(
           'specialist_name'  => $this->specialist_name,
            'operation_name' => $this->operation_name );
    }
}
?>
