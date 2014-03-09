<?php 

/*
*	Filename: borrower.php
*	Project Name: ICS Library System
*	Date Created: 23 January 2014
*	Created by: 
*
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrower extends CI_Controller {
	
	public function _construct(){
		parent::_construct();
		$this->load->model('borrower_model');
	}

	public function index(){
		$is_logged_in = $this->is_logged_in();
		if($is_logged_in) $this->borrowed_materials();
		else $this->load->view('user/index.php');
	}

	public function about(){
		$this->load->view('user/about_us.php');
	}
	

	public function no_cache(){
		$this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header('Pragma: no-cache');
	}

	public function is_logged_in(){
		return $this->session->userdata('email');
	}

	
	public function reserve(){
		$this->load->library("session");
		$this->load->helper('url');

		$materialid = $this->input->post('materialid');
		$userid = $this->session->userdata('email');

		$this->load->model('user/reservation_model');
		$this->reservation_model->get_book($materialid, $userid);	
	}
	

public function cancel_reservation(){
		$this->load->library("session");
		$this->load->helper('url');
		$matid = $this->input->post('materialid');
		$this->load->model('user/reservation_model');
		$this->reservation_model->cancel_res($matid);
//		$this->reserved_materials_view();
	}	


public function check_logout(){
		$is_logged_in = $this->is_logged_in();
		$this->no_cache();
		if( $is_logged_in ){
			redirect('/borrower/borrowed_materials', 'refresh');
		} else {
			$this->load->view('borrower/forgot_pword');
		}
	
}
	
public function home(){
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/borrower/login/null', 'refresh');
		}else{
			$this->no_cache();
			$this->load->model('user/borrowed_model'); 
			$userid = $this->session->userdata('email');
			// views the result by passing the data to the view php file
			$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
			$data['reserved'] = $this->borrowed_model->get_reserved_books();
			$data['overdue'] = $this->borrowed_model->get_overdue();
			$data['res'] = $this->borrowed_model->get_reservations();
			$data['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();
			$data['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
			$data['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
			$data['overdueCount'] = $this->borrowed_model->get_overdue_material_count();
			//update
			$this->load->model('user/reservation_model');
			$data['list'] = $this->reservation_model->waitlisted_matid($userid);
			$data['rank'] = $this->reservation_model->get_rank($userid);
			$data['total'] = $this->reservation_model->get_total($userid); //end update
			$data['searchtext']="";
			$this->load->view('user/profile', $data);	
		}
	}
	
	//7am update
	public function login($message){
		$is_logged_in = $this->is_logged_in();
		$this->no_cache();
		if( $is_logged_in ){
			redirect('/borrower/home', 'refresh');
		} else {
		
		if($message != null){
			if($message != 'dne' && $message != 'dnm' && $message !='done' && $message !='verified' ){
					$this->load->model('user/log_model');
					$em = $this->input->post('email');
					$borrower_info = $this->log_model->get_password($message);
					$data['idnumber'] = $borrower_info[0]->idnumber ;
					$data['password'] =$borrower_info[0] ->password;
					$data['email'] = $borrower_info[0]->email ;
			}
			else{
			$data['idnumber'] =null;
			$data['password'] =null;
			$data['email'] = null;
			}
			$data['message'] = $message;
			$this->load->view('user/forgot_pword',$data);
		}
		
		}
	}	//7am update
	
	public function check_user(){
		$this->load->model('user/check_user_model');
		
		$user_count = $this->check_user_model->check_email();

		//if user does not exist
		if( $user_count != 1 ){
			echo "0";
		}else {

			$active = $this->check_user_model->check_email_activation();

			if($active == 1){
				echo "3";
			}else{//activated
				$pass_count =  $this->check_user_model->check_password();

				//user exists but pword does not match
				if( $pass_count != 1 ){
					echo "2";
				} 
				//password and email match
				else {
					$this->load->model('user/log_model');
					$borrower_info = $this->log_model->get_borrower($this->input->post('email'), $this->input->post('pword'));
					$this->session->set_userdata('idnumber',$borrower_info[0]->idnumber);
					$this->session->set_userdata('email',$borrower_info[0]->email);
					$this->session->set_userdata('password',$this->input->post('pword'));
					$this->session->set_userdata('bookcount',$borrower_info[0]->bookcount);

					$b_info = $this->log_model->get_info($borrower_info[0]->idnumber);
					$this->session->set_userdata('college',$b_info[0]->college);
					$this->session->set_userdata('course',$b_info[0]->course);
					$this->session->set_userdata('sex',$b_info[0]->sex);
					$this->session->set_userdata('classification',$b_info[0]->classification);
					$this->session->set_userdata('fname',$b_info[0]->fname);
					$this->session->set_userdata('mname',$b_info[0]->mname);
					$this->session->set_userdata('lname',$b_info[0]->lname);
					$this->session->set_userdata('searchtype',0);
					echo "1";
				}
			}
			
		}
	
	}
	
public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	



	public function register(){
		$this->load->helper('url');
		$this->load->view('user/Register.php');
	}

	public function borrowed_materials() { 
		// loads the model php file which will interact with the database
		$this->no_cache();

		// loads the model php file which will interact with the database
		$this->load->model('user/borrowed_model'); 
		$userid = $this->session->userdata('email');
		
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$data['reserved'] = $this->borrowed_model->get_reserved_books();
		$data['overdue'] = $this->borrowed_model->get_overdue();
		$data['res'] = $this->borrowed_model->get_reservations();
		$data['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();
		$data['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
		$data['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
		$data['overdueCount'] = $this->borrowed_model->get_overdue_material_count();
		
		//update
		$this->load->model('user/reservation_model');
		$data['list'] = $this->reservation_model->waitlisted_matid($userid);
		$data['rank'] = $this->reservation_model->get_rank($userid);
		$data['total'] = $this->reservation_model->get_total($userid); //end update
		$data['searchtext']="";
		
		$this->load->view('user/profile', $data);

	}

	public function reserved_materials_view(){
		// loads the model php file which will interact with the database
		$this->load->helper('url');
		$this->load->model('user/borrowed_model'); 
		$userid = $this->session->userdata('email');
		// views the result by passing the data to the view php file
		$data['borrowed'] = $this->borrowed_model->get_borrowed_material();
		$data['reserved'] = $this->borrowed_model->get_reserved_books();
		$data['overdue'] = $this->borrowed_model->get_overdue();
		$data['res'] = $this->borrowed_model->get_reservations();
		$data['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();

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

public function resend_mail(){
	$this->load->model('user/verification_model');

	$email = $this->input->post('email');
	$idnumber = $this->input->post('idnumber');
	$password = SHA1($this->input->post('password'));

	$this->verification_model->send_verification_email($idnumber, $email, $password);
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
				//echo 'YOUR ACCOUNT HAS BEEN VERIFIED YEY';
				$this->login('verified');
			}
			else{
				$this->login('done');
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
			'trim|required|min_length[6]|max_length[32]');
		
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
			$name = $this->forgot_model->get_name($email);
			$name = $name[0]->fname;
			$result = $this->forgot_model->verify_email($email);
				if($result)
				{

					$verfied_email = $result[0]->email;
					$verification_code = $result[0]->password;
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
    					'smtp_port' => 465,
    					//'smtp_user' => 'icslibsystem@gmail.com',
    					//'smtp_pass' => 'computerscience128'
    					'smtp_user' => 'icslibsystem.dummy@gmail.com',
    					'smtp_pass' => 'codeigniter'
					);
					$this->load->library('email',$config);
					$this->email->set_newline("\r\n");

					$this->email->from('icslibsystem@gmail.com', 'ICS Library');
					$this->email->to($verfied_email); 
	
	
					$this->email->subject('Password Reset');
					$this->email->message("Hello {$name}, Below is the code you need for password reset {$verification_code} ");
	
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
			'trim|required|min_length[6]|max_length[32]|required|matches[password]');
		
		if($this->form_validation->run() == FALSE){
			echo '1';
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


public function getPassword()
	{
	$opassword = $this->input->post('opassword');
	$idnumber = $this->input->post('idnumber');

	$this->load->model('user/update_model');
	$cpword = $this->update_model->get_password($idnumber);
	//echo $cpword[0]->password;
	$opassword = SHA1($opassword);
	$ret_pw = $cpword[0]->password;
	$ret_val = array('opassword'=>$opassword, 'password'=>$ret_pw);
	echo json_encode($ret_val);
	

	}




public function outside_search(){
			
	$search = 	$this->db->escape_str($this->input->post('searchbox'));
		
	$search_option = $this->input->post('category'); //array yung options
	$type = $this->input->post('type');

	if(empty($type) || $search==''){
		$this->load->model('user/basic_search_model');
		$result_info['value'] = $this->basic_search_model->get_search_res($search,$search_option);
	}
	else{
		$this->load->model('user/advance_search_model');
		$result_info['value'] = $this->advance_search_model->get_adv_search($search,$search_option,$type);
	}

	$this->load->view('user/search_results_view', $result_info);
}



/*public function new_search(){
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/borrower/login/null', 'refresh');
		}else{
			$this->no_cache();
			$this->load->helper('url');
			
			$search = 	$this->db->escape_str($this->input->post('searchbox'));
			$userid = $this->session->userdata('email');
			
			$search_option = $this->input->post('category'); //array yung options
			$type = $this->input->post('type');

			if(empty($type) || $search==''){
				$this->load->model('user/basic_search_model');
				$result_info['value'] = $this->basic_search_model->get_search_res($search,$search_option);
			}
			else{
				$this->load->model('user/advance_search_model');
				$result_info['value'] = $this->advance_search_model->get_adv_search($search,$search_option,$type);
			}
			$this->load->model('user/basic_search_model');

			







		
			$this->load->model('user/reservation_model');
			$result_info['matid'] = $this->reservation_model->if_reserved($userid);
			$result_info['material'] = $this->reservation_model->if_waitlisted($userid);
			$result_info['total'] = $this->reservation_model->get_total($userid);
			
			$this->load->model('user/borrowed_model');
			$result_info['borrowed'] = $this->borrowed_model->get_borrowed_material();
			$result_info['res'] = $this->borrowed_model->get_reservations();
			$result_info['overdue'] = $this->borrowed_model->get_overdue();
			$result_info['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();
			
		
			$result_info['reserved'] = $this->borrowed_model->get_reserved_books();
				
			$result_info['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
			$result_info['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
			$result_info['overdueCount'] = $this->borrowed_model->get_overdue_material_count();
			$this->load->model('user/reservation_model');
			$result_info['list'] = $this->reservation_model->waitlisted_matid($userid);
			$result_info['rank'] = $this->reservation_model->get_rank($userid);
			$result_info['total'] = $this->reservation_model->get_total($userid); //end update
			
			$result_info['searchtext'] = $this->db->escape_str($this->input->post('searchbox'));
			//$this->load->view('user/search_results_view', $result_info);
			$this->load->view('user/search_results_view', $result_info);	
		}
	}*/

	public function get_message(){
		$this->load->model('user/borrowed_model'); 
		$data = array();
		// views the result by passing the data to the view php file
		$data['reserved'] = $this->borrowed_model->get_reserved_books();
		$data['overdue'] = $this->borrowed_model->get_overdue();	
		$data['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();

		echo json_encode($data);
	}






	

public function new_search(){
		$is_logged_in = $this->is_logged_in();
		if( !$is_logged_in ){
			redirect('/borrower/login/null', 'refresh');
		}else{
			$this->no_cache();
			$this->load->helper('url');
			
			$search = 	$this->db->escape_str($this->input->post('searchbox'));
			$userid = $this->session->userdata('email');
			
			$search_option = $this->input->post('category'); //array yung options
			$s_access_val = $this->input->post('s_access_val');
			$category = $this->input->post('category'); 
			$s_type = $this->input->post('s_type'); 
			$s_accessibility = $this->input->post('s_accessibility'); 

			$st = $this->session->userdata('searchtype');
			
			if($st == 0){

				$this->load->model('user/basic_search_model');
				$result_info['value'] = $this->basic_search_model->get_search_res($search,$search_option);
			}
			else if($st == 1){
				
				$this->load->model('user/advance_search_model');
				$result_info['value'] = $this->advance_search_model->get_adv_search($search,$category,$s_access_val,$s_type,$s_accessibility);
			}

			$this->load->model('user/basic_search_model');
			$this->load->model('user/reservation_model');
			$result_info['matid'] = $this->reservation_model->if_reserved($userid);
			$result_info['material'] = $this->reservation_model->if_waitlisted($userid);
			$result_info['total'] = $this->reservation_model->get_total($userid);
			
			$this->load->model('user/borrowed_model');
			$result_info['borrowed'] = $this->borrowed_model->get_borrowed_material();
			$result_info['res'] = $this->borrowed_model->get_reservations();
			$result_info['overdue'] = $this->borrowed_model->get_overdue();
			$result_info['readytoclaim'] = $this->borrowed_model->get_ready_to_claim();
			
		
			$result_info['reserved'] = $this->borrowed_model->get_reserved_books();
				
			$result_info['borrowedCount'] = $this->borrowed_model->get_borrowed_material_count();
			$result_info['reservedCount'] = $this->borrowed_model->get_reserved_material_count();
			$result_info['overdueCount'] = $this->borrowed_model->get_overdue_material_count();

			$this->load->model('user/reservation_model');
			$result_info['list'] = $this->reservation_model->waitlisted_matid($userid);
			$result_info['rank'] = $this->reservation_model->get_rank($userid);
			$result_info['total'] = $this->reservation_model->get_total($userid); //end update
			
			$result_info['searchtext'] = $this->db->escape_str($this->input->post('searchbox'));
			$this->load->view('user/search_results_view', $result_info);
		}
	}




	
}

?> 