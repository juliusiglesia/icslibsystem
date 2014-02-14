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
									FROM librarymaterial INNER JOIN borrowedmaterial ON librarymaterial.materialid = borrowedmaterial.materialid AND borrowedmaterial.status LIKE 'BORROWED'");
		
		$result = $query->result();

		foreach($result as $row) {
				$return_array[count($return_array)] = (array)$row;
		}

		return $return_array;
	}
}

?>