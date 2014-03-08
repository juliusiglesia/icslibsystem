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
		$query = $this->db->query("SELECT l.materialid, b.idnumber, l.isbn, l.type, l.name, b.start, b.expectedreturn,
									GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '; ') as authorname
									FROM librarymaterial l, borrowedmaterial b, author a WHERE l.materialid = b.materialid AND b.materialid = a.materialid AND b.status LIKE 'BORROWED' GROUP BY a.materialid ORDER BY b.expectedreturn");
		/*
		$result = $query->result();

		foreach($result as $row) {
				$return_array[count($return_array)] = (array)$row;
		}
		*/
		//echo count($query->result());
		return $query;
	}

	public function get_fine(){

		$this->load->database();
		$query = $this->db->query("SELECT fine FROM settings");
		return $query->row()->fine;
	}

	public function get_searched_book($word) {

		$return_array = array();
		$this->load->database();
		if($word!=''){
			$query = $this->db->query("SELECT l.materialid, b.idnumber, l.isbn, l.type, l.name, b.start, b.expectedreturn,
									GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '; ') as authorname
									FROM librarymaterial l, borrowedmaterial b, author a WHERE l.materialid = b.materialid AND b.materialid = a.materialid AND b.status LIKE 'BORROWED' AND (b.materialid LIKE '%$word%' OR l.course LIKE '%$word%' OR l.name LIKE '%$word%' OR b.idnumber LIKE '%$word%') GROUP BY a.materialid ORDER BY b.expectedreturn");
		}else{
			$query = $this->db->query("SELECT l.materialid, b.idnumber, l.isbn, l.type, l.name, b.start, b.expectedreturn,
									GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '; ') as authorname
									FROM librarymaterial l, borrowedmaterial b, author a WHERE l.materialid = b.materialid AND b.materialid = a.materialid AND b.status LIKE 'BORROWED' GROUP BY a.materialid ORDER BY b.expectedreturn");
		}

		return $query;
	}
}

?>