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
		// get all the materialids with reservations
		$query = $this->db->query("SELECT DISTINCT reservation.materialid, reservation.isbn 
									FROM librarymaterial INNER JOIN reservation
										ON librarymaterial.materialid = reservation.materialid 
											AND librarymaterial.isbn = reservation.isbn 
										WHERE reservation.materialid NOT IN 
										( SELECT materialid 
											FROM borrowedmaterial
											WHERE status LIKE 'BORROWED'
											GROUP BY idnumber
											HAVING COUNT(idnumber) > 3
										) ");
		
		$result = $query->result();
		
		foreach($result as $row) {
			// get the materialid, store it to a variable
			$matid = $row->materialid;
			$isbn = $row->isbn;

			// make the query for determining the number of available materials
			$query = $this->db->query("SELECT quantity-borrowedcopy AS available 
										FROM librarymaterial 
										WHERE materialid LIKE '${matid}'
											AND isbn LIKE '${isbn}'");				
			
			// get the result, store it t a variable
			$count = $query->row();
			$count = $count->available;

			$query = $this->db->query("SELECT COUNT(*) AS total 
										FROM reservation 
										WHERE materialid LIKE '${matid}'
											AND isbn LIKE '${isbn}'");				
			
			// get the result, store it t a variable
			$total = $query->row();
			$total = $total->total;

			$query = $this->db->query("SELECT MIN(queue) AS min 
										FROM reservation 
										WHERE materialid LIKE '${matid}'
											AND isbn LIKE '${isbn}'");				
			
			// get the result, store it t a variable
			$min = $query->row();
			$min = $min->min;

			if( $search == "" ){
				// get the n reservations for a library material, n = available copy of material
				$query = $this->db->query("SELECT *, ${total} AS total, queue-${min}+1 AS queue FROM reservation INNER JOIN librarymaterial 
												ON reservation.materialid=librarymaterial.materialid
											WHERE reservation.materialid LIKE '${matid}'
												AND reservation.isbn LIKE '${isbn}'
											ORDER BY queue, 1-started ASC
											LIMIT 0, ${count}");
			} else {
				$search = strtolower($search);
				$temp_search = explode(" ", $search);
				$where = "( ";
				$where2 = "( ";
				for( $i = 0; $i < count($temp_search); $i++ ){
					$where = $where . "LOWER(librarymaterial.materialid) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(name) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(idnumber) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "LOWER(type) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "year LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "queue LIKE '%" . $temp_search[$i] . "%' OR ";
					$where = $where . "startdate LIKE '%" . $temp_search[$i] . "%' OR ";
					$where2 = $where2 . "LOWER(fname) LIKE '%" . $temp_search[$i] . "%' OR ";
					$where2 = $where2 . "LOWER(mname) LIKE '%" . $temp_search[$i] . "%' OR ";
					
					if ( $i == count($temp_search)-1 ) {
						$where = $where . "reservation.claimdate LIKE '%" . $temp_search[$i] . "%' )";
						$where2 = $where2 . "LOWER(lname) LIKE '%" . $temp_search[$i] . "%' )";
					} else {
						$where = $where . "reservation.claimdate LIKE '%" . $temp_search[$i] . "%' OR ";
						$where2 = $where2 . "LOWER(lname) LIKE '%" . $temp_search[$i] . "%' OR ";
					}
					
				}				

				$query = $this->db->query("SELECT * FROM reservation INNER JOIN librarymaterial ON reservation.materialid=librarymaterial.materialid
											WHERE (reservation.materialid LIKE '${matid}' AND	${where} )
												OR reservation.materialid IN ( 
													SELECT materialid 
													FROM author 
													WHERE materialid LIKE '${matid}' AND ${where2}
												)
											ORDER BY queue ASC 
											LIMIT 0, ${count}");	
			}
			// get the result as object
			$query = $query->result();

			// add the result of the query in the return array by typecasting the object to an array
			foreach ($query as $tuple){
				$id = $tuple->materialid;
				$isbn = $tuple->isbn;
				$query = $this->db->query("SELECT fname, mname, lname 
											FROM author
											WHERE materialid LIKE '${id}' AND isbn LIKE '${isbn}'");
		
				$result = $query->result();
				$tuple->author = (array)$result;

				// get the author depending on the tuple's library material id and isbn
				// add it to $query variable

				$return_array[count($return_array)] = (array)$tuple;

			}
		}

		return $return_array;
	}

	public function update_claimed_date( $materialid, $isbn, $idnumber, $start_date ){
		//$date="2014-01-31"; //$date="2014-02-28";
		
		//if ordinary day, just add 3 days
		$claimed_date = date("Y-m-d", strtotime($start_date . "+3 day"));
		//If Thurs, from the ordinary day add 2 days as a count for Saturday and Sunday
		if(date('l', strtotime( $start_date)) == "Thursday") $claimed_date = date("Y-m-d", strtotime($claimed_date. "+2 day"));
		//If Fri, from the ordinary day add 2 days as a count for Saturday and Sunday
		if(date('l', strtotime( $start_date)) == "Friday") $claimed_date = date("Y-m-d", strtotime($claimed_date. "+2 day"));
		return $claimed_date;
	}
	
	public function do_claim( $materialid, $isbn, $idnumber, $start_date, $expectedreturn ){
		//stores the inputs to an array and finally insert it to table borrowedmaterial	
        $data = array(
					'idnumber'=>$idnumber,
					'materialid'=>$materialid,
					'isbn'=>$isbn,
					'start'=>$start_date,
					'expectedreturn'=>$expectedreturn
				);
		
		$this->db->insert('borrowedmaterial', $data);
		$query1 = "UPDATE librarymaterial SET borrowedcount = borrowedcount+1, borrowedcopy = borrowedcopy+1 WHERE materialid LIKE '${materialid}' AND isbn LIKE '${isbn}'";
		$query = "DELETE from reservation where idnumber LIKE '${idnumber}' AND materialid LIKE '${materialid}' AND isbn LIKE '${isbn}'";
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