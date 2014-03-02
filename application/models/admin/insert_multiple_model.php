 <?php


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_multiple_model extends CI_Model{
	public function __construct(){
		
	}
	
	public function insert_material( $file ){
		$material= array(
			'materialid' => trim($file[0]),
			'isbn' => trim($file[1]),
			'name' => trim($file[2]),
			'course' => trim($file[3]),
			'available' => trim($file[4]),
			'access' => trim($file[5]),
			'type' => trim($file[6]),
			'year' => trim($file[7]),
			'edvol' => trim($file[8]),
			'requirement' => trim($file[9]),
			'quantity' => trim($file[10])
		);

		$this->db->insert('librarymaterial', $material);
	}

	public function insert_author( $file ){
		$i = 11;
		$j = 0;

		while( $j != count($file[$i]) ){
			$author = array(
				'materialid' => trim($file[0]),
				'isbn' => trim($file[1]),
				'fname' => trim($file[$i][$j][0]),
				'mname' => trim($file[$i][$j][1]),
				'lname' => trim($file[$i][$j][2])
				);
			$this->db->insert('author', $author);
			$j++;
		}

	}

	public function insert_to_db(){
		$file = json_decode($this->input->get('insert'));
		for( $i = 0; $i < count($file); $i++){
			$this->insert_material($file[$i]);
			$this->insert_author($file[$i]);
			echo "true";
		}
    }
}

?>