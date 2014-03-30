<?php

/*
*	Filename: log_model.php
*	Project Name: ICS Library System
*	Created by: borrower team
*
*/

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Log_model extends CI_Model
{
	
	public function _construct()
	{
		parent :: _construct();
	}

	/**
	*	function that finds the user from the borrower table using inputs username and password
	*/
	public function get_borrower($username, $password)
	{
		$this->load->database();
		$password = sha1($password);

		$stmt = "SELECT * FROM `borrower` WHERE (email = '{$username}' 
					OR idnumber = '{$username}') AND password = '{$password}' AND status = 'ACTIVATED'";

		$query = $this->db->query($stmt);
		return $query->result();
	}


	/**
	*	function that gets the attributes of the user from the sample table using idnumber
	*/	
	public function get_info($idnumber)
	{
		$this->load->database();

		$stmt = "SELECT * FROM `sample` WHERE idnumber = '{$idnumber}'";

		$query = $this->db->query($stmt);
		return $query->result();
	}

	/**
	*	function that obtains the password from the borrower table using the input username
	*/
	public function get_password($username)
	{
		$this->load->database();

		$stmt = "SELECT idnumber,email,password FROM `borrower` 
					WHERE email = '{$username}' or idnumber = '{$username}'";

		$query = $this->db->query($stmt);
		return $query->result();
	}

	/**
	*	function that sets the lastsession of the borrower table using the input username
	*/
	public function set_last_session($username)
	{
		$this->load->database();

		$stmt = "UPDATE `borrower` SET `lastsession` = NOW() 
					WHERE `idnumber`= '$username'";

		$query = $this->db->query($stmt);
		return true;
	}

	/**
	*	function that inserts to log table the current user
	*/
	public function update_log_login($username)
	{
		$this->load->database();

		//insert into log
		//user logged in
		$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
					VALUES ('logged in', NOW(), '$username')";

		$query = $this->db->query($stmt);
		return true;
	}

	/**
	*	function that gets the isbn from the librarymaterial table using the input materialid
	*/
	public function get_isbn($matid)
	{
		$this->load->database();

		$stmt = "SELECT isbn FROM librarymaterial WHERE materialid = '$matid'";
		
		$query = $this->db->query($stmt);
		$result = $query->result();
		return $result;
	}
		
}
	/* 	End of file log_model.php
	* 	Location: ./application/models/user/log_model.php 
	*/
?>