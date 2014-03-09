<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

	<script>
		function returnBook( thisDiv ){
					bootbox.dialog({
						message: "Confirm return of borrowed material.",
						title: "Confirmation",
						buttons: {
							yes: {
								label: "Yes, continue",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									var fine = $.trim(parent.siblings('.fine').text());
									var materialid = $.trim(parent.siblings('.materialid').text());
									var isbn = $.trim(parent.siblings('.isbn').text());
									var idnumber = $.trim(parent.siblings('.idnumber').text());
							
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/material_returned",
										data: { isbn : isbn, materialid : materialid, fine : fine }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){

											if( result != "1" ){
												
												//thisButton.attr('disabled', 'disabled');
												// remove row
												//alert("Student has been notified");
												//document.getElementById("success_notify").style.display='none';

												$("#success_return").show();
												$("#success_return").html("Successfully returned!");
												$("#success_return").fadeIn('slow');
												$("#"+materialid+"-"+idnumber).html("");
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#success_return').fadeOut('slow') }, 5000);	
											} else {
												//alert("Failed to notify");
											}
										}
									});
								}
							},
							no: {
								label: "No",
								className: "btn-default"
							}
						}
					});
				}
	</script>
		
	<body>
		 <?php include 'includes/header.php'; ?>
        <div class="mainBody">
            <?php include 'includes/sidebar.php'; ?>

			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
						<h2> Borrowed View </h2>
						<h5> <i> You are currently viewing the borrowed material that can be provided with a library material copy. </i> </h5>
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
							<li class="active"> Borrowed </li>
						</ol>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 ">
								<div class="alert-container" style = 'height: 40px; padding-top: 10px; margin-bottom:10px;'>
									<div style="display:none; height: 20px; text-align: center;" id = "success_return">  </div>
								</div>
							</div>
						</div>
						<br />
						<form method="post" role="form" align="center">
							 <div class="row">
								<div class="col-md-6 col-md-offset-3 ">
									<div class="input-group">
                            			<input type="text" name="search" class="form-control"/>
                            			<span class="input-group-btn"> 
	                           				<input class = "btn btn-default" type="submit" value="Search" name="search_borrowed_books"/> 
	                           			</span>
									</div><!-- /input-group -->  
								</div><!-- /.col-lg-6 -->
							</div><!-- /.row -->
                        </form>
                        <br />
						<?php
						  if($this->input->post('returnButton') != ''){
							echo "wew";
						  }
						  	echo"<table border = '1' id='myTable' class='table table-hover'>
								<thead>
									<tr>
										<th width='10%'><center>ISBN/ISSN</center></th>
										<th width='11%'><center>ID Material</center></th>
										<th width='5%'><center>Type</center></th>
										<th width='42%'><center>Library Information</center></th>
										<th width='8%'><center>Borrower</center></th>
										<th width='8%'><center>Start Date</center></th>
										<th width='8%'><center>Due Date</center></th>
										<th width='5%'><center>Status</center></th>
										<th width='5%'><center>Action</center></th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>";
							echo "<tbody>";
                         	if($flag->num_rows ==0){		
                                    echo "<td colspan = '9' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No search results found.</center></td>";
                                    
                         	}else{
								date_default_timezone_set('Asia/Manila');
							    // Then call the date functions
							    $date = strtotime(date('Y-m-d'));
								//echo count($borrowed_books->result());
								//$i=0;
								foreach($borrowed_books->result() as $row){	
									$date2 = strtotime($row->expectedreturn);
									$days = $date-$date2;
									$finalfine = floor($days/(60*60*24))*$fine;
									echo "<tbody>";
									echo "<tr id = '{$row->materialid}-{$row->idnumber}'>";
									echo "<td class = 'isbn' ><center><span class='table-text'>{$row->isbn}</span></center> </td>";
									echo "<td class = 'materialid' ><center><span class='table-text'>{$row->materialid} </span></center></td>";
									
										if($row->type== 'Book')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Book'><span class='glyphicon glyphicon-book'></span></a>";
										else if($row->type == 'CD')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='CD'><span class='glyphicon glyphicon-headphones'></span></a>";
										else if($row->type == 'SP')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='SP'><span class='glyphicon glyphicon-file'></span></a>";
										else if($row->type == 'References')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='References'><span class='glyphicon glyphicon-paperclip'></span></a>";
										else if($row->type== 'Journals')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Journal'><span class='glyphicon glyphicon-pencil'></span></a>";
										else if($row->type== 'Magazines')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Magazine'><span class='glyphicon glyphicon-picture'></span></a>";
										else if($row->type == 'Thesis')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesi'><span class='glyphicon glyphicon-bookmark'></span></a>";
									
									echo "<td align='center'>". $type . "</span></td>";
									echo "<td>	<b><span class='title'>" . $row->name. ".</span></b><br />";
									echo "<span class='table-text'>".$row->authorname."</span>";
									echo "<td class='idnumber'><span class='table-text'>". $row->idnumber. "</span></td>";
									echo "<td><span class='table-text'>". $row->start . "</span></td>";
									echo "<td><span class='table-text'>". $row->expectedreturn. "</span></td>";
									if($finalfine > 0){
										echo "<td align='center'><span class='table-text'>". "Overdue" . "</span></td>";
									}
									else{
										echo "<td></td>";
									}
									echo "<td><button onclick = 'returnBook($(this))' class='returnButton btn btn-primary' name='return'><span class='glyphicon glyphicon-remove'></span></button>";
									echo "</td></tr>";
								}//for	
							}
							echo "</tbody>";
							echo "</table>";
						?>
						<?php include 'includes/pager.php'; ?>
						</div>
					</div>
				</div>
				<div id = "error"> </div>
			</div>
			
		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<?php include 'includes/pagination.php'; ?>	

		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>
		
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
	<script>
	$('#borrowed-nav').addClass('active');
		//For back to top javascript//
			$("#logout").click(function(){
				window.location.href = "<?php echo site_url('admin/logout'); ?>";
				
				});
					$("a.tooltipLink").tooltip();
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
	                });
	                //end code of back to top
			
		function submitForm(){
			$("#return").submit();
		}
			
		</script>

	</body>
</html>