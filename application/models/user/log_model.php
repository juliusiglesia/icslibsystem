<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Log_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_borrower($username, $password)
		{
			$this->load->database();
			$password = sha1($password);
			$stmt = "SELECT * FROM `borrower` WHERE (email = '{$username}' or idnumber = '{$username}') and password = '{$password}' and status = 'ACTIVATED'";
			$query = $this->db->query($stmt);
			return $query->result();
		}

	public function get_info($idnumber)
		{
			$this->load->database();
			$stmt = "SELECT * FROM `sample` WHERE idnumber = '{$idnumber}'";
			$query = $this->db->query($stmt);
			return $query->result();
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>