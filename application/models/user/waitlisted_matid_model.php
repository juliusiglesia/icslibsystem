<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Waitlisted_matid_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function waitlisted_matid($userid)
		{	$this->load->database();

			$idno=$userid;
			$return_array = array();
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				}
			$all_mat="SELECT materialid FROM reservation where idnumber='{$idno}' ORDER BY materialid";
			$list_mat=$this->db->query($all_mat);
			foreach ($list_mat->result() as $mats){
				$mid=$mats->materialid;
				$stmt = "SELECT * FROM author a, librarymaterial l WHERE a.materialid LIKE '%{$mid}%' AND a.materialid = l.materialid ORDER BY l.materialid";
			
					//echo $stmt;
					$query = $this->db->query($stmt);
					$query = $query->result();
			
					foreach ($query as $tuple){
						$return_array[count($return_array)] = (array)$tuple;
					}	
			}

				
			
			return $return_array;
			
			
			//echo $stmt;
			
			
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
