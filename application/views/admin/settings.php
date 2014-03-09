<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="mainBody">
            <!-- Nav tabs -->
            <?php include 'includes/sidebar.php'; ?> 

	         <div class="leftMain">
	        	<div id="main-page">
	        		<div id = "main-content">
						<div id="settings_container"> <br />
						
						<h2>Administrator Settings</h2><br />
						
						<legend> Semester Range </legend>
						<div class="alert alert-success alert-dismissable" id="info_succ" style = 'height: 40px; margin: 20px; text-align: center; display:none;'>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Update successful!</strong> Information successfully updated.
						</div> 
						
						<div id = "infoDiv" class="form-horizontal" >
							<div class="form-group">
								<label class="col-sm-3 control-label">Start of the Semester : </label>
								<div class="col-sm-3">
									<label class = "control-label" id="startDateText"> <?php echo $info[0]->start; ?> </label>
									<input type="date" class="form-control" id="startDateInput" value = "<?php echo $info[0]->start; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">End of the Semester : </label>
								<div class="col-sm-3">
									<label class = "control-label" id="endDateText"> <?php echo $info[0]->end; ?> </label>
									<input type="date" class="form-control" id="endDateInput" value = "<?php echo $info[0]->end; ?>" >
								</div>
							</div>
							<div id = "infoDiv" class="form-horizontal" >
								<div class="form-group">
									<div class="col-sm-3">
										<input type="button" class="btn btn-primary col-sm-6" id="updateInfo" value = "Update Info" />
										<input type="button" class="btn btn-danger col-sm-6" id="cancel" value = "Cancel" />
										<input type="button" class="btn btn-default col-sm-6" id="save" value = "Save" />
									</div>
								</div>
							</div>
						</div>
						<br />
						<legend> Fine Settings </legend>
						
						<div id = "fineDiv" class="form-horizontal" >
							<div class="form-group">
								<input type="number" class="control-label col-sm-1" id="fineInput" value = "<?php echo $info[0]->fine; ?>">
								<div class="col-sm-1">
									<input type="button" class="btn btn-default" id="fineEnable" value = "Enable Fine" />
									<input type="button" class="btn btn-default" id="fineDisable" value = "Disable Fine" />
								</div>
							</div>
						</div>
						<br /> <br />
						
						<legend> Password Settings </legend>
						<div id = "passwordDiv" class="form-horizontal" >
							<div class="form-group">
								<label class="col-sm-3 control-label"> Current Password : </label>
								<div class="col-sm-3">
									<label class = "control-label" id="passText"> *************** </label>
									<input type="password" class="form-control" id="passInput" value = "" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" id = "newPassLabel"> New Password : </label>
								<div class="col-sm-3">
									<input type="password" class="form-control" id="newPassInput" value = "" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" id = "reNewPassLabel" > Retype New Password : </label>
								<div class="col-sm-3">
									<input type="password" class="form-control" id="reNewPassInput" value = "" >
								</div>
							</div>
							<div class="form-group col-sm-9">
								<div class="col-sm-3 pull-right">
									<input type="button" class="btn btn-primary" id="updatePass" value = "Update Password" >
									<input type="button" class="btn btn-default" id="savePass" value = "Save" >
									<input type="button" class="btn btn-danger" id="cancelPass" value = "Cancel" >
								</div>
							</div>
						</div>
						<legend> Clear </legend>
						<input id = "clear" type = "button" class = "btn btn-default" value = "Clear Reservations" style = 'margin-top: 12px;'/>
					</div>
					</div>
					</div>
				</div>
				</div>
    </div>

	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>
	<script>
		var enable = "<?php echo $info[0]->fineenable; ?>";	
		hideInfoInput();
		hideFine();
		hidePassword();

		function hidePassword(){
			$('#passText').show();
			$('#updatePass').show();
			$('#newPassInput').hide();
			$('#passInput').hide();
			$('#reNewPassLabel').hide();				
			$('#reNewPassInput').hide();				
			$('#reNewPassLabel').hide();				
			$('#newPassLabel').hide();
			$('#savePass').hide();				
			$('#cancelPass').hide();							
		}

		function hideFine(){
			if( enable == 1 ) {
				$('#fineEnable').hide();
				$('#fineDisable').show();
				$('#fineInput').show();				
			} else {
				$('#fineInput').hide();
				$('#fineEnable').show();
				$('#fineDisable').hide();
			
			}
		}

		function hideInfoLabel(){
			$('#startDateText').hide();
			$('#endDateText').hide();

			$('#startDateInput').show();
			$('#endDateInput').show();
				
			
			$('#save').show();
			$('#cancel').show();
			$('#updateInfo').hide();

		}

		$('#cancelPass').click(function(){
			hidePassword();
		});

		$('#updatePass').click(function(){
			$('#newPassInput').show();
			$('#passInput').show();
			$('#reNewPassInput').show();				
			$('#reNewPassLabel').show();				
			$('#newPassLabel').show();
			$('#savePass').show();				
			$('#cancelPass').show();
			$('#updatePass').hide();
			$('#passText').hide();
		});

		$('#updateInfo').click(function(){
			hideInfoLabel();
		});

		$('#cancel').click(function(){
			hideInfoInput();
		});

		$('#fineEnable').click(function(){
			$('#fineEnable').hide();
			$('#fineDisable').show();
			$('#fineInput').show();	
		});


		$('#fineDisable').click(function(){
			$('#fineEnable').show();
			$('#fineDisable').hide();
			$('#fineInput').hide();	
		});

		function hideInfoInput(){
			$('#startDateText').show();
			$('#endDateText').show();

			$('#startDateInput').hide();
			$('#endDateInput').hide();

			$('#save').hide();
			$('#cancel').hide();
			$('#updateInfo').show();
			
		}

		initial_hide();
		
		function initial_hide() {
			$('#fine').hide();
			$('#enable_fine').hide();
			$('#fine-label').hide();
			$('#disable_fine').hide();

			$('#cna').hide();
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
			var disable_fine = document.getElementById('disable_fine');
			
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
			
			$.ajax({
				url : "<?php echo base_url();?>admin/settings_for_enable",
				success : function( result ){
					if( result == "" ){
						console.log("Updated");
					}

					$('table').trigger('update');
				}
			});
				
		}
		
		function disable_fine() {
			$('#fine-label').hide();
			$('#fine').hide();
			var disable_fine = document.getElementById('disable_fine');
			var enable_fine = document.getElementById('enable_fine');
			disable_fine.style.display='none';
			enable_fine.style.display='inline';
			
			$.ajax({
				url : "<?php echo base_url();?>admin/settings_for_disable",
				success : function( result ){
					if( result == "" ){
						console.log("Updated");
					}

					$('table').trigger('update');
				}
			});
		
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
		
		function confirmUpdateSettings( thisDiv ){
			bootbox.dialog({
				message: "Yey?",
				title: "Update Settings",
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
 														updateSettings(thisDiv);
														initial_hide();
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
		
		function updateSettings( thisDiv ){
		
			var fine = document.getElementById('fine_value');
			var filter = /^([0-9\.\])+(([0-9\-]{2})+$/; 
			var upd_info = document.getElementById('upd_info');
			var cancel1 = document.getElementById('cancel_1');
			var save1 = document.getElementById('save_1');
			var start_sem = document.getElementById('start_sem_value');
			var end_sem = document.getElementById('end_sem_value');
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
		
			var fine = document.getElementById('fine_value').value;
			var start_sem = document.getElementById('start_sem_value').value;
			var end_sem = document.getElementById('end_sem_value').value;
			$.ajax({
				type : "POST",
				url : "<?php echo base_url();?>admin/settings_for_info",
				data: { fine_value : fine, start_sem_value : start_sem, end_sem_value : end_sem },
				success : function( result ){
					if( result == "" ){
						console.log("Updated");
					}

					$('table').trigger('update');
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