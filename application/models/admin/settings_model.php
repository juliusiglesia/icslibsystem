<?php

/*
*	Filename: notification_model.php
*	Project Name: ICS Library System
*	Date Created: 26 January 2014
*	Created by: Charlene C. Canedo
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		//loads the database to allow to allow selection and insertion of data
		$this->load->database();
	}
	
	/*
	*	Gets all the idnumber in the system
	*/

	public function set_info( $start_sem_value, $end_sem_value){
		$query = "UPDATE settings SET start = '${start_sem_value}', end = '${end_sem_value}' WHERE id LIKE 1";
		$this->db->query($query);
	}
	
	public function set_password( $newpw ){
		$query = "UPDATE administrator SET password = sha1('${newpw}') WHERE username LIKE 'icslibadmin'";
		$this->db->query($query);
	}
	
	public function set_enable(){
		$query = "UPDATE settings SET fineenable = 1 WHERE id LIKE 1";
		$this->db->query($query);
	}
	
	public function set_disable(){
		$query = "UPDATE settings SET fineenable = 0 WHERE id LIKE 1";
		$this->db->query($query);
	}

	public function get_data(){
		$query = "SELECT * FROM settings";
		$sql = $this->db->query($query);
		return $sql->result();
	}

	public function set_fine( $fine ){
		$query = "UPDATE settings SET fine = '${fine}' WHERE id LIKE 1";
		$this->db->query($query);	
	}

}//end of class

?>