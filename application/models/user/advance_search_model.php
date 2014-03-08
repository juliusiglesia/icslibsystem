<?php
	class Advance_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_adv_search($search,$search_option,$type)
		{
			
			$return_array = array();
			
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();
			$types = array();
			$SO = $this->session->userdata('search_option');
			if(!empty($type)){
				foreach($type as $t) {
						$types[] = "l.type LIKE '%{$t}%'";
				}

				//get the queries
				if($search_option=='author'){ //check if author is checked
					$conditions[] = "a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%'";
				}
				else if($search_option=='name'){ //check if title is checked
					$conditions[] = "l.name LIKE '%{$search}%'";
				}
				else if($search_option=='course'){ //check if course is checked
					$conditions[] = "l.course LIKE '%{$search}%'";
				}

				else if($search_option=='year'){ //check if year is checked
					$conditions[] = "l.year LIKE '%{$search}'";
				}

				//@@@@@@@@@@@@@@@@@@@@@@
				$stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy,
						GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '\n') as authorname
						FROM author a, librarymaterial l WHERE "
										. "(" . implode(' OR ', $conditions) .")". "AND" ."(" . implode(' OR ', $types) .")" . " AND a.materialid = l.materialid
										GROUP BY l.materialid
										ORDER BY l.name";
				//@@@@@@@@@@@@@@@@@@@@@@
										
				//echo $stmt;
				$query = $this->db->query($stmt);
//-----				return $query->result();	
			
				$query = $query->result();
				
				foreach ($query as $tuple)
					$return_array[count($return_array)] = (array)$tuple;
				return $return_array;
			
			}else{
				//pag walang pinili sa checkboxes = general search
				//echo "ERROR!";
				//$this->load->controller('borrower');
				//$this->borrower->outside_search();
			}			
		}
	}	
?>