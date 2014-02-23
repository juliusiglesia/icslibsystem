<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Reserve_waitlist_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_borrowedcopy($materialid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			
			$stmt = "SELECT status FROM borrowedmaterial WHERE materialid = '{$materialid}' and status='BORROWED'";
			$query = $this->db->query($stmt);
			return $query->result();
			
		
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
