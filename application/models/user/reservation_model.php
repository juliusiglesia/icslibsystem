<?php

/*
*	Filename: reservation.php
*	Project Name: ICS Library System
*	Created by: Borrower Team
*
*/

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Reservation_model extends CI_Model
{
	
	public function _construct()
	{
		parent :: _construct();
	}
	
	/**
	*	function that checks if the user is waitlisted and gets the material where the user is queued
	*/
	public function if_waitlisted($userid)
	{	
		$this->load->database();
		$this->load->library("session");
		$userid = $this->session->userdata('email');
		
		$idno = $userid;
		
		$idnum = "SELECT idnumber FROM borrower WHERE email='{$idno}'";

		$bmidnum = $this->db->query($idnum);

			foreach ($bmidnum->result() as $id)
			{
			   $idn = $id->idnumber;
			}
		
		$material = "SELECT materialid FROM reservation WHERE idnumber='{$idn}'";

		$waitl = $this->db->query($material);

		$waitdata = array();

			foreach ($waitl->result() as $row)
			{
			    $waitdata[] = array(
					'materialid' => $row->materialid,
				);
			}

		return $waitdata;	
		
	}

	/**
	*	function that checks if the user has reservation 
	*	gets the material the user is reserving
	*/
	public function if_reserved($userid)
	{	
		$this->load->database();
		$this->load->library("session");

		$userid = $this->session->userdata('email');
		$reserved_flag = 0;
	
		$idno = $userid;
		$return_array = array();
		
		$idnum = "SELECT idnumber FROM borrower WHERE email='{$idno}'";

		$bmidnum = $this->db->query($idnum);

		foreach ($bmidnum->result() as $id)
		{
			$idn = $id->idnumber;
		}
		
		$material = "SELECT materialid FROM borrowedmaterial 
					 WHERE idnumber='{$idn}' 
					 AND status='BORROWED'";

		$res = $this->db->query($material);
		$data = array();

			foreach ($res->result() as $row)
			{
			    $data[] = array(
					'materialid' => $row->materialid
				);
			}

		return $data;	
		
	}

	/**
	*	function that cancels a reservation with the input materialid
	*/
	public function cancel_res($matid, $isbn)
	{
		$this->load->database();
		$idnum = $this->session->userdata('idnumber');
		$i = 0;

		$queue_detector = "SELECT queue FROM reservation 
						   WHERE idnumber = '{$this->session->userdata('idnumber')}' 
						   AND materialid = '{$matid}'";
		
		$queue = $this->db->query($queue_detector);

		foreach($queue->result() as $row)
		{
			$number = $row->queue;
			$i = $i +1;
		}

		if($i>0)
		{
			//cancel reservation
			//remove from reservation table
			$stmt  = "DELETE FROM reservation 
					  WHERE idnumber = '{$this->session->userdata('idnumber')}' 
					  AND materialid = '{$matid}'";

			$this->db->query($stmt);
			
			//update reservation count
			$decrement = "UPDATE reservation SET queue=queue-1 
						  WHERE materialid='{$matid}' 
						  AND queue>{$number}";

			$query = $this->db->query($decrement);	

			//insert into log
			//material reservation
			$stmt  = "INSERT INTO log( `action`, `time`, `idnumber`, `materialid`, `isbn` ) 
					  VALUES ( 'cancelled reservation', NOW(), '$idnum', '$matid', '$isbn')";

			$this->db->query($stmt);
		}	

	}

	/**
	*	function that gets the librarymaterial that the user wants to reserve
	*	insert it into the reservation table
	*/
	public function get_book($materialid, $userid)
	{
		$this->load->database();
		
		$materialid = $materialid;
		$userid = $userid;
		$return_array = array();	
		
		$idnum = "SELECT idnumber FROM borrower WHERE email='{$userid}'";

		$bmidnum = $this->db->query($idnum);
		
		foreach ($bmidnum->result() as $id)
		{
		   $idno = $id->idnumber;
			   
		}

		$queue = "SELECT COUNT(queue) AS number FROM reservation 
				  WHERE materialid='{$materialid}'";

		$q = $this->db->query($queue);

		foreach ($q->result() as $count)
		{
		   $qno = $count->number;
		}

		$qno = $qno + 1;

		$queue = "SELECT isbn FROM librarymaterial WHERE materialid='{$materialid}'";

		$q = $this->db->query($queue);

		foreach ($q->result() as $res)
		{
		   $isbn = $res->isbn;
		}
		
		$insert = "INSERT INTO reservation( idnumber, materialid, queue, isbn ) 
				   VALUES ( '{$idno}', '{$materialid}', '{$qno}', '{$isbn}' )";

		$insertbm = $this->db->query($insert);
		
	}

	/**
	*	function that gets the librarymaterial that is borrowed
	*/
	public function get_borrowedcopy($materialid)
	{
		$this->load->database();
		
		$materialid = $materialid;
		
		$stmt = "SELECT status FROM borrowedmaterial 
				 WHERE materialid = '{$materialid}' and status='BORROWED'";

		$query = $this->db->query($stmt);
		return $query->result();
			
	}

	/**
	*	function that gets the rank of the user from the queued reservations
	*/
	public function get_rank($userid)
	{	
		$this->load->database();
		$this->load->library("session");
		
	
		$userid = $this->session->userdata('email');
	
		$idno = $userid;
		$return_array = array();
		
		$idnum = "SELECT idnumber FROM borrower WHERE email='{$idno}'";

		$bmidnum = $this->db->query($idnum);
		
		foreach ($bmidnum->result() as $id)
		{
			$idn = $id->idnumber;
		}
		
		$r = "SELECT materialid, queue FROM reservation 
			  WHERE idnumber='{$idn}' 
			  ORDER BY materialid";

		$res = $this->db->query($r);
		$query = $res->result();

		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;
		
		return $return_array;
		
	}
	
	/**
	*	function that gets the total librarymaterial that is reserved
	*/
	public function get_total($userid)
	{	
		$this->load->database();
		$this->load->library("session");
	
		//get email of current user
		//save it into a variable ($userid)
		$userid = $this->session->userdata('email');
	
		$idno = $userid;
		$return_array = array();
		
		$idnum = "SELECT idnumber FROM borrower WHERE email='{$idno}'";

		$bmidnum = $this->db->query($idnum);

		foreach ($bmidnum->result() as $id)
		{
			$idn = $id->idnumber;
		}
		
		$m = "SELECT materialid, COUNT(materialid) AS tq 
		      FROM reservation GROUP BY materialid ORDER BY materialid";
		
		$res = $this->db->query($m);
		$query = $res->result();

		foreach ($query as $tuple)
			$return_array[count($return_array)] = (array)$tuple;
		
		return $return_array;
		
	}

	/**
	*	function that gets the librarymaterial is waitlisted
	*/
	public function waitlisted_matid($userid)
	{	
		$this->load->database();

		$idno = $userid;
		$return_array = array();

		$idnum = "SELECT idnumber FROM borrower where email='{$userid}'";

		$bmidnum = $this->db->query($idnum);

		foreach ($bmidnum->result() as $id)
		{
		   $idno = $id->idnumber;
		}

		$all_mat = "SELECT materialid FROM reservation 
					WHERE idnumber='{$idno}' ORDER BY materialid";

		$list_mat = $this->db->query($all_mat);

		foreach ($list_mat->result() as $mats)
		{
			$mid = $mats->materialid;

			$stmt = "SELECT * FROM author a, librarymaterial l 
					 WHERE a.materialid LIKE '%{$mid}%' 
					 AND a.materialid = l.materialid 
					 ORDER BY l.materialid";
		
			$query = $this->db->query($stmt);
			$query = $query->result();
	
			foreach ($query as $tuple)
			{
				$return_array[count($return_array)] = (array)$tuple;
			}	

		}

		return $return_array;	
		
	}

	/**
	*	function that returns maximum allowable sum of library material to be borrowed and reserved
	*/
	public function get_max()
	{
		$this->load->database();

		//select max
		$stmt = "SELECT max FROM settings";

		$query = $this->db->query($stmt);
		$result = $query->result();

		//return max
		return $result;
	}

}

/* 	End of reservation_model.php
	* 	Location: ./application/models/user/reservation_model.php 
*/
