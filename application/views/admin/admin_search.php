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
								url: "<?php echo base_url();?>admin/delete_material",
								data: { materialid : materialid }, 

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
										//alert("SUCCESS!!!");
										//document.getElementById("success_notify").style.display='none';

										$("#success_delete").show();
										$("#success_delete").html("Library Material successfully deleted from the database.");
										$("#success_delete").fadeIn('slow');
										$("#"+materialid).html("");
										document.body.scrollTop = document.documentElement.scrollTop = 0;
										setTimeout(function() { $('#success_delete').fadeOut('slow') }, 5000);	
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
		function showMaterial( thisDiv ){
			bootbox.dialog({
				message: showMessage,
				title: "<h3>Successfully Added!</h3>",
				buttons: {
					no: {
						label: "Okay",
						className: "btn-primary"
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
							<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
							<li class="active"> View All Materials </li>
						</ol>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 ">
							<div class="alert-container" style = 'height: 40px; margin-bottom: 20px; text-align: center;'>
								<div style="display:none" id = "success_delete" class = "alert alert-success">  </div>
							</div>
						</div>
					</div>
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
	                        <option value="book">Book</option>
	                        <option value="sp">SP</option>
	                        <option value="thesis">Thesis</option>
	                        <option value="references">References</option> 
	                        <option value="cd">CD</option>
	                        <option value="journals">Journals</option>
	                        <option value="magazines">Magazines</option>
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
                    <br /><br />
					<?php

						if($this->input->post('insert') != ''){
						    $numberOfAuthors = $this->input->post('numberOfAuthors');
						    $materialid = $this->input->post('materialid');
						    $course = $this->input->post('course');
						    $type = $this->input->post('type');
						    $isbn = $this->input->post('isbn');
						    $name = $this->input->post('name');
						    $year = $this->input->post('year');
						    $edvol = $this->input->post('edvol');
						    $access = $this->input->post('access');
						    $available = $this->input->post('available');
						    $requirement = $this->input->post('requirement');
							
							$fname1 = $this->input->post('fname1');
							$mname1 = $this->input->post('mname1');
							$lname1 = $this->input->post('lname1');
							
							$query = $this->db->query("SElECT * FROM librarymaterial WHERE materialid LIKE '${materialid}'");
							$query2 = $this->db->query("SElECT * FROM librarymaterial WHERE isbn LIKE '${isbn}'");
							
						    if( $query->num_rows() > 0 ) {
								$data_authors = array();
								$data_authors[1] = $this->input->post('fname1');
								$data_authors[2] = $this->input->post('mname1');
								$data_authors[3] = $this->input->post('lname1');
							
								for($i=$numberOfAuthors; $i>1; $i--){
									$k = 'fname' . $i;
									$s = 'mname' . $i;
									$p = 'lname' . $i;
									$fname = $this->input->post($k);
									$mname = $this->input->post($s);
									$lname = $this->input->post($p);
									
									array_push($data_authors, $fname, $mname, $lname);
								}
											
									$data = array(
										'materialid' => $materialid,
										'type' => $type,
										'isbn' => $isbn,
										'course' => $course,
										'name' => $name,
										'year' => $year,
										'edvol' => $edvol,
										'access' => $access,
										'available' => $available,
										'requirement' => $requirement,
										'numberOfAuthors' => $numberOfAuthors,
										$data_authors,
									);
										
									$this->session->set_flashdata('feedback1', $data);
									redirect('admin/add_material', 'location');
							}
							else if( $query2->num_rows() > 0 ) {
								$data_authors = array();
								$data_authors[1] = $this->input->post('fname1');
								$data_authors[2] = $this->input->post('mname1');
								$data_authors[3] = $this->input->post('lname1');
								
								for($i=$numberOfAuthors; $i>1; $i--){
										$k = 'fname' . $i;
										$s = 'mname' . $i;
										$p = 'lname' . $i;
										$fname = $this->input->post($k);
										$mname = $this->input->post($s);
										$lname = $this->input->post($p);
									
									array_push($data_authors, $fname, $mname, $lname);
								}
							
								$data2 = array(
									'materialid' => $materialid,
									'type' => $type,
									'isbn' => $isbn,
									'course' => $course,
									'name' => $name,
									'year' => $year,
									'edvol' => $edvol,
									'access' => $access,
									'available' => $available,
									'requirement' => $requirement,
									'numberOfAuthors' => $numberOfAuthors,
									$data_authors,
								);
										
								$this->session->set_flashdata('feedback3', $data2);
								redirect('admin/add_material', 'location');
							}
                        }
                    ?>
                    <?php
                        echo "<table border = '1' id='myTable' class = 'table table-hover'>
                            <thead>
                                <tr>
									<th style='width:11%;'><b><center>ISBN/ISSN</center></b></th>
                                    <th style='width:10%;'><center>ID Material</center></th>
                                    <th style='width:7%;'><b><center>Type</center></b></th>
                                    <th style='width:45%;'><center>Library Information</center></th>
                                    <th style='width:8%;'><center>Req.</center></th>
                                    <th style='width:5%;'><center>Available Copies</center></th>
                                    <th style='width:14%;'><b><center>Action</center></b></th>
                                </tr>
                            </thead>";
                                if($flag->num_rows()==0){
                                	echo "<tbody>";
                                    echo "<td colspan = '7' class = 'nolibmat' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No library material available.</center></td>";
                                    echo "</tbody>";
                                }else{ 
                                    echo "<tbody>";	
                                    foreach ($sql2->result() as $q){
										$rowAuthor = $q->authorname;
										echo "<tr id = '{$q->materialid}'>";
												
											if($q->type == 'Book' || $q->type == 'References' || $q->type == 'Journals' || $q->type == 'Magazines'){											
												echo "<td><center><span class='table-text'>{$q->isbn}</span></center></td>";
											}else echo "<td><center>---</center></td>";
												
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
													if ( $q->edvol > 0)
														echo "<span class ='author'>". $q->edvol ."th Edition.</span>";
												}	
											}
											
											echo "</td>";

												if($q->requirement==0){
													$req = "none";
												}else if($q->requirement==1){
													$req = "COI";
												}
												echo "<td><center>" . $req . "</center></td>";
												$availcopy = $q->quantity - $q->borrowedcopy;
												echo "<td><center>" . $availcopy ."/" .$q->quantity. "</center></td>";
												echo "<td align='center'>";
												echo "<form method='post' name='update' action='update_material'>";
												echo "<input type='hidden' name='materialid' value='" . $q->materialid . "'/>";
												echo "<button type='submit' class='updateButton btn btn-default' name='update'></form><span class='glyphicon glyphicon-edit'></button><button onclick = 'deleteBook($(this))' class='deleteButton btn btn-danger' name='return'><span class='glyphicon glyphicon-remove'></button>";
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
		
		<script id="js">	
			var tryinsert = <?php echo "'" . $this->input->post('insert') . "'"; ?>;
			if(tryinsert != ''){
				var type = "<?php if(isset($type)) echo $type; else echo '';?>";
				if (type == 'Book') {

				};
				var materialid = "<?php if(isset($materialid)) echo $materialid; else echo ''; ?>"; 
				var isbn = "<?php if(isset($isbn)) echo $isbn; else echo '';?>";
				var course = "<?php if(isset($course)) echo $course; else echo '';?>";
				var name = "<?php if(isset($name)) echo $name; else echo '';?>";
				var authorname = "<?php if(isset($fname1)) echo $fname1 . ' ' . $mname1 . ' ' . $lname1; else echo '';?>";
				var edvol = "<?php if(isset($edvol)) echo $edvol; else echo '';?>";
				var year = "<?php if(isset($year)) echo $year; else echo '';?>";
				var access = "<?php if(isset($access)){ if($access == 1) echo 'Student'; else if($access == 2) echo 'Faculty'; else if($access == 3) echo 'Room Use'; else echo 'Student/Faculty'; } else echo '';?>";
				var available = "<?php if(isset($available)){ if($available == 1) echo 'Available'; else echo 'Not Available';} else echo '';?>";
				var requirement = "<?php if(isset($requirement)){ if($requirement == 0) echo 'None'; else echo 'COI';}else echo '';?>";  

				if(type == 'SP' || type == 'Thesis'){
					if (edvol == '') {
					var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>Type: </b>"+type+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}else{
					var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>Type: </b>"+type+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Edition: </b>"+edvol+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}
				}else if(type == 'CD'){
					if (edvol == '') {
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>Type: </b>"+type+"<br /><b>Course Classification: </b>"+course+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}else{
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>Type: </b>"+type+"<br /><b>Course Classification: </b>"+course+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Edition: </b>"+edvol+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}
				}else if(type == 'Journals' || type == 'Magazines'){
					if (edvol == '') {
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>ISBN/ISSN: </b>"+isbn+"<br /><b>Type: </b>"+type+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}else{
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>ISBN/ISSN: </b>"+isbn+"<br /><b>Type: </b>"+type+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Edition: </b>"+edvol+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}	
				}
				else{
					if (edvol == '') {
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>ISBN/ISSN: </b>"+isbn+"<br /><b>Type: </b>"+type+"<br /><b>Course Classification: </b>"+course+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}else{
						var showMessage = "<strong><h4>Library Information: </h4></strong><br /><b>ID Material: </b>"+materialid+"<br /><b>ISBN/ISSN: </b>"+isbn+"<br /><b>Type: </b>"+type+"<br /><b>Course Classification: </b>"+course+"<br /><b>Title: </b>"+name+"<br /><b>Author: </b>"+authorname+"<br /><b>Year of Publication: </b>"+year+"<br /><b>Edition: </b>"+edvol+"<br /><b>Accessibility: </b>"+access+"<br /><b>Availability: </b>"+available+"<br /><b>Requirement: </b>"+requirement+"<br />";
					}
				}

				window.onload = function() {                   
				        showMaterial($(this)) 
				}
			}

			$("table")
				.tablesorter({
						theme: 'blue',
						widthFixed: true,
						widgets: ['zebra']
					})

			.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
				var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') + ' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
				$('#display')
					.append('<li><span class="str">"' + e.type + msg + '</li>')
					.find('li:first').remove();
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			})

			.tablesorterPager(pagerOptions);

		});
	
	</script>
	<script>
		//document.getElementById("success_update").style.display='none';
		//document.getElementById("success_added").style.display='none';
	$('#view-nav').addClass('active');
	$(document).ready(function(){
				//for tooltip
				$("a.tooltipLink").tooltip();
	});
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
    </script>
</body></html>