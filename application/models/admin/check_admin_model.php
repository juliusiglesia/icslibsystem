<?php

/**
* Class for the database access of the system
*
* @filename	sign.php
* @date created	27 01 2014
* @author	Adrian Leal
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_admin_model extends CI_Model{
	public function __construct(){
			
	}

	/**
	* Function for checking if the username is existing or not
	* 
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_username(){
		$username = $this->input->post('uname');
		$query = $this->db->query("SELECT * 
									FROM administrator 
									WHERE username LIKE '${username}'");
		return $query->num_rows();
	}

	/**
	* Function for checking if the username 
	* and password combination is correct
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_password(){
		$username =$this->input->post('uname');
		$password = sha1($this->input->post('pword'));

		$query = $this->db->query("	SELECT * 
									FROM administrator 
									WHERE username LIKE '${username}' 
										and password LIKE '${password}'");
		return $query->num_rows();
	}

	/**
	* Function for checking if the username is existing or not
	* 
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_session_validity($user){
		$query = $this->db->query("SELECT * 
									FROM administrator 
									WHERE username LIKE '${user}'");

		if($query->num_rows() == 1) return true;
		else return false;
	}
}
?>