<?php
	class Get_stats_model extends CI_Model {

		public function get_library_stats(){
			$this->load->database();
	        $sql = "SELECT COUNT(DISTINCT l.materialid) AS libmatcount, COUNT(DISTINCT b.id) AS bormatcount, (COUNT(DISTINCT l.materialid) - COUNT(DISTINCT b.id)) AS diffcount FROM borrowedmaterial b, librarymaterial l";
	        $query = $this->db->query($sql);
	        return $query->result();
		}

		public function get_library_weekly_stats(){
			$this->load->database();
			//$sql = "SELECT COUNT(DISTINCT l.materialid) AS libmatcount, COUNT(DISTINCT b.id) AS bormatcount, (COUNT(DISTINCT l.materialid) - COUNT(DISTINCT b.id)) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE b.startdate >= DATEADD(wk, DATEDIFF(wk, 0, NOW()), -1) AND b.stardate <= DATEADD(wk, DATEDIFF(wk, 0, NOW()), 5)";
			$sql = "SELECT COUNT(DISTINCT l.materialid) AS libmatcount, COUNT(DISTINCT b.id) AS bormatcount, (COUNT(DISTINCT l.materialid) - COUNT(DISTINCT b.id)) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE b.start >= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) DAY) AND b.start <= DATE_ADD(NOW(), INTERVAL(1-DAYOFWEEK(NOW())) +6 DAY)";	
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		public function get_library_last_week_ago_stats(){
			//last weeks ago
			$this->load->database();
			//$sql = "SELECT COUNT( DISTINCT l.materialid ) AS libmatcount, COUNT( DISTINCT b.id ) AS bormatcount, (COUNT( DISTINCT l.materialid ) - COUNT( DISTINCT b.id )) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE WEEK( b.start ) = WEEK( current_date ) -2 AND YEAR( b.start ) = YEAR( NOW( ) )"; 
			$sql = "SELECT COUNT( DISTINCT l.materialid ) AS libmatcount, COUNT( DISTINCT b.id ) AS bormatcount, (COUNT( DISTINCT l.materialid ) - COUNT( DISTINCT b.id )) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE b.start >= curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) +6 DAY AND b.start < curdate( ) - INTERVAL DAYOFWEEK( curdate( ) ) -1 DAY"; 
			$query = $this->db->query($sql);
			return $query->result();	
		}
		
		public function get_library_two_weeks_ago_stats(){
			//2 weeks ago
			$this->load->database();
			$sql = "SELECT COUNT( DISTINCT l.materialid ) AS libmatcount, COUNT( DISTINCT b.id ) AS bormatcount, (COUNT( DISTINCT l.materialid ) - COUNT( DISTINCT b.id )) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE WEEK( b.start ) = WEEK( current_date ) -2 AND YEAR( b.start ) = YEAR( NOW( ) )"; 
			$query = $this->db->query($sql);
			return $query->result();	
		}
		
		public function get_library_three_weeks_ago_stats(){
			//3 weeks ago
			$this->load->database();
			$sql = "SELECT COUNT( DISTINCT l.materialid ) AS libmatcount, COUNT( DISTINCT b.id ) AS bormatcount, (COUNT( DISTINCT l.materialid ) - COUNT( DISTINCT b.id )) AS diffcount FROM borrowedmaterial b, librarymaterial l WHERE WEEK( b.start ) = WEEK( current_date ) -3 AND YEAR( b.start ) = YEAR( NOW( ) )"; 
			$query = $this->db->query($sql);
			return $query->result();	
		}
	}
?>
