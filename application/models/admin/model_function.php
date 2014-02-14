<?php
class Model_function extends CI_Model {
	public function book_list(){
		$query = $this->db->query("SELECT * FROM librarymaterial");
		return $query->result();
	}
	public function get_book_info($name){		
		$query = $this->db->query("SELECT * FROM librarymaterial WHERE materialid = '".mysql_real_escape_string($name)."'");
		return $query->result();
	}
	public function book_update($data){
		$id = mysql_real_escape_string($data['materialid']);
		$this->db->update("librarymaterial",$data,"materialid = '". $id."'");
	}
	public function book_delete($data){
		$this->db->delete("librarymaterial",$data);
	}
}
?>