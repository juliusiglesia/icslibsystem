<?php
	class Temp_advance_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_adv_search($search, $category, $type, $s_type, $s_accessibility){
			
			$return_array = array();
			$search = strtolower($search);

			$condition_material = "";	

			// Availability
			if($type=='available')
				$condition_material = "available = 1";
			else if($type=='notavailable'){
				$condition_material = "available =  0";
			else if($type=='both')
				$condition_material = "available =  0 OR l.available = 1";

			// Type
			if($s_type=='All'){		//-------------------------------------  check query!!!! 
				$condition_material = " AND (l.type LIKE 'Book' OR l.type LIKE 'SP' OR l.type LIKE 'Thesis' OR l.type LIKE 'References' OR l.type LIKE 'CD' OR l.type LIKE 'Journals' OR l.type LIKE 'Magazines')";
			} else{		//-------------------------------------  check query!!!! 
				$condition_material = "AND l.type LIKE '${s_type}'";
			}

			if($s_accessibility == 'student'){
				$condition_material = " AND l.access != 2";
			} else if($s_accessibility == 'faculty' || $s_accessibility == 'both'){
				$condition_material = " AND l.access = 4";
			} else if($s_accessibility == 'roomuse'){
				$condition_material = " AND l.access = 3";
			}

			$condition_author = " a.fname LIKE '%%' OR a.mname LIKE '%%' OR a.lname LIKE '%%'";
			if($category=='author'){ //check if author is checked
				$condition_author = " a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%'";
			}
			else if($category=='name'){ //check if title is checked
				$condition_material= " AND l.name LIKE '%{$search}%'";
				
			}
			else if($category=='course'){ //check if course is checked
				$condition_material = " AND l.course LIKE '%{$search}%') ";
			}
			else if($category=='keyword'){ //check if year is checked
				$condition_material = " AND (l.name LIKE '%{$search}%' OR l.course LIKE '%{$search}%') ";
				$condition_author = " a.fname LIKE '%{$search}%' OR a.mname LIKE '%{$search}%' OR a.lname LIKE '%{$search}%'";
			}

			$stmt = "SELECT DISTINCT *
					FROM librarymaterial
					WHERE ${condition_material} 
						OR materialid IN ( 
							SELECT materialid 
							FROM author 
							WHERE ${condition_author}
						)";

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