<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Registration_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}
	

	/*
	*	Sets user status to ACTIVATED
	*/
	public function validate_account($email, $password){
	
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$query=$this->db->get("borrower");

		if($query->num_rows()>0){
			$profile = array('status' => 'ACTIVATED');
			$this->db->where('email', $email);
			//update borrower profile
			$this->db->update('borrower', $profile);
			return $query;
		}	
		
		else return false;
	}
	
	
	/*
	*	Adds user info to borrower table
	*/
	public function add_user()
		{
			
			$str = $this->input->post('idnumber');
			if(preg_match( '/^\d{4}-?\d{5}$/' ,$str)){
				/*if(preg_match( '/^\d{9}$/' ,$str)){
					$this->input->post('idnumber');
				}*/
				$classification = "S";
			}
			else{
				$classification = "F";
			}
			$data=array(
				'fname' =>$this->input->post('fname'),
				'mname' =>$this->input->post('mname'),
				'lname' =>$this->input->post('lname'),
				'idnumber' =>$this->input->post('idnumber'),
				'email' =>$this->input->post('email'),
				'password' =>SHA1($this->input->post('password')),
				'college' =>$this->input->post('college'),
				'course' =>$this->input->post('course'),
				'sex' =>$this->input->post('sex'),
				'classification' =>$classification
			);
			$idnumber = $this->input->post('idnumber');
			$this->db->insert('borrower',$data);	
		}

	public function idnumber_exist_check($idnumber)
			{
				$query = $this->db->get_where('sample', array('idnumber' => $idnumber));
				if($query->num_rows() > 0)
				{
					$query->free_result();
					return TRUE;
				}
				$query->free_result();
				return FALSE;
			}	

	public function idnumber_borrower_check($idnumber)
			{
				$query = $this->db->get_where('borrower', array('idnumber' => $idnumber));
				if($query->num_rows() > 0)
				{
					$query->free_result();
					return TRUE;
				}
				$query->free_result();
				return FALSE;
			}

	public function email_exist($email)
		{
			$query = $this->db->get_where('borrower', array('email' => $email));
			if($query->num_rows() > 0)
			{
				$query->free_result();
				return TRUE;
			}
			$query->free_result();
			return FALSE;
		}

}

	/* 	End of fileregistration_model.php
	* 	Location: ./application/models/user/registration_model.php 
	*/
?>