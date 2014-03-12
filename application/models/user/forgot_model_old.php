<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Forgot_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function verify_email($email)
	{
		$this->load->database();
		$stmt = "SELECT * FROM `borrower` WHERE email = '{$email}'";
		$query = $this->db->query($stmt);
		return $query->result();
	}

	public function change_password($email,$password)
		{
			//save password of current user to userdata
		$data=array(
				'password' =>SHA1($password)
			);
		
		//select row to be updated using idnumber of current user		
		$this->db->where('email', $email);
		//update selected row
		$this->db->update('borrower',$data);
		}
	public function get_name($email)
	{
		$this->load->database();
		$stmt = "SELECT idnumber FROM borrower WHERE email = '{$email}'";
		$query = $this->db->query($stmt);
		$result = $query->result();
		$idnumber = $result[0]->idnumber;
		$stmt = "SELECT fname FROM sample WHERE idnumber = '{$idnumber}'";
		$query = $this->db->query($stmt);
		return $query->result();
	}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/forgot_model.php 
	*/
?>