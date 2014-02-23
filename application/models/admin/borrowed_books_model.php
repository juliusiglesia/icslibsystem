<?php

/*
*	Filename: reservation_queue_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrowed_books_model extends CI_Model{
	public function __construct(){
			
	}

	/*
	*	Gets the lists of the reservations in the system
	*/
	public function get_borrowed_books() {

		$return_array = array();
		$this->load->database();
		$query = $this->db->query("SELECT * 
									FROM librarymaterial INNER JOIN borrowedmaterial ON librarymaterial.materialid = borrowedmaterial.materialid AND borrowedmaterial.status LIKE 'BORROWED' ORDER BY expectedreturn");
		/*
		$result = $query->result();

		foreach($result as $row) {
				$return_array[count($return_array)] = (array)$row;
		}
		*/
		return $query;
	}

	public function get_searched_book($word) {

		$return_array = array();
		$this->load->database();
		if($word!=''){
			$query = $this->db->query("SELECT * 
										FROM librarymaterial INNER JOIN borrowedmaterial ON librarymaterial.materialid = borrowedmaterial.materialid 
										AND (borrowedmaterial.materialid LIKE '%$word%' OR librarymaterial.course LIKE '%$word%' OR librarymaterial.name LIKE '%$word%')
										AND borrowedmaterial.status LIKE 'BORROWED' ORDER BY expectedreturn");
		}else{
			$query = $this->db->query("SELECT * 
										FROM librarymaterial INNER JOIN borrowedmaterial ON librarymaterial.materialid = borrowedmaterial.materialid 
										AND borrowedmaterial.status LIKE 'BORROWED' ORDER BY expectedreturn");

		}

		return $query;
	}
}

?>