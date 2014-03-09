<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>		
	<body>
		<?php include 'includes/header.php'; ?>
		<div class="mainBody">
			<script>
				function claim( thisDiv ){
					var thisButton = thisDiv;
					var parent = thisDiv.parent();
					var idnumber = parent.siblings('.idnumber').text().trim();
					var materialid = parent.siblings('.materialid').text().trim();
					var isbn = parent.siblings('.isbn').text().trim();
					if( isbn == "---" ) isbn = "+" + materialid;
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/check_reservation",
						data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							alert(result);
							if( parseInt(result.trim()) < 3 ){
								claimBootbox(thisDiv);
							} else {
								alert( "The borrower has three materials borrowed. This page will be refreshed." );
								$("#searchReservedBooks").val("");
								$("#searchReservedButton").click();
							}
						}
					});
				}
				
				function notify( thisDiv ){
					var thisButton = thisDiv;
					var parent = thisDiv.parent();
					var idnumber = parent.siblings('.idnumber').text().trim();
					var materialid = parent.siblings('.materialid').text().trim();
					var isbn = parent.siblings('.isbn').text().trim();
					if( isbn == "---" ) isbn = "+" + materialid;
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/check_reservation",
						dataType : 'html',
						data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							alert(result);
							if( parseInt(result.trim()) < 3 ){
								notifyBootbox( thisDiv );
							} else {
								alert( "The borrower has three materials borrowed. This page will be refreshed." );
								$("#searchReservedBooks").val("");
								$("#searchReservedButton").click();
							}
						}
					});

					
					
				}

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
									if( isbn == "---" ) isbn = "+" + materialid;
									
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/claim_reservation",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											// show that notification is successful
											//$('#error').html(result);
											if( result != "1" ){
												thisButton.attr('disabled', 'disabled');
												// remove row
												
												$('#alert').addClass("alert alert-success");
												$("#alert").html("Successfully claimed!");
												$("#alert").fadeIn('slow');
												$("#"+materialid+"-"+idnumber).remove();
												$('table').tablesorter();
												$('table').trigger('update');
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
											} else {
												//alert("Failed to notify");
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
									
									if( isbn == "---" ) isbn = "+" + materialid;

									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/notification",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											// show that notification is successful
											//$('#error').html(result);
											if( result != "1" ){

												// alert here if success
												thisButton.attr('disabled', true);
												thisButton.next().removeAttr('disabled');

												//alert("Success!")
												$('#alert').addClass("alert alert-success");
												$("#alert").html("The material can now be claimed!");
												$("#alert").fadeIn('slow');
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);

											} else {
												//alert("Fail!");
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
						<h5> <i> You are currently viewing the reservations that can be provided with a library material copy. </i> </h5>
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
							<li class="active"> Reservations </li>
						</ol>
						<?php if( count($reservations) != 0 ){ ?>
							<div class="row">
								<div class="col-md-6 col-md-offset-3 ">
									<div class="alert-container" style = 'height: 50px;'>
										<div style="height: 45px; text-align: center;" id = "alert"> </div>
									</div>
								</div>
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
											<th width="8%"><center>Start Date</center></th>
											<th width="5%"><center>Rank</center></th>
											<th width="12%"><center>Action</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$rank = 0;
											$i = 0;
										
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
														echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' ><span class='glyphicon glyphicon-bullhorn'></button>";
														echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><span class='glyphicon glyphicon-download'></button>";
														echo "</td>";
													} else {
														echo "<td><span class='table-text'> ${row['startdate']}</span> </td>";
														echo "<td align='center'><span class='table-text'>${row['queue']}/${row['total']}</span> </td>";
														echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><span class='glyphicon glyphicon-bullhorn'></button> ";
														echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><span class='glyphicon glyphicon-download'></button>";
														echo "</td>";
													}	
												}
												?>
									</tbody>
								</table>
							</div>
							<?php include 'includes/pager.php'; ?>
						<?php 
	
							} else {
								echo "<tbody>";
                           		echo "<td colspan = '7' style='background-color:rgba(0,0,0,0.1); color: black;'><center><h3> No reservations to be accepted </h3></center></td>";
                            	echo "</tbody>";	
							}
						?>
						</div>
					</div>
				</div>	
			</div>
		
		

		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<?php include 'includes/pagination.php'; ?>	
		
		<script>
			$('#reserved-nav').addClass('active');
			
			$(document).ready(function(){		
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

				function printEdition( data ){
					if( data != null ){
						if( data % 10 == 1 )
							return "<span class = 'author'> "+ data +"st Edition.</span>"; 
						if( data % 10 == 2 )
							return "<span class = 'author'> "+ data +"nd Edition.</span>"; 
						if( data % 10 == 3 )
							return "<span class = 'author'> "+ data +"rd Edition.</span>"; 
						else 
							return "<span class = 'author'> "+ data +"th Edition.</span>"; 
					}
					else{
						return "";
					}
				}

				function printISBN( data, type ){
					if(type == 'Book' || type == 'References' || type == 'Magazines' || type == 'Journals'){											
						return data;
					}
					else return "---";
				}

				function printDate( data, date ){
					if( data == 0 ){
						return "<td><center><span class='table-text'>Not yet notified </span></center></td>";
					} else {
						return "<td><center><span class='table-text'>" + date + "</span></center></td>";
					}
				}
				
				function printButton( condition ){
					if( condition == 0 ){
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify'><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><span class='glyphicon glyphicon-download'></button></td>";
					} else {
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><span class='glyphicon glyphicon-download'></button></td>";
					}					
				}
				
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

				$("#searchReservedBooks").keypress(function(event){
					if(event.keyCode == 13){
						event.preventDefault();
						$("#searchReservedButton").click();
					}
				});
		
				$("#searchReservedButton").click(function(){

					var search = $("#searchReservedBooks").val();	
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/search_reservations",
						dataType: "json",
						data: { search : search }, 

						beforeSend: function() {
							$('tbody').fadeOut();		
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							if( result != "" ){
								$('tbody').html("");
								$('tbody').fadeIn();
								//alert(result.length);
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
							} else {
								$('tbody').html("");
								$('tbody').fadeIn('slow');

								$('tbody').html("<td colspan = '8'><span style = 'center' > No results found </span> </td>");
								$("table").tablesorter();
							}

							$('table').trigger('update');				
						}
					});
				});
			});
		</script>
	</body>
</html>