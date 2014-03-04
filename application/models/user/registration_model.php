<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Registration_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}
	

	public function checkidnum($idnumber)
	{
		$this->load->database();
		$query = $this->db->query("SELECT count(idnumber) as count FROM borrower WHERE idnumber LIKE '$idnumber'");//title
		$result = $query->result();
		return $result;
	}

	public function checkidnum_sample($idnumber)
	{
		$this->load->database();
		$query = $this->db->query("SELECT count(idnumber) as count FROM sample WHERE idnumber LIKE '$idnumber'");//title
		$result = $query->result();
		return $result;
	}

	public function check_email_borrower($email)
	{
		$this->load->database();
		$query = $this->db->query("SELECT count(email) as count FROM borrower WHERE email LIKE '$email'");//title
		$result = $query->result();
		return $result;
	}

	public function resend_email_verification($email){
		$this->load->database();
		$query = $this->db->query("SELECT count(email) as count FROM borrower WHERE email LIKE '$email' AND status LIKE 'DEACTIVATED'");//title
		$result = $query->result();
		return $result;
	}


	public function idnumber_exist_check($idnumber)
			{
				$query = $this->db->get_where('sample', array('idnumber' => $idnumber));
				if($query->num_rows() > 0)
				{
					return FALSE;
				}
				$query->free_result();
				return TRUE;
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