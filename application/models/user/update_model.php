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
	public function update_email()
	{
		//save email address of current user to userdata
		$this->session->set_userdata('email',$this->input->post('email'));
		
		$data=array(
				'email' =>$this->input->post('email')
		);
		
		//select row to be updated using idnumber of current user	
		$this->db->where('idnumber', $this->session->userdata('idnumber'));
		//update selected row
		$this->db->update('borrower',$data);
	}
	
	
	/*
	*	Updates the password of current user
	*/
	public function update_password()
	{
		//save password of current user to userdata
		$this->session->set_userdata('password',$this->input->post('password'));
		
		$data=array(
				'password' =>SHA1($this->input->post('password'))
			);
		
		//select row to be updated using idnumber of current user		
		$this->db->where('idnumber', $this->session->userdata('idnumber'));
		//update selected row
		$this->db->update('borrower',$data);
	}
	
}
	/* 	End of file Update_model.php
	* 	Location: ./application/models/user/update_model.php 
	*/
?>