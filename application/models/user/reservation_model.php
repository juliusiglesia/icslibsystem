<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Reservation_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}
	//if waitlisted
	public function if_waitlisted($userid)
		{	$this->load->database();
			$this->load->library("session");
			$userid = $this->session->userdata('email');
			
			$idno=$userid;
			
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$material="SELECT materialid FROM reservation where idnumber='{$idn}'";
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
//if reserved
		public function if_reserved($userid)
		{	$this->load->database();
			$this->load->library("session");
			$userid = $this->session->userdata('email');
			$reserved_flag=0;
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$material="SELECT materialid FROM borrowedmaterial where idnumber='{$idn}'";
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

		public function cancel_res($matid)
		{
			$this->load->database();
			$i=0;
			$queue_detector = "SELECT queue FROM reservation WHERE idnumber = '{$this->session->userdata('idnumber')}' AND materialid = '{$matid}'";
			$queue = $this->db->query($queue_detector);
			foreach($queue->result() as $row){
				$number=$row->queue;
				$i = $i +1;
			}
			if($i>0){
				$stmt  = "DELETE FROM reservation WHERE idnumber = '{$this->session->userdata('idnumber')}' AND materialid = '{$matid}'";
				$this->db->query($stmt);
				
				$decrement="UPDATE reservation SET queue=queue-1 WHERE materialid='{$matid}' AND queue>{$number}";
				
				$query = $this->db->query($decrement);	
			}
			
			
		}

		public function get_book($materialid, $userid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			$userid=$userid;
			$return_array = array();	
			
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				   
				}
			$queue="SELECT COUNT(queue) as number FROM reservation where materialid='{$materialid}'";
			$q=$this->db->query($queue);
			foreach ($q->result() as $count)
				{
				   $qno=$count->number;
				}
			$qno=$qno+1;

			$queue="SELECT isbn FROM librarymaterial where materialid='{$materialid}'";
			$q=$this->db->query($queue);
			foreach ($q->result() as $res)
				{
				   $isbn = $res->isbn;
			}
			
			$insert="INSERT INTO reservation(idnumber, materialid, queue, isbn, startdate) VALUES ('{$idno}', '{$materialid}', '{$qno}', '{$isbn}', sysdate())";
			$insertbm = $this->db->query($insert);
			
		}

		public function get_borrowedcopy($materialid)
		{
			$this->load->database();
			
			$materialid=$materialid;
			
			$stmt = "SELECT status FROM borrowedmaterial WHERE materialid = '{$materialid}' and status='BORROWED'";
			$query = $this->db->query($stmt);
			return $query->result();
				
		}

		public function get_rank($userid)
		{	$this->load->database();
			$this->load->library("session");
			
		
			$userid = $this->session->userdata('email');
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$r="SELECT materialid, queue FROM reservation where idnumber='{$idn}' ORDER BY materialid";
			$res = $this->db->query($r);
			$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			
			return $return_array;
			
		}
		
		public function get_total($userid)
		{	$this->load->database();
			$this->load->library("session");
			
		
			$userid = $this->session->userdata('email');
		
			$idno=$userid;
			$return_array = array();
			
			$idnum="SELECT idnumber FROM borrower where email='{$idno}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idn=$id->idnumber;
			}
			
			$m="SELECT materialid, COUNT(materialid) as tq FROM reservation GROUP BY materialid ORDER BY materialid";
			$res = $this->db->query($m);
			$query = $res->result();
			foreach ($query as $tuple)
				$return_array[count($return_array)] = (array)$tuple;
			
			return $return_array;
			
		}

		public function waitlisted_matid($userid)
		{	$this->load->database();

			$idno=$userid;
			$return_array = array();
			$idnum="SELECT idnumber FROM borrower where email='{$userid}'";
			$bmidnum = $this->db->query($idnum);
			foreach ($bmidnum->result() as $id)
				{
				   $idno=$id->idnumber;
				}
			$all_mat="SELECT materialid FROM reservation where idnumber='{$idno}' ORDER BY materialid";
			$list_mat=$this->db->query($all_mat);
			foreach ($list_mat->result() as $mats){
				$mid=$mats->materialid;
				$stmt = "SELECT * FROM author a, librarymaterial l WHERE a.materialid LIKE '%{$mid}%' AND a.materialid = l.materialid ORDER BY l.materialid";
			
					//echo $stmt;
					$query = $this->db->query($stmt);
					$query = $query->result();
			
					foreach ($query as $tuple){
						$return_array[count($return_array)] = (array)$tuple;
					}	
			}

			return $return_array;	
			
		}

}

?>
