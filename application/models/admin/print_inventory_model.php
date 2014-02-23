<?php
/*============================================================+
* File name   : print_inventory_model.php
* Last Update : 2013-01-30
*
* Description : Generate PDF for Inventory Report
*
* Author: CMSC 128 AB-6L A.Y.2013-14
*
============================================================+
*/	
	class Print_inventory_model extends CI_Model{
		public function __construct(){
			
		}

		public function get_inventory_array() {

			$return_array = array();
			$this->load->database();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'Magazines'");	//gets all materials classified under Magazine
			$mags = $query->result_array();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'Book'");		//gets all materials classified under Book
			$books = $query->result_array();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'References'");	//gets all materials classified under Reference
			$refs = $query->result_array();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'SP'");			//gets all materials classified under SP
			$sps = $query->result_array();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'Thesis'");		//gets all materials classified under Thesis
			$theses = $query->result_array();

			$query = $this->db->query("SELECT name, quantity, quantity+borrowedcopy AS total 
										FROM librarymaterial 
										WHERE type LIKE 'Journals'");		//gets all materials classified under Thesis
			$journals = $query->result_array();

			$return_array['mags'] = (array)$mags;
			$return_array['books'] = (array)$books;
			$return_array['refs'] = (array)$refs;
			$return_array['sps'] = (array)$sps;
			$return_array['theses'] = (array)$theses;
			$return_array['journals'] = (array)$journals;
			return $return_array;
		}
	}
	/* 	End of file print_inventory_model.php
	* 	Location: ./application/models/print_inventory_model.php 
	*/
?>