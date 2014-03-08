<?php

/*
*	Filename: notification_model.php
*	Project Name: ICS Library System
*	Date Created: 26 January 2014
*	Created by: Charlene C. Canedo
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model{

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

	public function notify( $materialid, $idnumber, $isbn){	
		echo $materialid."<br />";
		echo $idnumber."<br />";
		echo $isbn."<br />";
		
		date_default_timezone_set("Asia/Manila");
		$time = date('Y-m-d H:i:s');
		$claimdate = date("Y-m-d", strtotime($time . "+2 day"));
		if(date('l', strtotime($time)) == "Friday") $claimdate = date("Y-m-d", strtotime($claimdate . "+2 day"));

		$query = "UPDATE reservation SET started = 1, startdate = '${time}', claimdate = '${claimdate}' WHERE materialid LIKE '${materialid}' AND idnumber LIKE '${idnumber}' AND isbn LIKE '${isbn}'";
		echo $query;
		$this->db->query($query);
	}
}//end of class

?>