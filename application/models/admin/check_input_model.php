<?php
	class Check_input_model extends CI_Model {
		public function check_isbn( $isbn ){
			$sql = "SELECT COUNT(isbn) AS count
					FROM librarymaterial
					WHERE isbn LIKE '${isbn}'";

			$query = $this->db->query($sql);
			return $query->row()->count;
		}

		public function check_materialid( $materialid ){
			$sql = "SELECT COUNT(materialid) AS count
					FROM librarymaterial
					WHERE materialid LIKE '${materialid}'";

			$query = $this->db->query($sql);
			return $query->row()->count;
		}
	}
?>
