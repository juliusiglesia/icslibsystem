<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>
		
	<script>
		function deleteBook( thisDiv ){
			bootbox.dialog({
				message: "You are about to delete a library material from the database. Continue?",
				title: "Confirmation",
				buttons: {
					yes: {
						label: "Continue",
						className: "btn-primary",
						callback: function() {
							var thisButton = thisDiv;
							var parent = thisDiv.parent();
							var materialid = $.trim(parent.siblings('.materialid').text());
							$.ajax({
								type: "POST",
								url: "<?php echo site_url(); ?>/admin/delete_material",
								data: { materialid : materialid }, 

								beforeSend: function() {
									//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
									$("#error_message").html("loading...");
								},

								error: function(xhr, textStatus, errorThrown) {
										$('#error_message').html(textStatus);
								},

								success: function( result ){

									if ($.trim(result) == '1'){
										$("#fail_delete").hide();
										$("#success_delete").show();
										$("#success_delete").html("Library Material successfully deleted from the database.");
										$("#success_delete").fadeIn('slow');
										$("#"+materialid).html("");
										document.body.scrollTop = document.documentElement.scrollTop = 0;
										setTimeout(function() { $('#success_delete').fadeOut('slow') }, 5000);
									}
									else if ($.trim(result) == '0') {
										$("#success_delete").hide();
										$("#fail_delete").show();
										$("#fail_delete").html("The book is currently borrowed / reserved. Have it returned first / clear all reservations before deleting from the database.");
										$("#fail_delete").fadeIn('slow');
										document.body.scrollTop = document.documentElement.scrollTop = 0;
										setTimeout(function() { $('#fail_delete').fadeOut('slow') }, 5000);
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
            <!-- Nav tabs -->
            <?php include 'includes/sidebar.php'; ?> 

        <div class="leftMain">
	        <div id="main-page">
	            <div id = "main-content">
	            	<br />
						<h2> All Library Materials </h2>
						<h5> <i> You are viewing all library materials. </i> </h5>
						<ol class="breadcrumb">
							<li><a href="<?php echo site_url(); ?>/admin/home">Home</a></li>
							<li class="active"> View All Materials </li>
						</ol>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 ">
							<div class="alert-container" style = 'height: 40px; margin-bottom: 20px; text-align: center;'>
								<div style="display:none" id = "success_delete" class = "alert alert-success">  </div>
							</div>
						</div>
					</div>
	            	<br /><br />
	                <form method="post"  style="width: 800px ; margin-left: auto; margin-right: auto;" role="form">
	                    <label for="filter"><span class="label label-default">Filter by:</span></label>
	                    <select name="filter">
	                        <option value="none">Any Field</option>
	                        <option value="author">Author</option>
	                        <option value="course">Course</option>
	                        <option value="name">Title</option>
	                    </select>
						<input type="text" name="search"  size="80"/>
						<input class = "btn btn-primary" type="submit" value="Search" name="search_books"/> 
	                    <label for="type"<span class="label label-default">Type:</span></label>
	                    <select name="type">
	                        <option value="allTypes">All</option>
	                        <option value="Book">Book</option>
	                        <option value="SP">SP</option>
	                        <option value="Thesis">Thesis</option>
	                        <option value="References">References</option> 
	                        <option value="Cd">CD</option>
	                        <option value="Journals">Journals</option>
	                        <option value="Magazines">Magazines</option>
                  		</select>          
	                 	<label for="access"><span class="label label-default">Accessible by:</span></label>
	                    <select name="access">
                            <option value="allAccess">---</option>
                            <option value="1">Student</option>
                            <option value="2">Faculty</option>
                            <option value="3">Room Use</option>
                            <option value="4">Student/Faculty</option>
	                    </select>
					  	<span class="label label-default">Availability:</span>
							<input type="radio" name="avail" value="1" id="available"/>
							<label for="available">Available</label>
							<input type="radio" name="avail" value="0" id="notavail"/>
							<label for="notavail">Not Available</label>
                            <input type="radio" name="avail" value="allAvail" id="avail" checked="true"/>
                            <label for="allAvail">Both</label>
							<br/>
						  
                    </form>
                    <br />
                    <?php
                        echo "<table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
									<th style='width:11%;'><b><center>ISBN/ISSN</center></b></th>
                                    <th style='width:10%;'><center>ID Material</center></th>
                                    <th style='width:7%;'><b><center>Type</center></b></th>
                                    <th style='width:49%;'><center>Library Information</center></th>
                                    <th style='width:8%;'><center>Req.</center></th>
                                    <th style='width:5%;'><center>Available Copies</center></th>
                                    <th style='width:10%;'><b><center>Action</center></b></th>
                                </tr>
                            </thead>";
                                if(count($flag)==0){
                                	echo "<tbody>";
                                    echo "<td colspan = '7' class = 'nolibmat' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No library material available.</center></td>";
                                    echo "</tbody>";
                                }else{ 
                                    echo "<tbody>";	
                                    foreach ($sql2 as $q){
										$rowAuthor = $q->authorname;
										echo "<tr id = '{$q->materialid}'>";
												
											if($q->type == 'Book' || $q->type == 'References' || $q->type == 'Journals' || $q->type == 'Magazines'){											
												echo "<td><center><span class='table-text'>{$q->isbn}</span></center></td>";
											}else echo "<td><center>---------</center></td>";
												
											echo "<td class = 'materialid'><center><span class='table-text'>{$q->materialid} </span></center></td>";

											if($q->type== 'Book')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Book'><span class='glyphicon glyphicon-book'></span></a>";
											else if($q->type == 'CD')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='CD'><span class='glyphicon glyphicon-headphones'></span></a>";
											else if($q->type == 'SP')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='SP'><span class='glyphicon glyphicon-file'></span></a>";
											else if($q->type == 'References')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='References'><span class='glyphicon glyphicon-paperclip'></span></a>";
											else if($q->type== 'Journals')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Journals'><span class='glyphicon glyphicon-pencil'></span></a>";
											else if($q->type== 'Magazines')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Magazines'><span class='glyphicon glyphicon-picture'></span></a>";
											else if($q->type == 'Thesis')
												$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesis'><span class='glyphicon glyphicon-bookmark'></span></a>";	
											
											echo "<td><center>" . $type . "</center></td>";
											echo "<td><span class='title'><b>" . $q->name. ".</b></span><br /><span class='author'>".$rowAuthor."<span class ='author' >". $q->year ."</span>" . ".";
									
											if( $q->edvol != NULL ){
												if( $q->edvol % 10 == 1 )
													echo "<span class ='author'>". $q->edvol ."st Edition.</span>"; 
												else if( $q->edvol % 10 == 2 )
													echo "<span class ='author'> ". $q->edvol ."nd Edition.</span>"; 
												else if( $q->edvol % 10 == 3 )
													echo "<span class ='author'>". $q->edvol ."rd Edition.</span>"; 
												else {
													if ( $q->edvol > 1)
														echo "<span class ='author'>". $q->edvol ."th Edition.</span>";
												}	
											}
											
											echo "</td>";

												if($q->requirement==0){
													$req = "none";
												}else if($q->requirement==1){
													$req = "COI";
												}else if($q->requirement==2){
													$req = "COO";
												}
												echo "<td><center>" . $req . "</center></td>";
												$availcopy = $q->quantity - $q->borrowedcopy;
												echo "<td><center>" . $availcopy ."/" .$q->quantity. "</center></td>";
												echo "<td align='center'>";
												echo "<form method='post' name='update' action='update_material'>";
												echo "<input type='hidden' name='materialid' value='" . $q->materialid . "'/>";
												echo "<button type='submit' class='updateButton btn btn-default' name='update'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Edit'><span class='glyphicon glyphicon-edit'></span></a></button></form>";
												echo "<button onclick = 'deleteBook($(this))' class='deleteButton btn btn-danger' name='return'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Delete'><span class='glyphicon glyphicon-remove'></span></a></button>";
												echo "</td></tr>";
											}
                                       	echo "</tbody>";
                                    }
                                echo "</table>";   
                         ?>
						<?php include 'includes/pager.php'; ?>
                    </div><!-- main content -->
                </div><!-- main page -->
        </div><!-- left -->

         <!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<?php include 'includes/pagination.php'; ?>	
	<script>
		//document.getElementById("success_update").style.display='none';
		//document.getElementById("success_added").style.display='none';
	
	$('#view-nav').addClass('active');
	$(document).ready(function(){
				//for tooltip
				$("a.tooltipLink").tooltip();
	});
    </script>
</body></html>
