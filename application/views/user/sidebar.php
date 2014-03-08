<?php 
	//profile picture
	/*base_url();
	if($this->session->userdata('sex') == 'F'){
		echo "<img src='/icslibsystem/dist/images/female.png' alt='' class='img-rounded img-responsive' />";
	}
	else{
		echo "<img src='/icslibsystem/dist/images/male.png' alt='' class='img-rounded img-responsive' />";
	}*/
?>
<div id = "userInfo">
<center>
<?php 
	base_url();
	if($this->session->userdata('sex') == 'F'){
		echo "<img src='/icslibsystem/dist/images/female.png' alt='' class='img-rounded img-responsive' />";
	}
	else if($this->session->userdata('email')=="fernerick27@gmail.com"){
		echo "<img src='/icslibsystem/dist/images/dev/fred.png' alt='' class='img-rounded img-responsive' />";
	}
	else{
		echo "<img src='/icslibsystem/dist/images/male.png' alt='' class='img-rounded img-responsive' />";
	}

?></center>


<!--information-->
<p style = "text-align: center; font-weight: bold; ">
	<?php echo $this->session->userdata('fname')?> <?php echo $this->session->userdata('mname')?> <?php echo $this->session->userdata('lname')?><br />
	<?php echo $this->session->userdata('idnumber')?><br />
	<?php echo $this->session->userdata('college')?> - <?php echo $this->session->userdata('course')?><br />
</p>
</div>

<div id = "summary">
<!--profile summary-->
<div class="profile_overview"> <hr />
	<!---<h4><u><b>Profile Summary:</b></u></h4>-->
	<ul style = "list-style: none; ">
		<li><b>Overdue books: 
			<span id = "overdue-count">
			<?php
				foreach($overdueCount as $row)
					echo "${row['COUNT(librarymaterial.materialid)']}";
			?> 
			</span>
			</b>
		</li>
					
		<li><b>Borrowed books:
			<span id = "borrowed-count">
			<?php
				foreach($borrowedCount as $row)
					echo "${row['COUNT(librarymaterial.materialid)']}";
			?> 
		</span>
			</b>
		</li>
							
		<li><b>Reserved books:
			<span id = "reserved-count">
			<?php
				foreach($reservedCount as $row)
					echo "${row['resCount']}";
				?> 
			</span>
			</b>
			
		</li>
								
	</ul>	<hr />			
</div> <!--end of profile_overview-->
</div>

<button class="btn collapse-data-btn btn-default" id="manageBtn">Manage account</button>
<button class="btn collapse-data-btn btn-default" id="cancelBtn">Hindi to cancel!</button>

<div id="update" >
	<form>
		<hr />
		<label> Email: </label>
		<input id="email" name="email" type="text" value="<?php echo $this->session->userdata('email'); ?>">&nbsp;
		<label for="email" id ="email-label"><?php echo $this->session->userdata('email'); ?> </label>
		
		<a id="edit-email" value="Update Email" style = "cursor : pointer;" onclick="edit()"> &nbsp; Edit </a>
		<br /><a type="button" class = "btn btn-default" id="set-email" value="Save" style = "cursor : pointer;"> <i class="glyphicon glyphicon-ok"></i>  </a>
		<a type="button" class = "btn btn-default" id="cancel-email" value="Cancel" onclick="cancel_email()" style = "cursor : pointer;"> <i class="glyphicon glyphicon-remove"></i></a>
		
		<hr />
		<label for="pass" id="i-pass"> Password: </label>
		&nbsp;&nbsp;<label for="password" id ="password-label"> <?php echo "*************"; ?> </label>
		<label for="cpass" id="cpass-label">Current Password</label><input id="opassword" name="password" type="password" value=""/><!--not edited -->
		
		<label for="npass" id="npass-label">New Password:</label><input id="npassword" name="npassword" type="password" value=""/>
		<label for="rnpass" id="rnpass-label">Re-type New Password:</label><input id="re-npassword" name="re-password" type="password" value=""/>
		<a id = "edit-password" value="Update Password" onclick="edit_password()" style = "cursor : pointer;"> &nbsp; Edit </a>
		<br /><a type="button" class = "btn btn-default" id="set-password" value="Save" style = "cursor : pointer;" style="font-size:15px;"> <i class="glyphicon glyphicon-ok"></i> </a>
		<a type="button" class = "btn btn-default" id="cancel-password" value="Cancel" onclick="cancel()" style = "cursor : pointer;" style="font-size:15px;"> <i class="glyphicon glyphicon-remove"></i> </a>
		<hr />
	</form>
</div> <!--update account-->



<span id="error_update"> </span>
<span id="error_updatePassword"> </span>

<div id = "success_email_update" class = "alert alert-success">  </div>

<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>

<script>
$('#update').hide();
$('#cancelBtn').hide();

hideEmailEdit();
hidePasswordEdit();

	$('#opassword').blur(function () {
	var opassword = $('#opassword').val();
	var id = "<?php echo $this->session->userdata('idnumber');?>";
	var password;
		$.ajax({
			url: "<?php echo base_url(); ?>borrower/getPassword",
			type: "POST",
			data: {idnumber: id,
					opassword: opassword
				},
			dataType: "JSON",
			success: function(result){
				password = result.password;
				opassword = result.opassword;
				if(opassword == password)
				{
					$('#error_updatePassword').html("");
				}
				else
				{
					$('#error_updatePassword').html("Wrong password");
				}
			},
			error: function() {
				alert('Oops.An error occured.');
			}

		});


	});

$('#npassword').blur(function(){
		var value_pword = $('#npassword').val();
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
				else{
					//var x = document.getElementById('re_password');
					//x.disabled = false;
					$('#error_updatePassword').html("");
				}
			}

		});

	});

	$('#re-npassword').blur(function(){
		var value_pword = $('#npassword').val();
		var value_re_pword = $('#re-npassword').val();
		$.ajax({
			url: "<?php echo base_url(); ?>borrower/checkUpdateRe_Password",
			type: "POST",
			data: {re_password : value_re_pword,
					password: value_pword},
			success: function(result){
				if($.trim(result) == "1"){
					$('#error_updatePassword').html("Passwords do not match.");
					//$('#set_password').disabled();
				}
				/*else if($.trim(result)=="2"){
                   $('#error_updatePassword').html("Password and Re_password does not match");
              		//$('#set_password').disabled();
              	}*/
				else{
					//var z = document.getElementById('set_password');
					//z.disabled=false;
					$('#error_updatePassword').html("");
					//$('#set_password').show();
				}
			}

		});

	});

function hideEmailEdit(){
	$('#set-email').hide();
	$('#cancel-email').hide();
	$('#email').hide();
}

function hidePasswordEdit(){
	$('#set-password').hide();
	$('#cancel-password').hide();
	$('#cpass-label').hide();
	$('#npass-label').hide();
	$('#rnpass-label').hide();
	$('#opassword').hide();
	$('#npassword').hide();
	$('#re-npassword').hide();
}

$('#manageBtn').click( function(){
	$('#summary').slideUp('slow');
	$('#manageBtn').hide();
	$('#update').show();
	$('#cancelBtn').show();
});

$('#cancelBtn').click( function(){
	$('#cancelBtn').hide();
	$('#summary').slideDown('slow');
	$('#manageBtn').show();
	$('#update').hide();
	$('#error_updatePassword').html("");
	$('#error_update').html("");
	$('#cancel-email').click();
	$('#cancel-password').click();
});

$('#edit-email').click( function(){
	$('#edit-email').hide();
	$('#email-label').hide();
	$('#set-email').show();
	$('#cancel-email').show();	
	$('#email').show();
});

$('#edit-password').click( function(){
	$('#edit-password').hide();
	$('#password-label').hide();
	$('#i-pass').hide();
	$('#cpass-label').show();
	$('#npass-label').show();
	$('#rnpass-label').show();
	$('#set-password').show();
	$('#cancel-password').show();	
	$('#opassword').show();
	$('#npassword').show();
	$('#re-npassword').show();
});

$('#set-email').click(function(){
		$('#set-email').hide();
		$('#cancel-email').hide();
		$('#edit-email').show();
		$('#email-label').show();
		$('#email').hide();
});

$('#cancel-email').click(function(){
		$('#set-email').hide();
		$('#cancel-email').hide();
		$('#edit-email').show();
		$('#email-label').show();
		$('#error_updateEmail').html("");
		$('#email').hide();
});

$('#set-password').click(function(){
	var opassword = $('#opassword').val();
	var npassword = $('#npassword').val();
	var re_password = $('#re-npassword').val();
	var id = "<?php echo $this->session->userdata('idnumber');?>";
	
if(npassword == re_password){
	$.ajax({
			url: "<?php echo base_url(); ?>borrower/getPassword",
			type: "POST",
			data: {idnumber: id,
					opassword: opassword
				},
			dataType: "JSON",
			success: function(result){
				password = result.password;
				opassword = result.opassword;
				if(opassword == password)
				{
					$('#error_updatePassword').html("");
					$('#set-password').hide();
					$('#cancel-password').hide();
					$('#i-pass').show();
					$('#password-label').show();
					$('#edit-password').show();
					$('#cpass-label').hide();
					$('#npass-label').hide();
					$('#rnpass-label').hide();
					$('#opassword').hide();
					$('#npassword').hide();
					$('#re-npassword').hide();
						$.ajax({
							url: "<?php echo base_url(); ?>borrower/updatePassword",
							type: "POST",
							data: {password: npassword},
							success: function()
								{
									//var opassword = $('#opassword').val();
									//var npassword = $('#npassword').val();
									//var re_password = $('#re-npassword').val();

									$("#success_email_update").show();
									$("#success_email_update").html("Password successfully changed :D");
									$("#success_email_update").fadeIn('slow');
									setTimeout(function() { $('#success_email_update').fadeOut('slow') }, 3000);
								},
							error: function()
							{
								alert('Oops. An error occured.');
							}
							});
				}

				else
				{
					$('#error_updatePassword').html("Wrong password.");
				}

			},
			error: function() {
				alert('Oops.An error occured.');
			}

		});
}

else
{
		$('#error_updatePassword').html("New password does not match.");
}

	/*if((npassword == re_password) && (cpword == pword))
	{
		$.ajax({
			url: "<?php echo base_url(); ?>borrower/checkUpdateRe_Password",
			type: "POST",
			data: {password: npassword},
			success: function()
			{
				$('#set-password').hide();
				$('#cancel-password').hide();
				$('#i-pass').show();
				$('#password-label').show();
				$('#edit-password').show();
				$('#cpass-label').hide();
				$('#npass-label').hide();
				$('#rnpass-label').hide();
				$('#opassword').hide();
				$('#npassword').hide();
				$('#re-npassword').hide();
				alert('updated password');
			}

		});
	}*/


});

$('#cancel-password').click(function(){
		$('#set-password').hide();
		$('#cancel-password').hide();
		$('#cpass-label').hide();
		$('#npass-label').hide();
		$('#rnpass-label').hide();
		$('#opassword').hide();
		$('#npassword').hide();
		$('#re-npassword').hide();
		$('#i-pass').show();
		$('#password-label').show();
		$('#edit-password').show();
		$('#error_updatePassword').html("");
});

//**** BORROWER ****//

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


	/***********************update password***********************/

	$('#npass-label').blur(function(){
		var value_pword = $('#npass-label').val();
		$.ajax({
			
		});
	});




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
			              	 $('#email-label').html(value);
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


	$('#set-email').click(function(){
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
											
		var w = document.getElementById('npass-label');
		var x = document.getElementById('rnpass-label');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set-password');
		var a = document.getElementById('cancel-password');
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
		var z = document.getElementById('set-email');
		//var emailLabel = document.getElementById('email_label');
		y.style.display="inline";
		z.style.display="none";
		w.style.display="none";
		$("#email").hide();
		$('#error').hide();
		$('#error_update').html("");
		$("#email-label").show();               
		$("#update_password[type=button]").removeAttr("disabled"); 
		}

	function cancel(){
											
		var w = document.getElementById('npass-label');
		var x = document.getElementById('rnpass-label');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set-password');
		var a = document.getElementById('cancel-password');
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


</script>