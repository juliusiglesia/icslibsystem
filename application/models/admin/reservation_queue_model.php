<?php

/*
*	Filename: reservation_queue_model.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_queue_model extends CI_Model{
	public function __construct(){
			
	}

	/*
	*	Gets the lists of the reservations in the system
	*/
	public function get_reservations() {
		
		/*
		*	get all the id, store it in an array
		*	while( array is not empty ){
		*		count = get the value of quantity - borrowed copy for array[i] // that is the available copy		
		*		get all the reservation for the array[i] and limit the result from 1 to count
		*		store it into the return array
		*	}
		*
		*/

		$return_array = array();
		$this->load->database();
		$query = $this->db->query("SELECT DISTINCT reservation.materialid 
									FROM librarymaterial INNER JOIN reservation ON librarymaterial.materialid = reservation.materialid");
		
		$result = $query->result();
		
		foreach($result as $row) {
			// get the materialid, store it to a variable
			$temp = $row->materialid;

			// make the query
			$query = $this->db->query("SELECT quantity-borrowedcopy AS available 
										FROM librarymaterial 
										WHERE materialid LIKE '${temp}'");				
			
			// get the result, store it t a variable
			$count = $query->row();
			$count = $count->available;
			
			// get the n reservations for a library material, n = available copy of material
			$query = $this->db->query("SELECT * FROM reservation INNER JOIN librarymaterial ON reservation.materialid=librarymaterial.materialid 
										WHERE reservation.materialid LIKE '${temp}' 
										ORDER BY queue ASC 
										LIMIT 0, ${count}");
			
			// get the result as object
			$query = $query->result();

			// add the result of the query in the return array by typecasting the object to an array
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
		}

		return $return_array;
	}
}

?>