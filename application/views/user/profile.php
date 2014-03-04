<?php include 'logout_header.php'; ?>

	<!--
	
			BORROWER SIDEBAR
	
	-->
	<br/><br/>
	<div class="container">
	<div class="mainBody">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?php echo base_url(); ?>profile"><i class="fa fa-home fa-fw"></i>Profile</a></li>
                <li><a href="<?php echo base_url(); ?>borrowed_materials"><i class="fa fa-list-alt fa-fw"></i>Books on Hand</a></li>
                <li><a href="<?php echo base_url(); ?>reserved_materials"><i class="fa fa-file-o fa-fw"></i>Reserved Books</a></li>
                <li><a href="<?php echo base_url(); ?>user_search"><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
		
        <div class="col-md-8.5 well">
		
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="well well-sm">
							<div class="row">
								<div class="col-xs-6 col-sm-3 "">
									<img src="<?php echo base_url();?>images/derpina.png" alt="" class="img-rounded img-responsive" />
								</div>
								
								<div class="col-sm-6 col-md-8">
									<h4>
										Hi, <?php echo $this->session->userdata('fname'), "!"?> </h4>
									<p>
										<i class="glyphicon glyphicon-tag"></i>ID Number: <?php echo $this->session->userdata('idnumber')?>
										<br />
										<i class="glyphicon glyphicon-map-marker"></i>Course: <?php echo $this->session->userdata('course')?>
										<br />
										<i class="glyphicon glyphicon-briefcase"></i>College: <?php echo $this->session->userdata('college')?></p>
									
									<p>
									<p><?php include 'update_email_view.php'; ?></p>
									<p><?php include 'update_password_view.php'; ?>	</p>
									</p>
									
									<br />
									<br />
									<div class="profile_overview">
										<h3>Profile Summary:</h3>
										<ul>
										
											<li><b>Overdue books:</b> </li>
											<li><b>Borrowed books:</b> </li>
											<li><b>Reserved books:</b> </li>
										
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