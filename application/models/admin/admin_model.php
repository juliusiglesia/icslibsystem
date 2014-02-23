<?php

	class Admin_model extends CI_Model{

	public function viewAll(){
		$this->load->database();

		$query = $this->db->query("SELECT DISTINCT * FROM librarymaterial l,author a where l.materialid=a.materialid ORDER BY l.name");
		return $query; 

	}

	public function search($filter, $type, $word, $access, $avail){
		$this->load->database();
		$access2=0;
        if($access==1 || $access==2) {$access2=4;}
		if($filter=="author"){
                    if($type!="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND l.type='$type'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND l.type='$type'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }
                        
                    }else if($type=="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql ="SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%')
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }

            		}
        }else if($filter=="title"){
                    if($type!="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND l.type='$type'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND l.type='$type'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }
                    }else if($type=="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql ="SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                           l.name like '%$word%'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql ="SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.name like '%$word%'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }

                    }

                }else if($filter=="subject"){
                    if($type!="allTypes"){
                       if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND l.type='$type'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND l.type='$type'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }
                    }else if($type=="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql ="SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            l.course like '%$word%'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }

                    }
                }else{//none
                    if($type!="allTypes"){
                       if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%')
                                            AND l.type='$type'
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql ="SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%')
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%')
                                            AND l.type='$type'
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%')
                                            AND l.type='$type'
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }
                    }else if($type=="allTypes"){
                        if($access=="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%'
                                            OR l.type='%$word%')
                                            ORDER BY l.name";
                        }else if($access!="allAccess" && $avail=="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%'
                                            OR l.type='%$word%')
                                            AND (l.access='$access' OR l.access='$access2')
                                            ORDER BY l.name";
                        }else if($access=="allAccess" && $avail!="allAvail"){
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%'
                                            OR l.type='%$word%')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }else{
                                $sql = "SELECT DISTINCT * FROM librarymaterial l,author a 
                                            where l.materialid=a.materialid AND
                                            (l.materialid like '%$word%'
                                            OR l.name like '%$word%'
                                            OR l.course like '%$word%'
                                            OR a.fname like '%$word%'
                                            OR a.mname like '%$word%'
                                            OR a.lname like '%$word%'
                                            OR l.year like '%$word%'
                                            OR l.type='%$word%')
                                            AND (l.access='$access' OR l.access='$access2')
                                            AND l.available='$avail'
                                            ORDER BY l.name";
                        }
                }
            }
            $query = $this->db->query($sql);
			return $query;
	}
			
	public function get_book_info($name){
		$this->load->database();		
		$query = $this->db->query("SELECT * FROM librarymaterial WHERE materialid = '".$this->db->escape_like_str($name)."'");
		return $query->result();
	}
	
	public function book_update($data, $data1){
		$this->load->database();
		$id = $this->db->escape_like_str($data['materialid']);
		$this->db->update("librarymaterial",$data1,"materialid = '". $id."'"); 	
	}
	
	public function author_update($data,$data2){
		$this->load->database();
		$id = $this->db->escape_like_str($data['materialid']); 
		$this->db->update("author",$data2,"materialid = '". $id."'"); 	
	}
	public function book_delete($data){
		$this->load->database();
		$this->db->delete("librarymaterial",$data);
	}
    
    public function get_stats_model(){
         $this->load->database();
         $sql = "SELECT COUNT(DISTINCT l.materialid) AS libmatcount, COUNT(DISTINCT b.id) AS bormatcount, (COUNT(DISTINCT l.materialid) - COUNT(DISTINCT b.id)) AS diffcount FROM borrowedmaterial b, librarymaterial l";
         $query = $this->db->query($sql);
         return $query->result();
     }	
}
?>
