<?php

/*
*	Filename: reservation_queue_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_info_model extends CI_Model{
	public function __construct(){
			
	}

	/*
	*	Gets the lists of the reservations in the system
	*/
	public function get_update_details($id) {

		$this->load->database();
		$query = $this->db->query("SELECT * FROM librarymaterial WHERE materialid = '$id'");
		
		$result = $query->row();
		
		$query2 = $this->db->query("SELECT fname, mname, lname FROM author WHERE materialid = '$id'");
		$result->author = $query2->result();
		//var_dump($result);
		return $result;
	}
}

?>