<?php include 'admin_header.php'; ?></div>
        <div class="mainBody">
            <!-- Nav tabs -->
            <div class="sidebarMain">
                <ul class="nav nav-pills nav-stacked">
                    <li id = "reserved-nav" >
						<a href="<?php echo base_url();?>admin/reservation">Reserved Books</a>
					</li>
					<li id = "borrowed-nav">
						<a href="<?php echo base_url();?>admin/borrowed_books">Borrowed Books</a>
					</li>
					<li id = "view-nav">
						<a href="<?php echo base_url();?>admin/admin_search">View All Library Materials</a>
					</li>
					<li id = "add-nav">
						<a href="<?php echo base_url();?>admin/add_material">Add A New Material</a>
					</li>
					<li id = "overview-nav"  class="active">
						<a href="<?php echo base_url();?>admin/home">Overview</a>
					</li>
                </ul>
			</div>   

        <div class="leftMain">
        <div id="main-page">
        <div id = "main-content">
		<div id="settings_container">
		
		<h2>Admin Settings</h2><br />
		<div class="alert alert-success alert-dismissable" id="info_succ" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Update successful!</strong> Information successfully updated.
		</div>
			<table id="settingsForm">
				<tr>
					<td><label>*Fine: </label></td>
					<td><input type="text" value="3.00" name="fine" pattern="[0-9]+" id="fine" disabled required></td>
				</tr>
				<tr>
					<td><label>*Start of Semester: </label></td>
					<td><input type="date" value="2013-11-11" name="start_sem" id="start_sem" disabled required></td>
				</tr>
				<tr>
					<td><label>*End of Semester: </label></td>
					<td><input type="date" value="2014-03-29" name="end_sem" id="end_sem" disabled required></td>
					
				</tr>
				
				<tr>
				<td><br /></td>
				</tr>
				
				</table>
					
					<input type="submit" id="cancel_1" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel1()">
					<input type="button" id="save_1" name="insert" class="btn btn-primary" value="Update" onclick="validate_info()" style="display: none;">
					<input type="submit" id="upd_info" class="btn btn-primary" align="right" value="Update Info" onclick="update1()" />
						
			<table>
				

				<td><hr style="width:717%; border:1px dashed #A8A8FF; text-align:center;"></td>
				
				<tr>
					<td><h4>Edit Password</h4><br /></td>
				<tr>
						
				</table>
					<div id = "alert" class="alert alert-success alert-dismissable">
						
					</div>
				<table>
				<tr>
					<td><label>Current Password:</label></td>
					<td><input type="password" id="currpw" name="currpw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				<tr>
					<td><label>Retype Current Password:</label></td>
					<td><input type="password" id="crepw" name="crepw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				<tr>
					<td><label>New Password:</label></td>
					<td><input type="password" id="newpw" name="newpw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				<tr>
					<td><label>Retype New Password:</label></td>
					<td><input type="password" id="nrepw" name="nrepw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				
				<tr>
				<td><br /></td>
				</tr>


				
		</table>
		<input type="submit" id="cancel_2" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel2()">
		<input type="button" id="save_2" name="insert" class="btn btn-primary" value="Save" style="display: none;" onclick="valPword()">
		<input type="submit" id="upd_pword" name="insert" class="btn btn-primary" value="Update Password" onclick="update2()">
		<br/>
		<button type="button" class="btn btn-default" id= "clearButton" >Clear Reservations</button>&nbsp;&nbsp;
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
	<script>

		$('#clearButton').click(function(){
			bootbox.dialog({
						message: "Are you sure you want to clear the reservations of materials?",
						title: "Confirm clear reservations",
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									var idnumber = $.trim(parent.siblings('.idnumber').text());
									var materialid = $.trim(parent.siblings('.materialid').text());
									var isbn = $.trim(parent.siblings('.isbn').text());
							
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/clear_reservation",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											$('#alert')
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

		function update1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info = document.getElementById('upd_info');
			
			//var new_start_sem = date(start_sem);
			
			//alert(new_start_sem);
		
			fine.disabled=false;
			start_sem.disabled=false;
			end_sem.disabled=false;
			cancel_1.style.display='inline';
			save_1.style.display='inline';
			upd_info.style.display='none';
		
		}
	
		function cancel1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info= document.getElementById('upd_info');
			
			fine.disabled=true;
			start_sem.disabled=true;
			end_sem.disabled=true;
			cancel_1.style.display='none';
			save_1.style.display='none';
			upd_info.style.display='inline';
		
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
		
			
			var crepw = document.getElementById('crepw');
			var newpw = document.getElementById('newpw');
			var currpw = document.getElementById('currpw');
			var nrepw = document.getElementById('nrepw');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');
			
			crepw.disabled=false;
			newpw.disabled=false;
			currpw.disabled=false;
			nrepw.disabled=false;
			cancel_2.style.display='inline';
			save_2.style.display='inline';
			upd_pword.style.display='none';
			
		}
		
		function cancel2(){
		
			var crepw = document.getElementById('crepw');
			var newpw = document.getElementById('newpw');
			var currpw = document.getElementById('currpw');
			var nrepw = document.getElementById('nrepw');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');
			
			crepw.disabled=true;
			newpw.disabled=true;
			currpw.disabled=true;
			nrepw.disabled=true;
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
													
			else if (newpw.value!=nrepw.value || (newpw.value == '' || nrepw.value == '')) {
				alert('Please retype your password.');
				newpw.focus;
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
	</script>

	</body>
</html>