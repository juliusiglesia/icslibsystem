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

<!--information-->
<p>
	<i class="glyphicon glyphicon-user"></i> ID Number: <?php echo $this->session->userdata('idnumber')?><br />
	<i class="glyphicon glyphicon-briefcase"></i> Course: <?php echo $this->session->userdata('course')?><br />
	<i class="glyphicon glyphicon-star"></i> College: <?php echo $this->session->userdata('college')?>
</p>

<!--profile summary-->
<div class="profile_overview">
	<h4><u><b>Profile Summary:</b></u></h4>
	<ul>
		<li><b>Overdue books: 
			<?php
				foreach($overdueCount as $row)
					echo "${row['COUNT(librarymaterial.materialid)']}";
			?> 
			</b>
		</li>
					
		<li><b>Borrowed books:
			<?php
				foreach($borrowedCount as $row)
					echo "${row['COUNT(librarymaterial.materialid)']}";
			?> 
			</b>
		</li>
							
		<li><b>Reserved books:
			<?php
				foreach($reservedCount as $row)
					echo "${row['resCount']}";
				?> 
			</b>
		</li>
								
	</ul>				
</div> <!--profile_overview-->

<center>
	<a class="btn collapse-data-btn" data-toggle="collapse" href="#update">Manage account</a>
</center>

<!--update account-->
<div id="update" class="collapse">
	<?php include 'update_email_view.php';?> <br/>
	<?php include 'update_password_view.php';?>
</div> <!--update account-->