
<?php
	class Basic_search_model extends CI_Model {
		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_search_res($search, $filter)
		{
			
			if($filter==NULL){
				$filter='keyword';
			}

			$this->load->database();
			$return_array = array();

			//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
			
			if($filter == 'keyword'){
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
			}

			//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

			$query = $this->db->query($stmt);
			$query = $query->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			return $return_array;
		}
	}	
?>