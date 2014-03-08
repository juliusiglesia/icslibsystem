<?php 
	//profile picture
	base_url();
	if($this->session->userdata('sex') == 'F'){
		echo "<img src='dist/images/derpina.png' alt='' class='img-rounded img-responsive' />";
	}
	else{
		echo "<img src='dist/images/derp.png' alt='' class='img-rounded img-responsive' />";
	}

?>