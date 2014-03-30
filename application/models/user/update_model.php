<?php


/*
*	Filename: update_model.php
*	Project Name: ICS Library System
*	Created by: Borrower's Team
*
*/


if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Update_model extends CI_Model{
	
	public function _construct()
	{
		parent :: _construct();
	}
	
	
	/*
	*	Updates the email of current user
	*/
	public function update_email($email)
	{

		//save email address of current user to userdata
		$this->session->set_userdata('email',$this->input->post('email'));
		
		$data=array(
				'email' =>$email
		);
		
		//select row to be updated using idnumber of current user	
		$this->db->where('idnumber', $this->session->userdata('idnumber'));
		//update selected row
		$this->db->update('borrower',$data);

		$username = $this->session->userdata('idnumber');

		//insert into log
		$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
				 VALUES ('changed email', NOW(), '$username')";

		$query = $this->db->query($stmt);

	}
	
	
	/*
	*	Updates the password of current user
	*/
	public function update_password($password)
	{
		
		//save password of current user to userdata
		$data = array(
				'password' => SHA1($password)
		);
		
		//select row to be updated using idnumber of current user		
		$this->db->where('idnumber', $this->session->userdata('idnumber'));
		//update selected row
		$this->db->update('borrower',$data);

		//save idnumber of current user to a variable
		$username = $this->session->userdata('idnumber');

		//insert into log
		$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
				 VALUES ('changed password', NOW(), '$username')";

		$query = $this->db->query($stmt);

	}


	/*
	* 	@return boolean 	email status
	*	
	*	Return true if email exist	
	*/
	public function email_exist($email)
	{
		$this->load->database();
		$temp = $this->session->userdata('email');

		$query = $this->db->query( "SELECT * FROM `borrower` 
									WHERE `email` LIKE '$email' 
									AND `email` NOT LIKE '$temp'" );

		if($query->num_rows() > 0)
		{
			$query->free_result();
			return true;
		}

		$query->free_result();
		return false;

	}


	/*
	*	return count of email
	*/

	public function check_email_borrower($email)
	{
		$this->load->database();
		$temp = $this->session->userdata('email');

		//select count
		$query = $this->db->query( "SELECT count(email) AS count FROM borrower 
									WHERE email LIKE '$email' 
									AND `email` NOT LIKE '$temp'" );

		$result = $query->result();
		return $result;
	}


	/*
	*	return password
	*/
	public function get_password($idnumber)
	{
		$this->load->database();

		//select password of current user
		$stmt = "SELECT password FROM `borrower` 
				 WHERE idnumber LIKE '{$idnumber}'";

		$query = $this->db->query($stmt);
		$result = $query->result();
		return $result;

	}

}
	
/* 	End of file update_model.php
* 	Location: ./application/models/user/update_model.php 
*/