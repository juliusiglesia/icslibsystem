<?php
	
	class Verification_model extends CI_Model{
	
	
		public function __construct(){
			$this->load->database();
			$this->load->helper('url');
		}
		
		public function insert_user($email, $idnumber, $password){

				$data=array(
				'idnumber' => $idnumber,
				'email' =>  $email,
				'password' => $password
			);

			$this->db->insert('borrower',$data);
				
			$this->send_verification_email($idnumber, $email, $password);
				
		}
		
		public function send_verification_email($idnumber, $email, $password){
		 	
		 	$sql = "SELECT fname FROM sample WHERE idnumber LIKE '{$idnumber}'";
		 	$result = $this->db->query($sql);
		 	
			
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				//'smtp_user' => 'system.icslibrary@gmail.com',  //ADMIN EMAIL
				//'smtp_pass' => 'icslibraryadmin',			   //ADMIN PW
				//dummy account
				'smtp_user' => 'icslibsystem.dummy@gmail.com', 
				'smtp_pass' => 'codeigniter',			   
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_mailtype('html');
			$this->email->set_newline("\r\n");
			$this->email->from('System.ICSLibrary@gmail.com', 'ICSLibrary Admin');
			$this->email->to($email);
			$this->email->subject('Account Verification');
			
			$message = '<html><head></head><body>';
			$message .= '<p>Dearest '. $result .',<br />';
			$message .= '<p>Please click the link: <strong><a href="'. base_url() .'borrower/validate_email/'. $idnumber .'/'. $password .'">CLICK ME</a></strong> for your account to verify.</p><br />';
			$message .= '<p>Thank you, <br />';
			$message .= 'ICSLibrary Admin Team</p>';
			$message .= '</body></html>';
			
			$this->email->message($message);
		
			$this->email->send();	

        }
		
		public function validate_email($idnumber, $verification_code){
			
			//$sql = "SELECT idnumber, password FROM borrower WHERE idnumber = '{$idnumber}'";
			//$result = $this->db->query($sql);
			
			$validation = $this->activate_account($idnumber);
			if($validation === true){
				return true;
			}else{
				//echo 'verification_model/validate_email error';
				return false;
			}
			/* AFTER THIS FUNCTION BABALIK NA SIYA SA REGISTER->validate_email() */
		}
		
		public function activate_account($idnumber){
			
			$sql = "UPDATE borrower SET status = 'ACTIVATED' WHERE idnumber = '{$idnumber}'";
			$result = $this->db->query($sql);
			
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				//echo 'activate_account error';
				return false;
			}
			
		}
		
	}

?>