<?php 
	//profile picture
	base_url();
	if($this->session->userdata('sex') == 'F'){
		echo "<img src='dist/images/female.png' alt='' class='img-rounded img-responsive' />";
	}
	else{
		echo "<img src='dist/images/male.png' alt='' class='img-rounded img-responsive' />";
	}

?>