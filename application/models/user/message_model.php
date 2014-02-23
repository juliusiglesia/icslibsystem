<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Message_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}
	
	//Gets the messsage from the database and return the data to the controller
	public function get_messages($useridnumber)
		{
			
			$return_array = array();
			
			$this->load->database();
			$stmt = "SELECT  `message` FROM  `notification` WHERE  `idnumber` =  '$useridnumber'";
			$query = $this->db->query($stmt);

			$result = $query->result();
			
			foreach($result as $row) {
				$temp = $row->message;

			// make the query
			$query = $this->db->query("SELECT `message` FROM `template` WHERE `id` = $temp");				
			$query = $query->result();

			// add the result of the query in the return array by typecasting the object to an array
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			}
			
			return $return_array;
		}
	
	
}
	/* 	End of file Message_model.php
	* 	Location: ./application/models/user/message_model.php 
	*/
?>