<?php 

/*
*	Filename: borrower.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: Julius M. Iglesia
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrower extends CI_Controller {
	
	public function _construct()
	{
		parent::_construct();
		$this->load->model('borrower_model');
	}

	public function index(){
		$this->load->helper('url');
		$email = $this->session->userdata('email');
		if($email)
		$this->load->view('user/profile.php');
		else
		$this->load->view('user/index.php');
	}

	public function outside_search(){
		$this->load->helper('url');
		
		$search =  $this->input->post('search');
		$filter =  $this->input->post('filter');
		
		$result_info['value'] = $this->basic_search_model->get_search_res($search, $filter);
		
		
	}
	
	public function user_search(){
		$this->load->library("session");
		$this->load->helper('url');
		
		$search =  $this->input->post('search');
		$filter =  $this->input->post('filter');
		
		$materialid = $this->input->post('materialid');
		$userid = $this->session->userdata('email');

		$this->load->model('user/basic_search_model');
		$this->load->model('user/check_reserved_model');
		$this->load->model('user/check_waitlisted_model');

		$result_info['matid'] = $this->check_reserved_model->if_reserved($userid);
		$result_info['material'] = $this->check_waitlisted_model->if_waitlisted($userid);
		if($search=='')
			$result_info['value'] = NULL;
		else	
			$result_info['value'] = $this->basic_search_model->get_search_res($search, $filter);
		$email = $this->session->userdata('email');
		
		if($email)
			$this->load->view('user/user_search', $result_info);
		else
			$this->load->view('user/outside_search', $result_info);
	}

	public function register(){
		$this->load->helper('url');
		$this->load->view('user/Register.php');
	}
	public function reserve(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('materialid');
		$userid = $this->session->userdata('email');
		

		
		$this->load->model('user/reserve_waitlist_model');
		$check_borrowed = $this->reserve_waitlist_model->get_borrowedcopy($materialid);		
		if($check_borrowed){
				$data['materialid']=$materialid;
				$this->load->view('user/waitlist_book', $data);

		}else{
				$data['materialid']=$materialid;
				$this->load->model('user/load_requirement_model');
				$check_req = $this->load_requirement_model->get_requirement($materialid);
				if(($check_req[0]->requirement) != 1){
					$this->load->view('user/reserve_book', $data);
				}else{
					$this->load->view('user/reserve_req_book', $data);
				}
		}
		
	}
	
	public function reserve_continue(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('yes');
		$userid = $this->session->userdata('email');
		
		$data['materialid']=$materialid;
		$data['user']=$userid;

		$this->load->model('user/reserve_book_model');
		//$query = $this->db->get_where('librarymaterial', array('materialid' => $materialid));
		$this->reserve_book_model->get_book($materialid, $userid);
		$this->load->view('user/reserved', $data);

	}	
	public function waitlist_continue(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('yes');
		$userid = $this->session->userdata('email');
		
		$data['materialid']=$materialid;
		$data['user']=$userid;
		
		$this->load->model('user/waitlist_book_model');
		$this->load->model('user/waitlisted_matid_model');
		$this->load->model('user/waitlist_rank_model');
		$this->load->model('user/waitlist_queue_model');
		
		$this->waitlist_book_model->waitlist_book($materialid, $userid);
		
		$data['list'] = $this->waitlisted_matid_model->waitlisted_matid($userid);
		$data['rank'] = $this->waitlist_rank_model->get_rank($userid);
		$data['total'] = $this->waitlist_queue_model->get_total($userid);
		$this->load->view('user/waitlisted', $data);
		
	}
	
	public function login()
	{
		$this->load->library("session");
		$this->load->helper('url');
		
		$username = $this->input->post('username');
		$password =  $this->input->post('password');
		$pass = $password;

		$this->load->model('user/log_model');
		$borrower_info = $this->log_model->get_borrower($username, $password);
		
		if($borrower_info)
		{
		$data['header'] = "Hello, {$borrower_info[0]->fname} ";
		
		$this->session->set_userdata('fname',$borrower_info[0]->fname);
		$this->session->set_userdata('mname',$borrower_info[0]->mname);
		$this->session->set_userdata('lname',$borrower_info[0]->lname);
		$this->session->set_userdata('idnumber',$borrower_info[0]->idnumber);
		$this->session->set_userdata('email',$borrower_info[0]->email);
		$this->session->set_userdata('password',$pass);
		$this->session->set_userdata('college',$borrower_info[0]->college);
		$this->session->set_userdata('course',$borrower_info[0]->course);
		$this->session->set_userdata('sex',$borrower_info[0]->sex);
		$this->session->set_userdata('classification',$borrower_info[0]->classification);
		$this->session->set_userdata('bookcount',$borrower_info[0]->bookcount);
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		$this->borrowed_materials();
		//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
		}
		else
		{
			$this->load->view('user/forgot_pword');
		}
	}
	
	public function logout()
	{
		$this->load->library("session");
		$this->session->sess_destroy();
		$this->load->helper('url');
		$this->index();
	}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	public function borrowed_materials() { 
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$data['res'] = $this->borrowed_model->get_reservations();
		$data['overdue'] = $this->borrowed_model->get_overdue();
		$data['status']="FALSE";
		$data['passStatus']="FALSE";
		$data['temp']="TRUE";
		$this->load->view('user/profile', $data);
	}
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	
	public function borrowed_materials_view(){
	
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$this->load->view('user/borrowed_books', $data);
	
	}
	
	public function reserved_materials_view(){
	
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_reservations();
		$this->load->view('user/reserved_books', $data);
	
	}
		
	
	public function load_profile(){
		$this->borrowed_materials();
		
	}







	public function registration()
	{
		$this->load->library('form_validation');
		//field name, error message, validation rules
		
		$this->form_validation->set_rules('fname','First Name',
			'trim|required|min_length[4]|xss_clean|alpha_dash');
		$this->form_validation->set_rules('mname','Middle Name',
			'trim|required|min_length[4]|xss_clean|alpha_dash');
		$this->form_validation->set_rules('lname','Last Name',
			'trim|required|min_length[4]|xss_clean|alpha_dash');
		$this->form_validation->set_rules('idnumber','IDnumber',
			'trim|required|min_length[4]|max_length[11]|xss_clean|callback_idnumber_check|callback_idnumber_exist_check|callback_check_idnum');
		$this->form_validation->set_rules('email','Email',
			'trim|required|valid_email|max_length[50]|callback_email_exist');
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[4]|max_length[32]|matches[password_conf]|!matches[fname]|!matches[mname]|!matches[lname]');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation',
			'xss_clean|required|matches[password]');
		$this->form_validation->set_rules('course','Course',
			'trim|required|min_length[4]|max_length[10]|xss_clean|alpha');

		if($this->form_validation->run() == FALSE){
			$temp['temp'] = "FALSE";
			$this->load->helper('url');
			$this->load->view('user/Register',$temp);
		}
		else{
			$this->load->model('user/registration_model'); 
			$this->registration_model->add_user();
			//$this->verify();
			$this->index();
		}
	}

//error validation	
	public function check_idnum($idnumber)
	{
		$this->load->model('user/registration_model');
		$result=$this->registration_model->idnumber_exist_check($idnumber);
		if($result){
			$this->form_validation->set_message('check_idnum','The ID number you entered is invalid.');
			return FALSE;
		}
		else return TRUE;
	}

	public function idnumber_exist_check($idnumber)
	{
		$this->load->model('user/registration_model');
		$result=$this->registration_model->idnumber_borrower_check($idnumber);
		if($result){
			$this->form_validation->set_message('idnumber_exist_check','Already a user');
			return FALSE;
		}
	}

	public function idnumber_check($str)
	{
		if(preg_match( '/(^\d{4}-?\d{5}$|^\d{11}$)/' ,$str)){
			return true;
			}
		else{
			$this->form_validation->set_message('idnumber_check','Invalid id number.');
			return FALSE;
			}
	}

	function email_exist($email)
	{
		$this->load->model('user/registration_model');
		$result=$this->registration_model->email_exist($email);
		if($result){
			$this->form_validation->set_message('email_exist','The %s already exists in our database,
			please use a different one.');
			return FALSE;
		}
	}
	
//account validation
	public function validate()
	{
		$this->load->library("session");
		$this->load->helper('url');

		$email=$this->input->post('email');
		$code=$this->input->post('code');
		$password=SHA1($this->input->post('code'));
		$pass=$password;
		$this->load->model('user/registration_model');
		$result=$this->registration_model->validate_account($email,$code);
		if($result)
		{ 
			$this->continue_();	
			$this->load->library("session");
			$this->session->sess_destroy();
			$this->load->helper('url');	
		}
		else $this->verify();
	}

	//update functions
	public function update_email()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email',
			'trim|required|valid_email|max_length[50]|callback_email_exist');

		if($this->form_validation->run() == FALSE){
			$temp['status']="FALSE";
			$temp['passStatus']="";
			$temp['temp']="FALSE";
			$this->load->view('user/profile',$temp);
		}
		else{
			$temp['status']="TRUE";
			$temp['passStatus']="";
			$temp['temp']="TRUE";
			$this->load->model('user/update_model');
			$this->update_model->update_email();
			$this->load->view('user/profile',$temp);
		}
	}
	
	public function update_password()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('password', 'password',
			'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('re_password', 'password2',
			'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$temp['passStatus']="FALSE";
			$temp['status']="";
			$temp['temp']="FALSE";
			$this->load->view('user/profile',$temp);
		}
		else{
			$temp['passStatus']="TRUE";
			$temp['status']="";
			$temp['temp']="TRUE";
			$pass = $this->input->post('password');
			$this->session->set_userdata('password',$pass);
			$this->load->model('user/update_model');
			$this->update_model->update_password();
			$this->load->view('user/profile',$temp);
		}
	}

	public function search()
	{

		$this->load->helper('url');
		
		$search =  $this->input->post('search');
		$filter =  $this->input->post('filter');
		$this->load->model('user/basic_search_model');
		if($search=='')
			$result_info['value'] = NULL;
		else
			$temp_result = $this->basic_search_model->get_search_res($search, $filter);

		
		//if($email)
		//	$this->load->view('user/user_search', $result_info);
		//else
		//	$this->load->view('user/outside_search', $result_info);
		
	}

	public function verify_page()
	{
		$this->load->view('user/validate');
		
	}

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

     public function verify_account(){

     	$this->load->library("session");
		$this->load->helper('url');

		$email=$this->input->post('email');
		$code=$this->input->post('code');
		$this->load->model('user/registration_model');
		$result=$this->registration_model->validate_account($email,$code);
		if($result)
		{ 
			$this->load->library("session");
			$this->session->sess_destroy();
			$this->load->helper('url');	
			$this->index();
		}
		else{
			$this->verify_page();
		}
     }
}

?> 