<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>	

		<script type="text/javascript">

		function confirmDeleteAccount( thisDiv ){
			bootbox.dialog({
				message: "This account will be deleted. Are you sure you want to proceed?",
				title: "Delete Account",
				onEscape: function() {},
				buttons: {
					yes: {
						label: "Yes, continue.",
						className: "btn-primary",
						callback: function() {
							var password = prompt( "Please enter admin password" ).trim();
							if( password != "" ){
								$.ajax({
									type : "POST",
									url : "<?php echo base_url(); ?>admin/check_password",
									data : { password : password },
									success : function( result ){
													console.log( result );
													if( result == "1" ){
 														deleteAccount(thisDiv);
													} else {
														alert( "Wrong password!" );
													}
												}

								});								
							}
						}
					},
					no: {
						label: "No.",
						className: "btn-default"
					}
				}
			});
		}

		function deleteAccount( thisDiv ){
			var idnumber = thisDiv.parent().siblings('.idnumber').text().trim();
			$.ajax({
				type : "POST",
				url : "<?php echo base_url(); ?>admin/delete_account",
				data : { idnumber : idnumber },
				success : function( result ){
					if( result == "" ){
						console.log("Deleted");
						$('#'+idnumber).remove();
					}

					$('table').trigger('update');
				}
			});
		}

		</script>
	</head>		
	<body>
		<?php include 'includes/header.php'; ?>

		<div class="mainBody">
			<!-- Nav tabs -->
			<?php include 'includes/sidebar.php'; ?>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
							<h2> Search User </h2>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
								<li class="active"> Search User </li>
							</ol>
						<br />
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
										<input type="text" id = "searchUser" class="form-control">
										<span class="input-group-btn">
											<button class="btn btn-default" id = "searchUserButton" type="button" value="Search"> Search</button>
										</span>
									</div><!-- /input-group -->
								</div><!-- /.col-lg-6 -->
							</div><!-- /.row -->
						<br /><br />
						<table class="table table-hover table-bordered" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th width="10%"><center>Student/Employee Number</center></th>
									<th width="55%"><center>Borrower Information</center></th>
									<th width="15%"><center>Status</center></th>
									<th width="20%"><center>Remove</center></th>
								</tr>
							</thead>
							
							<tbody>
								<?php  
									foreach ($users as $data){
										$data = (array)$data;
										echo "<tr id = '${data['idnumber']}'>";
										echo "<td class = 'idnumber' > ${data['idnumber']}  </td>";
										echo "<td>"; 
										echo "<strong><span class = 'fname'> ${data['fname']} </span> <span class = 'mname'> ${data['mname']}  </span> <span class = 'lname'> ${data['lname']}  </span> </strong> <br /> ${data['email']}  <br />"; 
										echo "<span class = 'college'> ${data['college']}  </span> - <span class = 'course'> ${data['course']} </span>"; 
										
										if( $data['classification'] == 'F' ) echo "<span class = 'classification'><i> (Faculty) </i> </span><br />"; 
										else echo "<span class = 'classification'><i> (Student) </i> </span><br />"; 
										echo "</td>";
										echo "<td> <strong> ${data['status']} </strong> </td>";
										echo "<td> <button class = 'btn btn-default' onclick = 'confirmDeleteAccount($(this))' > Delete Account </button> </td>";
										echo "</tr>";	
									}
								?>
							</tbody>
						</table>
						<?php include 'includes/pager.php'; ?>
					</div>
				</div>
				
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<?php include 'includes/pagination.php'; ?>	

		
		<script type="text/javascript">
			$('#user-nav').addClass('active');

			function printIdNumber( idnumber ){
				return "<td class = 'idnumber'> " + idnumber + "</td>"
			}

			function printStatus( status ){
				return "<td class = 'status'> <strong>" + status + "</strong></td>"
			}

			function printBorrowerInfo( fname, mname, lname, email, course, college, classification ){
				ret = "<td> <strong> <span class = 'fname'> " + fname + " </span><span class = 'fname'> " + mname + " </span><span class = 'fname'> " + lname + " </span> </strong> <br />";
				ret += "<span class = 'email'> " + email + " </span><br />";
				ret += "<span class = 'college'> " + college + "  </span> - <span class = 'course'> " + course + " </span>";
				
				if( classification == 'F' ) ret += "<span class = 'classification'><i> (Faculty) </i> </span><br />"; 
				else ret += "<span class = 'classification'><i> (Student) </i> </span><br />"; 

				ret += "</td>";

				return ret;
			}
			
			function printButton( ){
				return "<td> <button class = 'btn btn-default' onclick = 'confirmDeleteAccount($(this))' > Delete Account </button> </td>";
			}

			function updateContents( data ){
				var content = "";

				content += printIdNumber( data.idnumber );
				content += printBorrowerInfo( data.fname, data.mname, data.lname, data.email, data.course, data.college, data.classification );
				content += printStatus( data.status );
				content += printButton();
				
				return content;
			}

			$('#searchUserButton').click(function (){
				var search = $('#searchUser').val();
				$.ajax({
					type : "POST",
					url : "<?php echo site_url(); ?>/admin/search_user",
					data : { search : search },
					dataType : "json",
					success : function( result ){
						if( result.length != 0 ){
							$('tbody').html("");
							for( var i = 0; i < result.length; i++ ){
								$('tbody').append("<tr id = '"+ result[i].idnumber  +"'>" + updateContents(result[i]) + "</tr>");	
							}
						 	$('table').trigger('update');
						} else {
							$('tbody').html("<td colspan = '8'><span style = 'center' > No results found </span> </td>");
							$("table").tablesorter();


						}
						$('table').trigger('update');
						
					}
				});
			});

			$("#logout").click(function(){
				window.location.href = "<?php echo site_url('admin/logout'); ?>";
			});	
		</script>
		<script>
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
			</script>
	</body>
</html>