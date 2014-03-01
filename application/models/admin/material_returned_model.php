<?php

/*
*	Filename: notification_model.php
*	Project Name: ICS Library System
*	Date Created: 26 January 2014
*	Created by: Charlene C. Canedo
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material_returned_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		//loads the database to allow to allow selection and insertion of data
		$this->load->database();
	}
	
	/*
	*	Gets all the idnumber in the system
	*/
	public function get_idnumber() {
		$query = $this->db->query('SELECT idnumber FROM borrower');
		return $query->result();
	}//end of get_idnumber
	
	public function update_start_date( $materialid, $idnumber, $time ){
		$query = "UPDATE reservation SET started = 1, startdate = '${time}' WHERE materialid LIKE '${materialid}' AND idnumber LIKE '${idnumber}'";
		$this->db->query($query);
	}

	public function notify( $materialid, $idnumber, $message ){
		$read =	0;
		//current date and time
		date_default_timezone_set("Asia/Dubai");
		$time = date('Y-m-d H:i:s');

		//stores the inputs to an array and finally insert it to table notification	
        $data = array(
					'idnumber'=>$idnumber,
					'materialid'=>$materialid,
					'message'=>$message,
					'finished'=>$read,
					'time'=>$time
				);
		
		$this->db->insert('notification', $data); 
		$this->update_start_date( $materialid, $idnumber, $time );

	}//end of process

}//end of class


?>