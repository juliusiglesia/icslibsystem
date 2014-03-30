<?php

/*
*	Filename: check_user_model.php
*	Project Name: ICS Library System
*	Created by: Borrower's Team
*
*/

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Check_user_model extends CI_Model
{
	
	public function _construct()
	{
		parent :: _construct();
	}

	public function check_email()
	{
		$this->load->database();
		$email = $this->input->post('email');
		
		$stmt = "SELECT * FROM `borrower` WHERE email = '{$email}' or idnumber = '{$email}'";

		$query = $this->db->query($stmt);
		return $query->num_rows();
	}

	public function check_email_activation()
	{
		$this->load->database();
		$email = $this->input->post('email');
		
		$stmt = "SELECT * FROM `borrower` 
					WHERE (email = '{$email}' OR idnumber = '{$email}') 
					AND status = 'DEACTIVATED'";

		$query = $this->db->query($stmt);
		return $query->num_rows();
	}
	
	public function check_password()
	{
		$this->load->database();
		$email = $this->input->post('email');
		$password = sha1($this->input->post('pword'));
		
		$stmt = "SELECT * FROM `borrower` 
					WHERE (email = '{$email}' OR idnumber = '{$email}') 
					AND password ='{$password}' AND status = 'ACTIVATED'";

		$query = $this->db->query($stmt);
		return $query->num_rows();
	}
}
	/* 	End of file check_user_model.php
	* 	Location: ./application/models/user/check_user_model.php 
	*/
?>