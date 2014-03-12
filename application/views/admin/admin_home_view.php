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
							
					<div class="long-title"><h3></h3></div>
					<div id="infoContainer" class="col-sm-5" style = "text-align: center" >
						<img class="col-md-8 col-sm-offset-2 img-responsive" src="<?php echo base_url();?>dist/images/female.png" />
						
						<div class="col-md-8 col-sm-offset-2 " >
							<hr />
							<?php
								echo "<b> $info->fname ";
								echo "$info->mname ";
								echo "$info->lname </b>";
								echo "<br />";
								echo "$info->email <br />";
								echo "Employee Number : $info->enum <br />";
								echo "Logged in as : $info->username";
							?>
						</div>	
					</div>
					<div id="piechartContainer"></div>
					<script> var libmatcount = new Array(); var bormatcount = new Array(); var diffcount = new Array(); </script>
					<?php
						$row = $stats[0];
							echo "<script>";
							echo "libmatcount[0] = $row->libmatcount;";
							echo "bormatcount[0] = $row->bormatcount;";
							echo "diffcount[0] = $row->diffcount;";
							echo "</script>";
					?>		
					</div>	
					<div class="col-sm-5" style = "text-align: center" >
						<div class="btn_container col-md-8 col-sm-offset-2 ">
							<!--a href="<?php echo base_url();?>admin/"><button type="button" class="btn btn-success">Generate System Log</button></a-->
						</div>	
					</div>	
					<div class="btn_container" style = "text-align: center; padding-right: 100px;" >
						<a target = "_blank" href="<?php echo site_url();?>/admin/print_inventory"><button type="button" class="btn btn-primary">Generate Report</button></a>
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
			
		</script>
		<script>
			$(function ()  
				{
				   var dataSource = [
				    { book: "In", count: libmatcount[0] },
				    { book: "Out", count: bormatcount[0] }
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