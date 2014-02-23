<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>ICS-iLS</title>

		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/dataTables.bootstrap.css"  rel="stylesheet" type="text/css" >
	</head>
	
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
					<li id = "reserved-nav"  class="active" >
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
				<div id="main-page">
					<div id = "main-content">
						<br />
						<br />
						<form method="post"  style="width: 600px ; margin-left: auto; margin-right: auto;" role="form">
                                        <input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
                                        <input class = "btn btn-primary" type="submit" id = "searchReservedBooks" value="Search" name="search_books"/> 
                                        <br />
                        </form>

                         <br/>
						<table id = "reserved-materials" class="tablesorter" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th style='width:10%;' title="Material ID">Material ID</th>
									<th style='width:10%;' title="Type">Type</th>
									<th style='width:50%;' title="Material">Material</th>
									<th style='width:10%;' title="Borrower">Borrower</th>			
									<th style='width:10%;' title="Start date">Claim Date</th>
									<th style='width:10%;' title="Action">Action</th>
								</tr>
							</thead>
							
							<tbody id = "reserved-materials-body">
								<?php
									echo "<script>  var rowCount = 0; </script>";
									foreach($reservations as $row){
										echo 	"<script> 
													rowCount++; 
												</script>";
										echo "<tr id = '${row['materialid']}'>";

										echo "<td class = 'materialid' > ${row['materialid']} </td>";
										echo "<td class = 'type' > ${row['type']} </td>";
										
										echo "<td>";
										echo "<span class = 'name' ><b> ${row['name']}</span></b>" . ",";
										echo "<span >Author, </span>" . ".";
										echo "<span class = 'year' > ${row['year']}</span>" . ".";
										if( $row['edvol'] != NULL ){
											if( $row['edvol'] % 10 == 1 )
												echo "<span> ${row['edvol']}st Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 2 )
												echo "<span> ${row['edvol']}nd Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 3 )
												echo "<span> ${row['edvol']}rd Edition </span>" . "."; 
											else 
												echo "<span> ${row['edvol']}th Edition </span>" . ".";
										}
										echo "<span> <br /> ( ${row['type']} )</span>";
										echo "</td>";
										
										if( $row['started'] == 0 ){
											echo "<td> Not yet notified </td>";
											echo "<td> ${row['queue']} </td>";
											echo "<td><button class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button>";
											echo "<button class='sendClaim btn btn-primary' name='claim' value='${row['id']}'  disabled>Claim</button>";
											echo "</td>";
										} else {
											echo "<td> ${row['startdate']} </td>";
											echo "<td> ${row['queue']} </td>";
											echo "<td><button class='sendNotif btn btn-primary' name='notify' value='${row['id']}' disabled>Notify</button>";
											echo "<button class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button>";
											echo "</td>";
										}
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!--button id="button" > button </button-->
				<div id = "error"> </div>
			</div>
		
		<footer>
            <a href="#" class="back-to-top"><img id="foot" src="<?php echo base_url();?>dist/images/top_icon.PNG" alt="Back to Top"></a>
            <p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
        </footer>

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>js/jquery.tablesorter.js" type="text/javascript"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/dataTables.bootstrap.js"></script>
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
		
		<script>
			
			$(document).ready(function(){
				
				event.preventDefault();
				var currentData = <?php echo json_encode($reservations); ?>;

				//$('#reserved-materials').dataTable();

				function updateContents( current, result ){
					var exist = false;
					if( result.length != current.length ){
						for( var i = 0; i < result.length; i++  ){
							for( var j = 0; j < current.length; j++  ){
								if( result[i].id == current[j].id  ){
									exist = true;
								}
							}		
							if( !exist ) {
								$('#reserved-materials').prepend("<tr id ='" + result[i].materialid + "' > <td class = 'materialid' > " + result[i].materialid + "  </td> <td class = 'idnumber' > " + result[i].idnumber + "  </td> <td>" + "<span class = 'name' > " + result[i].name + " </span>, <span class = 'year' > " + result[i].year + " </span>." + printEdition( result[i].edvol ) + "<span> <br /> ( " + result[i].type + " )</span> </td> <td> " + printDate( result[i].started, result[i].startdate ) + " </td> <td> " + result[i].queue + " </td> <td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button> </td></tr>");
								//$('#reserved-materials').dataTable().fnAddData( result[i] );
							}
							
							exist = false;
						}
					}					
				}

				function printEdition( data ){
					if( data != null ){
						if( data % 10 == 1 )
							return "<span> "+ data +"st Edition </span>."; 
						if( data % 10 == 2 )
							return "<span> "+ data +"nd Edition </span>."; 
						if( data % 10 == 3 )
							return "<span> "+ data +"rd Edition </span>."; 
						else 
							return "<span> "+ data +"th Edition </span>."; 
					}
				}

				function printDate( data, date ){
					if( data == 0 ){
						return "Not yet notified";
					} else {
						return date;
					}
				}

				function printButton( condition ){
					if( condition == 0 ){
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}' disabled>Claim</button> </td>";
					} else {
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}' disabled>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button> </td>";
					}

					
				}

				$("#searchReservedBooks").keyup(function(){
					var search = $("#searchReservedBooks").val();
				//alert(search);
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/search_reservations",
						dataType: "json",
						data: { search : search }, 

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
							if( result != "" ){
								$('#reserved-materials-body').html("");
								//alert(result.length);
								for( i = 0; i < result.length; i++ ){
									$('#reserved-materials-body').append("<tr id ='" + result[i].materialid + "' > <td class = 'materialid' > " + result[i].materialid + "  </td> <td class = 'idnumber' > " + result[i].idnumber + "  </td> <td>" + "<span class = 'name' > " + result[i].name + " </span>, <span class = 'year' > " + result[i].year + " </span>." + printEdition( result[i].edvol ) + "<span> <br /> ( " + result[i].type + " )</span> </td> <td> " + printDate( result[i].started, result[i].startdate ) + " </td> <td> " + result[i].queue + " </td> " + printButton( result[i].started ) + "</tr>");
								}
								
							} else {
								$('#reserved-materials-body').html("<tbody> </tbody>");
								//alert("Failed to notify");
							}
						}
					});
				});

				function searchReservedMaterial( search ){
					
				}

				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});
				
				$(".sendClaim").click( function(){
					var thisButton = $(this);
					var parent = $(this).parent();
					var idnumber = $.trim(parent.siblings('.idnumber').text());
					var materialid = $.trim(parent.siblings('.materialid').text());
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/claim_reservation",
						data: { materialid : materialid, idnumber : idnumber }, 

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
								thisButton.attr('disabled', 'disabled');
								// remove row
								//alert("Student has been notified");
							} else {
								//alert("Failed to notify");
							}
						}
					});
				});
				
				$(".sendNotif").click( function(){
					var thisButton = $(this);
					var parent = $(this).parent();
					var idnumber = $.trim(parent.siblings('.idnumber').text());
					var materialid = $.trim(parent.siblings('.materialid').text());

					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/notification",
						data: { materialid : materialid, idnumber : idnumber }, 

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

								// alert here if success
								thisButton.attr('disabled', true);
								thisButton.next().removeAttr('disabled');

								alert("Success!")
							} else {
								//alert("Fail!");
							}
						}
					});
				});

				$("#button").click(function(){
					$.ajax({

						url: "<?php echo base_url();?>update/reservation_queue",
						dataType: "json",

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							//$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
							//	$('#error_message').html(textStatus);
						},

						success: function( result ){
							alert(result.length);
							alert(rowCount);
							alert( currentData[0].id );
							updateContents( currentData, result );
							currentData = result;
							console.log( currentData );
							//$('#reserved-materials').dataTable( { currentData });
						}

					});
				});
			});
		</script>
	</body>
</html>