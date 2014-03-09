
<?php
	class Basic_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_search_res($search, $category)
		{


			$return_array = array();
			
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();

			$search = strtolower($search);
			
			/*if($filter == 'keyword'){
				$stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy,
						GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '\n') as authorname
						FROM author a, librarymaterial l
						WHERE (a.fname LIKE '{%{$search}%}' 
						OR a.materialid LIKE '%{$search}%'
						OR a.mname LIKE '%{$search}%' 
						OR a.lname LIKE '%{$search}%'
						OR l.materialid LIKE '%{$search}%' 
						OR l.course LIKE '%{$search}%'
						OR l.type LIKE '%{$search}%'  
						OR l.name LIKE '%{$search}%'
						OR l.year LIKE '%{$search}%')	
						AND a.materialid = l.materialid 
						GROUP BY l.materialid
						ORDER BY l.name";
			}
			else if($filter=='name' || $filter =='course' ){
				$stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy,
						GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '\n') as authorname
						FROM author a, librarymaterial l
						WHERE l.$filter LIKE '%{$search}%'	
						AND a.materialid = l.materialid 
						GROUP BY l.materialid
						ORDER BY l.name";

			
			}
			else if($filter=='author'){
				$stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy,
						GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '\n') as authorname
						FROM author a, librarymaterial l
						WHERE (a.fname LIKE '{%{$search}%}' 
						OR a.mname LIKE '%{$search}%' 
						OR a.lname LIKE '%{$search}%')	
						AND a.materialid = l.materialid 
						GROUP BY l.materialid
						ORDER BY l.name";	
			}*/

			$conditions = "";
			$condition_author = "";
				//get the queries
				if($category=='author'){ //check if author is checked
					$condition_author = " (LOWER(fname) LIKE '%{$search}%' OR LOWER(mname) LIKE '%{$search}%' OR LOWER(lname) LIKE '%{$search}%') ";
				}
				else if($category=='name'){ //check if title is checked
					$conditions = "(LOWER(name) LIKE '%{$search}%') ";
				}
				else if($category=='course'){ //check if course is checked
					$conditions = " (LOWER(course) LIKE '%{$search}%') ";
				}
				else if($category=='keyword'){ //check if year is checked
					$conditions = " (LOWER(name) LIKE '%{$search}%' OR LOWER(course) LIKE '%{$search}%')";
					$condition_author = " (LOWER(fname) LIKE '%{$search}%' OR LOWER(mname) LIKE '%{$search}%' OR LOWER(lname) LIKE '%{$search}%') ";
				}

				if ( $conditions != "" && $condition_author != "" ) $stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l WHERE ${conditions} OR 
						materialid IN ( SELECT materialid FROM author WHERE ${condition_author} )
						ORDER BY l.name";

				else $stmt = "SELECT DISTINCT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
						FROM librarymaterial l ORDER BY l.name";

				echo $stmt;
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