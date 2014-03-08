<?php

/*
*	Filename: rating_model.php
*	Project Name: ICS Library System
*	Date Created: 6 March 2014
*	Created by: John Nicholo Dominguez
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rating_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		//loads the database to allow to allow selection and insertion of data
		$this->load->database();
	}
	
	/*
	*	Gets all the idnumber in the system
	*/
	
	public function insert_rating( $materialid, $idnumber, $isbn, $rating ){
		$this->load->database();

		$sql="SELECT materialid, isbn FROM librarymaterial WHERE materialid='{$materialid}' AND isbn='${isbn}'";
		$matid = $this->db->query($sql);
		
		foreach ($matid->result() as $row){
		   $materialid=$row->materialid;
		   $isbn=$row->isbn;
		}

		$sql="SELECT idnumber FROM borrower WHERE idnumber='{$idnumber}'";
		$idno = $this->db->query($sql);
		
		foreach ($idno->result() as $row){
		   $idnumber=$row->idnumber;
		}

		$data=array(
			'materialid' => $materialid,
			'idnumber' => $idnumber,
			'isbn' => $isbn,
			'rating' => $rating
		);

		$this->db->insert('rating',$data);			
	}

	public function update_rating( $materialid, $idnumber, $isbn, $rating ){

		$sql="UPDATE rating SET rating = '${rating}' WHERE materialid LIKE '${materialid}' AND idnumber LIKE '${idnumber}' AND isbn LIKE '${isbn}'";
		$this->db->query($sql);		
	}

	public function check_rating( $materialid, $idnumber, $isbn, $rating ){
		$materialid = trim($materialid);
		$idnumber = trim($idnumber);
		$isbn = trim($isbn);
		$rating = trim($rating);

		$sql="SELECT COUNT(*) AS count from rating WHERE materialid LIKE '${materialid}' AND idnumber LIKE '${idnumber}'";
		$result = $this->db->query($sql);
		$count = $result->row()->count;
		
		if($count == 0){
			$this->insert_rating($materialid, $idnumber, $isbn, $rating);
		}
		else{
			$this->update_rating($materialid, $idnumber, $isbn, $rating);			
		}			
	}
}//end of class

?>