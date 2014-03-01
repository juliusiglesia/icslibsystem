<?php


class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('verification_model');
	}

	public function registration(){
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|sha1');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('verification_view');
		}
		else
		{
			/*
					this insert_user() function is for insertion of the user when signing up
					kayo n bahala sa implementation ng insert_user pero $this->input->post('email') etc...... lang nman yun.
					
			*/
			$result = $this->verification_model->insert_user();
		}
		

	}
	
	public function validate_email($idnumber, $verification_code){
			//baka kasi may space pero hindi naman siguro mangyayari yun.
			$verification_code = trim($verification_code);
			
			//tapos irrun nya n yung nsa verifcation_model
			$validated = $this->verification_model->validate_email($idnumber, $verification_code);
			
			if($validated === true){
				//redirect to somewhere
				//pedeng page na "YOUR ACCOUNT HAS BEEN VERIFIED YEY!!"
			}
			else{
				echo 'error';
			}
	}

}

?>
