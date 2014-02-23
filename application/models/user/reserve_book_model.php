<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Reserve_book_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_book($materialid, $userid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			$userid=$userid;
			$return_array = array();
			/*$stmt = "UPDATE librarymaterial SET borrowedcopy=borrowedcopy+1 WHERE materialid='{$materialid}'";
			
			$query = $this->db->query($stmt);*/
			
			
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				   
				}
			$qno=1;
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
