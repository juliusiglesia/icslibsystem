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
			$this->borrowed_materials();
		else
			$this->load->view('user/index.php');
	}


	public function outside_search(){
		$this->load->helper('url');
		
		
		$search = 	$this->db->escape_str($this->input->post('search'));
		$filter =  $this->input->post('filter');
		
		$this->load->model('user/basic_search_model');

		if($search=='')
			$result_info['value'] = NULL;
		else	
			$result_info['value'] = $this->basic_search_model->get_search_res($search, $filter);
		$this->load->view('user/outside_search.php', $result_info);
	}
	
	public function user_search(){
		$this->load->helper('url');
		$this->load->library("session");
		
		$search = 	$this->db->escape_str($this->input->post('search'));
		$filter =  $this->input->post('filter');
		
		$this->load->model('user/basic_search_model');
		$this->session->set_userdata('search', $search);
		

		$materialid = $this->input->post('materialid');
		$userid = $this->session->userdata('email');

		$this->load->model('user/reservation_model');
		
		$this->load->model('user/basic_search_model');

		$result_info['matid'] = $this->reservation_model->if_reserved($userid);
		$result_info['material'] = $this->reservation_model->if_waitlisted($userid);
		
		$this->load->model('user/borrowed_model');
		$result_info['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$result_info['res'] = $this->borrowed_model->get_reserved_books();
		$result_info['overdue'] = $this->borrowed_model->get_overdue();
		
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
	
	public function advanced_search(){
		$this->load->helper('url');
		
		
		$search = 	$this->db->escape_str($this->input->post('searchbox'));
		$userid = $this->session->userdata('email');
		
		$search_option = $this->input->post('category'); //array yung options
		$type = $this->input->post('type');
		if($type==NULL && $search!=''){
			$this->load->model('user/basic_search_model');
			$result_info['value'] = $this->basic_search_model->get_search_res($search,$search_option);
		}
		else{
			$this->load->model('user/advance_search_model');
			$result_info['value'] = $this->advance_search_model->get_adv_search($search,$search_option,$type);
		}
		$this->load->model('user/basic_search_model');
		if($this->session->userdata('email')){
			
			$this->load->model('user/reservation_model');

			$result_info['matid'] = $this->reservation_model->if_reserved($userid);
			$result_info['material'] = $this->reservation_model->if_waitlisted($userid);
			
			$this->load->model('user/borrowed_model');
			$result_info['borrowed'] = $this->borrowed_model->get_borrowed_material();
			$result_info['res'] = $this->borrowed_model->get_reserved_books();
			$result_info['overdue'] = $this->borrowed_model->get_overdue();
		
			$this->load->view('user/adv_search', $result_info);
		}else
			$this->load->view('user/outside_adv_search', $result_info);

	}

	
	public function reserve(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('materialid');
		$userid = $this->session->userdata('email');

		$this->load->model('user/reservation_model');
		$check_borrowed = $this->reservation_model->get_borrowedcopy($materialid);		
		if($check_borrowed){
			$data['materialid']=$materialid;
			$this->load->view('user/waitlist_book', $data);

		}else{
			$this->load->model('user/reservation_model');
			$this->reservation_model->get_book($materialid, $userid);
		}

		
	}
	
	public function reserve_continue(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('yes');
		$userid = $this->session->userdata('email');
		
		$data['materialid']=$materialid;
		$data['user']=$userid;
		$data['value']=$this->input->post('search');

		$this->load->model('user/reservation_model');
		$this->reservation_model->get_book($materialid, $userid);
		$this->load->view('user/user_search', $data);
	}

	public function cancel_reservation(){
		$this->load->library("session");
		$this->load->helper('url');
		$matid = $this->input->post('materialid');
		$this->load->model('user/reservation_model');
		$this->reservation_model->cancel_res($matid);
		$this->reserved_materials_view();
	}	

	//reservation with otherstudent reserved 
	/*public function waitlist_continue(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('yes');
		$userid = $this->session->userdata('email');
		
		$data['materialid']=$materialid;
		$data['user']=$userid;

		$this->load->model('user/waitlist_book_model');
		$this->load->model('user/reservation_model');
		
		$this->waitlist_book_model->waitlist_book($materialid, $userid);
		$data['list'] = $this->reservation_model->waitlisted_matid($userid);

		$this->load->view('user/waitlisted', $data);
		
	}*/

	
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
		
		$this->session->set_userdata('idnumber',$borrower_info[0]->idnumber);
		$this->session->set_userdata('email',$borrower_info[0]->email);
		$this->session->set_userdata('password',$pass);
		$this->session->set_userdata('bookcount',$borrower_info[0]->bookcount);

			$b_info = $this->log_model->get_info($borrower_info[0]->idnumber);
				$this->session->set_userdata('college',$b_info[0]->college);
				$this->session->set_userdata('course',$b_info[0]->course);
				$this->session->set_userdata('sex',$b_info[0]->sex);
				$this->session->set_userdata('classification',$b_info[0]->classification);
				$this->session->set_userdata('fname',$b_info[0]->fname);
				$this->session->set_userdata('mname',$b_info[0]->mname);
				$this->session->set_userdata('lname',$b_info[0]->lname);
			
		$this->borrowed_materials();
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
	



	public function register(){
		$this->load->helper('url');
		$this->load->view('user/Register.php');
	}

	public function borrowed_materials() { 
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$data['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
		$data['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
		$data['overdueCount'] = $this->borrowed_model->get_overdue_material_count();
		$data['res'] = $this->borrowed_model->get_reservations();
		$data['overdue'] = $this->borrowed_model->get_overdue();
		$this->load->view('user/profile', $data);
	}
	
	public function borrowed_materials_view(){
	
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		// views the result by passing the data to the view php file
		$data['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
		$data['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
		$data['overdueCount'] = $this->borrowed_model->get_overdue_material_count();
		$data['res'] = $this->borrowed_model->get_reservations();
		$data['overdue'] = $this->borrowed_model->get_overdue();
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();

		$this->load->view('user/borrowed_books', $data);
	
	}
	public function profile(){
		$email = $this->session->userdata('email');
		if($email)
			//$this->borrowed_materials();
			echo $email;
		else
			//$this->index();
			echo "MAY MALI!";
	}	


	
	public function reserved_materials_view(){
	
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		$userid = $this->session->userdata('email');
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$data['res'] = $this->borrowed_model->get_reserved_books();
		$data['overdue'] = $this->borrowed_model->get_overdue();

		//update
		$this->load->model('user/reservation_model');
		$data['list'] = $this->reservation_model->waitlisted_matid($userid);
		$data['rank'] = $this->reservation_model->get_rank($userid);
		$data['total'] = $this->reservation_model->get_total($userid); //end update
		$this->load->view('user/reserved_books', $data);
	
	}
		
	public function load_profile(){
		$email = $this->session->userdata('email');
		if($email)
			$this->borrowed_materials();
		else
			$this->index();
			
	}


	public function registration(){

		
		$this->load->model('user/verification_model');

		$email = $this->input->post('email');
		$idnumber = $this->input->post('idnumber');
		$password = SHA1($this->input->post('password'));

		
		$this->verification_model->insert_user( $email, $idnumber, $password );



	}

	public function validate_email($idnumber, $verification_code){

			$this->load->model('user/verification_model');
			
			//tapos irrun nya n yung nsa verifcation_model
			$validated = $this->verification_model->validate_email($idnumber, $verification_code);
			
			if($validated === true){
				echo 'YOUR ACCOUNT HAS BEEN VERIFIED YEY';
			}
			else{
				echo 'error';
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

//error validation	


	public function idnumber_check($str)
	{
		if(preg_match( '/(^\d{4}-\d{5}$|^\d{9}$)/' ,$str)){
			return TRUE;
			}
		else{
			$this->form_validation->set_message('idnumber_check','Invalid id number.');
			return FALSE;
			}
	}



	/**
	* this function checks the idnumber
	*/
	public function checkidnumber(){
		$idnumber = $this->input->post('idnumber');		//store the result into the variable idnumber
		$this->load->library('form_validation');		//loads the library that validates the form
		//field name, error message, validation rules
		
		$this->form_validation->set_rules('idnumber','IDnumber',
			'trim|required|max_length[10]|xss_clean|callback_idnumber_check');		//sets the rules for the validation form

		if($this->form_validation->run() == FALSE){		//something is wrong with the validation
			echo '3';
		}
		else{
			$this->load->model('user/registration_model');		//loads the model of the registration
			$in_borrower = $this->registration_model->checkidnum($idnumber);		//store the result from the function
			$in_sample = $this->registration_model->checkidnum_sample($idnumber);
			if($in_borrower[0]->count == 1){
				echo '1';
			}
			else if($in_sample[0]->count == 0){
				echo '2';
			}
			else{
				echo '0';
			}
		}

		
		
	}

	public function checkemail(){
		$this->load->library('form_validation');
		//field name, error message, validation rules
		$email = $this->input->post('email');
		$this->form_validation->set_rules('email','Email',
			'trim|required|valid_email|max_length[50]');
			
			if($this->form_validation->run() == FALSE){
				echo '1';
			}
			else {
				$this->load->model('user/registration_model');
				$in_borrower = $this->registration_model->check_email_borrower($email);
				if($in_borrower[0]->count == 1){
					echo '2';
				}
				else{
					echo $in_borrower[0]->count;
				}
			}
	}

	public function checkpassword(){

		$this->load->library('form_validation');
		//field name, error message, validation rules
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[8]|max_length[32]');
		
		if($this->form_validation->run() == FALSE){
			echo "1";
		}
		else{
			echo "0";
		}
	}


public function resend_email_verification(){
	$this->load->library('form_validation');
		//field name, error message, validation rules
		$email = $this->input->post('email1');
		$this->form_validation->set_rules('email1','Email',
			'trim|required|valid_email|max_length[50]');
			
			if($this->form_validation->run() == FALSE){
				echo '3';
			}
			else {
				$this->load->model('user/registration_model');
				$in_borrower = $this->registration_model->resend_email_verification($email);
				if($in_borrower[0]->count == 0){
					echo '2';
				}
				else{
					echo $in_borrower[0]->count;
				}
			}
}

public function forgot_password()
	{
		$action = $this->input->post('action');
		
		
		if($action == 'verify_email')
		{
			$email = $this->input->post('email');
			$this->load->model('user/forgot_model');
			$result = $this->forgot_model->verify_email($email);
				if($result)
				{
					$verfied_email = $result[0]->email;
					$verification_code = $result[0]->password;
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
    					'smtp_port' => 465,
    					'smtp_user' => 'icslibsystem.dummy@gmail.com',
    					'smtp_pass' => 'icslibraryadmin'
					);
					$this->load->library('email',$config);
					$this->email->set_newline("\r\n");

					$this->email->from('icslibsystem.dummy@gmail.com', 'ICS Library');
					$this->email->to($verfied_email); 
	
	
					$this->email->subject('Password Reset');
					$this->email->message("Hello, Below is the code you need for password reset {$verification_code} ");
	
						if($this->email->send())
						{
							$ret_val = array('message'=> 'Verification code has been sent to your mail.','stat'=> 'success','verf_code' => $verification_code);
							echo json_encode($ret_val);
							
						}

						else
						{
							$ret_val = array('message'=> 'An error occured.','stat'=> 'fail');
							echo json_encode($ret_val);
						}
				}

				else
				{
					$ret_val = array('message'=> 'The email you entered is not registered.','stat'=> 'fail');
					echo json_encode($ret_val);
				}
		}

		else if($action == 'verify_code')
		{
			$code_input = $this->input->post('code_input');
			$verification_code = $this->input->post('verf_code');
				if($verification_code == $code_input)
				{
						$ret_val = array('message'=> 'Verification code accepted.','stat'=> 'success');
						echo json_encode($ret_val);
				}

				else
				{
						$ret_val = array('message'=> 'Verification code denied. Please make sure you entered the code correctly.','stat'=> 'fail');
						echo json_encode($ret_val);

				}
		}

		 else if($action == 'change_pw')
		{
			$new_password = $this->input->post('new_password');
			$retype_new_pw = $this->input->post('retype_new_pw');
			$email = $this->input->post('email');

			if($new_password == $retype_new_pw)
			{
					//put database update here update password to new password
					$this->load->model('user/forgot_model');
					$this->forgot_model->change_password($email,$new_password);
					$ret_val = array('message' => 'Your password has been reset. Please do not forget it again.','stat' => 'success','email' => $email );
					echo json_encode($ret_val);
			}

			else
			{
					$ret_val = array('message' => 'Error in resetting your password. Try again later.','stat' => 'fail');
					echo json_encode($ret_val);
			}

		 }

}

public function checkUpdateEmail(){
		$this->load->library('form_validation');
		//field name, error message, validation rules
		$email = $this->input->post('email');
		$this->form_validation->set_rules('email','Email',
			'trim|required|valid_email|max_length[50]');
			
			if($this->form_validation->run() == FALSE){
				echo '1';
			}
			else {
				$this->load->model('user/update_model');
				$in_borrower = $this->update_model->update_email_exist($email);
				if($in_borrower[0]->count == 1){
					echo '2';
				}
				else{
					echo '0';
				}
			}
}

public function checkUpdatePassword(){

		$this->load->library('form_validation');
		//field name, error message, validation rules
		$password = $this->input->post('password');
		//$re_password = $this->input->post('re_password');
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[6]|max_length[32]');
		
		if($this->form_validation->run() == FALSE){
			echo '1';
		}
		else{
			echo '0';
		}
	}

public function checkUpdateRe_Password(){

		$this->load->library('form_validation');
		//field name, error message, validation rules
		$password = $this->input->post('password');
		$re_password = $this->input->post('re_password');
		$this->form_validation->set_rules('re_password', 'Password',
			'trim|required|min_length[6]|max_length[32]');
		
		if($this->form_validation->run() == FALSE){
			echo '1';
		}
		else if($password != $re_password){
			//check if password == password_conf
			//$this->load->model('user/update_model');
			echo '2';
		}
		else{	
			echo '0';
		}
	}

/*new update*/
public function updateEmail(){
		
		$email = $this->input->post('email');
			
		$this->load->model('user/update_model');
		$this->update_model->update_email($email);
		echo "1";
}

public function updatePassword(){
	$password = $this->input->post('password');

	$this->load->model('user/update_model');
	$this->update_model->update_password($password);
	
	echo "1";
}


}

?> 