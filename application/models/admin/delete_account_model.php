<?php

/**
* Class for the database access of the system
*
* @filename	sign.php
* @date created	27 01 2014
* @author	Adrian Leal
*/

class Delete_account_model extends CI_Model{

	public function check_combination(){
		$user = $this->session->userdata('user');
		$pass = sha1(trim($this->input->post('password')));
		$query = $this->db->query("SELECT COUNT(*) AS count 
									FROM administrator
									WHERE username LIKE '${user}' 
										AND password LIKE '${pass}'");
		return $query->row()->count;
	}

	public function delete_account(){
		$user = trim($this->input->post('idnumber'));
		$query = $this->db->query("DELETE FROM borrower
									WHERE idnumber LIKE '${user}'");
		$query = $this->db->query("DELETE FROM reservation
									WHERE idnumber LIKE '${user}'");	
	}

	public function DELETE_reservations(){
		$user = trim($this->input->post('idnumber'));
		$query = $this->db->query("DELETE FROM reservation
									WHERE idnumber LIKE '${user}'");
	}

}
?>