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
		$this->notification_model->notify( $materialid, $idnumber );
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
			$this->load->model('admin/admin_model');
			$data['stats'] = $this->admin_model->get_stats_model();
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
		$this->load->model('admin/borrowed_books_model'); 
		if($this->input->post('search_borrowed_books')){
			$word = $this->input->post('search');
			$array['borrowed_books'] = $this->borrowed_books_model->get_searched_book($word);
			//$array['flag'] = $array['borrowed_books'];
			if($array['borrowed_books']->num_rows==0){
				$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
			}
		}else{
		// calls the function get_reservation_array(), and store it to the data array
			$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
			$array['flag'] = $array['borrowed_books'];
		// views the result by passing the data to the view php file
		}
			$this->load->view('admin/borrowed_books_view', $array);

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
		$idnumber = $this->input->post('idnumber');
		$message = $this->input->post('message');
    	$this->notification_model->notify( $materialid, $idnumber, $message );
    }

	public function admin_search() {

		$this->load->model('admin/admin_model');
		$this->load->library('javascript');
		
		if($this->input->post('search_books')!=''){
			$filter = $this->input->post('filter');
			$type = $this->input->post('type');
			$access = $this->input->post('access');
			$avail = $this->input->post('avail');
			$word = $this->input->post('search');

			$data['sql2'] = $this->admin_model->search($filter,$type,$word,$access,$avail);
			$this->load->view('admin/admin_search',$data);

		}else{
			$data['sql2'] = $this->admin_model->viewAll();
			$this->load->view('admin/admin_search',$data);
		}
		
		if($this->input->post('insert') != ''){
			$numberOfAuthors = $this->input->post('numberOfAuthors');
			
			if($numberOfAuthors > 1){
				$materialid = $this->input->post('materialid');
				$course = $this->input->post('course');
				$type = $this->input->post('type');
				$name = $this->input->post('name');
				$year = $this->input->post('year');
				$edvol = $this->input->post('edvol');
				$access = $this->input->post('access');
				$available = $this->input->post('available');
				$requirement = $this->input->post('requirement');
				
				$query = $this->db->get_where('librarymaterial', array('materialid' => $materialid));

				if( $query->num_rows() > 0 ) {
					header('location:/icslibsystem/index.php/admin/add_material');
				} 
				else {
					$data_libmaterial = array(
						'materialid' => $materialid,
						'course' => $course,
						'type' => $type,
						'name' => $name,
						'year' => $year,
						'edvol' => $edvol,
						'access' => $access,
						'available' => $available,
						'requirement' => $requirement,
					);
			
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_material($data_libmaterial);
				}
				
				for($i=$numberOfAuthors; $i>0; $i--){
					if($i == 1){
						$fname = $this->input->post('fname');
						$mname = $this->input->post('mname');
						$lname = $this->input->post('lname');
					}
					else{
						$k = 'fname' . $i;
						$s = 'mname' . $i;
						$p = 'lname' . $i;
						$fname = $this->input->post($k);
						$mname = $this->input->post($s);
						$lname = $this->input->post($p);
					}
					
					$data_author = array(
						'materialid' => $materialid,
						'fname' => $fname,
						'mname' => $mname,
						'lname' => $lname,
					);	
					
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_author($data_author);
				}
			}	
			else{
				$materialid = $this->input->post('materialid');
				$course = $this->input->post('course');
				$type = $this->input->post('type');
				$name = $this->input->post('name');
				$year = $this->input->post('year');
				$edvol = $this->input->post('edvol');
				$access = $this->input->post('access');
				$available = $this->input->post('available');
				$requirement = $this->input->post('requirement');
			
				$fname = $this->input->post('fname');
				$mname = $this->input->post('mname');
				$lname = $this->input->post('lname');
			
				$query = $this->db->get_where('librarymaterial', array('materialid' => $materialid));

				if( $query->num_rows() > 0 ) {
					header('location:/icslibsystem/index.php/admin/add_material');
				} 
				else {
					$data_libmaterial = array(
						'materialid' => $materialid,
						'course' => $course,
						'type' => $type,
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
					);	
					
					$this->load->model('admin/add_material_model');
					$this->add_material_model->insert_author($data_author);
				}
			}	
		}
	}
	
	public function update()
	{
		$data['title'] = "Edit Books";
		$this->load->model("admin/model_function");
		$name = $this->input->get('flag', TRUE);
		$data['result'] = $this->model_function->get_book_info($name);
		$this->load->view('admin/view_update',$data);
	}
	public function update_page($data)
	{	
		$this->load->helper('url');
		$data = $this->input->post(NULL, TRUE);				
		if($this->input->post('submit')){
			$this->load->model('admin/admin_model');
			
			//get form variable
			$materialid = $this->input->post('materialid');
			$name = $this->input->post('name');
			$type = $this->input->post('type');
			$course = $this->input->post('course');
			$lname = $this->input->post('lname');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$available = $this->input->post('available');
			$access = $this->input->post('access');
			$year = $this->input->post('year');
			$requirement = $this->input->post('requirement');
			$quantity = $this->input->post('quantity');
			
			$data1 = array(
            'name' => $name,
			'type' => $type,
			'course' => $course,
			'available' => $available,
			'access' => $access,
			'year' => $year,
			'requirement' => $requirement,
			'quantity' => $quantity,
			);
							
			$data2 = array(
			'lname' => $lname,
			'fname' => $fname,
			'mname' => $mname,
			);
			
			$this->admin_model->book_update($data,$data1);
			$this->admin_model->author_update($data,$data2);
		}
		header('location:/icslibsystem/admin/admin_search');		
	}
	public function delete(){	
		
		$this->load->model('admin/admin_model');
		$data['materialid'] = $this->input->get('flag', TRUE);
		$this->admin_model->book_delete($data);
		$this->admin_search();
	}
	
	public function add_material() {
		$this->load->view('admin/add_material_view');
		
	}
	
	public function claim_reservation(){
		$this->load->model('admin/reservation_queue_model');
		$materialid = $this->input->post('materialid');
		$idnumber = $this->input->post('idnumber');
		var_dump($_POST);
		date_default_timezone_set("Asia/Manila");
		$start_date = date('Y-m-d');
		$expectedreturn = $this->reservation_queue_model->update_claimed_date( $materialid, $idnumber, $start_date );
		$this->reservation_queue_model->do_claim( $materialid, $idnumber, $start_date, $expectedreturn );
		
	}
}

?>
