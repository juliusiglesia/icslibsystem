<?php

/*
*	Filename: clear_reservation_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clear_reservation_model extends CI_Model{
	public function __construct(){
			
	}

	public function clear(){
		$query = "TRUNCATE TABLE reservation";
		$this->db->query($query);

		//insert into log
		//Admin cleared the reservation table
		$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
						  VALUES( 'cleared reservation', NOW(), 'Admin')";
		$this->db->query($stmt);				  
	}
}

?>