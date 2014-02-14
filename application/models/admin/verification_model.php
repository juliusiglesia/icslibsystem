<?php
	
	class Verification_model extends CI_Model{
		public function __construct(){
			
		}

		public function verifying() { 
			$email = $this->input->post('email');
			$password = sha1($this->input->post('password'));
			
			return $password;
		}
	}

?>