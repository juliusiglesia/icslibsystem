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
			redirect('/admin/home', 'refresh');
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
		redirect('/admin/login', 'refresh');
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
			$data['stats'] = $this->get_stats_model->get_library_stats();
			$data['weekstats'] = $this->get_stats_model->get_current_week();
			//$this->load->view('admin/admin_home_view', $data);
			$data['laststats'] = $this->get_stats_model->get_last_week();
			$data['twostats'] = $this->get_stats_model->get_last_two_weeks();
			$data['threestats'] = $this->get_stats_model->get_last_three_weeks();
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
		} else {
			$this->no_cache();
			$data['user'] = $is_logged_in;
			$this->load->model('admin/borrowed_books_model'); 
			if($this->input->post('search_borrowed_books')){
				$word = $this->db->escape_str($this->input->post('search'));
				$array['borrowed_books'] = $this->borrowed_books_model->get_searched_book($word);
				$array['flag'] = $array['borrowed_books'];
				$array['fine'] = $this->borrowed_books_model->get_fine();
				if($array['borrowed_books']->num_rows==0){
					$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
				}
			}else{
				$array['fine'] = $this->borrowed_books_model->get_fine();
				$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
				$array['flag'] = $array['borrowed_books'];
			// views the result by passing the data to the view php file
			}
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

			$data['sql2'] = $this->admin_model->search($filter,$type,$word,$access,$avail);
			$data['flag'] = $data['sql2'];
			if($data['sql2']->num_rows()==0){
				$data['sql2'] = $this->admin_model->viewAll();
			}
			$this->load->view('admin/admin_search',$data);

		}else{
			$data['sql2'] = $this->admin_model->viewAll();
			$data['flag'] = $data['sql2'];
			$this->load->view('admin/admin_search',$data);
		}
		
		if($this->input->post('insert') != ''){
			$numberOfAuthors = $this->input->post('numberOfAuthors');
			
			if($numberOfAuthors > 1){
				$materialid = $this->input->post('materialid');
				$course = $this->input->post('course');
				$type = $this->input->post('type');
				$isbn = $this->input->post('isbn');
				$name = $this->input->post('name');
				$year = $this->input->post('year');
				$edvol = $this->input->post('edvol');
				$access = $this->input->post('access');
				$available = $this->input->post('available');
				$requirement = $this->input->post('requirement');
				
				$query = $this->db->query("SElECT * FROM librarymaterial WHERE materialid LIKE '${materialid}'");
				$query2 = $this->db->query("SElECT * FROM librarymaterial WHERE materialid LIKE '${materialid}' AND isbn LIKE '${isbn}'");
				
				if( $query->num_rows() > 0 ){}
				else if( $query2->num_rows() > 0 ){}
				else{
					
						$data_libmaterial = array(
						'materialid' => $materialid,
						'course' => $course,
						'type' => $type,
						'isbn' => $isbn,
						'name' => $name,
						'year' => $year,
						'edvol' => $edvol,
						'access' => $access,
						'available' => $available,
						'requirement' => $requirement,
						);
					
			
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_material($data_libmaterial);
				
				
				for($i=$numberOfAuthors; $i>0; $i--){
						$k = 'fname' . $i;
						$s = 'mname' . $i;
						$p = 'lname' . $i;
						$fname = $this->input->post($k);
						$mname = $this->input->post($s);
						$lname = $this->input->post($p);
					
					$data_author = array(
						'materialid' => $materialid,
						'fname' => $fname,
						'mname' => $mname,
						'lname' => $lname,
						'isbn' => $isbn,
					);	
					
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_author($data_author);
				}
				
				}
			}	
			else{
				$materialid = $this->input->post('materialid');
				$course = $this->input->post('course');
				$type = $this->input->post('type');
				$isbn = $this->input->post('isbn');
				$name = $this->input->post('name');
				$year = $this->input->post('year');
				$edvol = $this->input->post('edvol');
				$access = $this->input->post('access');
				$available = $this->input->post('available');
				$requirement = $this->input->post('requirement');
			
				$fname = $this->input->post('fname1');
				$mname = $this->input->post('mname1');
				$lname = $this->input->post('lname1');
			
				$query = $this->db->query("SElECT * FROM librarymaterial WHERE materialid LIKE '${materialid}'");
				$query2 = $this->db->query("SElECT * FROM librarymaterial WHERE isbn LIKE '${isbn}'");
				
				if( $query->num_rows() > 0 ){}
				else if( $query2->num_rows() > 0 ){}
				else{
				
						$data_libmaterial = array(
						'materialid' => $materialid,
						'course' => $course,
						'type' => $type,
						'isbn' => $isbn,
						'name' => $name,
						'year' => $year,
						'edvol' => $edvol,
						'access' => $access,
						'available' => $available,
						'requirement' => $requirement,
						);
					
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_material($data_libmaterial);
			
					$data_author = array(
						'materialid' => $materialid,
						'fname' => $fname,
						'mname' => $mname,
						'lname' => $lname,
						'isbn' => $isbn,
					);	
					
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_author($data_author);
				}
			}	
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
		if ($type == 'Book' || $type == 'Reference' || $type == 'Journals' || $type == 'Magazines')
			$isbn = $this->input->post('isbn');
		else $isbn = "+".$materialid;
		if ($type == 'Book' || $type == 'Reference' || $type == 'CD')
			$course = $this->input->post('course');
		else $course = null;
		$name = $this->input->post('name');
		$year = $this->input->post('year');
		$edvol = $this->input->post('edvol');
		$access = $this->input->post('access');
		$available = $this->input->post('available');
		$requirement = $this->input->post('requirement');
		$previous_matID = $this->input->post('previous_matID');
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
			$all_authors[] = array (
				'materialid' => $previous_matID,
				'fname' => $authors[$i][0],
				'mname' => $authors[$i][1],
				'lname' => $authors[$i][2],
				'isbn' => $isbn,
			);
		}
		/*$authors = array (
			'fname' => $authors_fname,
			'mname' => $authors_mname,
			'lname' => $authors_lname,
		);*/
		$this->admin_model->book_update($library_material_data, $all_authors, $previous_matID);

		//redirect('/admin/borrowed_books', 'refresh');
		//$message = $this->input->post('message');
    	//$this->notification_model->notify( $materialid, $idnumber, $message );
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
		$this->admin_model->book_delete($materialid);
		$this->admin_search();
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
	
	public function settings(){
		$this->load->helper('url');
		
		$this->load->model('admin/settings_model');	
		$data['info'] = $this->settings_model->get_data();
		$this->load->view('admin/settings', $data);


	}

	public function search_user(){
		$this->load->model('admin/search_user_model');
		if ( !$this->input->post('search') ) $search = ""; 
		else $search = $this->input->post('search');

		echo json_encode($this->search_user_model->get_users( $search ));
	}

	public function get_user(){
		$this->load->model('admin/search_user_model');
		$search = ""; 
		$data['users'] = $this->search_user_model->get_users( $search );
		$this->load->view('admin/search_user_view', $data);
	}

	public function add_multiple(){
	
		$this->load->view('admin/add_multiple_view');
	
	}

	
	public function insert_multiple(){
		$this->load->model('admin/insert_multiple_model');
		$this->insert_multiple_model->insert_to_db();	
			
	}

	public function settings_for_info(){
	
		$this->load->model('admin/settings_model');
		
		$fine = $this->input->post('fine');
		$start_sem = $this->input->post('start_sem');
		$end_sem = $this->input->post('end_sem');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_info( $fine, $start_sem, $end_sem );		
	}
	
	public function settings_for_password(){
		
		$this->load->model('admin/settings_model');
		
		$newpw = $this->input->post('newpw');

		//$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $isbn, $idnumber, $start_date );
		$this->settings_model->set_password( $newpw );		
	}

	public function check_isbn( ){
		$this->load->model('admin/check_input_model');
		$isbn = $this->input->post('isbn');
		echo $this->check_input_model->check_isbn($isbn);
	}

	public function check_materialid( ){
		$this->load->model('admin/check_input_model');
		$materialid = $this->input->post('materialid');
		echo $this->check_input_model->check_materialid($materialid);
	}

	public function clear_reservation(){
		$this->load->model('admin/clear_reservation_model');
		$this->clear_reservation_model->clear();
		
	}
}

?>
