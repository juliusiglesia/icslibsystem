<?php include 'logout_header.php'; ?>

	<!--
	
			BORROWER SIDEBAR
	
	-->
	
	<div class="container">
	<div class="mainBody">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo base_url(); ?>borrower"><i class="fa fa-home fa-fw"></i>Profile</a></li>
                <li><a href="<?php echo base_url(); ?>borrower/borrowed_books"><i class="fa fa-list-alt fa-fw"></i>Books on Hand</a></li>
                <li><a href="<?php echo base_url(); ?>borrower/reserved_books"><i class="fa fa-file-o fa-fw"></i>Reserved Books</a></li>
                <li class="active"><a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
        
		
									
	</div>
	</div>
	</div>	

			
			
			
		</div>
	</div>


	<div class="container marketing">
<?php include 'home_footer.php'; ?>