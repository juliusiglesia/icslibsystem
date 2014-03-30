<?php


/*
*	Filename: basic_search_model.php
*	Project Name: ICS Library System
*	Created by: Borrower's Team
*
*/


if(! defined('BASEPATH')) exit ('No direct script access allowed');

	class Basic_search_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
		}
	
		public function get_search_res($search, $category)
		{
			//sanitize data
			$search = $this->db->escape_like_str($search);
			$search = trim($search);
			$search = mysql_real_escape_string($search);
			$search = htmlspecialchars($search);
			$search = str_replace("'", '', $search);

			$return_array = array();
			$this->load->database();
			$this->load->library("session");
			
			$conditions = array();
			$search = strtolower($search);

			$temp_search = explode(" ", $search);

		
			for( $i=0; $i<count($temp_search); $i++ )
			{	
				//get the queries
				if($category == 'author'){ //check if author is checked
					$conditions[] = "(a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' 
									 OR a.lname LIKE '%{$temp_search[$i]}%')";
				}
				else if($category == 'name'){ //check if title is checked
					$conditions[] = "(l.name LIKE '%{$temp_search[$i]}%')";
				}
				else if($category == 'course'){ //check if course is checked
					$conditions[] = "(l.course LIKE '%{$temp_search[$i]}%' 
									 OR l.materialid LIKE '%{$temp_search[$i]}%')";
				}
				else if($category == 'keyword'){ //check if year is checked
					$conditions[] = "(l.name LIKE '%{$temp_search[$i]}%' OR l.course LIKE '%{$temp_search[$i]}%') 
									 OR (a.fname LIKE '%{$temp_search[$i]}%' OR a.mname LIKE '%{$temp_search[$i]}%' 
									 OR a.lname LIKE '%{$temp_search[$i]}%')";
				}

			}
				
				$id = $this->session->userdata('idnumber');

				if(count($conditions) != 0)
				{			
					$stmt = "SELECT DISTINCT (SELECT AVG(rating) FROM rating WHERE materialid = l.materialid) AS avg ,
							 l.materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year, l.edvol, 
							 l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
							 FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid 
							 WHERE ". implode(' OR ', $conditions) . "ORDER BY l.name";
				}
				else
				{
					$stmt = "SELECT DISTINCT (SELECT AVG(rating) FROM rating WHERE materialid = l.materialid) AS avg ,
							 l.materialid as materialid, l.isbn, l.name, l.course, l.available, l.access, l.type, l.year,
							 l.edvol, l.borrowedcount, l.requirement, l.quantity, l.borrowedcopy
							 FROM librarymaterial l INNER JOIN author a ON a.materialid = l.materialid ORDER BY l.name";	
				}

				$query = $this->db->query($stmt);
				$query = $query->result();
		
				foreach ($query as $tuple)
				{
					if(!isset($tuple->materialid))
					{
						$id = '';
					}
					else
						$mid = $tuple->materialid;
					
						$isbn = $tuple->isbn;
						
						$query = $this->db->query("SELECT fname, mname, lname 
													FROM author
													WHERE materialid LIKE '${mid}' AND isbn LIKE '${isbn}'");
						
						$query1 = $this->db->query("SELECT rating 
													FROM rating
													WHERE materialid LIKE '${mid}' AND idnumber LIKE '${id}'");
						
						$result = $query->result();
						$result1 = $query1->row();

						$tuple->author = (array)$result;
					
						if( !isset($result1->rating) ) $tuple->rating = null;
						else $tuple->rating = $result1->rating;
						
						// get the author depending on the tuple's library material id and isbn
						// add it to $query variable
						$return_array[count($return_array)] = (array)$tuple;
					
					}
				return $return_array;

		}

	}	

	/* 	End of Basic_search_model.php
	* 	Location: ./application/models/user/basic_search_model.php 
	*/

