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
	        		<div class="row">
	        		<div id = "main-content">
						<div id="settings_container"> <br />
						
						<h2>Administrator Settings</h2><br />
						
						<div class="alert alert-success alert-dismissable" id="info_succ" style = 'height: 40px; margin: 20px; text-align: center; display:none;'>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Update successful!</strong> Information successfully updated.
						</div> 
						<div class="alert-container" style = 'height: 50px;'>
							<div style="height: 45px; text-align: center;" id = "alert"> </div>
						</div>
						<div id = "fineDiv" class="form-inline">
							<label class = "control-label"> Fine Settings </label> &nbsp;
							<button class="btn btn-default" id="fineEnable" >Enable</button>
							<button class="btn btn-default" id="fineDisable" >Disable</button>
							<div class="form-group">
								<label class="sr-only" for="fineInput">Fine</label>
								<input type="number" class="form-control col-sm-1" id="fineInput" value = "<?php echo $info[0]->fine; ?>">
							</div>
						</div>
						<br /> <br /> <br />

						<div id = "maxDiv" class="form-inline">
							<label class = "control-label"> Maximum Materials </label> &nbsp;
							<button class="btn btn-default" id="updateMax" > Update </button>
							<button class="btn btn-default" id="saveMax" > Save </button>
							<button class="btn btn-default" id="cancelMax" > Cancel </button>
							<div class="form-group">
								<label class="sr-only" for="maxInput">Maximum</label>
								<!--label class="control-label col-sm-1" id="maxLabel" ><?php echo $info[0]->max; ?></label-->
								<input type="number" class="form-control col-sm-1" id="maxInput" value = "<?php echo $info[0]->max; ?>">
							</div>
						</div>
						<br /> <br /> <br />
						

						<!--button class="btn btn-primary ladda-button" data-style="expand-right">
							<span class="ladda-label"> Save snippet </span>
						</button-->


						<div id = "passwordDiv" class="form-horizontal" >
							<div class="form-group">
								<label class="col-sm-2 control-label"> Current Password : </label>
								<div class="col-sm-3">
									<label class = "control-label" id="passText"> *************** </label>
									<input type="password" class="form-control" id="passInput" value = "" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" id = "newPassLabel"> New Password : </label>
								<div class="col-sm-3">
									<input type="password" class="form-control" id="newPassInput" value = "" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" id = "reNewPassLabel" for = ""> Retype New Password : </label>
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
						<br /><br /><br />
						<div class="form-group">
							<label class="col-sm-2 control-label"> Clear : </label>
							<div class="col-sm-3">
								<input id = "clear" type = "button" class = "btn btn-default" value = "Clear Reservations" style = 'margin-top: 12px;'/>
							</div>
						</div>
					</div>
					</div>
					</div>
				</div>
				</div>
    </div>

	<script>
		var enable = "<?php echo $info[0]->fineenable; ?>";
		var fineFlag = '';
		
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
				
			
			$('#save').show();
			$('#cancel').show();
			$('#updateInfo').hide();

		}
		
		function hideMax(){
			$('#maxInput').hide();
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

			fineFlag = 'enable';
			confirmUpdateSettings('fineDiv');
			
		});


		$('#fineDisable').click(function(){
			if(info_check()){
				fineFlag = 'disable';
				confirmUpdateSettings('fineDiv');
			}
		});
		
		$("#clear").click(function(){		
			confirmUpdateSettings('clearDiv'); 	
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
			if(max_check()){ 
				confirmUpdateSettings('maxDiv'); 
			};
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
			var fine = document.getElementById('fineInput').value;
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_fine",
					data: { fine: fine },
					success : function( result ){
						if( result == "" ){
							$('#alert').addClass("alert alert-success");
							$("#alert").html("Successfully changed the fine");
							$("#alert").fadeIn('slow');
							setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
						}
	
						$('table').trigger('update');
					}
				});
		});				

		$('#savePass').click(function(){
			if(valPword() && reNewPassInput_check()){ 

				var newpw = document.getElementById('newPassInput').value;
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_password",
					data: { newpw: newpw },
					success : function( result ){
						if( result == "" ){
							$('#alert').addClass("alert alert-success");
							$("#alert").html("Successfully changed password!");
							$("#alert").fadeIn('slow');
							setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
						}
	
						$('table').trigger('update');
				}
				});

				$('#newPassInput').val('');
				$('#passInput').val('');			
				$('#reNewPassInput').val('');
				hidePassword(); 
				
		}
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
			var fine = document.getElementById('fineInput');
			var filter = /^\d{1,2}$/; 
			if (!filter.test(fine.value)){
				alert('Invalid fine value.');
				fine.focus;	

				return false;
			}else return true;
				
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
						
						$('#alert').addClass("alert alert-success");
						$("#alert").html("Successfully enabled!");
						$("#alert").fadeIn('slow');
						setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
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
			
						
						$('#alert').addClass("alert alert-success");
						$("#alert").html("Successfully disabled!");
						$("#alert").fadeIn('slow');
						setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
					}

					$('table').trigger('update');
				}
			});
		
		}
		
		function confirmUpdateSettings( thisDiv ){
			var msg;
			if(fineFlag == 'enable' && thisDiv == 'fineDiv'){
				msg = 'Are you sure to enable fine?';
			}else if(fineFlag == 'disable' && thisDiv == 'fineDiv'){
				msg = 'Are you sure to disable fine?';
			}else if(thisDiv == 'maxDiv'){
				msg = 'Are you sure to update maximum number of materials?';
			}
			else if(thisDiv == 'clearDiv'){
				msg = 'Are you sure to clear all reservations?';
			}
			bootbox.dialog({	
				message: msg,
				title: "Update Settings",
				onEscape: function() {},
				buttons: {
					yes: {
						label: "Yes, continue.",
						className: "btn-primary",
						callback: function() {
							var password;
							//var password = prompt( "Please enter admin password" );
							bootbox.dialog({
							  message: "Password: <input type='password' id='pw' name='first_name'></input>",
							  title: "Update settings",
							  buttons: {
								main: {
								  label: "Confirm",
								  className: "btn-primary",
								  callback: function() {
									console.log("Hi "+ $('#pw').val());
									password = $('#pw').val();
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
																bootbox.dialog({
																	message: "Error in password!",
																	title: "Error Settings",
																	onEscape: function() {},
																	buttons: {
																		no: {
																			label: "Dismiss",
																			className: "btn-default"
																		}
																	}
																});
															}
														}

										});								
									}
								  }
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
				if( fineFlag == 'enable' ){
					$('#fineEnable').hide();
					$('#fineDisable').show();
					$('#fineInput').show();
					enable_fine();
				}else{
					$('#fineEnable').show();
					$('#fineDisable').hide();
					$('#fineInput').hide();
					disable_fine();	
				}
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/settings_for_fine",
					data: { fine: fine },
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
							//hideFine();
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
							$('#alert').addClass("alert alert-success");
							$("#alert").html("Successfully updated max reservations!");
							$("#alert").fadeIn('slow');
							setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
							hideMax(); 
						}
	
						$('table').trigger('update');
					}
				});
			}
			else if(thisDiv == 'clearDiv'){
				$.ajax({
					type: "POST",
					url: "<?php echo site_url()?>/admin/clear_reservation",
					success : function( result ){
						if( result == "" ){
							console.log("Updated");
							$('#alert').addClass("alert alert-success");
							$("#alert").html("Successfully cleared all reservations!");
							$("#alert").fadeIn('slow');
							setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);
							hideMax(); 
						}
	
						$('table').trigger('update');
					}
				});		
			}
		}
		
	</script>
	</body>
</html>