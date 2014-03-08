<?php

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
		//$this->session->set_userdata('email', $email);
		//return $i;		
	}
	
	
	/*
	*	Updates the password of current user
	*/
	public function update_password($password)
	{
		//save password of current user to userdata
		//$this->load->database();
		//$this->session->set_userdata('password',$this->input->post('password'));
		
		$data=array(
				'password' => SHA1($password)
			);
		
		//select row to be updated using idnumber of current user		
		$this->db->where('idnumber', $this->session->userdata('idnumber'));
		//update selected row
		$this->db->update('borrower',$data);
	}

	public function email_exist($email)
	{
		//$query = $this->db->get_where('borrower', array('email' => $email));
		$this->load->database();
		$temp = $this->session->userdata('email');
		$query = $this->db->query("SELECT * FROM `borrower` WHERE `email` LIKE '$email' AND `email` NOT LIKE '$temp'");
		if($query->num_rows() > 0)
		{
			$query->free_result();
			return true;
		}
		$query->free_result();
		return false;
	}

	public function check_email_borrower($email)
	{
		$this->load->database();
		$temp = $this->session->userdata('email');
		$query = $this->db->query("SELECT count(email) as count FROM borrower WHERE email LIKE '$email' AND `email` NOT LIKE '$temp'");//title
		$result = $query->result();
		return $result;
	}


	public function update_email_exist($email)
	{
		//$query = $this->db->get_where('borrower', array('email' => $email));
		$this->load->database();
		$temp = $this->session->userdata('email');
		$this->load->database();
		$query = $this->db->query("SELECT count(email) as count FROM borrower WHERE email LIKE '$email' AND `email` NOT LIKE '$temp'");//title
		$result = $query->result();
		return $result;
	}

	public function get_password($idnumber)
	{
		$this->load->database();
		
			$stmt = "SELECT password FROM `borrower` WHERE idnumber LIKE '{$idnumber}'";
			$query = $this->db->query($stmt);
			$result = $query->result();
			return $result;
	}




	
}
	/* 	End of file Update_model.php
	* 	Location: ./application/models/user/update_model.php 
	*/
?>