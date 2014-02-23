<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Waitlist_rank_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_rank($userid)
		{	$this->load->database();
			$this->load->library("session");
			
		
			$userid = $this->session->userdata('email');
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$r="SELECT materialid, queue FROM reservation where idnumber='{$idn}' ORDER BY materialid";
			$res = $this->db->query($r);
			$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			
			return $return_array;
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
