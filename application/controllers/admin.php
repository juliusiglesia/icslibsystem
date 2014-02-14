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
		// loads the model php file which will interact with the database
		$this->load->model('admin/reservation_queue_model'); 
		// calls the function get_reservation_array(), and store it to the data array
		//$array['reservation']=$this->reservation_queue_model->get_reservation_array();
		$array['reservations'] = $this->reservation_queue_model->get_reservations();
		// views the result by passing the data to the view php file
		//if($array['reservations'] != null){
			$this->load->view('admin/reservation_queue_view', $array);
		//}
		//header('Content-Type: application/json', true);
		//echo json_encode($array['reservations']);
	}

	/*
	*	Controls the view of notification in the system
	*/
	public function notification(){
		// loads the model php file which will interact with the database
        $this->load->model('admin/notification_model'); 
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
		$this->load->view("admin/login_view");
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
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
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
		echo "Admin!";
		echo "Welcome to ICSLIB!";
	}

	public function borrowed_books() { 
		// loads the model php file which will interact with the database
		$this->load->model('admin/borrowed_books_model'); 
		// calls the function get_reservation_array(), and store it to the data array
		//$array['reservation']=$this->reservation_queue_model->get_reservation_array();
		$array['borrowed_books'] = $this->borrowed_books_model->get_borrowed_books();
		// views the result by passing the data to the view php file
		if($array['borrowed_books'] != null){
			$this->load->view('admin/borrowed_books_view', $array);
		}
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
		$this->load->model('admin/admin_model');
		$this->admin_model->book_update($data);
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
}

?>
