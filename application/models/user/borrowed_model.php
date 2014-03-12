<?php

/*
*	Filename: reservation_queue_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrowed_model extends CI_Model{
	public function __construct(){
			
	}

	public function get_ready_to_claim(){
		$return_array2 = array();
		$this->load->database();
		//Reserved Books
		$idnum=$this->session->userdata('idnumber');
		$query = $this->db->query("SELECT librarymaterial.materialid, reservation.claimdate
									FROM librarymaterial 
									JOIN reservation
										ON librarymaterial.materialid = reservation.materialid 
									WHERE reservation.idnumber = '$idnum' AND reservation.queue = 1 AND reservation.claimdate IS NOT NULL");//title
		$result = $query->result();
		foreach ($result as $tuple)
			$return_array2[count($return_array2)] = (array)$tuple;
		return $return_array2;
	}

	/*
	*	Gets the lists of the reservations in the system
	*/
	public function get_borrowed_material() {
		
		/*
		*	get all the id, store it in an array
		*	while( array is not empty ){
		*		count = get the value of quantity - borrowed copy for array[i] // that is the available copy		
		*		get all the reservation for the array[i] and limit the result from 1 to count
		*		store it into the return array
		*	}
		*
		*/

		$return_array = array();
		$this->load->database();
		$idnum=$this->session->userdata('idnumber');
		// Books on Hand
		/*$query = $this->db->query("SELECT DATEDIFF((SELECT CURDATE()),borrowedmaterial.expectedreturn)*settings.fine as user_fine, author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type, librarymaterial.isbn
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
									JOIN settings
									WHERE borrowedmaterial.idnumber = '$idnum' AND borrowedmaterial.actualreturn IS NULL
									ORDER BY user_fine desc");*/

		$query = $this->db->query("SELECT DATEDIFF((SELECT CURDATE()),bm.expectedreturn)*s.fine as user_fine, 
									GROUP_CONCAT(ab.fname, ' ', ab.mname, ' ', ab.lname) as authorname, ab.materialid,
									l.name, 
									l.year, l.type, l.isbn
									FROM librarymaterial l
									LEFT JOIN borrowedmaterial bm
									ON l.materialid = bm.materialid
									LEFT JOIN author ab
									ON ab.materialid = bm.materialid
									JOIN settings s
									WHERE bm.idnumber = '$idnum' AND bm.actualreturn IS NULL
									GROUP BY ab.materialid
									ORDER BY user_fine desc;");
					
		$result = $query->result();
			foreach ($result as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			return $return_array;	
	}
	
	public function get_reservations(){
		$return_array2 = array();
		$this->load->database();
		//Reserved Books
		$idnum=$this->session->userdata('idnumber');
		$query = $this->db->query("SELECT librarymaterial.course, librarymaterial.name
									FROM librarymaterial 
									JOIN reservation
										ON librarymaterial.materialid = reservation.materialid 
									WHERE reservation.idnumber = '$idnum'");//title
									// AND reservation.queue = 1 AND reservation.claimdate IS NULL
		$result = $query->result();
		foreach ($result as $tuple)
			$return_array2[count($return_array2)] = (array)$tuple;
		return $return_array2;
	}

	public function get_reserved_books(){
		$return_array2 = array();
		$this->load->database();
	
		//Reserved Books
		$idnum=$this->session->userdata('idnumber');

		$query = $this->db->query("SELECT ab.materialid, l.name, l.year, l.type, l.isbn,
									GROUP_CONCAT(ab.fname,' ',ab.mname,' ', ab.lname) as authorname
									FROM librarymaterial l
									LEFT JOIN reservation r
									ON l.materialid = r.materialid
									LEFT JOIN author ab
									ON ab.materialid = r.materialid
									WHERE r.idnumber = '$idnum'
									GROUP BY ab.materialid;");


		$result = $query->result();
		foreach ($result as $tuple)
			$return_array2[count($return_array2)] = (array)$tuple;
		return $return_array2;
	}
	public function get_overdue(){
		$return_array3 = array();
		$this->load->database();
	
		//Reserved Books
		$idnum=$this->session->userdata('idnumber');
		$query = $this->db->query("SELECT DATEDIFF((SELECT CURDATE()),borrowedmaterial.expectedreturn)*settings.fine as user_fine, author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
									JOIN settings
									WHERE borrowedmaterial.idnumber = '$idnum'
									AND borrowedmaterial.actualreturn IS NULL
									AND borrowedmaterial.expectedreturn <(SELECT CURDATE())
									ORDER BY user_fine desc");
					
		$result = $query->result();
		foreach ($result as $tuple)
			$return_array3[count($return_array3)] = (array)$tuple;
		return $return_array3;
	}

	public function get_borrowed_material_count(){

		$return_array = array();
		$this->load->database();
		$idnum=$this->session->userdata('idnumber');
		// Books on Hand
		$query ="SELECT COUNT(librarymaterial.materialid)
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									WHERE borrowedmaterial.idnumber = '$idnum' AND borrowedmaterial.actualreturn IS NULL";
		$res = $this->db->query($query);	
		$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;

		return $return_array;
	}

	public function get_reserved_material_count(){

		$return_array = array();
		$this->load->database();
		$idnum=$this->session->userdata('idnumber');
		// Books on Hand
		$query ="SELECT COUNT(librarymaterial.materialid) as resCount
									FROM librarymaterial 
									JOIN reservation 
										ON librarymaterial.materialid = reservation.materialid
									WHERE reservation.idnumber = '$idnum'";
		$res = $this->db->query($query);	
		$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;

		return $return_array;
	}

	public function get_overdue_material_count(){

		$return_array = array();
		$this->load->database();
		$idnum=$this->session->userdata('idnumber');
		// Books on Hand
		$query ="SELECT COUNT(librarymaterial.materialid)
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
									WHERE borrowedmaterial.idnumber = '$idnum'
									AND borrowedmaterial.actualreturn IS NULL
									AND borrowedmaterial.expectedreturn < (SELECT CURDATE())";
		$res = $this->db->query($query);	
		$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;

		return $return_array;
	}

	public function get_fine_enable(){
		$return_array = array();
		$this->load->database();

		$query = "SELECT fineenable FROM settings WHERE id=1";

		$res = $this->db->query($query);
		$query = $res->result();

		//return $query;

		foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			return $return_array;	
	}

}

?>