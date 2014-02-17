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

	public function update_claimed_date( $materialid, $idnumber, $start_date ){
		//$date="2014-01-31"; //$date="2014-02-28";
		
		//if ordinary day, just add 3 days
		$claimed_date = date("Y-m-d", strtotime($start_date . "+3 day"));
		//If Thurs, from the ordinary day add 2 days as a count for Saturday and Sunday
		if(date('l', strtotime( $start_date)) == "Thursday") $claimed_date = date("Y-m-d", strtotime($claimed_date. "+2 day"));
		//If Fri, from the ordinary day add 2 days as a count for Saturday and Sunday
		if(date('l', strtotime( $start_date)) == "Friday") $claimed_date = date("Y-m-d", strtotime($claimed_date. "+2 day"));
		return $claimed_date;
	}
	
	public function do_claim( $materialid, $idnumber, $start_date, $expectedreturn ){

		//stores the inputs to an array and finally insert it to table borrowedmaterial	
        $data = array(
					'idnumber'=>$idnumber,
					'materialid'=>$materialid,
					'start'=>$start_date,
					'expectedreturn'=>$expectedreturn
				);
		
		$this->db->insert('borrowedmaterial', $data);
		$query = "DELETE from reservation where idnumber LIKE '${idnumber}' AND materialid LIKE '${materialid}'";
		$this->db->query($query);
	}
}

?>