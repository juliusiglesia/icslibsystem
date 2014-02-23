<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Check_reserved_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function if_reserved($userid)
		{	$this->load->database();
			$this->load->library("session");
			$userid = $this->session->userdata('email');
			$reserved_flag=0;
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$material="SELECT materialid FROM borrowedmaterial where idnumber='{$idn}'";
			$res = $this->db->query($material);
			$data = array();

				foreach ($res->result() as $row)
				{
				    $data[] = array(
					'materialid' => $row->materialid,
					);
				}

			return $data;
			//echo $stmt;
			//return $return_array;
			
			
		}
		
}
	/* 	End of file Log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>
