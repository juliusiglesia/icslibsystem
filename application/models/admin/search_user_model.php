<?php

/*
*	Filename: reservation_queue_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_user_model extends CI_Model{
	public function __construct(){
			
	}

	/*
	*	Gets the lists of the reservations in the system
	*/
	public function get_users( $search = "" ) {
		
		$search = trim($search);

		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		$result = array();
		$search = strtolower($search);
		$temp_search = explode(" ", $search);
		$where = "( ";
		$where2 = "( ";
		for( $i = 0; $i < count($temp_search); $i++ ){
			$where = $where . "LOWER(status) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(borrower.idnumber) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "bookcount LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(fname) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(mname) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(lname) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(college) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(course) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(classification) LIKE '%" . $temp_search[$i] . "%' OR ";
			
			if ( $i == count($temp_search)-1 ) {
				$where = $where . "LOWER(sex) LIKE '%" . $temp_search[$i] . "%' )";
			} else {
				$where = $where . "LOWER(sex) LIKE '%" . $temp_search[$i] . "%' OR ";
			}
		}				
		$query = $this->db->query("SELECT *
									FROM borrower INNER JOIN sample 
									ON borrower.idnumber = sample.idnumber
									WHERE ${where}
									ORDER BY borrower.idnumber ASC");

		$result_array = $query->result();
		
		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		foreach ($result_array as $data) {
			$idnum = $data->idnumber;
	
			//borrowed books
			$where = "status LIKE 'BORROWED' and idnumber LIKE '$idnum'";
			$query = $this->db->query("SELECT IFNULL(COUNT(*), 0) as borrowed
									FROM borrowedmaterial 
									WHERE ${where}");
			$data->borrowed = $query->row()->borrowed;
			//overdue books

			$where = "DATEDIFF('${date_now}', expectedreturn) < 0 and idnumber LIKE '$idnum'";
			$query = $this->db->query("SELECT IFNULL(COUNT(*), 0) as overdue
									FROM borrowedmaterial 
									WHERE ${where}");
			
			$data->overdue = $query->row()->overdue;

			//reserved books
			$where = "idnumber LIKE '$idnum'";
			$query = $this->db->query("SELECT IFNULL(COUNT(*), 0) as reserved
									FROM reservation 
									WHERE ${where}");
			
			$data->reserved = $query->row()->reserved;
		}
		return $result_array;
	}

}

?>