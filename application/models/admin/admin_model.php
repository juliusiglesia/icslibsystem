<?php

	class Admin_model extends CI_Model{

	public function viewAll(){
		$this->load->database();

		$query = $this->db->query("SELECT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount,
									l.requirement, l.quantity, l.borrowedcopy, GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname,'; ') as authorname FROM librarymaterial l, author a WHERE l.materialid = a.materialid GROUP BY a.materialid ORDER BY l.name");
		return $query->result(); 

	}

	public function search($filter, $type, $word, $access, $avail){
		$this->load->database();
		 $access2=0;
        if($access==1 || $access==2) {$access2=4;}
        $sql = "SELECT l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, l.borrowedcount, l.requirement,
				l.quantity, l.borrowedcopy, GROUP_CONCAT(a.lname, ', ', a.fname, ' ', a.mname, '; ') as authorname FROM librarymaterial l, author a WHERE l.materialid = a.materialid";

        if($filter!="none"){
            if($filter=="author"){
                
                 $sql = $sql." AND
                         (a.fname like '%$word%'
                         OR a.mname like '%$word%'
                         OR a.lname like '%$word%')";

            }else if($filter=="course" || $filter=="name"){
                
                $sql = $sql." AND l.$filter like '%$word%'";
            }
         }

        if($type!="allTypes"){

            $sql = $sql." AND l.type like '%$type%'";
        }

        if($access!="allAccess"){
            $sql = $sql." AND (l.access='$access' OR l.access='$access2')";
        }

        if($avail!="allAvail"){
            $sql = $sql." AND l.available='$avail'";
        }

        if($word!='' && $filter=="none"){
            
            $sql=$sql." AND (l.materialid like '%$word%'
                            OR l.name like '%$word%'
                            OR l.course like '%$word%'
                            OR a.fname like '%$word%'
                            OR a.mname like '%$word%'
                            OR a.lname like '%$word%'
                            OR l.year like '%$word%')";
        }
        $sql = $sql." GROUP BY a.materialid ORDER BY l.name";
        $query = $this->db->query($sql);
        return $query->result();
	}
			
	public function get_book_info($name){
		$this->load->database();		
		$query = $this->db->query("SELECT * FROM librarymaterial WHERE materialid = '".$this->db->escape_like_str($name)."'");
		return $query->result();
	}
	
	public function book_update($library_material_data, $all_authors, $previous_matID, $previous_isbn){
		$this->load->database();
		$materialid = $this->db->escape_like_str($previous_matID);
        $isbn = $this->db->escape_like_str($previous_isbn);

        $this->db->where('materialid', $materialid);
        $this->db->update('librarymaterial', $library_material_data);

        $this->db->where('materialid', $library_material_data['materialid']);
        $this->db->delete('author'); 
        //echo $library_material_data['materialid'] . $library_material_data['isbn'];
        for ($i=0; $i<count($all_authors); $i++) {
         $all_authors[$i]['materialid'] = $library_material_data['materialid'];
         $all_authors[$i]['isbn'] = $library_material_data['isbn'];
        }
        $this->db->insert_batch("author",$all_authors);
        
	}

    public function book_add($library_material_data, $all_authors){
        $this->load->database();
        $this->db->insert("librarymaterial",$library_material_data); 
        $this->db->insert_batch("author",$all_authors); 
    }
	
	public function book_delete($data){
		$this->load->database();
		//$this->db->delete("librarymaterial",$data);
		$this->db->delete("librarymaterial","materialid = '". $data."'");
	}
    
    public function get_stats_model(){
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
}
?>
