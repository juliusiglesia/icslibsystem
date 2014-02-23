<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Search_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	public function get_search_res($filter, $search)
	{
		$this->load->database();
		$stmt = "SELECT * FROM `librarymaterial` WHERE {$filter} = '{$search}'";
		echo $stmt;
		$query = $this->db->query($stmt);
		return $query;
	}
	
}

	/* 	End of file Search_model.php
	* 	Location: ./application/models/user/search_model.php 
	*/
?>