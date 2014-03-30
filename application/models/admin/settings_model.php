<?php

/*
*	Filename: settings_model.php
*	Project Name: ICS Library System
*	Date Created: 26 January 2014
*	Created by: CMSC 128 AB-6L
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		//loads the database to allow to allow selection and updates of data
		$this->load->database();
	}
	
	/*
	*	Updates the database sets the value of start and end of sem depending upon the admin.
	*	Inserts changes or actions on the table log.
	*/
	public function set_info( $start_sem_value, $end_sem_value){
		$query = "UPDATE settings SET start = '${start_sem_value}', end = '${end_sem_value}' WHERE id LIKE 1";
		$this->db->query($query);
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('updated sem info', NOW(), 'Admin')");
	
	}
	/*
	*	Updates the database sets the value of the password depending upon the admin.
	*	Inserts changes or actions on the table log.
	*/
	public function set_password( $newpw ){
		$query = "UPDATE administrator SET password = sha1('${newpw}') WHERE username LIKE 'icslibadmin'";
		$this->db->query($query);
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('changed password', NOW(), 'Admin')");
	}
	/*
	*	Updates the database sets the value of fineenable to 1 whenever the admin wishes to enable fine.
	*	Inserts changes or actions on the table log.
	*/
	public function set_enable(){
		$query = "UPDATE settings SET fineenable = 1 WHERE id LIKE 1";
		$this->db->query($query);
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('enabled fine', NOW(), 'Admin')");
	}
	/*
	*	Updates the database sets the value of fineenable to 0 whenever the admin wishes to disable fine.
	*	Inserts changes or actions on the table log.
	*/
	public function set_disable(){
		$query = "UPDATE settings SET fineenable = 0 WHERE id LIKE 1";
		$this->db->query($query);
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('disabled fine', NOW(), 'Admin')");
	}
	/*
	*	Gets all the data from the table settings.
	*/
	public function get_data(){
		$query = "SELECT * FROM settings";
		$sql = $this->db->query($query);
		return $sql->result();
	}
	/*
	*	Updates the database sets the value of fine depending upon the admin.
	*	Inserts changes or actions on the table log.
	*/
	public function set_fine( $fine ){
		$query = "UPDATE settings SET fine = '${fine}' WHERE id LIKE 1";
		$this->db->query($query);
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('set fine', NOW(), 'Admin')");	
	}
	/*
	*	Updates the database sets the value of max depending upon the admin.
	*	Inserts changes or actions on the table log.
	*/
	public function set_max( $max ){
		$query = "UPDATE settings SET max = '${max}' WHERE id LIKE 1";
		$this->db->query($query);	
		$this->db->query("INSERT INTO log(action, time, idnumber) VALUES('changed max', NOW(), 'Admin')");
	}
}//end of class

?>