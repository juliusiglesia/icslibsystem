<?php
	
	class Verification_model extends CI_Model{
	
	
		public function __construct(){
			$this->load->database();
			$this->load->helper('url');
		}
		
		public function insert_user(){
			/*
				PLS READ:
					cinomment out ko lang muna to kasi trabaho nyo daw to sabi ni TL. Ginawa ko na lang yung 'pseudocode' para less time
					ang pag aral nyo sa code n to. Gumamit muna ko ng values directly from borrower table for updating its status. Di ako kumuha sa user kasi
					kelangan mag insert muna. E d ako familiar sa table ng borrower, at sabi nga ni TL trabaho nyo yun :))
					
				
				ito yung part na kkunin lahat ng values example:
				$firstname = $this->input->post('firstname');
				$email = $this->input->post('email');
				$idnumber = $this->input->post('idnumber');
				$password = sha1($this->input->post('password'));
				bla bla bla . . .
				
				$sql = "INSERT BLAH BLAH BLAH";
				$result = $this->db->query($sql);
				
				ETO KAPAG SUCCESSFUL UNG PAG INSERT
				if($this->db->affected_rows() === 1){
					$verification_code = $password;	
					
					**try nyo yung $this->session->set_userdata(); pero d pa ko mxadong familiar
					
					$this->send_verification_email();
				}else{
					BLAH BLAH BLAH
				}
				
			*/
				
				$this->send_verification_email();
				
		}
		
		public function send_verification_email(){
		 
				
			
			/*
				//ganto ata gagawin nyo: 
				$email = $this->input->post('email');
				$password = sha1($this->input->post('password'));
				
				PERO EXAMPLE LANG TO PARA DI N KO MAG INSERT PLEASE DELETE DISZZ
				
				**try nyo yung $this->session->userdata(); pero d pa ko mxadong familiar
				
			*/
			
			/*
				KUNG GUSTO NYO DIN ITEST MUNA NG HND MUNA KUMUKUHA SA DATABASE:
				**insert sa sample table, tapos insert sa borrower, nangopya lng ako ng password tapos inedit ko lng ng dlwang letters
				**dapat legit yung email na ilalagay kasi mag eerror.
			*/
			$verification_code = 'e4472543c238772747cb33c08bdd5273106438g5';
			$email = 'jettcalleja@gmail.com';
			$idnumber = '2009-17975';
		
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'system.icslibrary@gmail.com',  //ADMIN EMAIL
				'smtp_pass' => 'icslibraryadmin',			   //ADMIN PW
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_mailtype('html');
			$this->email->set_newline("\r\n");
			$this->email->from('System.ICSLibrary@gmail.com', 'ICSLibrary Admin');
			$this->email->to($email);
			$this->email->subject('Email Test');
			
			/*
				PDE NYONG PAGANDAHIN PA YUNG MESSAGE SAMPLE MESSAGE LANG YAN. "Verification link: <i>Verify</i>YEAH."
				nag html type ako para pede ayos ayos yung format or something, at dahil gumamit din ako ng <a href>
			*/
			$message = '<html><head></head><body>';
			
			/* base_url. 'index.php/CONTROLLER/function sa controller na icacall pagkaclick ng link */
			
			/* example URL: http://localhost/CodeIgniter_2.1.4/index.php/register/validate_email/2009-17975/e4472543c238772747cb33c08bdd5273106438g5 */
			/* 
			
				WAG MALITO KASI MERON DING FUNCTION NA validate_email() dito sa model 
				yung sa controller muna yung iinvoke nya. 
			
			*/
			
			
			$message .= '<p>Verification link: <strong><a href="'. base_url() .'index.php/register/validate_email/'. $idnumber .'/'. $verification_code .'">Verify</a></strong>YEAH.</p>';
			$message .= '</body></html>';
			
			$this->email->message($message);
		
			$this->email->send();		
        }
		
		public function validate_email($idnumber, $verification_code){
			
			/* ewan ko lang kung necessary pa to pero lagay nyo na din :)) */
			$sql = "SELECT idnumber, password FROM borrower WHERE idnumber = '{$idnumber}'";
			$result = $this->db->query($sql);
			
			$validation = $this->activate_account($idnumber);
			if($validation === true){
				return true;
			}else{
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
				echo 'activate_account error';
				return false;
			}
			
		}
		
	}

?>
