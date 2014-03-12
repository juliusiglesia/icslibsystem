<?php 

/*
*	Filename: admin.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: CMSC 128 AB-6L
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	/*
	*	Controls the view of reservations in the system
	*/
	public function reservation_queue() { 
		// views the result by passing the data to the view php file
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
			$data['user'] = $is_logged_in;
			// loads the model php file which will interact with the database
			$this->load->model('admin/reservation_queue_model'); 
			// calls the function get_reservation_array(), and store it to the data array
			$data['reservations'] = $this->reservation_queue_model->get_reservations();	
			$this->load->view('admin/reservation_queue_view', $data);
			
		}
	}

	public function search_reservations(){
		$this->load->model('admin/reservation_queue_model'); 
		header('Content-Type: application/json', true);
		$array = $this->reservation_queue_model->search_reservations();

		echo json_encode($array);			
	}

	/*
	*	Controls the view of notification in the system
	*/
	public function notification(){
		// loads the model php file which will interact with the database
        $this->load->model('admin/notification_model'); 
		//calls function save(), to save or to insert the data that has been processed

		$materialid = $this->input->post('materialid');
		$idnumber = $this->input->post('idnumber');
		$isbn = $this->input->post('isbn');

		$this->notification_model->notify( $materialid, $idnumber, $isbn );
    }

	
	public function print_inventory(){
		// loads the model php file which will interact with the database
		$this->load->model('admin/print_inventory_model'); 
		// calls the function get_reservation_array(), and store it to the data array
		$data['libinventory'] = $this->print_inventory_model->get_inventory_array();
		// views the result by passing the data to the view php file
		$this->load->view('admin/print_inventory_view', $data);	
	}

	/**
	* log in function for displaying login form
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function login(){
		$is_logged_in = $this->is_logged_in();
		$this->no_cache();
		if( $is_logged_in ){
			redirect('admin/home', 'refresh');
		} else {
			$this->load->view('admin/login_view');
		}
	}

	/**
	* log out function for logging administrator from the system
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login', 'refresh');
	}

	/**
	* function for checking if the data from the form
	* is a valid admin or not
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_admin(){
		$this->load->model('admin/check_admin_model');
		
		$user_count = $this->check_admin_model->check_username();
		
		if( $user_count != 1 ){
			echo "Username does not exist!";
		} else {
			$pass_count = $this->check_admin_model->check_password();
			
			if( $pass_count != 1 ){
				echo "Password does not match with the username!";
			} else {
				$this->session->set_userdata('user', $this->input->post('uname'));
				echo "1";
			}
		}
	}


	/**
	* function for displaying the home page
	* of the administrator logged in
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function home(){
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
			$data['user'] = $is_logged_in;
			
			$this->load->model('admin/get_stats_model');
			$this->load->model('admin/login_model');
			$data['stats'] = $this->get_stats_model->get_library_stats();
			$data['info'] = $this->login_model->get_info();
			$this->load->view('admin/admin_home_view', $data);
		}
	}

	/*
	*	function verification for displaying input text for:
	*		1. email
	*		2. password
	*	input text for email will be required and must be valid email
	*	input text for password will be required as well
	*	then it will call the function verify()
	*/

	public function no_cache(){
		$this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header('Pragma: no-cache');
	}

	public function is_logged_in(){
		$this->update_reservations();
		$user = $this->session->userdata('user');
		return $user;
	}

	/*
	*	function verification for displaying input text for:
	*		1. email
	*		2. password
	*	input text for email will be required and must be valid email
	*	input text for password will be required as well
	*	then it will call the function verify()
	*/

	public function verification(){
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->load->model('admin/verification_model');
		$this->load->view('admin/verification_view');

		$this->verify();
	}
	/*
	*	function verify() responsible for email sending using Email class
	*/
	public function verify(){
	// loads the model php file to allow the access of the function verifying()
        $this->load->model('admin/verification_model'); 
	//if submit, process the data
        if($this->input->post('submit')){
			$email = $this->input->post('email');
			$inputPw = sha1($this->input->post('password'));
			$password = $inputPw;

			/*
			* 	the array $config is the set of configuration for the email
			*	system.icslibrary@gmail.com is the sender
			*	icslibraryadmin is the password of the send
			*/
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'system.icslibrary@gmail.com',  		
				'smtp_pass' => 'icslibraryadmin',		
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			/*
			*	email->from('The sender's email', 'Name of the sender')
			*	email->to('email to be sent to')
			*	email->subject('The subject')
			*	email->message('Your message')
			*	*After the email attributes are set, then the email is ready to be sent*
			*	email->send()
			*/
			$this->email->from('System.ICSLibrary@gmail.com', 'ICSLibrary Admin');
			$this->email->to($email);
			$this->email->subject('Email Verification');
			$this->email->message('Hi this is your verification code: '.$password.' Good day!');
			$this->email->send();		
        }
     }

	public function index(){
		$this->login();
	}

		public function borrowed_books() { 
		// loads the model php file which will interact with the database

		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		}
		else{
			$this->no_cache();
			$data['user'] = $is_logged_in;
			$this->load->model('admin/borrowed_books_model'); 

			if($this->input->post('search_borrowed_books')){

				$word = $this->db->escape_str($this->input->post('search'));

				if ($word!="") {
					$words = explode(" ", $word);
					$array['borrowed_books'] = array();
					foreach ($words as $keyword) {
						//array_push($data['sql2'],$this->admin_model->search($filter,$type,$keyword,$access,$avail));
						$query_result = $this->borrowed_books_model->get_searched_book($keyword);

						foreach($query_result as $entry){
							if(!in_array($entry, $array['borrowed_books'])){
								array_push($array['borrowed_books'], $entry);
						    }
						}
					}
				}
				else {
					$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
				}
				
				
			}
			else{
				$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
			}
			$array['flag'] = $array['borrowed_books'];
			$array['fine'] = $this->borrowed_books_model->get_fine();
			$array['enable_fine'] = $this->borrowed_books_model->get_enable_fine();
			$this->load->view('admin/borrowed_books_view', $array);
		}
	}

	public function material_returned(){
		// loads the model php file which will interact with the database
       	$this->load->model('admin/material_returned_model'); 
		//calls function get_idnumber, add and stores it to the data array
		//$data['groups'] = $this->notification_model->get_idnumber();
		// views the result by passing the data to the view php file
        //$this->load->view('admin/notification_view', $data);
		//calls function save(), to save or to insert the data that has been processed
		//$this->save();
		$materialid = $this->input->post('materialid');
		$isbn = $this->input->post('isbn');
		$fine = $this->input->post('fine');
		$this->material_returned_model->update_status($isbn, $materialid, $fine);

		redirect('/admin/borrowed_books', 'refresh');
		//$message = $this->input->post('message');
    	//$this->notification_model->notify( $materialid, $idnumber, $message );
    }

	public function admin_search() {

		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
			$data['user'] = $is_logged_in;
			$this->load->model('admin/admin_model');
			$this->load->library('javascript');
			
			if($this->input->post('search_books')!=''){
				$filter = $this->input->post('filter');
				$type = $this->input->post('type');
				$access = $this->input->post('access');
				$avail = $this->input->post('avail');
				$word = $this->db->escape_str($this->input->post('search'));

				$words = explode(" ", $word);
				$data['sql2'] = array();
				foreach ($words as $keyword) {
					//array_push($data['sql2'],$this->admin_model->search($filter,$type,$keyword,$access,$avail));
					$query_result = $this->admin_model->search($filter,$type,$keyword,$access,$avail);
					foreach($query_result as $entry){
						if(!in_array($entry, $data['sql2'])){
							array_push($data['sql2'], $entry);
					    }
					}
				}
				//var_dump($data['sql2']);
				$data['flag'] = $data['sql2'];
				//$data['sql2'] = $this->admin_model->search($filter,$type,$word,$access,$avail);
				//$data['flag'] = $data['sql2'];
				//if($data['sql2']->num_rows()==0){
				//	$data['sql2'] = $this->admin_model->viewAll();
				//}
				if (count($data['sql2']) == 0){
					$data['sql2'] = $this->admin_model->viewAll();
				}
				$this->load->view('admin/admin_search',$data);

			}else{
				$data['sql2'] = $this->admin_model->viewAll();
				$data['flag'] = $data['sql2'];
				$this->load->view('admin/admin_search',$data);
			}
		}
	}
	
	public function update_execution(){
		// loads the model php file which will interact with the database
       	$this->load->model('admin/admin_model'); 
		//calls function get_idnumber, add and stores it to the data array
		//$data['groups'] = $this->notification_model->get_idnumber();
		// views the result by passing the data to the view php file
        //$this->load->view('admin/notification_view', $data);
		//calls function save(), to save or to insert the data that has been processed
		//$this->save();
		//var_dump($this-post());
		$materialid = $this->input->post('materialid');
		//echo $materialid;
		$type = $this->input->post('type');
		if ($type == 'Book' || $type == 'References' || $type == 'Journals' || $type == 'Magazines')
			$isbn = $this->input->post('isbn');
		else $isbn = "+".$materialid;
		if ($type == 'Book' || $type == 'References' || $type == 'CD')
			$course = $this->input->post('course');
		else $course = 0;
		$name = $this->input->post('name');
		$year = $this->input->post('year');
		$edvol = $this->input->post('edvol');
		$access = $this->input->post('access');
		$available = $this->input->post('available');
		$requirement = $this->input->post('requirement');
		$previous_matID = $this->input->post('previous_matID');
		$previous_isbn = $this->input->post('previous_isbn');
		/*$authors_fname = $this->input->post('authors_fname');
		$authors_mname = $this->input->post('authors_mname');
		$authors_lname = $this->input->post('authors_lname');
		echo $previous_matID;*/
		
		$library_material_data = array (
			'materialid' => $materialid,
			'type' => $type,
			'isbn' => $isbn,
			'course' => $course,
			'name' => $name,
			'year' => $year,
			'edvol' => $edvol,
			'access' => $access,
			'available' => $available,
			'requirement' => $requirement,
		);
		
		$authors = $this->input->post('authors');
		$all_authors = array ();
		
		for ($i=0; $i<count($authors); $i++) {

			$entry = array (
				'materialid' => $previous_matID,
				'fname' => $authors[$i][0],
				'mname' => $authors[$i][1],
				'lname' => $authors[$i][2],
				'isbn' => $previous_isbn,
			);
			
			if(!in_array($entry, $all_authors)){
				array_push($all_authors, $entry);
			}
		}

		/*$authors = array (
			'fname' => $authors_fname,
			'mname' => $authors_mname,
			'lname' => $authors_lname,
		);*/
		$this->admin_model->book_update($library_material_data, $all_authors, $previous_matID, $previous_isbn);

		//redirect('/admin/borrowed_books', 'refresh');
		//$message = $this->input->post('message');
    	//$this->notification_model->notify( $materialid, $idnumber, $message );
    }

    public function add_execution(){
		// loads the model php file which will interact with the database
       	$this->load->model('admin/admin_model'); 
		//calls function get_idnumber, add and stores it to the data array
		//$data['groups'] = $this->notification_model->get_idnumber();
		// views the result by passing the data to the view php file
        //$this->load->view('admin/notification_view', $data);
		//calls function save(), to save or to insert the data that has been processed
		//$this->save();
		//var_dump($this-post());
		$materialid = $this->input->post('materialid');
		//echo $materialid;
		$type = $this->input->post('type');
		if ($type == 'Book' || $type == 'References' || $type == 'Journals' || $type == 'Magazines')
			$isbn = $this->input->post('isbn');
		else $isbn = "+".$materialid;
		if ($type == 'Book' || $type == 'References' || $type == 'CD')
			$course = $this->input->post('course');
		else $course = null;
		$name = $this->input->post('name');
		$year = $this->input->post('year');
		$edvol = $this->input->post('edvol');
		$access = $this->input->post('access');
		$available = $this->input->post('available');
		$requirement = $this->input->post('requirement');
		
		$library_material_data = array (
			'materialid' => $materialid,
			'type' => $type,
			'isbn' => $isbn,
			'course' => $course,
			'name' => $name,
			'year' => $year,
			'edvol' => $edvol,
			'access' => $access,
			'available' => $available,
			'requirement' => $requirement,
		);
		
		$authors = $this->input->post('authors');
		$all_authors = array ();
		
		for ($i=0; $i<count($authors); $i++) {

			$entry = array (
				'materialid' => $materialid,
				'fname' => $authors[$i][0],
				'mname' => $authors[$i][1],
				'lname' => $authors[$i][2],
				'isbn' => $isbn,
			);
			
			if(!in_array($entry, $all_authors)){
				array_push($all_authors, $entry);
			}
		}
		/*$authors = array (
			'fname' => $authors_fname,
			'mname' => $authors_mname,
			'lname' => $authors_lname,
		);*/
		$this->admin_model->book_add($library_material_data, $all_authors);

		//redirect('/admin/borrowed_books', 'refresh');
		//$message = $this->input->post('message');
    	//$this->notification_model->notify( $materialid, $idnumber, $message );
    }
	
	public function show_recent($materialid){

		$this->load->model('admin/admin_model');
		$filter = "none";
		$type = "allTypes";
		$access ="allAccess";
		$avail ="allAvail";
		$data['sql2'] = array();
		$query_result = $this->admin_model->search($filter,$type,$materialid,$access,$avail);
		array_push($data['sql2'], $query_result[0]);
		$data['flag'] = $data['sql2'];
		$this->load->view('admin/show_recent_view',$data);
	}

	public function update_material()
	{	
		$this->load->model('admin/update_info_model'); 
		
		$materialid = $this->input->post('materialid');
		
		if (!$materialid) redirect ("admin/admin_search");
		
		$data['update_details'] = $this->update_info_model->get_update_details($materialid);
		
		$this->load->view('admin/update_info_view', $data);
			
	}
	public function delete_material(){	
		
		$this->load->model('admin/admin_model');
		$materialid = $this->input->post('materialid');
		//$data['materialid'] = $this->input->get('flag', TRUE);

		$query = $this->db->query("SELECT count(materialid) as count
									FROM borrowedmaterial 
									WHERE materialid LIKE '${materialid}'");

		$result = $query->result();
		if ($result[0]->count == 0) {

			$query = $this->db->query("SELECT count(materialid) as count
									FROM reservation 
									WHERE materialid LIKE '${materialid}'");
			$result = $query->result();

			if ($result[0]->count == 0) {
				$this->admin_model->book_delete($materialid);
				echo '1';
			}
			else echo '0';
		}
		else echo '0';

		//$this->admin_search();
	}
	
	public function add_material() {
	$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
			$data['user'] = $is_logged_in;
		$this->load->view('admin/add_material_view');
		}
	}
	
	public function isbn1_check ($str) {
		if (preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/',$str)) {
			return true;
		}
		else {
			return false;
		}
	}
	public function isbn2_check ($str) {
		if (preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/',$str)) {
			return true;
		}
		else {
			return false;
		}
	}

	public function check_new_isbn( ){
		$isbn = $this->input->post('isbn');
		$type = $this->input->post('type');
		$previous_isbn = $this->input->post('previous_isbn');
		
		$this->load->library('form_validation');
		if ($type == 'Book' || $type == 'References') $this->form_validation->set_rules('isbn', 'ISBN','trim|required|max_length[10]|xss_clean|callback_isbn1_check');
		else if ($type == 'Journals' || $type == 'Magazines') $this->form_validation->set_rules('isbn', 'ISBN','trim|required|max_length[8]|xss_clean|callback_isbn2_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else if ($previous_isbn == $isbn){
			echo '1';
		}
		else {
			$this->load->model('admin/check_input_model');
			$num_isbn = $this->check_input_model->check_ISBN($isbn);
			if ($num_isbn[0]->count == 0) {
				echo '1';
			}
			else echo '2';
		}
	}

	public function check_isbn( ){
		$isbn = $this->input->post('isbn');
		$type = $this->input->post('type');
		
		$this->load->library('form_validation');
		if ($type == 'Book' || $type == 'References') $this->form_validation->set_rules('isbn', 'ISBN','trim|required|xss_clean|callback_isbn1_check');
		else if ($type == 'Journals' || $type == 'Magazines') $this->form_validation->set_rules('isbn', 'ISBN','trim|required|xss_clean|callback_isbn2_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else {
			$this->load->model('admin/check_input_model');
			$num_isbn = $this->check_input_model->check_ISBN($isbn);
			if (intval($num_isbn) == 0) {
				echo '1';
			}
			else echo '2';
		}
	}

	public function materialid_check ($str) {
		if (preg_match('/^[A-Za-z0-9]+$/',$str)) return true;
		else return false;
	}

	public function check_materialid(){
		$materialid = $this->input->post('materialid');
		$preclass = $this->input->post('preclass');
		$new_matID = $preclass . $materialid;
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('materialid', 'materialID','trim|required|xss_clean|callback_materialid_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else {
			$this->load->model('admin/check_input_model');
			$num_matID = $this->check_input_model->check_materialid($preclass, $materialid);
			
			if (intval($num_matID) == 0) {
				echo '1';
			}
			else echo '2';
		}
	}

	public function check_new_materialid(){
		$materialid = $this->input->post('materialid');
		$preclass = $this->input->post('preclass');
		$new_matID = $preclass . $materialid;
		$previous_matID = $this->input->post('previous_matID');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('materialid', 'materialID','trim|required|xss_clean|callback_materialid_check');

		if ($this->form_validation->run() == false){
			echo '3';
		}
		else if ($previous_matID == $new_matID){
			echo '1';
		}
		else {
			$this->load->model('admin/check_input_model');
			$num_matID = $this->check_input_model->check_materialid($preclass, $materialid);
			if (intval($num_matID) == 0) {
				echo '1';
			}
			else echo '2';
		}
	}

	public function claim_reservation(){
		$this->load->model('admin/reservation_queue_model');
		$materialid = $this->input->post('materialid');
		$isbn = $this->input->post('isbn');
		$idnumber = $this->input->post('idnumber');
		date_default_timezone_set("Asia/Manila");
		$start_date = date('Y-m-d');
		$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->reservation_queue_model->do_claim( $materialid, $isbn, $idnumber, $start_date, $expectedreturn );
		
	}

	/*
		Page for admin settings
	*/
	

	public function search_user(){
		$this->load->model('admin/search_user_model');
		if ( !$this->input->post('search') ) $search = ""; 
		else $search = $this->input->post('search');

		echo json_encode($this->search_user_model->get_users( $search ));
	}

	public function get_user(){
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
		$this->load->model('admin/search_user_model');
		$search = ""; 
		$data['users'] = $this->search_user_model->get_users( $search );
		$this->load->view('admin/get_user_view', $data);
		}
	}

	public function add_multiple(){
	$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/admin/login', 'refresh');
		} else {
			$this->no_cache();
		$this->load->view('admin/add_multiple_view');
	}
	}

	
	public function insert_multiple(){
		$this->load->model('admin/insert_multiple_model');
		$this->insert_multiple_model->insert_to_db();	
			
	}

	public function check_add_isbn( ){
		$this->load->model('admin/check_input_model');
		$isbn = $this->input->post('isbn');
		echo $this->check_input_model->check_isbn($isbn);
	}

	public function check_add_materialid( ){
		$this->load->model('admin/check_input_model');
		$materialid = $this->input->post('materialid');
		echo $this->check_input_model->check_materialid($materialid);
	}

	public function clear_reservation(){
		$this->load->model('admin/clear_reservation_model');
		$this->clear_reservation_model->clear();
		
	}

	public function check_password(){
		$this->load->model('admin/delete_account_model');
		echo $this->delete_account_model->check_combination();
	} 

	public function delete_account(){
		$this->load->model('admin/delete_account_model');
		$this->delete_account_model->delete_account();
	}


	public function settings(){
		$this->load->model('admin/settings_model');	
		$data['info'] = $this->settings_model->get_data();
		$this->load->view('admin/settings', $data);
	}

	public function settings_for_enable(){	
		$this->load->model('admin/settings_model');
		$this->settings_model->set_enable();	
	
	}
	
	public function settings_for_disable(){
		
		$this->load->model('admin/settings_model');
		
		$this->settings_model->set_disable();	
	
	}

	public function settings_for_info(){
	
		$this->load->model('admin/settings_model');

		$start_sem_value = $this->input->post('start_sem_value');
		$end_sem_value = $this->input->post('end_sem_value');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_info( $start_sem_value, $end_sem_value );		
	}

	public function settings_for_fine(){
	
		$this->load->model('admin/settings_model');

		$fine = $this->input->post('fine');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_fine( $fine );	
	}
	
	public function settings_for_password(){
		
		$this->load->model('admin/settings_model');
		
		$newpw = $this->input->post('newpw');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_password( $newpw );		
	}

	public function settings_for_max(){
	
		$this->load->model('admin/settings_model');

		$max = $this->input->post('max');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_max( $max );	
	}
	
	public function check_reservation(){
		$this->load->model('admin/reservation_queue_model');
		echo $this->reservation_queue_model->check_reservation();
	}

	public function update_reservations(){
		$this->load->model('admin/reservation_queue_model');
		$this->reservation_queue_model->update_reservations();		
	}
}	

?>
