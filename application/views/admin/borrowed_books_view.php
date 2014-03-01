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
	<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/date_picker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet" /> <!--for chart -->

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
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="30px"></a>
                </div>
				<!--<div class="alert alert-success" id="returned">
					<a href="#" class="close" data-dismiss="alert" id="boton_cerrar">&times;</a> 
					<strong>Successfully returned material!</strong>     
				</div>-->
                <form class="navbar-form navbar-right" role="form">
                    <!-- Split button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default" data-toggle="dropdown">
					<span class="glyphicon glyphicon-cog"></span>
				  </button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
                  </ul>
                </div>
                </form>

            </div>
        </div>
		<div class="mainBody">
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav" >
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" class="active">
						<a href="<?php echo base_url();?>admin/borrowed_books"><span class="glyphicon glyphicon-export"></span> &nbsp;Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search"><span class="glyphicon glyphicon-search"></span> &nbsp;View All Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add A New Material&nbsp;&nbsp;&nbsp;</a>
					</li>
					<li id = "overview-nav">
						<a href="<?php echo base_url();?>admin/home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Overview</a>
					</li>	
				</ul>
			</div>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br /><br />
						<form method="post"  style="width: 800px ; margin-left: auto; margin-right: auto;" role="form" align="center">
                                        <input type="text" name="search"  size="80"/>
                                        <input class = "btn btn-primary" type="submit" value="Search" name="search_borrowed_books"/> 
                                  
                        </form>
                         <br/>

						<table class="tablesorter" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							
						<?php
						  if($this->input->post('returnButton') != ''){
							echo "wew";
						  }
                         	if($flag->num_rows ==0){
                         		 echo "<center>No search results found. </center>";
                         	}

								echo"<table border = '1' id='myTable' class='tablesorter'>
								<thead>
									<tr>
										<th title='ISBN' width='10%'><center>ISBN</center></th>
										<th title='Library Material ID' width='10%'><center>Library Material ID</center></th>
										<th title='Type' width='5%'><center>Type</center></th>
										<th title='Library Information' width='41%'><center>Library Information</center></th>
										<th title='Borrower' width='8%'><center>Borrower</center></th>
										<th title='Start date' width='8%'><center>Start Date</center></th>
										<th title='Due Date' width='8%'><center>Due Date</center></th>
										<th title='Fine' width='5%'><center>Fine</center></th>
										<th title='Action' width='5%'><center>Action</center></th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>";
					

								date_default_timezone_set('Asia/Manila');
							    // Then call the date functions
							    $date = strtotime(date('Y-m-d'));

								foreach($borrowed_books->result() as $row){							
									echo "<tr>";
									echo "<td class='isbn' align='center'><span class='table-text'>". $row->isbn ."</span></td>";
									echo "<td class='materialid' align='center'><span class='table-text'>". $row->materialid . "</span></td>";
									
										if($row->type == 'Book')
											$type = "<span class='glyphicon glyphicon-book'></span>";
										else if($row->type == 'CD')
											$type = "<span class='glyphicon glyphicon-headphones'></span>";
										else if($row->type == 'SP')
											$type = "<span class='glyphicon glyphicon-file'></span>";
										else if($row->type == 'Reference')
											$type = "<span class='glyphicon glyphicon-paperclip'></span>";
										else if($row->type == 'Journals')
											$type = "<span class='glyphicon glyphicon-pencil'></span>";
										else if($row->type == 'Magazines')
											$type = "<span class='glyphicon glyphicon-picture'></span>";
										else if($row->type == 'Thesis')
											$type = "<span class='glyphicon glyphicon-bookmark'></span>";
									
									echo "<td align='center'>". $type . "</span></td>";
									echo "<td>	<b><span class='title'>" . $row->name. ".</span></b><br />";
									echo "<td class='idnumber'><span class='table-text'>". $row->idnumber. "</span></td>";
									echo "<td><span class='table-text'>". $row->start . "</span></td>";
									echo "<td><span class='table-text'>". $row->expectedreturn. "</span></td>";
									$date2 = strtotime($row->expectedreturn);
									$days = $date-$date2;
									echo "<td><span class='table-text'>". floor($days/(60*60*24))*$fine . ".00" . "</span></td>";
									echo "<td><form method='post' id='return' action='material_returned'>
											<input type='hidden' value='".$row->materialid."' name='materialid'/>
											<input type='hidden' value='".$row->isbn."' name='isbn'/>
											<input type='hidden' value='".$row->idnumber."' name='idnumber'/>
											<input type='hidden' value='".floor($days/(60*60*24))*$fine."' name='fine'/>";
											
									echo "<button type='button' data-toggle='modal' data-target='#container1' class='sendNotif btn btn-primary'>Return</button>";
									echo "</td></tr>";
								}
								echo "</table>";
						?>
						</table>
					</div>
				</div>
				<div id = "error"> </div>
			</div>
	<div class="modal fade bs-example-modal-sm" id="container1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Return Material</h3>
                  </div>
                  <div id="details" class="modal-body">
				  <strong>Confirm return of library material?</strong>
                </div>
                 <div class="modal-footer">
					<button type="submit" class="btn"  name="returnButton"> Return </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
					 </form>
                 </div>
                 </div>
            </div>
    </div>
		
		<!-- FOOTER -->
		<footer> <a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
			<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
		</footer>
		
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();  ?>js/jquery.tablesorter.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>js/jquery.tablesorter.js" type="text/javascript"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>
		
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
		
		<script>
		
			 $("#logout").click(function(){
                window.location.href = "<?php echo site_url('admin/logout'); ?>";
            	});

			$(document).ready(function(){
				$("div#returned").hide();
			
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
					//back to top code
					 var offset = 220;
	                var duration = 500;
	                jQuery(window).scroll(function() {
	                    if (jQuery(this).scrollTop() > offset) {
	                        jQuery('.back-to-top').fadeIn(duration);
	                    } else {
	                        jQuery('.back-to-top').fadeOut(duration);
	                    }
	                });
	                
	                jQuery('.back-to-top').click(function(event) {
	                    event.preventDefault();
	                    jQuery('html, body').animate({scrollTop: 0}, duration);
	                    return false;
	                })
	                //end code of back to top

				});
			});
			
		function submitForm(){
			$("#return").submit();
		}
			
		</script>

	</body>
</html>