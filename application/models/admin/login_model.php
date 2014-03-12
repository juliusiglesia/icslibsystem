<?php

/**
* Class for the database access of the system
*
* @filename	sign.php
* @date created	27 01 2014
* @author	Adrian Leal
*/

class Login_model extends CI_Model{

	public function get_info(){
		$query = $this->db->query("SELECT fname, mname, lname, email, enum, username FROM administrator WHERE username LIKE 'icslibadmin'");
		return $query->row();
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
		if(isset($_POST["submit"])){
			$user = $_POST["uname"];
			$query = $this->db->query("SELECT * 
										FROM administrator 
										WHERE username LIKE '$user'");
			return $query->num_rows();
		}
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
		$query = $this->check_username();
		if($query > 0){
			if(isset($_POST["submit"])){
				$user = $_POST["uname"];
				$pass = sha1($_POST["pword"]);

				$query1 = $this->db->query("SELECT * 
											FROM administrator 
											WHERE username LIKE '${user}' and password LIKE '${pass}'");
				if($query1->num_rows() > 0){
					return $query1->num_rows();
				}
				else{
					echo "Invalid username/password combination.<br/>";
					echo "<a href='login'>Back</a><br/>";
				}
			}
		}
		else{
			echo "Username does not exist<br/>";
			echo "<a href='login'>Back</a><br/>";
		}
	}

	/**
	* Function for retrieving the query of the username
	* and password combination that the user entered
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function retrieve_query_result(){

		$user = $_POST["uname"];
		$pass = sha1($_POST["pword"]);

		$query1 = $this->db->query("SELECT * FROM administrator WHERE username LIKE '${user}' and password LIKE '${pass}'");
		$result = $query1->result();
		return $result;
	}

	/**
	* Function for checking the user input
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check(){
		if(!isset($_SESSION['user'])){
			$query1 = $this->check_password();
		}
		if($query1 > 0){
			return true;
		}
		else
			return false;
	}

}
?>