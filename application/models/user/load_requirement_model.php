<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Load_requirement_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_requirement($materialid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			
			$return_array = array();
			$stmt = "SELECT requirement FROM librarymaterial WHERE materialid='{$materialid}'";
			
			$query = $this->db->query($stmt);
			
			return $query->result();
				
			
		//select row to be updated using idnumber of current user	
		
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
