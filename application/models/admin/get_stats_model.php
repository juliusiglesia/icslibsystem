<?php
/*
*	Filename: add_material_model.php
*	Project Name: ICS Library System
*	Date Created: 29 January 2014
*	Created by: CMSC 128 AB-6L
*
*/
	class Get_stats_model extends CI_Model {
	
	/*
	*	Get the number of all the library, borrowed and reserved materials from the database.
	*/
	public function get_library_stats(){
         $sql = "SELECT IFNULL(SUM(quantity), 0) AS libmatcount, 
         					IFNULL(SUM(borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(quantity) - SUM(borrowedcopy), 0) AS diffcount 
         				FROM librarymaterial";
         $query = $this->db->query($sql);
         
         return $query->result();
     }	

 	/*
	*	Get the number of all the library, borrowed and reserved materials from the database of the current week.
	*/
	public function get_current_week(){
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(COUNT(b.idnumber), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - COUNT(b.idnumber), 0) AS diffcount 
						FROM borrowedmaterial b, librarymaterial l 
						WHERE b.start >= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) DAY) 
							AND b.start <= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) +6 DAY)";	
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*
	*	Get the number of all the library, borrowed and reserved materials from the database of the previous week.
	*/
	public function get_last_week(){
		
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(quantity), 0) AS libmatcount, 
         					IFNULL(COUNT(b.idnumber), 0) AS bormatcount, 
         					IFNULL(SUM(quantity) - COUNT(b.idnumber), 0) AS diffcount 
						FROM borrowedmaterial b, librarymaterial l
						WHERE b.start >= curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) +6 DAY 
							AND b.start < curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) -1 DAY"; 
		$query = $this->db->query($sql);
		return $query->result();	
	}
	/*
	*	Get the number of all the library, borrowed and reserved materials from the database of the last two weeks .
	*/
	public function get_last_two_weeks(){
		
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(quantity), 0) AS libmatcount, 
         					IFNULL(COUNT(b.idnumber), 0) AS bormatcount, 
         					IFNULL(SUM(quantity) - COUNT(b.idnumber), 0) AS diffcount
						FROM borrowedmaterial b, librarymaterial l 
						WHERE WEEK( b.start ) = WEEK( current_date ) -2 
							AND YEAR( b.start ) = YEAR( NOW( ) )"; 
		$query = $this->db->query($sql);
		return $query->result();	
	}
	/*
	*	Get the number of all the library, borrowed and reserved materials from the databas of the last three weeks.
	*/
	public function get_last_three_weeks(){
		
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(SUM(l.borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - SUM(l.borrowedcopy), 0) AS diffcount   
						FROM borrowedmaterial b, librarymaterial l 
						WHERE WEEK( b.start ) = WEEK( current_date ) -3 
							AND YEAR( b.start ) = YEAR( NOW( ) )"; 
		$query = $this->db->query($sql);
		return $query->result();	
	}
	}
?>
