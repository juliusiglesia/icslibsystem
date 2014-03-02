<?php
	class Get_stats_model extends CI_Model {

	public function get_library_stats(){
         $this->load->database();
         $sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(SUM(l.borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - SUM(l.borrowedcopy), 0) AS diffcount 
         				FROM borrowedmaterial b, librarymaterial l";
         $query = $this->db->query($sql);
         
         return $query->result();
     }	

 	
	public function get_current_week(){
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(SUM(l.borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - SUM(l.borrowedcopy), 0) AS diffcount 
						FROM borrowedmaterial b, librarymaterial l 
						WHERE b.start >= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) DAY) 
							AND b.start <= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) +6 DAY)";	
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function get_last_week(){
		//last weeks ago
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(SUM(l.borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - SUM(l.borrowedcopy), 0) AS diffcount 
						FROM borrowedmaterial b, librarymaterial l 
						WHERE b.start >= curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) +6 DAY 
							AND b.start < curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) -1 DAY"; 
		$query = $this->db->query($sql);
		return $query->result();	
	}
	
	public function get_last_two_weeks(){
		//2 weeks ago
		$this->load->database();
		$sql = "SELECT IFNULL(SUM(l.quantity), 0) AS libmatcount, 
         					IFNULL(SUM(l.borrowedcopy), 0) AS bormatcount, 
         					IFNULL(SUM(l.quantity) - SUM(l.borrowedcopy), 0) AS diffcount 
						FROM borrowedmaterial b, librarymaterial l 
						WHERE WEEK( b.start ) = WEEK( current_date ) -2 
							AND YEAR( b.start ) = YEAR( NOW( ) )"; 
		$query = $this->db->query($sql);
		return $query->result();	
	}
	
	public function get_last_three_weeks(){
		//3 weeks ago
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
