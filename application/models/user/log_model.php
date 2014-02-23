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
			$stmt = "SELECT * FROM `borrower` WHERE email = '{$username}'  and password = '{$password}'";
			$query = $this->db->query($stmt);
			return $query->result();
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>