<?php include 'admin_header.php'?></div>
		<div class="mainBody">
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav" >
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
						<div class="title">
							<h2>Statistics</h2>
						</div>
						<div class="content">
							<div class="pane">
							
								<div class="long-title"><h3></h3></div>
								<div id="barchartContainer" style=" display: inline-block; white-space: nowrap; width: 53%; height: auto; margin-left: -55%;"></div>
								<div id="piechartContainer" style=" display: inline-block; white-space: nowrap; width: 10%; height: auto;"></div>
								
								
							</div>
							<div class="btn_container">
								<!--<button type="button" class="btn btn-default" onclick="clearAlert()">Clear Reservations</button>&nbsp;&nbsp;-->
								<a href="<?php echo base_url();?>admin/print_inventory"><button type="button" class="btn btn-danger">Generate Report</button></a>
							</div>
								
						</div>
						<br />

						<?php 
 							foreach ($stats as $row) {
 								//echo "Library Material Count:".$row->libmatcount." Borrowed Material Count: ".$row->bormatcount." Not Borrowed Material Count: ".$row->diffcount;
 								echo "<br/>";
 								echo "<script> var libmatcount = $row->libmatcount </script>";
 								echo "<script> var bormatcount = $row->bormatcount </script>";
 								echo "<script> var diffcount = $row->diffcount </script>";
 							}

 							foreach ($weekstats as $row) {
 								//echo "Library Material Count:".$row->libmatcount." Borrowed Material Count: ".$row->bormatcount." Not Borrowed Material Count: ".$row->diffcount;
 								//echo "<br/>";
 							}
 						?>
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
				   //--------------------------------/
				    //PHP CODE TO KNOW PHP CODE TO KNOW COUNT OF RESERVED BOOKS
				   var dataSource = [
				    { week: "WEEK 1", value1: 423,  value2: 12,  value3: 500},
				    { week: "WEEK 2", value1: 178,  value2: 43,  value3: 30},
				    { week: "WEEK 3", value1: 308,  value2: 123,  value3: 500},
				    { week: "WEEK 4", value1: 348,  value2: 230,  value3: 12}
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
				        { valueField: "value1", name: "1" },
						{ valueField: "value2", name: "2" },
				        { valueField: "value3", name: "3" }
				    ],
				    title: "Reservations per Month",
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
				    { book: "Out", count: libmatcount },
				    { book: "In", count: diffcount }
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
				    title: "Materials in Circulation"
				});
				}

			);
		</script>

	</body>
</html>