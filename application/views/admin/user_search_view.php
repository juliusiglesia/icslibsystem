<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>	
	<body>
		 <?php include 'includes/header.php'; ?>

		<div class="mainBody">
			<!-- Nav tabs -->
			<?php include 'includes/sidebar.php'; ?>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
						<br />

						<input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
						<input class = "btn btn-primary" type="button" id = "searchReservedButton" value="Search"/> 
						<div id = "alert"> </div><br /><br />
	                
						<table class="table table-hover tablesorter" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th width="10%"><center>Student/Employee Number</center></th>
									<th width="55%"><center>Borrower Information</center></th>
									<th width="15%"><center>Status</center></th>
									<th width="20%"><center>Remove</center></th>
								</tr>
							</thead>
							
							<tbody>
								
							</tbody>
						</table>
						<?php include 'includes/pager.php'; ?>
					</div>
				</div>
				
			</div>
		</div>
		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>


		<?php include 'includes/pagination.php'; ?>
		
		<script id="js">

			$('#user-nav').addClass('active');
			
		</script>
		<script type="text/javascript">
				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});	
		</script>
	</body>
</html>