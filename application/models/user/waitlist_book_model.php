<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Waitlist_book_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function waitlist_book($materialid, $userid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			$userid=$userid;
			$return_array = array();
			
			
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				   
				}
			$check_queue="SELECT COUNT(queue) as queno FROM reservation where materialid='{$materialid}' ORDER BY materialid";
			$queue_result=$this->db->query($check_queue);
			foreach ($queue_result->result() as $no)
				{
				   $qno=$no->queno+1;
				   
				}
			$insert="INSERT INTO reservation(idnumber, materialid, queue) VALUES ('{$idno}', '{$materialid}', {$qno})";
			$insertbm = $this->db->query($insert);
			//$insertbm = $query->result();
			
				
			
		//select row to be updated using idnumber of current user	
		
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
