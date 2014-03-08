<?php 
	if($this->session->userdata('email'))
		include 'logout_header.php'; 
	else
		include 'home_header.php';
?>

	<!--
	
			BORROWER SIDEBAR
	
	-->
	<br/><br/>
	<div class="container">
	<div class="mainBody">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo base_url(); ?>reserved_materials"><span class="glyphicon glyphicon-folder-close"></span><i class="fa fa-home fa-fw"></i>Library Inventory</a></li>
                <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span><i class="fa fa-file-o fa-fw"></i>Manage Profile</a></li>
                <li><a href="<?php echo base_url(); ?>user_search"><span class="glyphicon glyphicon-search"></span><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
		
        <div class="col-md-8.5 well1">
		
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="well2 well-sm">
							<div class="row">
								<div class="col-xs-6 col-sm-3">
									<?php 
										base_url();
										if($this->session->userdata('sex') == 'F'){
											echo "<img src='dist/images/derpina.png' alt='' class='img-rounded img-responsive' />";
										}
									 	else{
											echo "<img src='dist/images/derp.png' alt='' class='img-rounded img-responsive' />";
										}
									?>
								</div>
								
								<div class="col-sm-6 col-md-8">
									<h4>
										Hi, <?php echo $this->session->userdata('fname'), "!"?> </h4>
									<p>
										<i class="glyphicon glyphicon-tag"></i> ID Number: <?php echo $this->session->userdata('idnumber')?>
										<br />
										<i class="glyphicon glyphicon-map-marker"></i> Course: <?php echo $this->session->userdata('course')?>
										<br />
										<i class="glyphicon glyphicon-briefcase"></i> College: <?php echo $this->session->userdata('college')?></p>
									
									<p>
									<p><?php include 'update_email_view.php'; ?></p>
									<p><?php include 'update_password_view.php'; ?>	</p>
									</p>
									
									<br />
									<br />
									<div class="profile_overview">
										<h3>Profile Summary:</h3>
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
												echo "${row['COUNT(author.materialid)']}";
												?> 
												</b>
											</li>
										
										</ul>
									
									</div> <!--profile_overview-->
								</div> <!--col-sm-6 cod-md-8-->
							</div> <!--row-->
						</div> <!--well well-sm-->
					</div> <!--col-md-9-->
				</div> <!--row-->
					
		
			</div> <!--container-->
		</div> <!--col-md-8.5-->
	</div>	 <!--row-->	
	</div> <!--mainBody-->
	</div>  <!--container-->


	<div class="container marketing">
<?php include 'home_footer.php'; ?>