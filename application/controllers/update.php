<?php 

/*
*	Filename: admin.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: CMSC 128 AB-6L
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	/*
	*	Controls the view of reservations in the system
	*/
	public function reservation_queue() { 
		// loads the model php file which will interact with the database
		$this->load->model('admin/reservation_queue_model'); 
		$array['reservations'] = $this->reservation_queue_model->get_reservations();
		header('Content-Type: application/json', true);
		echo json_encode($array['reservations']);
	}
}

?>
