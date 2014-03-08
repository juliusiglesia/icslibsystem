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
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="40px"></a>
                </div>

                <div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-cog" ></span></a>
				  
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
					<li><a href="#">Help</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
				  </ul>
            </div>

            </div></div>
        <div class="mainBody">
            <!-- Nav tabs -->
            <div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked"><br />
					<li id = "reserved-nav">
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
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
		<div id="settings_container">
		<br />
		<h2>Admin Settings</h2><br />
		<div class="alert alert-success alert-dismissable" id="info_succ" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Update successful!</strong> Information successfully updated.
		</div>
			<table id="settingsForm">
				<tr>
					<td><label for = "fine" id="fine-label">* Fine: </label></td>
					<?php 
						foreach($info as $row){
							echo " <td id='fine'><label id='fine_value'> $row->fine </label></td>";
						}
					?>
				</tr>
				<tr>
					<td><label>* Start of Semester: </label></td>
					<?php 
						foreach($info as $row){
							echo " <td id='start_sem'><label id='start_sem_value'> $row->start </label></td>";
						}
					?>
				</tr>
				<tr>
					<td><label>* End of Semester: </label></td>
					<?php 
						foreach($info as $row){
							echo " <td id='end_sem'><label id='end_sem_value'> $row->end </label></td>";
						}
					?>
					
				</tr>
				
				<tr>
				<td><br /></td>
				</tr>
				
				</table>
					
					<input type="submit" id="cancel_1" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel1()">
					<input type="button" id="save_1" name="insert" class="btn btn-primary" value="Update" onclick="validate_info()" style="display: none;">
					<input type="submit" id="upd_info" class="btn btn-primary" align="right" value="Update Info" onclick="update1()" />	
					<input type="button" id="enable_fine" class="btn btn-primary" align="right" value="Enable Fine" onclick="enable_fine()" />
					<input type="button" id="disable_fine" class="btn btn-primary" align="right" value="Disable Fine" onclick="disable_fine()" />	

				<hr style="border:1px dashed #A8A8FF;text-align:center;" />
				
					<td><h4>Edit Password</h4><br /></td>
					<div class="alert alert-success alert-dismissable" id="pword_succ" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Update successful!</strong> Password successfully updated.
					</div>
				<table id='edit_password_table' style='display:none;'>
					<tr>
						<td><label>Current Password:</label></td>
						<td><input type="password" id="currpw" name="currpw" value="" pattern="\w{0,}\d{1,}\w{0,}" ><span id='currpw_error'></span></td>
					</tr>
					<tr>
						<td><label>Retype Current Password:</label></td>
						<td><input type="password" id="crepw" name="crepw" value="" pattern="\w{0,}\d{1,}\w{0,}" onblur="crepw_check()"><span id='crepw_error'></span></td>
					</tr>
					<tr>
						<td><label>New Password:</label></td>
						<td><input type="password" id="newpw" name="newpw" value="" pattern="\w{0,}\d{1,}\w{0,}"><span id='newpw_error'></span></td>
					</tr>
					<tr>
						<td><label>Retype New Password:</label></td>
						<td><input type="password" id="nrepw" name="nrepw" value="" pattern="\w{0,}\d{1,}\w{0,}" onblur="nrepw_check()"><span id='nrepw_error'></span></td>
					</tr>
					
					<tr>
					<td><br /></td>
					</tr>
				</table>
		<input type="submit" id="cancel_2" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel2()">
		<input type="button" id="save_2" name="insert" class="btn btn-primary" value="Save" style="display: none;" onclick="valPword()">
		<input type="submit" id="upd_pword" name="insert" class="btn btn-primary" value="Update Password" onclick="update2()">
		<br/>
		<input id = "clear" type = "button" class = "btn btn-default" value = "Clear Reservations"/>
		</div>
		</div>
		</div>
		</div>
		</div>
		<footer>
        <center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
      </footer>

    </div>

	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>
	<script>
	
		initial_hide();
		
		function initial_hide() {
			$('#fine').hide();
			$('#enable_fine').hide();
			$('#fine-label').hide();
			$('#disable_fine').hide();
		}

		function crepw_check(){
			var currpw = document.getElementById('currpw').value;
			var crepw = document.getElementById('crepw').value;
			var crepw_error = document.getElementById('crepw_error');

			if(currpw != crepw){
				crepw_error.innerHTML = "Not identical to current password";
			}
			else{
				crepw_error.innerHTML = "";
			}

		}

		function nrepw_check(){
			var newpw = document.getElementById('newpw').value;
			var nrepw = document.getElementById('nrepw').value;
			var nrepw_error = document.getElementById('nrepw_error');

			if(newpw != nrepw){
				nrepw_error.innerHTML = "Not identical to new password";
			}
			else{
				nrepw_error.innerHTML = "";
			}

		}

		function update1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var fine_data = document.getElementById('fine_value').innerHTML;
			var start_sem_data = document.getElementById('start_sem_value').innerHTML;
			var end_sem_data = document.getElementById('end_sem_value').innerHTML;
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info = document.getElementById('upd_info');
			var enable_fine = document.getElementById('enable_fine');
			
			start_sem.innerHTML = "<input type='text' name='start_sem' id='start_sem_value' placeholder='"+start_sem_data+"'/>";
			end_sem.innerHTML = "<input type='text' name='end_sem' id='end_sem_value' placeholder='"+end_sem_data+"'/>";
			cancel_1.style.display='inline';
			save_1.style.display='inline';
			enable_fine.style.display='inline';
			upd_info.style.display='none';
		
		}
		
		function enable_fine() {
			$('#fine-label').show();
			$('#fine').show();
			var fine_data = document.getElementById('fine_value').innerHTML;
			var disable_fine = document.getElementById('disable_fine');
			var enable_fine = document.getElementById('enable_fine');
			fine.innerHTML = "<input type='text' name='fine' id='fine_value' placeholder='"+fine_data+"'/>";
			disable_fine.style.display='inline';
			enable_fine.style.display='none';
				
		}
		
		function disable_fine() {
			$('#fine-label').hide();
			$('#fine').hide();
			var disable_fine = document.getElementById('disable_fine');
			var enable_fine = document.getElementById('enable_fine');
			disable_fine.style.display='none';
			enable_fine.style.display='inline';
		
		}
	
		function cancel1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var fine_data = document.getElementById('fine_value').placeholder;
			var start_sem_data = document.getElementById('start_sem_value').placeholder;
			var end_sem_data = document.getElementById('end_sem_value').placeholder;
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info = document.getElementById('upd_info');
			var enable_fine = document.getElementById('enable_fine');
			var disable_fine = document.getElementById('disable_fine');
			
			//fine.innerHTML = "<label id='fine_value'>"+fine_data+"</label>";
			start_sem.innerHTML = "<label id='start_sem_value'>"+start_sem_data+"</label>";
			end_sem.innerHTML = "<label id='end_sem_value'>"+end_sem_data+"</label>";
			cancel_1.style.display='none';
			save_1.style.display='none';
			upd_info.style.display='inline';
			enable_fine.style.display='none';
			disable_fine.style.display='none';
			$('#fine-label').hide();
			$('#fine').hide();
		
		}
		
				
		function validate_info(){
		
			var fine = document.getElementById('fine');
			var filter = /^([0-9\.\])+(([0-9\-]{2})+$/; 
			var upd_info = document.getElementById('upd_info');
			var cancel1 = document.getElementById('cancel1');
			var save1 = document.getElementById('save1');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var start_sem_date = new Date(start_sem.value);
			var end_sem_date = new Date(end_sem.value);
			var current_date = new Date();
			var info_succ = document.getElementById('info_succ');
			var oneDay = 24*60*60*1000;    // hours*minutes*seconds*milliseconds
			
			var months_difference;
			months_difference = (end_sem_date.getFullYear() - start_sem_date.getFullYear()) * 12;
			months_difference -= start_sem_date.getMonth();
			months_difference += end_sem_date.getMonth();
			if(months_difference <= 0) months_difference = 0;
			
			start_sem_date.setDate(start_sem_date.getDate()+1);
			
			if (!filter.test(fine.value)){
				alert('Invalid fine value.');
				fine.focus;	
				return false;
			}
			
			if (start_sem_date < current_date) {
				alert('The input for start sem is less than the current date');
				return false;
			}
			
			else if(end_sem.value < start_sem.value){
				
				alert('End of semester date should occur later than the start of semester date.');
				return false;
			}
			
			else if( months_difference < 4 || months_difference > 5){
				alert('Invalid semester length.');
				return false;
			}
			
			else{
				fine.disabled=true;
				start_sem.disabled=true;
				end_sem.disabled=true;
				info_succ.style.display='block';	
				cancel_1.style.display='none';
				save_1.style.display='none';
				upd_info.style.display='inline';
							
			}
			
			var fine = document.getElementById('fine').value;
			var start_sem = document.getElementById('start_sem').value;
			var end_sem = document.getElementById('end_sem').value;
			
			$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/settings_for_info",
						data: { fine : fine, start_sem : start_sem, end_sem : end_sem }, 

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
						}
					});
		
		}
		
		function update2(){
		
			var table = document.getElementById('edit_password_table');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');
			
			table.style.display='block';
			cancel_2.style.display='inline';
			save_2.style.display='inline';
			upd_pword.style.display='none';
			
		}
		
		function cancel2(){

			var table = document.getElementById('edit_password_table');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');

			table.style.display='none';
			cancel_2.style.display='none';
			save_2.style.display='none';
			upd_pword.style.display='inline';
		
		}
		
		function valPword(){
			
			var currpw=document.getElementById('currpw');
			var newpw = document.getElementById('newpw');
			var crepw = document.getElementById('crepw');
			var nrepw = document.getElementById('nrepw');
			var upd_pword = document.getElementById('upd_pword');
			var save_2 = document.getElementById('save_2');
			var cancel_2 = document.getElementById('cancel_2');
			var pword_succ = document.getElementById('pword_succ');
			
			if(newpw.value == currpw.value){
				alert('Please provide a new password');
			}

			else if(newpw.value.length < 6) {
				alert("Password must be greater than 6 characters!");
				return false;
			}
			else{
				currpw.value = newpw.value;
				crepw.value='';
				nrepw.value='';
				newpw.disabled=true;
				currpw.disabled=true;
				nrepw.disabled=true;
				cancel_2.style.display='none';
				save_2.style.display='none';
				upd_pword.style.display='inline';
				pword_succ.style.display='block';
				
			}
			
			var newpw = document.getElementById('newpw').value;
			
			$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/settings_for_password",
						data: { newpw: newpw },

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							// show that notification is successful
							$('#error_message').html(result);
							
						}
					});
		
		}

		$("#clear").click(function(){
			
			bootbox.dialog({
						message: "Are you sure you want to clear the reservations?",
						title: "Clear Reservations",
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/clear_reservation",

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											console.log("Cleared");
											
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
			
		
		});
	</script>

	</body>
</html>