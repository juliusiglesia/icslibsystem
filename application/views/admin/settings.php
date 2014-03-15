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
									<input type="date" class="form-control" id="startDateInput" value = "<?php echo $info[0]->start; ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">End of the Semester : </label>
								<div class="col-sm-3">
									<label class = "control-label" id="endDateText"> <?php echo $info[0]->end; ?> </label>
									<input type="date" class="form-control" id="endDateInput" value = "<?php echo $info[0]->end; ?>"/>
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
						
						<legend> Maximum Materials Settings </legend>
						
						<div id = "maxDiv" class="form-horizontal" >
							<div class="form-group">
								<input type="text" class="control-label col-sm-1" id="maxInput" value = "<?php echo $info[0]->max; ?>">
								<div class="col-sm-3">
									<input type="button" class="btn btn-primary col-sm-6" id="updateMax" value = "Update Max" />
									<input type="button" class="btn btn-default col-sm-6" id="saveMax" value = "Save" />
									<input type="button" class="btn btn-danger col-sm-6" id="cancelMax" value = "Cancel" />
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
								<label class="col-sm-3 control-label" id = "reNewPassLabel" for = ""> Retype New Password : </label>
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
						<div id= "clearDiv">
						<input id = "clear" type = "button" class = "btn btn-default" value = "Clear Reservations" style = 'margin-top: 12px;'/>
						</div>
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
		hideMax();
		hidePassword();

		function hidePassword(){
			$('#passText').show();
			$('#updatePass').show();
			$('#newPassInput').hide();
			$('#passInput').hide();				
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
		
		function hideMax(){
			$('#maxInput').show();
			$('#updateMax').show();
			$('#saveMax').hide();
			$('#cancelMax').hide();
		}
		
		function hideMaxLabel(){
			$('#maxInput').show();
			$('#updateMax').hide();
			$('#saveMax').show();
			$('#cancelMax').show();
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
		
		$('#updateMax').click(function() {
			hideMaxLabel();
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
			enable_fine();

			confirmUpdateSettings('fineDiv');	
		});


		$('#fineDisable').click(function(){
			$('#fineEnable').show();
			$('#fineDisable').hide();
			$('#fineInput').hide();
			disable_fine();	

			confirmUpdateSettings('fineDiv');
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
		
		$('#saveMax').click(function(){
			//if(max_check()){ 
				confirmUpdateSettings('maxDiv'); 
				hideMax(); 
			//};
		});
		
		$('#cancelMax').click(function(){		
				hideMax(); 
		});

		$('#save').click(function(){
			if(info_check()){ 
				confirmUpdateSettings('infoDiv'); 
				hideInfoInput(); 
			};
		});

		$('#reNewPassInput').blur(function(){
			reNewPassInput_check();	
		});

		$('#fineInput').on('change',function(){
			confirmUpdateSettings('fineDiv');
		});				

		$('#savePass').click(function(){
			if(valPword() && reNewPassInput_check()){ 
				confirmUpdateSettings('passwordDiv');
				/*$('#newPassInput').val('');
				$('#passInput').val('');			
				$('#reNewPassInput').val('');*/
				hidePassword(); 
			};	
		});

		function reNewPassInput_check(){
			var newPassInput = document.getElementById('newPassInput').value;
			var reNewPassInput = document.getElementById('reNewPassInput').value;
			var reNewPassDiv = document.getElementById('reNewPassInput').parentNode;

			if(newPassInput != reNewPassInput){
				reNewPassDiv.className += " has-error";
				return false;
			}
			else{
				reNewPassDiv.className = "col-sm-3";
				return true;
			}
		}
		
		function valPword(){
			
			var currpw = document.getElementById('passInput').value;
			var newpw = document.getElementById('newPassInput').value;
			var nrepw = document.getElementById('reNewPassInput').value;
			
			if(newpw == currpw){
				alert('Please provide a new password');
				return false;
			}

			else if(newpw.length < 6) {
				alert("Password must be greater than 6 characters!");
				return false;
			}
			else{
				return true;
			}
		
		}
		
		function max_check() {
			var max = document.getElementById('maxInput').value;
			var filter = /^\d{1,2}$/; 
			if (!filter.test(max)){
				alert('Invalid max value.');
				max.focus;	
				return false;
			}
			
			else {
				return true;
			}
		
		}

		function info_check(){
			var start_sem = document.getElementById('startDateInput').value;
			var end_sem = document.getElementById('endDateInput').value;
			var start_sem_date = new Date(start_sem);
			var end_sem_date = new Date(end_sem);
			var current_date = new Date();
			var oneDay = 24*60*60*1000;    // hours*minutes*seconds*milliseconds
			
			var months_difference;
			months_difference = (end_sem_date.getFullYear() - start_sem_date.getFullYear()) * 12;
			months_difference -= start_sem_date.getMonth();
			months_difference += end_sem_date.getMonth();
			if(months_difference <= 0) months_difference = 0;
			
			start_sem_date.setDate(start_sem_date.getDate()+1);
			
			if (start_sem_date < current_date) {
				alert('The input for start sem is less than the current date');
				return false;
			}
			
			if(end_sem.value < start_sem.value){
				
				alert('End of semester date should occur later than the start of semester date.');
				return false;
			}
			
			else if( months_difference < 5 || months_difference > 6){
				alert('Invalid semester length.');
				return false;
			}
			else return true;	
		}

		function enable_fine() {
			$('#fine-label').show();
			$('#fine').show();
			var fine_data = document.getElementById('fineInput').innerHTML;
			var disable_fine = document.getElementById('fineDisable');
			var enable_fine = document.getElementById('fineEnable');
			disable_fine.style.display='inline';
			enable_fine.style.display='none';
			
			$.ajax({
				url : "<?php echo site_url()?>/admin/settings_for_enable",
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
			var disable_fine = document.getElementById('fineDisable');
			var enable_fine = document.getElementById('fineEnable');
			disable_fine.style.display='none';
			enable_fine.style.display='inline';
			
			$.ajax({
				url : "<?php echo site_url()?>/admin/settings_for_disable",
				success : function( result ){
					if( result == "" ){
						console.log("Updated");
					}

					$('table').trigger('update');
				}
			});
		
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
									url : "<?php echo site_url()?>/admin/check_password",
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
			if(thisDiv == 'infoDiv'){
				var start_sem_value = document.getElementById('startDateInput').value;
				var end_sem_value = document.getElementById('endDateInput').value;
	
				$.ajax({
					type : "POST",
					url : "<?php echo site_url()?>/admin/settings_for_info",
					data: { start_sem_value : start_sem_value, end_sem_value : end_sem_value },
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
						}
	
						$('table').trigger('update');
					}
				});
			}
			else if(thisDiv == 'fineDiv'){
				var fine = document.getElementById('fineInput').value;
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_fine",
					data: { fine: fine },
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
						}
	
						$('table').trigger('update');
					}
				});
			}
			else if(thisDiv == 'maxDiv'){
				var max = document.getElementById('maxInput').value;
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_max",
					data: { max: max },
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
						}
	
						$('table').trigger('update');
					}
				});
			}
			else if(thisDiv == 'passwordDiv'){
				var newpw = document.getElementById('newPassInput').value;
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_password",
					data: { newpw: newpw },
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
						}
	
						$('table').trigger('update');
					}
				});
			}
		}
		
		function checkDays(){
			var end_sem = document.getElementById('endDateInput').value;
			var end_sem_date = new Date(end_sem);
			var current_date = new Date();
			var diff =  Math.floor(( Date.parse(end_sem_date) - Date.parse(current_date) ) / 86400000);
				
			if(diff > 10){
				alert("Invalid number of days.");
				return false;
			}else return true;
				
		}

		$("#clear").click(function(){
			if(checkDays()){ 
				confirmClearReserv('clearDiv'); 
			};		
		});
		
		function confirmClearReserv( thisDiv ){
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
										url: "<?php echo site_url()?>/admin/clear_reservation",

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
				
		}
	</script>

	</body>
</html>