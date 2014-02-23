<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Check_waitlisted_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function if_waitlisted($userid)
		{	$this->load->database();
			$this->load->library("session");
			$userid = $this->session->userdata('email');
			
			$idno=$userid;
			
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$material="SELECT materialid FROM reservation where idnumber='{$idn}'";
			$waitl = $this->db->query($material);
			$waitdata = array();

				foreach ($waitl->result() as $row)
				{
				    $waitdata[] = array(
					'materialid' => $row->materialid,
					);
				}

			return $waitdata;
			//echo $stmt;
			//return $return_array;
			
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
