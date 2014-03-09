<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

	<body>
		<?php include 'includes/header.php'; ?>

		<div class="mainBody">
			<!-- Nav tabs -->
			<?php include 'includes/sidebar.php'; ?>
			
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
		
		<script src="<?php echo base_url();?>dist/js/Chart.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/knockout-3.0.0.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/globalize.min.js"></script>
		<script src="<?php echo base_url();?>dist/chart_js/dx.chartjs.js"></script>
		
		<!-- For bar chart -->
		<script>
		
			$('#overview-nav').addClass('active');
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