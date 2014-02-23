<!DOCTYPE html>
<html lang="en"><head>
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
	<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">

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
					<li id = "overview-nav" class="active">
						<a href="<?php echo base_url();?>admin/home">Overview</a>
					</li>
					<li id = "reserved-nav" >
						<a href="<?php echo base_url();?>admin/reservation">Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
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
				<div id = "main-page">
					<div id = "main-content">
						<br />
						<br />
						<h1 style="width: 800px ; margin-left: auto; margin-right: auto;">STATISTICS</h1>
						<canvas id="bargraph" height="350" width="500"></canvas>
						<br/>
						<br/>
						<?php 
							foreach ($stats as $row) {
								echo "Library Material Count:".$row->libmatcount." Borrowed Material Count: ".$row->bormatcount." Not Borrowed Material Count: ".$row->diffcount;
								//echo "<br/>";
							}
						?>

						<br/>
						<br/>
					</div>
				</div>
			</div>
		</div>
		
		<!-- FOOTER -->
		 <footer>
            <a href="#" class="back-to-top"><img id="foot" src="<?php echo base_url();?>dist/images/top_icon.PNG" alt="Back to Top"></a>
            <p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
        </footer>
		

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>dist/js/Chart.js"></script>
		
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->

		<script type="text/javascript">
			$("#logout").click(function(){
				window.location.href = "<?php echo site_url('admin/logout'); ?>";
			});

			$("#reserved-nav").click(function(){
				$.ajax({

					url: "<?php echo base_url();?>admin/reservation_queue",
					dataType: "json",

					beforeSend: function() {
						//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
						$("#error_message").html("loading...");
					},

					error: function(xhr, textStatus, errorThrown) {
							$('#error_message').html(textStatus);
					},

					success: function( result ){
						if( result == "" ) $("#result").html("No reserved!");
						else{
							$("#result").html(result[0].id);

						}
					}
				});
			});
		</script>

		<script>
			var barChartData = {
				labels : ["January","February","March","April","May","June","July"],
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						data : [65,59,90,81,56,55,40]
					},
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						data : [28,48,40,19,96,27,100]
					}
				]
				
			}

		var myLine = new Chart(document.getElementById("bargraph").getContext("2d")).Bar(barChartData);
		
		</script>

	</body>
</html>