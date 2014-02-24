<?php
	class Get_stats_model extends CI_Model {

		public function get_library_stats(){
			$this->load->database();
	        $sql = "SELECT COUNT(DISTINCT l.materialid) AS libmatcount, COUNT(DISTINCT b.id) AS bormatcount, (COUNT(DISTINCT l.materialid) - COUNT(DISTINCT b.id)) AS diffcount FROM borrowedmaterial b, librarymaterial l";
	        $query = $this->db->query($sql);
	        return $query->result();
		}

	}
?>
