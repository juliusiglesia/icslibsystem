
<?php
	class Basic_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_search_res($search, $category)
		{
			$search = $this->db->escape_like_str($search);
			$search = trim($search);
			$search = mysql_real_escape_string($search);
			$search = htmlspecialchars($search);
			$search = str_replace("'", '', $search);
			$return_array = array();
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();
			$search = strtolower($search);
			//$conditions = "";
			$temp_search = explode(" ", $search);

			for($i=0; $i<count($temp_search); $i++){	
				//get the queries
				if($category=='author'){ //check if author is checked
					$conditions[] = "(a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' OR a.lname LIKE '%{$temp_search[$i]}%')";
				}
				else if($category=='name'){ //check if title is checked
					$conditions[] = "(l.name LIKE '%{$temp_search[$i]}%')";
				}
				else if($category=='course'){ //check if course is checked
					$conditions[] = "(l.course LIKE '%{$temp_search[$i]}%')";
				}
				else if($category=='keyword'){ //check if year is checked
					$conditions[] = "(l.name LIKE '%{$temp_search[$i]}%' OR l.course LIKE '%{$temp_search[$i]}%') 
									OR (a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' OR a.lname LIKE '%{$temp_search[$i]}%')";
				}
			}
				$id = $this->session->userdata('idnumber');

				if(count($conditions)!=0){			
					$stmt = "SELECT DISTINCT r.rating, l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid LEFT JOIN rating r ON r.idnumber = '${id}' AND l.materialid = r.materialid WHERE ". implode(' OR ', $conditions) . "ORDER BY l.name";
				}
				else{
					$stmt = "SELECT DISTINCT r.rating, l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid LEFT JOIN rating r ON r.idnumber = '${id}' AND l.materialid = r.materialid ORDER BY l.name";	
				}

				$query = $this->db->query($stmt);
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