<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class patient_data extends Resource_Plugin_Abstract{

    private $patientnumber;
    private $gender;
    private $birthdate;

    function init() {
        $this->retrievePatientNumber();
        $this->retrieveGender();
        $this->retrieveBirthDate();
    }

    private function retrievePatientNumber() {
        $sql = 'SELECT p.pat_ID FROM powi_info p WHERE p.operation_ID = ? ';
        //todo echte data
        $this->patientnumber = $this->_db->fetchOne($sql, 598);
    }

    private function retrieveGender() {
        $sql = 'SELECT g.name FROM genders g
					INNER JOIN powi_patient pp ON g.ID = pp.sex
					INNER JOIN powi_info pi ON pp.pat_ID = pi.pat_ID 
					INNER JOIN operations o ON pi.operation_ID = o.ID
					WHERE o.ID = ? ';
         //todo echte data
        $this->gender = $this->_db->fetchOne($sql, 598);
        if ($this->gender == 'F') {
            $this->gender = 'Vrouw';
        } else if ($this->gender == 'M') {
            $this->gender = 'Man';
        } else {
            $this->gender = 'Onbekend';
        }
    }

    private function retrieveBirthDate() {
        $sql = 'SELECT p.dob FROM powi_patient p 
					INNER JOIN powi_info pi ON p.pat_ID = pi.pat_ID 
					INNER JOIN operations o ON pi.operation_ID = o.ID
					WHERE o.ID = ?';
         //todo echte data
        $birthdateTemp = $this->_db->fetchOne($sql, 598);
            if ($birthdateTemp == null) {
                $this->birthdate = 'Onbekend';
            } else {
                $date = new DateTime($birthdateTemp);
                $this->birthdate = $date->format('d/m/Y');
            }
    }

    public function extractData() {
		return array('patientnumber' => $this->patientnumber,
                    'gender' => $this->gender,
                    'birthdate' => $this->birthdate);
		
	}

}

?>
