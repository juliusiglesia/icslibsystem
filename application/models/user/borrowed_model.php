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
		$query = $this->db->query("SELECT DATEDIFF((SELECT CURDATE()),borrowedmaterial.expectedreturn)*settings.fine as user_fine, author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
									JOIN settings
									WHERE borrowedmaterial.idnumber = '$idnum' AND borrowedmaterial.actualreturn IS NULL
									ORDER BY user_fine desc");
					
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
									WHERE reservation.idnumber = '$idnum' AND reservation.queue = 1");//title
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
		$query = $this->db->query("SELECT author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type
									FROM librarymaterial 
									JOIN reservation 
										ON librarymaterial.materialid = reservation.materialid
									JOIN author
										ON author.materialid = reservation.materialid
									WHERE reservation.idnumber = '$idnum'");
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
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
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
		$query ="SELECT COUNT(author.materialid)
									FROM librarymaterial 
									JOIN reservation 
										ON librarymaterial.materialid = reservation.materialid
									JOIN author
										ON author.materialid = reservation.materialid
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

}

?>