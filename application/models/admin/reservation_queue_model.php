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
	public function get_reservations( $search = "" ) {
		
		/*
		*	get all the id, store it in an array
		*	while( array is not empty ){
		*		count = get the value of quantity - borrowed copy for array[i] // that is the available copy		
		*		get all the reservation for the array[i] and limit the result from 1 to count
		*		store it into the return array
		*	}
		*
		*/

		$search = trim($search);

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
			
			if( $search == "" ){
			// get the n reservations for a library material, n = available copy of material
			$query = $this->db->query("SELECT * FROM reservation INNER JOIN librarymaterial ON reservation.materialid=librarymaterial.materialid
										WHERE reservation.materialid LIKE '${temp}' 
										ORDER BY queue ASC 
										LIMIT 0, ${count}");
			}

			else {
				$search = strtolower($search);
				$temp_search = explode(" ", $search);
				$where = "( ";
				for( $i = 0; $i < count($temp_search); $i++ ){
					$where = $where . "LOWER(librarymaterial.materialid) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(name) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(idnumber) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(type) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "queue LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "startdate LIKE '%" . $temp_search[$i] . "%' OR ";
					if ( $i == count($temp_search)-1 ) $where = $where . "reservation.claimdate LIKE '%" . $temp_search[$i] . "%' )";
					else $where = $where . "reservation.claimdate LIKE '%" . $temp_search[$i] . "%' OR ";
				}				

				$query = $this->db->query("SELECT * FROM reservation INNER JOIN librarymaterial ON reservation.materialid=librarymaterial.materialid
											WHERE reservation.materialid LIKE '${temp}' AND	${where}
											ORDER BY queue ASC 
											LIMIT 0, ${count}");	
				}
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
		$query1 = "UPDATE librarymaterial SET borrowedcount = borrowedcount+1, borrowedcopy = borrowedcopy+1 WHERE materialid LIKE '${materialid}'";
		$query = "DELETE from reservation where idnumber LIKE '${idnumber}' AND materialid LIKE '${materialid}'";
		//echo "<script> alert(${query1}) </script>";
		$this->db->query($query1);
		$this->db->query($query);
	}


	public function get_author(){
		$query = $this->db->query("SELECT fname, mname, lname FROM author WHERE materialid LIKE '${materialid}'");
		return $query->result();
	}

	public function search_reservations(){
		$search = $this->input->post('search');
		return $this->get_reservations( $search );
	}


}

?>