<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

	<title>ICS-iLS</title>

	<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">

	<style type="text/css" id="holderjs-style"></style></head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>dist/images/logowhite.png" height="30px"></a>
				</div>
				
				<form class="navbar-form navbar-right" role="form">
					<button type="button" class="btn btn-success" id = "logout" >Log out</button>
				</form>

			</div>
		</div>
		<div class="mainBody">
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "overview-nav">
						<a href="<?php echo base_url();?>admin/home">Overview</a>
					</li>
					<li id = "reserved-nav" >
						<a href="<?php echo base_url();?>admin/reservation">Reserved Books</a>
					</li>
					<li id = "borrowed-nav" class="active" >
						<a href="<?php echo base_url();?>admin/borrowed_books">Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search">View All Library Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material">Add A New Material</a>
					</li>
					<li id = "generate-nav" >
						<a href="<?php echo base_url();?>admin/print_inventory" target = "_blank" >Generate Report</a>
					</li>
				</ul>
			</div>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<h1> Borrowed Books </h1>
						<table border = "1">
							<thead>
								<tr>
									<th title="Material ID">Library Material ID</th>
									<th title="Course">Course</th>
									<th title="Information">Library Information</th>
									<th title="Start date">Start Date</th>
									<th title="Rank">Rank</th>
									<th title="Action">Action</th>
								</tr>
							</thead>
						<?php
							
							foreach($borrowed_books as $row){
								echo "<tr>";
								echo "<td> ${row['materialid']} </td>";
								echo "<td> ${row['course']} </td>";
								echo "<td> ${row['name']} </td>";
								echo "<td> ${row['start']} </td>";
								echo "<td> ${row['expectedreturn']} </td>";
								echo "<td><button click class='sendNotif btn btn-primary'>Send notification</button>";
								echo "</tr>";
							}	
						?>
						</table>
					</div>
				</div>
				<div id = "error"> </div>
			</div>

			<!-- FOOTER -->
			<div class = "container marketing" >
				<footer>
					<p class="pull-right"><a href="#"> Back to Top </a></p>
					<p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
				</footer>
			</div><!-- /.container -->
		</div>
		
		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
		
		<script>
			$(document).ready(function(){
				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});
				
				$(".sendNotif").click( function(){
					var parent = $(this).parent();
					var idnumber = $.trim(parent.siblings('.idnumber').text());
					var materialid = $.trim(parent.siblings('.materialid').text());
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/notification",
						data: { materialid : materialid, idnumber : idnumber, message: '1' }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							// show that notification is successful
							$('#error').html(result);
							if( result == "" ){
								//alert("Success!")
							} else {
								//alert("Fail!");
							}
						}
					});

				});
			});
			
		</script>

	</body>
</html>