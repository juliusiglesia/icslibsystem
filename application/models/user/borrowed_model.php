<?php

/*
*	Filename: borrowed_model.php
*	Project Name: ICS Library System
*	Created by: Borrower's Team
*
*/


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrowed_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();	
	}

	/*	
	*	Function that returns the books that are reserved and are ready to be claimed by the borrower.	
	*/
	public function get_ready_to_claim()
	{

		//Create a new array that will hold the result.
		$return_array2 = array();	

		//Load the database to be used, the databse where the data will be fetched.				
		$this->load->database();	

		//Reserved Books
		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');

		/*SQL query that selects all the reserved books that is approved by the admin to be ready to claim.*/
		$query = $this->db->query("SELECT librarymaterial.materialid, reservation.claimdate
									FROM librarymaterial 
									JOIN reservation
										ON librarymaterial.materialid = reservation.materialid 
									WHERE reservation.idnumber = '$idnum' AND reservation.queue = 1 
									AND reservation.claimdate IS NOT NULL");//title

		//Executes the SQL query
		$result = $query->result();					

		/*Stores the resulting tuples into the array $return_array2.*/
		foreach ($result as $tuple)					
			$return_array2[count($return_array2)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array2;				

	}


	/*
	*	Function that gets the lists of the borrwed materials in the system.
	*/
	public function get_borrowed_material()
	{
		
		/*
		*	get all the id, store it in an array
		*	while( array is not empty ){
		*		count = get the value of quantity - borrowed copy for array[i] // that is the available copy		
		*		get all the reservation for the array[i] and limit the result from 1 to count
		*		store it into the return array
		*	}
		*
		*/

		//Create a new array that will hold the result.
		$return_array = array();					

		//Load the database to be used, the databse where the data will be fetched.
		$this->load->database();					

		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');
		
		// Books on Hand
		/*SQL query that selects all the reservations made by the system.*/

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
					

		//Executes the SQL query
		$result = $query->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($result as $tuple)					
			$return_array[count($return_array)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array;					
	}
	public function get_return_date(){
		$return_array3 = array();
		$this->load->database();
	
		//Reserved Books
		$idnum=$this->session->userdata('idnumber');
		$query = $this->db->query("SELECT borrowedmaterial.expectedreturn as expected_return, author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type
									FROM librarymaterial 
									JOIN borrowedmaterial 
										ON librarymaterial.materialid = borrowedmaterial.materialid
									JOIN author
										ON author.materialid = borrowedmaterial.materialid
									JOIN settings
									WHERE borrowedmaterial.idnumber = '$idnum'
									AND borrowedmaterial.actualreturn IS NULL
									ORDER BY expected_return desc");
					
		$result = $query->result();
		foreach ($result as $tuple)
			$return_array3[count($return_array3)] = (array)$tuple;
		return $return_array3;
	}

	/*
	*	Function that gets the lists of the reserved materials in the system.
	*/
	public function get_reservations()
	{
		//Create a new array that will hold the result.
		$return_array2 = array();	

		//Load the database to be used, the databse where the data will be fetched.				
		$this->load->database();

		//Reserved Books
		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');
		
		/*SQL query that selects all the name and the subject course of the books that user reserved.*/
		$query = $this->db->query("SELECT librarymaterial.course, librarymaterial.name
									FROM librarymaterial 
									JOIN reservation
										ON librarymaterial.materialid = reservation.materialid 
									WHERE reservation.idnumber = '$idnum'");//title

							
		//Executes the SQL query
		$result = $query->result();					

		/*Stores the resulting tuples into the array $return_array2.*/
		foreach ($result as $tuple)
			$return_array2[count($return_array2)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array2;						
	}


	/*
	*	Function that gets the lists of the authors of reserved books in the system.
	*/
	public function get_reserved_books()
	{
		//Create a new array that will hold the result.
		$return_array2 = array();	

		//Load the database to be used, the databse where the data will be fetched.				
		$this->load->database();					
	
		//Reserved Books
		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');

		/*SQL query that selects all the books that user reserved; the book id, title, year, type and isbn number.*/

		$query = $this->db->query("SELECT ab.materialid, l.name, l.year, l.type, l.isbn,
									GROUP_CONCAT(ab.fname,' ',ab.mname,' ', ab.lname) as authorname
									FROM librarymaterial l
									LEFT JOIN reservation r
									ON l.materialid = r.materialid
									LEFT JOIN author ab
									ON ab.materialid = r.materialid
									WHERE r.idnumber = '$idnum'
									GROUP BY ab.materialid;");

		//Executes the SQL query
		$result = $query->result();					

		/*Stores the resulting tuples into the array $return_array2.*/
		foreach ($result as $tuple)
			$return_array2[count($return_array2)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array2;						
	}


	/*
	*	Function that gets the lists of the overdued materials in the system.
	*/
	public function get_overdue()
	{
		//Create a new array that will hold the result.
		$return_array3 = array();

		//Load the database to be used, the databse where the data will be fetched.					
		$this->load->database();					
	
		//Reserved Books
		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');
		
		/*SQL query that selects all the books that are already overdued.*/

		$query = $this->db->query("SELECT DATEDIFF((SELECT CURDATE()),borrowedmaterial.expectedreturn)*settings.fine AS user_fine, author.fname, author.mname, author.materialid, author.lname,librarymaterial.name, librarymaterial.year, librarymaterial.type
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

		//Executes the SQL query
		$result = $query->result();					

		/*Stores the resulting tuples into the array $return_array3.*/
		foreach ($result AS $tuple)
			$return_array3[count($return_array3)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array3;						
	}


	/*
	*	Function that counts the number of borrowed materials in the system.
	*/
	public function get_borrowed_material_count()
	{
		//Create a new array that will hold the result.
		$return_array = array();

		//Load the database to be used, the databse where the data will be fetched.					
		$this->load->database();

		//Assign the session data to varible $idnum.					
		$idnum=$this->session->userdata('idnumber');

		// Books on Hand

		/*SQL query that counts all the books that are out in the library or borrowed by the logged-in users.*/

		$query = "SELECT COUNT(librarymaterial.materialid)
				  	FROM librarymaterial 
				  	JOIN borrowedmaterial 
				  	ON librarymaterial.materialid = borrowedmaterial.materialid
				  	WHERE borrowedmaterial.idnumber = '$idnum' AND borrowedmaterial.actualreturn IS NULL";

		$res = $this->db->query($query);	

		//Executes the SQL query					
		$query = $res->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array;						
	}


	/*
	*	Function that counts the number of reserved materials in the system.
	*/
	public function get_reserved_material_count()
	{
		//Create a new array that will hold the result.
		$return_array = array();		

		//Load the database to be used, the databse where the data will be fetched.			
		$this->load->database();		

		//Assign the session data to varible $idnum.			
		$idnum=$this->session->userdata('idnumber');

		// Books on Hand

		/*SQL query that counts all the books that are reserved by the logged-in user.*/

		$query = "SELECT COUNT(librarymaterial.materialid) as resCount
									FROM librarymaterial 
									JOIN reservation 
									ON librarymaterial.materialid = reservation.materialid
									WHERE reservation.idnumber = '$idnum'";

		$res = $this->db->query($query);	

		//Executes the SQL query
		$query = $res->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array;						
	}


	public function get_ready_to_claim_count()
	{
		//Create a new array that will hold the result.
		$return_array = array();	

		//Load the database to be used, the databse where the data will be fetched.				
		$this->load->database();		

		//Assign the session data to varible $idnum.			
		$idnum=$this->session->userdata('idnumber');

		// Books on Hand

		$query = "SELECT COUNT(librarymaterial.materialid)
						FROM librarymaterial
						JOIN reservation
							ON librarymaterial.materialid = reservation.materialid
						WHERE reservation.idnumber = '$idnum' AND reservation.claimdate IS NOT NULL";

		$res = $this->db->query($query);

		//Executes the SQL query	
		$query = $res->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array;						
	}


	/*
	*	Function that counts the number of uverdued materials in the system.
	*/
	public function get_overdue_material_count()
	{
		//Create a new array that will hold the result.
		$return_array = array();					

		//Load the database to be used, the database where the data will be fetched.
		$this->load->database();

		//Assign the session data to varible $idnum.
		$idnum=$this->session->userdata('idnumber');


		// Books on Hand

		/*SQL query that counts all the books that are overdued.*/

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

		//Executes the SQL query
		$query = $res->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;

		//Returns the resulting array.
		return $return_array;						
	}


	/*
	*	Function that enable and disables the fine feature in the system.
	*/
	public function get_fine_enable()
	{
		//Create a new array that will hold the result.
		$return_array = array();		

		//Load the database to be used, the databse where the data will be fetched.			
		$this->load->database();					

		/*SQL query that selects the setting of fine_enable, 1 if it is enabled, 0 if it is not.*/
		$query = "SELECT fineenable FROM settings WHERE id=1";

		$res = $this->db->query($query);

		//Executes the SQL query	
		$query = $res->result();					

		/*Stores the resulting tuples into the array $return_array.*/
		foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
		//Returns the resulting array.
		return $return_array;						
	
	}

}

	/* 	End of Borrowed_model.php
	* 	Location: ./application/models/user/borrowed_model.php 
	*/