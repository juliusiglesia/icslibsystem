<?php
	class Advance_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_adv_search($search,$category,$type,$s_type,$s_accessibility){
			
			$return_array = array();
			$search = trim($search);
			$search = mysql_real_escape_string($search);
			$search = htmlspecialchars($search);
        
			
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();
			$cond = array();
			$search = strtolower($search);
			$temp_search = explode(" ", $search);
			

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
				if($s_type==NULL) $s_type="All";
				if($s_type=='All'){	
					$conditions[] = " (l.type LIKE 'Book' OR l.type LIKE 'SP' OR l.type LIKE 'Thesis' OR l.type LIKE 'References' OR l.type LIKE 'CD' OR l.type LIKE 'Journals' OR l.type LIKE 'Magazines') ";
				} else{		
					$conditions[] = " (l.type LIKE '${s_type}') ";
				}

				//check accessibility
				if($s_accessibility == 'student'){
					$conditions[] = " (l.access = 1) ";
				} else if($s_accessibility == 'faculty'){
					$conditions[] = " (l.access = 2) ";
				} else if($s_accessibility == 'roomuse'){
					$conditions[] = " (l.access = 3) ";
				}else{
					$conditions[] = " (l.access = 4) ";
				}

				
				for($i=0; $i<count($temp_search); $i++){	
					//get the queries
					if($category=='author'){ //check if author is checked
						$cond[] = "(a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' OR a.lname LIKE '%{$temp_search[$i]}%')";
					}
					else if($category=='name'){ //check if title is checked
						$cond[] = "(l.name LIKE '%{$temp_search[$i]}%')";
					}
					else if($category=='course'){ //check if course is checked
						$cond[] = "(l.course LIKE '%{$temp_search[$i]}%')";
					}
					else if($category=='keyword'){ //check if year is checked
						$cond[] = "(l.name LIKE '%{$temp_search[$i]}%' OR l.course LIKE '%{$temp_search[$i]}%') 
										or (a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' OR a.lname LIKE '%{$temp_search[$i]}%')";
					}
				}
				$id = $this->session->userdata('idnumber');

				if(count($cond)!=0){
					$stmt = "SELECT DISTINCT r.rating,l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid INNER JOIN rating r ON r.idnumber = '${id}' AND l.materialid = r.materialid WHERE ( "
							. implode(' AND ', $conditions) . ") AND " . implode(' OR ', $cond) . " ORDER BY l.name";
				}
				else{
					$stmt = "SELECT DISTINCT r.rating, l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid INNER JOIN rating r ON r.idnumber = '${id}' AND l.materialid = r.materialid WHERE ( "
							. implode(' AND ', $conditions)  . " ORDER BY l.name";	
				}
				$query = $this->db->query($stmt);
				//echo $stmt;
				$query = $query->result();
				echo "<br/><br/><br/><br/><br/><br/>".$stmt;
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