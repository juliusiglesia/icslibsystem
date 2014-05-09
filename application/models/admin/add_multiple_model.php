 <?php

/*
*	Filename: add_material_model.php
*	Project Name: ICS Library System
*	Date Created: 29 January 2014
*	Created by: Mac Emerson B. Reyes
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_multiple_model extends CI_Model{
	public function __construct(){
		
	}
	
	public function checkIfExists( ) {
		$this->load->database();
		$file = json_decode($this->input->get('insert'));

		$materialid = $file[1][0];
		$isbn = $file[1][1];
		$flag;
		$query = "SELECT * FROM librarymaterial WHERE materialid LIKE '${materialid}' AND isbn LIKE '${isbn}'";
		$q = $this->db->query($query);
		
		if($q->num_rows() > 0){
			return true;
		} else return false;
		
	}
	
}

?>