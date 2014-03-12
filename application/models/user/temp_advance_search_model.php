<?php
	class Temp_advance_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_adv_search($search,$category,$type,$s_type,$s_accessibility){
			
			$return_array = array();
			
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();

			$search = strtolower($search);

				if($type=='available'){
					$conditions[] = " (l.available = 1) ";
				}
				else if($type=='notavailable'){	
					$conditions[] = " (l.available =  0) ";
				}
				else if($type=='both'){	
					$conditions[] = " (l.available =  0 OR l.available = 1) ";
				}


				//check type
				if($s_type=='All'){		//-------------------------------------  check query!!!! 
					$conditions[] = " (l.type LIKE 'Book' OR l.type LIKE 'SP' OR l.type LIKE 'Thesis' OR l.type LIKE 'References' OR l.type LIKE 'CD' OR l.type LIKE 'Journals' OR l.type LIKE 'Magazines') ";
				} else{		//-------------------------------------  check query!!!! 
					$conditions[] = " (l.type LIKE '${s_type}') ";
				}

				//check accessibility
				if($s_accessibility == 'student'){
					$conditions[] = " (l.access != 2) ";
				} else if($s_accessibility == 'faculty' || $s_accessibility == 'both'){
					$conditions[] = " (l.access = 4) ";
				} else if($s_accessibility == 'roomuse'){
					$conditions[] = " (l.access = 3) ";
				}

				
				$author = "";
				//get the queries
				if($category=='author'){ //check if author is checked
					$author = " (a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%') ";
				}
				else if($category=='name'){ //check if title is checked
					$conditions[]= "(l.name LIKE '%{$search}%'";
				}
				else if($category=='course'){ //check if course is checked
					$conditions[] = " (l.course LIKE '%{$search}%') ";
				}
				else if($category=='keyword'){ //check if year is checked
					$conditions[] = " (l.name LIKE '%{$search}%' OR l.course LIKE '%{$search}%') ";
					$author = " (a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%') ";
				}


				$stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM author a, librarymaterial l WHERE "
							. implode(' AND ', $conditions) . " OR ${author} " .
							"ORDER BY l.name";

				$query = $this->db->query($stmt);
				echo $stmt;
				$query = $query->result();

				foreach ($query as $tuple){
					$id = $tuple->materialid;
					$isbn = $tuple->isbn;
					
					$query = $this->db->query("SELECT fname, mname, lname 
												FROM author
												WHERE materialid LIKE '${id}' AND isbn LIKE '${isbn}'");
					$result = $query->result();
					
					$tuple->author = (array)$result;

					// get the author depending on the tuple's library material id and isbn
					// add it to $query variable
					$return_array[count($return_array)] = (array)$tuple;
				}

				return $return_array;
		
		}
	}	
?>