<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="<?php echo base_url();?>dist/images/favicon.png">

	<title>ICS-iLS</title>

	<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet">

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
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="40px"></a>
                </div>
			<div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-cog" ></span></a>
				  
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
					<li><a href="#">Help</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
				  </ul>
            </div>
			</div>
			</div>

		<div class="mainBody">
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav" ><br />
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
						<a href="<?php echo base_url();?>admin/borrowed_books"><span class="glyphicon glyphicon-export"></span> &nbsp;Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search"><span class="glyphicon glyphicon-search"></span> &nbsp;View All Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add A New Material&nbsp;&nbsp;&nbsp;</a>
					</li>
					<li id = "overview-nav" class="active">
						<a href="<?php echo base_url();?>admin/home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Overview</a>
					</li>	
				</ul>
			</div>
			
			<div class="leftMain">
				<div id = "main-page">
					<div id = "main-content">
					<br />
						<div class="content">
							<div class="pane">
							
								<div class="long-title"><h3></h3></div>
								<div id="barchartContainer" style=" display: inline-block; white-space: nowrap; width: 53%; height: auto; margin-left: -55%;"></div>
								<div id="piechartContainer" style=" display: inline-block; white-space: nowrap; width: 10%; height: auto;"></div>
								<script> var libmatcount = new Array(); var bormatcount = new Array(); var diffcount = new Array(); </script>
								<?php

									$row = $stats[0];
	 								echo "<script>";
	 								echo "libmatcount[0] = $row->libmatcount;";
	 								echo "bormatcount[0] = $row->bormatcount;";
	 								echo "diffcount[0] = $row->diffcount;";

	 								$row = $weekstats[0];
									echo "libmatcount[1] = $row->libmatcount;";
	 								echo "bormatcount[1] = $row->bormatcount;";
	 								echo "diffcount[1] = $row->diffcount;"; 								

	 								$row = $laststats[0];								
									echo "libmatcount[2] = $row->libmatcount;";
	 								echo "bormatcount[2] = $row->bormatcount;";
	 								echo "diffcount[2] = $row->diffcount;"; 								
									
									$row = $twostats[0];								
									echo "libmatcount[3] = $row->libmatcount;";
	 								echo "bormatcount[3] = $row->bormatcount;";
	 								echo "diffcount[3] = $row->diffcount;"; 	

	 								$row = $threestats[0];								
									echo "libmatcount[4] = $row->libmatcount;";
	 								echo "bormatcount[4] = $row->bormatcount;";
	 								echo "diffcount[4] = $row->diffcount;"; 								
									
	 								echo "</script>";
		 						?>
							</div>
							<div class="btn_container">
								<a href="<?php echo base_url();?>admin/print_inventory"><button type="button" class="btn btn-danger">Generate Report</button></a>
							</div>
								
						</div>
						<br/>
					</div>
				</div>
			</div>
		</div>
		
		<!-- FOOTER -->
		<footer>
			<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
		</footer>
		

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>dist/js/Chart.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/knockout-3.0.0.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/globalize.min.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/dx.chartjs.js"></script>
		
		<!-- For bar chart -->
		<script>
		
			function clearAlert(){
			
				alert('Are you sure you want to clear all reservations?');
				alert('Are you really sure? You\'\re going to delete ALL reservation data.');
				alert('This is your last chance. Are you sure you want to clear all reservations?');
			
			}
			
			$(function ()
				{				
					var dataSource = [
				    { week: "Current week", value1 : bormatcount[1], value2: diffcount[1] },
				    { week: "Last week", value1 : bormatcount[2], value2: diffcount[2] },
				    { week: "Last two weeks", value1 : bormatcount[3], value2: diffcount[3] },
				    { week: "Last three weeks",value1 : bormatcount[4], value2: diffcount[4] }
				];

				$("#barchartContainer").dxChart({
				    dataSource: dataSource,
				    commonSeriesSettings: {
				        argumentField: "week",
				        type: "bar",
				        hoverMode: "allArgumentPoints",
				        selectionMode: "allArgumentPoints",
				        label: {
				            visible: true,
				            format: "fixedPoint",
				            precision: 0
				        }
				    },

				    //--------------------------------/
				    //PHP CODE TO KNOW MONTH
				    series: [
						{ valueField: "value1", name: "Borrowed Materials" },
				        { valueField: "value2", name: "Available Materials" }
				    ],
				    title: "Four-Week Stats",
				    legend: {
				        verticalAlignment: "bottom",
				        horizontalAlignment: "center"
				    },
				    pointClick: function (point) {
				        this.select();
				    }
				});
				}

			);
		</script>
		<script>
			$(function ()  
				{
				   var dataSource = [
				    { book: "Out", count: libmatcount[0] },
				    { book: "In", count: bormatcount[0] }
				];

				$("#piechartContainer").dxPieChart({
				    size:{ 
				        width: 500
				    },
				    dataSource: dataSource,
				    series: [
				        {
				            argumentField: "book",
				            valueField: "count",
				            label:{
				                visible: true,
				                connector:{
				                    visible:true,           
				                    width: 1
				                }
				            }
				        }
				    ],
				    title: "Circulation of Materials"
				});
				}

			);
		</script>

	</body>
</html>