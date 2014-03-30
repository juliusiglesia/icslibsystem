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

	public function update_status($isbn, $materialid, $fine){

		$this->load->database();
		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');
		
		$query1 = "UPDATE borrowedmaterial SET status = 'RETURNED', actualreturn = '${date}', fine = '${fine}' WHERE isbn = '${isbn}' or materialid = '${materialid}'";
		$query2 = "UPDATE librarymaterial SET borrowedcopy = borrowedcopy-1, available = 1 WHERE isbn = '${isbn}' or materialid = '${materialid}'";
		$this->db->query($query1);
		$this->db->query($query2);
	}

}//end of class


?>