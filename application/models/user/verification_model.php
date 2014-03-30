<?php
	
	/**	Filename: verification_model.php
	*	Project Name: ICS Library System
	*	Created by: Borrower's Team
	*
	*/

	class Verification_model extends CI_Model{
	
		/**
		*	function that loads the database
		*/

		public function __construct(){
			$this->load->database();
			$this->load->helper('url');
		}
		

		/**
		*	function that inserts a user into the borrower table
		*/

		public function insert_user($email, $idnumber, $password){

				$data=array(
				'idnumber' => $idnumber,
				'email' =>  $email,
				'password' => $password
			);

			$this->db->insert('borrower',$data);
		}
		public function check_account($email){
			$sql = "SELECT email FROM borrower WHERE email = '{$email}'";
			$result = $this->db->query($sql);
			//echo "<br/><br/><br/><br/><br/><br/>".count($result);
			if(count($result)==1) return true;
			else return false;
				
		}

		/**
		*	function that sends a verification email to the user
		*/

		public function send_verification_email($idnumber, $email, $password){
		 	
		 	$sql = "SELECT fname FROM sample WHERE idnumber LIKE '{$idnumber}'";
		 	$result = $this->db->query($sql);
		 	
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'icslibsystem.noreply@gmail.com', 
				'smtp_pass' => 'computerscience128',			   
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_mailtype('html');
			$this->email->set_newline("\r\n");
			$this->email->from('icslibsystem.noreply@gmail.com', 'ICS Library');
			$this->email->to($email);
			$this->email->subject('[iLS] Please verify your account '. $result->row()->fname.'');
			
			$message = '<html><head></head><body>';
			$message .= '<p>Hey hey, we want to verify that you are indeed "'. $result->row()->fname .'".  If that is the case, please follow the link below: <br />';
			$message .= '<p><a href="'. base_url() .'index.php/borrower/validate_email/'. $idnumber .'/'. $password .'">VERIFY MY ILS ACCOUNT</a></p><br />';
			$message .= '<p>If you are not "'. $result->row()->fname .'" or did not request for this verification, you can ignore this email.<br /></p>';
			$message .= '</body></html>';
			
			$this->email->message($message);
			
			if($this->email->send()){
				$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) VALUES ('v-email sent', NOW(), '$idnumber')";
				$query = $this->db->query($stmt);
				return true;
			}
			else return false;
        }
		
		/**
		*	function which calls the function activate_account that activates an account
		*/

		public function validate_email($idnumber, $verification_code){
			
			
			$validation = $this->activate_account($idnumber);
			if($validation === true){
				return true;
			}else{
				return false;
			}
		}
		

		/**
		*	function that updates the borrower's status into ACTIVATED
		*/

		public function activate_account($idnumber){
			
			$sql = "UPDATE borrower SET status = 'ACTIVATED' WHERE idnumber = '{$idnumber}'";
			$result = $this->db->query($sql);
			
			if($this->db->affected_rows() === 1){
				$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) VALUES ('account activated', NOW(), '$idnumber')";
				$query = $this->db->query($stmt);
				return true;
			}else{
				return false;
			}
			
		}
		
	}


	/* 	End of verification_model.php
	* 	Location: ./application/models/user/verification_model.php 
	*/

?>

