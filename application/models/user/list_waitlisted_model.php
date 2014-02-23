<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class List_waitlisted_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function list_waitlisted($userid)
		{	$this->load->database();

			$idno=$userid;
			
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				}
			$all_rank="SELECT queue FROM reservation where idnumber='{$idno}' ORDER BY materialid";
			$list_ranks=$this->db->query($all_rank);
			
			foreach ($list_ranks as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			
			return $return_array;
			
			
			//echo $stmt;
			
			
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
