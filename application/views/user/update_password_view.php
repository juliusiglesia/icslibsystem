<form id="passForm" method="post">
	<i class="glyphicon glyphicon-lock"></i> Password&nbsp;
	<input id="password" name="password" type="password" value="<?php echo $this->session->userdata('password'); ?>" disabled>&nbsp;
	<input id="re_password" name="re_password" type="password" value="" style="display:none;"><br/>
	<input type="button" id="update_password" value="Update Password" class="btn btn-primary btn-sm" onclick="edit_password()">
	<input type="button" id="set_password" value="Save" class="btn btn-primary btn-sm" style="display:none;" data-toggle="modal">
	<input type="button" id="cancel_pword" value="Cancel" class="btn btn-primary btn-sm" onclick="cancel()" style="display:none;">
</form>

<span id="error_update"> </span>
<span id="error_updatePassword"> </span>

<div id = "success_email_update" class = "alert alert-success">  </div>

<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	$("#email").hide();
	$("#temp").hide();

	$('#success_email_update').hide();
	
	$('#pass').hide();

	$('#email').blur(function(){
		var value = $('#email').val();
        $.ajax({
          url: "<?php echo base_url();?>borrower/checkUpdateEmail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="1"){
                   $('#error_update').html("Invalid email");
              }
              else if($.trim(result)=="2"){
                   $('#error_update').html("Email already in use");
              }
              else if($.trim(result)=="0"){
                   $('#error_update').html("");
              }
            }
        });
	});

	/*password change*/
	$('#password').blur(function(){
		var value_pword = $('#password').val();
		$.ajax({
			url: "<?php echo base_url(); ?>borrower/checkUpdatePassword",
			type: "POST",
			data: {password : value_pword},
			success: function(result){
				if($.trim(result) == "1"){
					$('#error_updatePassword').html("Invalid password");
					//$('#re_password').hide();
				}
				/*else if($.trim(result)=="2"){
                   $('#error_updatePassword').html("Password and Re_password does not match");
              	}*/
				else if($.trim(result) == "0"){
					var x = document.getElementById('re_password');
					x.disabled = false;
					$('#error_updatePassword').html("");
				}
			}

		});

	});

	$('#re_password').blur(function(){
		var value_pword = $('#password').val();
		var value_re_pword = $('#re_password').val();
		$.ajax({
			url: "<?php echo base_url(); ?>borrower/checkUpdateRe_Password",
			type: "POST",
			data: {re_password : value_re_pword,
					password: value_pword},
			success: function(result){
				if($.trim(result) == "1"){
					$('#error_updatePassword').html("Invalid password");
					//$('#set_password').disabled();
				}
				/*else if($.trim(result)=="2"){
                   $('#error_updatePassword').html("Password and Re_password does not match");
              		//$('#set_password').disabled();
              	}*/
				else if($.trim(result) == "0"){
					var z = document.getElementById('set_password');
					z.disabled=false;
					$('#error_updatePassword').html("");
					//$('#set_password').show();
				}
			}

		});

	});

	$('#set_password').click(function(){
		update_password();
	});

	function update_password(){
		
		var value = $('#password').val();
		var pass_value = $('#re_password').val();
		$.ajax({
			url: "<?php echo site_url('borrower/checkUpdateRe_Password'); ?>",
			type: "POST",
			data: { password : value,
					re_password : pass_value },
			success : function(result){
				//alert($.trim(result));
				if($.trim(result) == "1"){
					$('#error_updatePassword').html("Invalid re_password");
					//$('#cancel_pword').hide();
				}
				else if($.trim(result)=="2"){
                   $('#error_updatePassword').html("Password and Re_password does not match");
              		//$('#set_password').disabled();
              	}
				else{
					//$('#set_password').show();
					//alert(value);
					$.ajax({
						url: "<?php echo site_url('borrower/updatePassword');?>",
						type: "POST",
						data: {password : value},
						success: function(result){
							//alert($.trim(result));
							if($.trim(result) == "1"){
								$('#cancel_pword').click();
								$("#success_email_update").show();
							    $("#success_email_update").html("Password successfully updated :D");
							    $("#success_email_update").fadeIn('slow');
								setTimeout(function() { $('#success_email_update').fadeOut('slow') }, 3000);
							}
						},
						error: function()
						{
							//alert('error in update');
						}
					});
				}
			},
			error: function()
			{
				//alert('error!!');
			}
		});
	}


	function update_email(){
		var value = $('#email').val();
        $.ajax({
          url: "<?php echo base_url();?>borrower/checkUpdateEmail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="1"){
                   $('#error_update').html("Invalid email");
              }
              else if($.trim(result)=="2"){
                   $('#error_update').html("Email already in use");
              }
              else{

                   $.ajax({
			          url: "<?php echo base_url();?>borrower/updateEmail",
			          type: "POST",
			          data: { email : value },
			          success: function(result){
			              if($.trim(result)=="1"){
			              	 $('#email_label').html(value);
			                 $('#cancel').click();
			                 $("#success_email_update").show();
							 $("#success_email_update").html("Email successfully updated :D");
							 $("#success_email_update").fadeIn('slow');
							 setTimeout(function() { $('#success_email_update').fadeOut('slow') }, 3000);
			              }

			            }
			         });


              }
              
            }
        });
       }


	$('#set_email').click(function(){
		update_email();
	});

	function edit(){										
		var w = document.getElementById('cancel');
		var y = document.getElementById('update_email');
		var z = document.getElementById('set_email');
		y.style.display="none";
		z.style.display="inline";
		w.style.display="inline";
		$("#email").show();
		$("#email_label").hide();
		$("#update_password[type=button]").attr("disabled", "disabled");

	}

	
	function edit_password(){
											
		var w = document.getElementById('password');
		var x = document.getElementById('re_password');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set_password');
		var a = document.getElementById('cancel_pword');
		w.disabled=false;
		x.style.display="inline";
		x.disabled=true;
		y.style.display="none";
		z.style.display="inline";
		z.disabled=true;
		a.style.display="inline";
		//$("#password").show();

		$("#update_email[type=button]").attr("disabled", "disabled");

												
	}
											
	/*function validate(){
											
		var email = document.getElementById('email');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var y = document.getElementById('update_email');
		var w = document.getElementById('cancel');

		if (filter.test(email.value)){
			w.style.display="none";
			y.style.display="inline";
			$("#temp").click();
			alert("Your email has been updated.");	
		}
		else{
			//alert('Please provide a valid email address');
			email.focus;	
		}
											
	}*/


											
	function cancel_email(){
											
		var w = document.getElementById('cancel');
		var y = document.getElementById('update_email');
		var z = document.getElementById('set_email');
		//var emailLabel = document.getElementById('email_label');
		y.style.display="inline";
		z.style.display="none";
		w.style.display="none";
		$("#email").hide();
		$('#error').hide();
		$('#error_update').html("");
		$("#email_label").show();               
		$("#update_password[type=button]").removeAttr("disabled"); 
		}

	function cancel(){
											
		var w = document.getElementById('password');
		var x = document.getElementById('re_password');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set_password');
		var a = document.getElementById('cancel_pword');
		w.disabled=true;
		x.style.display="none";
		//x.disabled=true;
		y.style.display="inline";
		z.style.display="none";
		//z.disabled=true;
		a.style.display="none";
		//$("#password").show();

		$('#error').hide();
		$('#error_update').html("");
		$("#update_email[type=button]").removeAttr("disabled");
		$('#error_updatePassword').html("");

	}

    function passLoadError(){
        if("<?php echo form_error('password'); ?>"!=""){
          $('#error').show();
          $('#update_password').click();
        }
    }

	
	/*									
	function validate_password(){
											
		var w = document.getElementById('password');
		var x = document.getElementById('re_password');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set_password');
		var a = document.getElementById('cancel_pword');
												
		if (w.value!=x.value) {
			alert('Please retype your password.');
			w.focus;
			return false;
		}
		else{
			$('#pass').click();
			alert("Your password has been updated.");
			//z.setAttribute('data-target', '#password_dialog');
		}
	}*/
											
	
									
</script>