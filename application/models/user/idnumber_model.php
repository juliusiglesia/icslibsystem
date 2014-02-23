<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Idnumber_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_idnumber($userid)
		{	$this->load->database();
			$this->load->library("session");
			
		
			$userid = $this->session->userdata('email');
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				$idnumber=$id->idnumber;
			
			return $idnumber;
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
