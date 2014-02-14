 <?php

/*
*	Filename: add_material_model.php
*	Project Name: ICS Library System
*	Date Created: 29 January 2014
*	Created by: Mac Emerson B. Reyes
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_material_model extends CI_Model{
	public function __construct(){
		
	}
	
	public function insert_material($data){
		$this->load->database();
		$this->db->insert('librarymaterial', $data);
    }
	
	public function insert_author($data){
		$this->load->database();
		$this->db->insert('author', $data);
	}
}

?>