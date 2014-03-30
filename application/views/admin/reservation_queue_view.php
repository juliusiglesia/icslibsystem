<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>		
	<body>
		<?php include 'includes/header.php'; ?>
		<div class="mainBody">
			<script>
			
				//Call for the bootbox model when button claim clicked
				function claim( thisDiv ){
					claimBootbox(thisDiv);		
				}
				//Call for the bootbox model when button notify clicked
				function notify( thisDiv ){
					notifyBootbox( thisDiv );
				}
				
				/*This function passes the input from the form into the controller
				*The input that was passed from the controller will be used by the function claim_reservation
				*If success: remove the row that includes the button that was clicked. Else: alert error_message
				* @param thisDiv - the div under consideration
				*/
				function claimBootbox( thisDiv ){
					bootbox.dialog({
						message: "Are you sure that this material will now be claimed?",
						title: "Claim of material confirmation",
						onEscape: function() {},
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									var idnumber = parent.siblings('.idnumber').text().trim();
									var materialid = parent.siblings('.materialid').text().trim();
									var isbn = parent.siblings('.isbn').text().trim();
									var title = parent.siblings().find('.title').text().trim();

									if( isbn == "---" ) isbn = "+" + materialid;
									
									$.ajax({
										type: "POST",
										url: "<?php echo site_url()?>/admin/claim_reservation",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											$("#alert").removeClass("alert alert-success");
											$("#alert").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
										},

										error: function(xhr, textStatus, errorThrown) {
											$("#alert").addClass("alert alert-success");
											$("#alert").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
											$("#alert").fadeIn('slow');
										},

										success: function( result ){
											if( result != "1" ){
												$("#alert").fadeOut('slow', function( ){
													thisButton.attr('disabled', 'disabled');
													
													$('#alert').addClass("alert alert-success");
													$("#alert").html( "<strong>" + title + "</strong> was claimed by <strong>" + idnumber + "</strong>" );
													$("#alert").fadeIn('slow');
													
													$("#"+materialid+"-"+idnumber).remove();
													$('table').tablesorter();
													$('table').trigger('update');
													
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
												});
											} else {
												$("#alert").fadeOut('slow', function( ){
													$('#alert').addClass("alert alert-success");
													$("#alert").html( "<strong> Error while claiming the material. </strong>" );
													$("#alert").fadeIn('slow');
													
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
												});
											}
										}
									});
								}
							},
							no: {
								label: "No.",
								className: "btn-default"
							}
						}
					});
				}
				/*This function passes the input from the form into the controller.
				*The input that was passed from the controller will be used by the function notification
				*If success: print the current date on Start Date column. Else: print error_message
				* @param thisDiv - the div under consideration
				*/
				function notifyBootbox( thisDiv ){
					bootbox.dialog({
						message: "Are you sure that this material will now be claimed?",
						title: "Claim of material confirmation",
						onEscape: function() {},
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									
									var idnumber = parent.siblings('.idnumber').text().trim();
									var materialid = parent.siblings('.materialid').text().trim();
									var isbn = parent.siblings('.isbn').text().trim();
									var title = parent.siblings().find('.title').text().trim();
									
									if( isbn == "---" ) isbn = "+" + materialid;

									$.ajax({
										type: "POST",
										url: "<?php echo site_url()?>/admin/notification",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											$("#alert").removeClass("alert alert-success");
											$("#alert").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
										},

										error: function(xhr, textStatus, errorThrown) {
											$("#alert").addClass("alert alert-success");
											$("#alert").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
											$("#alert").fadeIn('slow');
										},

										success: function( result ){
											// show that notification is successful
											//$('#error').html(result);
											if( result != "1" ){
												$("#alert").fadeOut('slow', function( ){
													thisButton.attr('disabled', true);
													thisButton.next().removeAttr('disabled');

													$('#alert').addClass("alert alert-success");
													$("#alert").html( "<strong>" + title + "</strong> can now be claimed by <strong>" + idnumber + "</strong>" );
													$("#alert").fadeIn('slow');
													
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													setTimeout(function() { $('#alert').fadeOut('slow') }, 10000);
												});
											} else {
												$("#alert").fadeOut('slow', function( ){
													$('#alert').addClass("alert alert-success");
													$("#alert").html( "<strong> Error while notifying the borrower. </strong>" );
													$("#alert").fadeIn('slow');
													
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
												});
											}
										}
									});
								}
							},
							no: {
								label: "No.",
								className: "btn-default"
							}
						}
					});

				}

			</script>
			
			<?php include 'includes/sidebar.php'; ?>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
						<h2> Reservations View </h2>
						<h5> <i> These reservations are currently ranked no. 1 - n available copies of the material. Reservations with no available copies will not be displayed.</i> </h5>
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url()?>/admin/home">Home</a></li>
							<li class="active"> Reservations </li>
						</ol>						
						<div class="col-md-6 col-md-offset-3 " style = 'height: 50px; margin-bottom : 40px;'>
							<div style="text-align: center;" id = "alert"> </div>
						</div>
						<br />
						
						<div class="row">
							<div class="col-md-6 col-md-offset-3 ">
								<div class="input-group">
									<input type="text" id = "searchReservedBooks" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-default" id = "searchReservedButton" type="button"> Search</button>
									</span>
								</div><!-- /input-group -->
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
						<br />
						
						<div class = 'table-responsive '>
							<table class='table table-hover table-bordered'>
								<thead>
									<tr>
										<th width="5%"><center>ISBN/ISSN</center></th>
										<th width="11%"><center>ID Material</center></th>
										<td width="5%"><br /><center><b>Type</b></center></td>
										<th width="44%"><center>Library Information</center></th>
										<th width="5%"><center>Borrower</center></th>
										<th width="8%"><center>Claim Date</center></th>
										<th width="5%"><center>Rank</center></th>
										<td width="12%"><center>Action</center></td>
									</tr>
								</thead>
								<tbody>
									<?php
										
										$rank = 0;
										$i = 0;
										
										if(count($reservations) == 0) echo "<h5 style = 'text-align: center' > <br /> <b>No reservations to be accepted </b> </h5> <br />";
										
										foreach($reservations as $row){
											echo "<tr id = '${row['materialid']}-${row['idnumber']}'>";
											if($row['type'] == 'Book' || $row['type'] == 'References' || $row['type'] == 'Magazines' || $row['type'] == 'Journals'){											
												echo "<td class = 'isbn'><span class='table-text'><center>" . $row['isbn'] ."</center></span></td>";
											}
											else echo "<td class = 'isbn' align='center'>---</td>";
											echo "<td class = 'materialid' ><center><span class='table-text'>${row['materialid']} </span></center></td>";
											
											if($row['type']== 'Book')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Book'><span class='glyphicon glyphicon-book'></span></a>";
											else if($row['type'] == 'CD')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='CD'><span class='glyphicon glyphicon-headphones'></span></a>";
											else if($row['type'] == 'SP')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='SP'><span class='glyphicon glyphicon-file'></span></a>";
											else if($row['type'] == 'References')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='References'><span class='glyphicon glyphicon-paperclip'></span></a>";
											else if($row['type']== 'Journals')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Journals'><span class='glyphicon glyphicon-pencil'></span></a>";
											else if($row['type']== 'Magazines')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Magazines'><span class='glyphicon glyphicon-picture'></span></a>";
											else if($row['type'] == 'Thesis')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesis'><span class='glyphicon glyphicon-bookmark'></span></a>";	
												
											echo "<td class = 'type' align='center'>". $type ."</td>";
											echo "<td>";
											echo "<b><span class ='title'>${row['name']}.</b></span><br />";									
											
											foreach ($row['author'] as $name) {
												$name = (array)$name;
												echo "<span class ='author'> ${name['lname']}, ${name['fname']} ${name['mname']}.</span>";
											}

											echo "<span class ='author' > ${row['year']}</span>" . ".";
											if( $row['edvol'] != NULL ){
												if( $row['edvol'] % 10 == 1 )
													echo "<span class ='author'> ${row['edvol']}st Edition </span>" . "."; 
												if( $row['edvol'] % 10 == 2 )
													echo "<span class ='author'> ${row['edvol']}nd Edition </span>" . "."; 
												if( $row['edvol'] % 10 == 3 )
													echo "<span class ='author'> ${row['edvol']}rd Edition </span>" . "."; 
												else 
													echo "<span class ='author'> ${row['edvol']}th Edition </span>" . ".";
											}
											echo "</td>";
											echo "<td class = 'idnumber' ><center><span class='table-text'>${row['idnumber']}</span></center> </td>";
											
											if( $row['started'] == 0 ){
												echo "<td align='center'><span class='table-text'>Not yet notifed</span></td>";
												echo "<td align='center'><span class='table-text'> ${row['queue']}/${row['total']}</span> </td>";
												echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' ><a data-toggle='tooltip' class='tooltipLink' data-original-title='Notify user'><span class='glyphicon glyphicon-bullhorn'></span></a></button>";
												echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><a data-toggle='tooltip' class='tooltipLink' data-original-title='Claim'><span class='glyphicon glyphicon-download'></span></a></button>";
												echo "</td>";
											} else {
												echo "<td><span class='table-text'> ${row['startdate']}</span> </td>";
												echo "<td align='center'><span class='table-text'>${row['queue']}/${row['total']}</span> </td>";
												echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><a data-toggle='tooltip' class='tooltipLink' data-original-title='Notify user'><span class='glyphicon glyphicon-bullhorn'></span></a></button> ";
												echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Claim'><span class='glyphicon glyphicon-download'></span></a></button>";
												echo "</td>";
											}

											echo "</tr>";	
										}

										?>
								</tbody>		
							</table>
						</div>
						<?php include 'includes/pager.php'; ?>
						</div>
					</div>
				</div>	
			</div>
		
		

		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<?php include 'includes/pagination.php'; ?>	
		
		<script>
			
			$(document).ready(function( ){
				//for tooltip
				$("a.tooltipLink").tooltip();

				//Format the name into this form ( Surname, Firstname M.I.)
				$('#reserved-nav').addClass('active');
			
				function printAuthor( data ){
					var ret = "";
					if( data != null){
						for( var i = 0; i < data.length; i++ ){
							ret += "<span class ='author'>" + data[i].lname +  ", ";
							ret += data[i].fname + " ";
							ret += data[i].mname +  ".</span>";
						}
					}
					return ret;
				}
				
				//If edition = 1 , print 1st Edition; if edition = 2, print 2nd Edition; if edition = 3, print 3rd Edition; if edition > 3 , print (num)th Edition
				function printEdition( data ){
					if( data != null ){
						if( data % 10 == 1 )
							return "<span class = 'edition'> "+ data +"st Edition.</span>"; 
						if( data % 10 == 2 )
							return "<span class = 'edition'> "+ data +"nd Edition.</span>"; 
						if( data % 10 == 3 )
							return "<span class = 'edition'> "+ data +"rd Edition.</span>"; 
						else 
							return "<span class = 'edition'> "+ data +"th Edition.</span>"; 
					}
					else{
						return "";
					}
				}
				
				//Print ISBN except for SP, Thesis and CD's
				function printISBN( data, type ){
					if(type == 'Book' || type == 'References' || type == 'Magazines' || type == 'Journals'){											
						return data;
					}
					else return "---";
				}
				
				//Print date (current date) if the button notify was clicked
				function printDate( data, date ){
					if( data == 0 ){
						return "<td><center><span class='table-text'>Not yet notified </span></center></td>";
					} else {
						return "<td><center><span class='table-text'>" + date + "</span></center></td>";
					}
				}
				
				//if start = 1 disable notify button, enable claim button otherwise enable notify button and disable claim button
				function printButton( condition ){
					if( condition == 0 ){
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify'><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><span class='glyphicon glyphicon-download'></button></td>";
					} else {
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><span class='glyphicon glyphicon-download'></button></td>";
					}					
				}
				
				//Print icon depending on type
				function printType( type ){
					if( type == 'Book')
						type = "<center><span class='glyphicon glyphicon-book'></span></center>";
					else if( type == 'CD')
						type = "<center><span class='glyphicon glyphicon-headphones'></span></center>";
 					else if( type == 'SP')
						type = "<center><span class='glyphicon glyphicon-file'></span></center>";
					else if( type == 'References')
						type = "<center><span class='glyphicon glyphicon-paperclip'></span></center>";
					else if( type == 'Journals')
						type = "<center><span class='glyphicon glyphicon-pencil'></span></center>";
					else if( type == 'Magazines')
						type = "<center><span class='glyphicon glyphicon-picture'></span></center>";
					else if( type == 'Thesis')
						type = "<center><span class='glyphicon glyphicon-bookmark'></span></center>";
						
					return type;
				}
				
				//add key listener to enter key
				$("#searchReservedBooks").keypress(function(event){
					if(event.keyCode == 13){
						event.preventDefault();
						$("#searchReservedButton").click();
					}
				});
				
				/*This function passes the search input from the form into the controller.
				* The input that was passed from the controller will be used by the function search_reservation
				* If success: display the result. Else: display "No results found"
				* @param thisDiv - the div under consideration
				*/
				$("#searchReservedButton").click(function(){
					var search = $("#searchReservedBooks").val();

					$.ajax({
						type: "POST",
						url: "<?php echo site_url('admin/search_reservations')?>",
						dataType: "json",
						data: { search : search }, 

						beforeSend: function() {
							$("#alert").show();
							$("#alert").removeClass("alert alert-success");
							$("#alert").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
						},

						error: function(xhr, textStatus, errorThrown) {
							$("#alert").addClass("alert alert-success");
							$("#alert").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
							$("#alert").fadeIn('slow');
						},

						success: function( result ){
							$("#alert").fadeOut('slow', function(){
								$("#alert").hide();	
							});
							
							if( result != "" ){
								$('tbody').html("");
								$('tbody').fadeIn('slow', function(){
									for( i = 0; i < result.length; i++ ){
										var content = "";
										content = content + "<tr id ='"+ result[i].materialid + "-" + result[i].idnumber +"' > ";
										content = content + "<td class = 'isbn' ><span class='table-text'> " + printISBN( result[i].isbn, result[i].type ) + "  </span></center></td>";
										content = content + "<td class = 'materialid' ><center><span class='table-text'> " + result[i].materialid + " </span></center></td>"; 
										content = content + "<td class = 'type' > " + printType(result[i].type) + " </td>";
										content = content + "<td><span class = 'title' > <strong> " + result[i].name + ".</strong> </span><br />" + printAuthor(result[i].author) + "<span class = 'author' > " + result[i].year + ".</span>" + printEdition( result[i].edvol ) + " </td>";
										content = content + "<td class = 'idnumber' ><center><span class='table-text'> " + result[i].idnumber + " </span></center></td>";
										content = content + printDate( result[i].started, result[i].claimdate );
										content = content + "<td align='center'><span class='table-text'>" + result[i].queue + "/" + result[i].total + "</span></td>";
										content = content + printButton( result[i].started ) + "</tr>";

										$('tbody').append( content );
										
									}
									$('table').trigger('update');									
								});
								
							} else {
								$('tbody').html("");
								$('tbody').fadeIn('slow');

								$('tbody').html("<td colspan = '8'><center> <br /> <b>No results found</b> </center> <br /></td>");
								$('table').tablesorter();
							}

							$('table').trigger('update');				
						}
					});
				});
			});
		</script>
	</body>
</html>
