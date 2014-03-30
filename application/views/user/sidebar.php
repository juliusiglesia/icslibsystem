<div id = "userInfo">
<center>
<?php 
	if($this->session->userdata('sex') == 'F'){
		echo "<img src='";
		echo base_url();
		echo "dist/images/female.png' alt='' class='img-rounded img-responsive' />";
	}
	else{
		echo "<img src='";
		echo base_url();
		echo "dist/images/male.png' alt='' class='img-rounded img-responsive' />";
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
<div class="profile_overview"> 

	<center>
	<br/>Material Inventory
	<hr/>
	<table cellpadding="2">
		<tr>
			<b>
			<td>Overdue materials &nbsp;</td>
			<td id="overdueCount"><?php
				foreach($overdueCount as $row)
					echo " ${row['COUNT(librarymaterial.materialid)']}";
			?> 
			</td>
			</b>
		<tr>			
		<tr>
			<b>
			<td>Borrowed materials &nbsp;</td>
			<td id="borrowedCount"><?php
				foreach($borrowedCount as $row)
					echo " ${row['COUNT(librarymaterial.materialid)']}";
			?> 
			</td>
			</b>
		</tr>
		<tr>
			<b>
			<td>Reserved materials &nbsp;</td>
			<td id="reservedCount"><?php
				foreach($reservedCount as $row)
					echo " ${row['resCount']}";
				?> 
			</td>
			</b>
		</tr>
	</table>
	</center>
	<hr />			
</div> <!--end of profile_overview-->
</div>

<center>
<button class="btn collapse-data-btn " id="manageBtn" class="button-color">Manage account</button>
</center>

<div id="update" >
	<form>
		<div id = "success_email_update" class = "alert alert-success"></div>
		<div id="error_update" class = "alert alert-danger"> </div>
		<div id="error_updatePassword" class = "alert alert-danger"> </div>
		<hr />
		<table>
		<tr>
			<td><label> Email: </label></td>
			<td><input id="email" name="email" type="text" value="<?php echo $this->session->userdata('email'); ?>">&nbsp;
			<label for="email" id ="email-label"><?php echo $this->session->userdata('email'); ?> </label></td>
		</tr>
		<tr>
			<td><label for="epass" id="epass-label">Current Password</label></td>
			<td><input id="epassword" name="password" type="password" value=""/></td>
		</tr>
		</table>

		
		<a id="edit-email" value="Update Email" style = "cursor : pointer;" onclick="edit()"> &nbsp; Edit </a>
		<br /><a type="button" class = "btn btn-default" id="set-email" value="Save" style = "cursor : pointer;"> <i class="glyphicon glyphicon-ok"></i>  </a>
		<a type="button" class = "btn btn-default" id="cancel-email" value="Cancel" onclick="cancel_email()" style = "cursor : pointer;"> <i class="glyphicon glyphicon-remove"></i></a>
		
		<hr />
		
			<label for="pass" id="i-pass"> Password: </label>
			&nbsp;&nbsp;<label for="password" id ="password-label"> <?php echo "*************"; ?> </label>
			<a id = "edit-password" value="Update Password" onclick="edit_password()" style = "cursor : pointer;"> Edit </a>
		<table>
		<tr>
			<td><label for="cpass" id="cpass-label">Current Password</label></td>
			<td><input id="opassword" name="password" type="password" value=""/></td>
		</tr>
		<tr>
			<td><label for="npass" id="npass-label">New Password:</label></td>
			<td><input id="npassword" name="npassword" type="password" value=""/></td>
		</tr>
		<tr>
			<td><label for="rnpass" id="rnpass-label">Re-type New Password:</label></td>
			<td><input id="re-npassword" name="re-password" type="password" value=""/></td>
		</tr>
		</table>
		
		<br /><a type="button" class = "btn btn-default" id="set-password" value="Save" style = "cursor : pointer;" style="font-size:15px;"> <i class="glyphicon glyphicon-ok"></i> </a>
		<a type="button" class = "btn btn-default" id="cancel-password" value="Cancel" onclick="cancel()" style = "cursor : pointer;" style="font-size:15px;"> <i class="glyphicon glyphicon-remove"></i> </a>

		<hr />
	</form>
</div> <!--update account-->

<center><button class="btn collapse-data-btn btn-default" id="cancelBtn">Cancel</button></center>


<div id = "alert_update" class = "alert alert-danger">  </div>


<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>

<script>
$('#update').hide();
$('#cancelBtn').hide();
$('#alert_update').hide();
$("#error_update").hide();
$('#error_updatePassword').hide();
$("#epass-label").hide();
$('#epassword').hide();

hideEmailEdit();
hidePasswordEdit();
var flag = false;
var flagMail = false;

	$('#opassword').blur(function () {
	var opassword = $('#opassword').val();
	var id = "<?php echo $this->session->userdata('idnumber');?>";
	var password;
		$.ajax({
			url: "<?php echo site_url(); ?>/borrower/getPassword",
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
					$("#error_updatePassword").show();
					$('#error_updatePassword').html("Wrong Password");
					$("#error_updatePassword").fadeIn('slow');
					setTimeout(function() { $('#error_updatePassword').fadeOut('slow') }, 3000);
				}
			},
			error: function() {
				$("#alert_update").show();
				$('#alert_update').html("Oops.An error occured.");
				$("#alert_update").fadeIn('slow');
				setTimeout(function() { $('#alert_update').fadeOut('slow') }, 3000);
			}
		});
	});

	$('#epassword').blur(function (){
	var epassword = $('#epassword').val();
	var id = "<?php echo $this->session->userdata('idnumber');?>";
	var password;
		$.ajax({
			url: "<?php echo site_url(); ?>/borrower/getPasswordForEmail",
			type: "POST",
			data: {idnumber: id,
					epassword: epassword
				},
			dataType: "JSON",
			success: function(result){
				password = result.password;
				epassword = result.epassword;
				if(epassword == password)
				{
					$('#error_update').html("");
					flag = true;
				}
				else
				{
					flag = false;
					$("#error_update").show();
					$('#error_update').html("Wrong Password");
					$("#error_update").fadeIn('slow');
					setTimeout(function() { $('#error_update').fadeOut('slow') }, 3000);
				}
			},
			error: function() {
				flag = false;
				$("#alert_update").show();
				$('#alert_update').html("Oops.An error occured.");
				$("#alert_update").fadeIn('slow');
				setTimeout(function() { $('#alert_update').fadeOut('slow') }, 3000);
			}
		});
	});





	$('#npassword').blur(function(){
		var value_pword = $('#npassword').val();
		$.ajax({
			url: "<?php echo site_url(); ?>/borrower/checkUpdatePassword",
			type: "POST",
			data: {password : value_pword},
			success: function(result){
				if($.trim(result) == "1"){
					$("#error_updatePassword").show();
					$('#error_updatePassword').html("Invalid Password");
					$("#error_updatePassword").fadeIn('slow');
					setTimeout(function() { $('#error_updatePassword').fadeOut('slow') }, 3000);
				}
				else{
					$('#error_updatePassword').html("");
				}
			}

		});

	});

	$('#re-npassword').blur(function(){
		var value_pword = $('#npassword').val();
		var value_re_pword = $('#re-npassword').val();
		$.ajax({
			url: "<?php echo site_url(); ?>/borrower/checkUpdateRe_Password",
			type: "POST",
			data: {re_password : value_re_pword,
					password: value_pword},
			success: function(result){
				if($.trim(result) == "1"){
					//$('#error_updatePassword').html("Passwords do not match.");
					$("#error_updatePassword").show();
					$('#error_updatePassword').html("Passwords do not match");
					$("#error_updatePassword").fadeIn('slow');
					setTimeout(function() { $('#error_updatePassword').fadeOut('slow') }, 3000);
				}
				else{
					$('#error_updatePassword').html("");
				}
			}
		});

	});

function hideEmailEdit(){
	$('#set-email').hide();
	$('#cancel-email').hide();
	$('#email').hide();
	$("#epass-label").hide();
	$('#epassword').val("");
	$('#epassword').hide();
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
	$('#set-email').hide();
	$('#cancel-email').hide();
	$('#edit-email').show();
	$('#email-label').show();
	$('#error_updateEmail').html("");
	$('#email').hide();
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
	$('#opassword').val("");
	$('#npassword').val("");
	$('#re-npassword').val("");
	$('#email').val("<?php echo $this->session->userdata('email'); ?>");
	$("#epass-label").hide();
	$('#epassword').hide();
	$('#epassword').val("");
});

$('#edit-email').click( function(){
	$('#edit-email').hide();
	$('#email-label').hide();
	$('#set-email').show();
	$('#cancel-email').show();	
	$('#email').show();
	$('#error_update').html("");
	$("#epass-label").show();
	$('#epassword').show();
	$('#email').focus();
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
	$('#error_updatePassword').html("");
});


$('#cancel-email').click(function(){
		$('#set-email').hide();
		$('#cancel-email').hide();
		$('#edit-email').show();
		$('#email-label').show();
		$('#error_updateEmail').html("");
		$('#email').hide();
		$('#email').val("<?php echo $this->session->userdata('email'); ?>");
		$("#epass-label").hide();
		$('#epassword').val("");
		$('#epassword').hide();
});

$('#set-password').click(function(){
	var opassword = $('#opassword').val();
	var npassword = $('#npassword').val();
	var re_password = $('#re-npassword').val();
	var id = "<?php echo $this->session->userdata('idnumber');?>";
	
if(npassword == re_password){
	$.ajax({
			url: "<?php echo site_url(); ?>/borrower/getPassword",
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
							url: "<?php echo site_url(); ?>/borrower/updatePassword",
							type: "POST",
							data: {password: npassword},
							success: function()
								{
									$("#success_email_update").show();
									$("#success_email_update").html("Password successfully changed :D");
									$("#success_email_update").fadeIn('slow');
									setTimeout(function() { $('#success_email_update').fadeOut('slow') }, 3000);
								},
							error: function()
							{
									$("#alert_update").show();
									$('#alert_update').html("Oops.An error occured.");
									$("#alert_update").fadeIn('slow');
									setTimeout(function() { $('#alert_update').fadeOut('slow') }, 3000);
							}
							});
				}

				else
				{
					//$('#error_updatePassword').html("Wrong password.");
					$("#error_updatePassword").show();
					$('#error_updatePassword').html("Wrong password.");
					$("#error_updatePassword").fadeIn('slow');
					setTimeout(function() { $('#error_updatePassword').fadeOut('slow') }, 3000);
				}

			},
			error: function() {
				$("#alert_update").show();
				$('#alert_update').html("Oops.An error occured.");
				$("#alert_update").fadeIn('slow');
				setTimeout(function() { $('#alert_update').fadeOut('slow') }, 3000);
			}

		});
}

else
{
	$("#error_updatePassword").show();
	$('#error_updatePassword').html("New password does not match.");
	$("#error_updatePassword").fadeIn('slow');
	setTimeout(function() { $('#error_updatePassword').fadeOut('slow') }, 3000);
}

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
		$('#opassword').val("");
		$('#npassword').val("");
		$('#re-npassword').val("");
});

//**** BORROWER ****//

	$("#email").hide();
	$("#temp").hide();

	$('#success_email_update').hide();
	
	$('#pass').hide();


	$('#email').blur(function(){
		var value = $('#email').val();
        $.ajax({
          url: "<?php echo site_url();?>/borrower/checkUpdateEmail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="1"){
                flagMail = false;
                $("#error_update").show();
				$('#error_update').html("Oops.An error occured.");
				$("#error_update").fadeIn('slow');
				setTimeout(function() { $('#error_update').fadeOut('slow') }, 3000);
              }
              else if($.trim(result)=="2"){
                flagMail = false;
                $("#error_update").show();
				$('#error_update').html("Email already in use");
				$("#error_update").fadeIn('slow');
				setTimeout(function() { $('#error_update').fadeOut('slow') }, 3000);
              }
              else if($.trim(result)=="0"){
              	flagMail = true;
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
          url: "<?php echo site_url();?>/borrower/checkUpdateEmail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="1"){
                   $("#error_update").show();
				   $('#error_update').html("Invalid Email");
				   $("#error_updateord").fadeIn('slow');
					setTimeout(function() { $('#error_update').fadeOut('slow') }, 3000);
              }
              else if($.trim(result)=="2"){
                   $("#error_update").show();
				   $('#error_update').html("Email already in use");
				   $("#error_update").fadeIn('slow');
				   setTimeout(function() { $('#error_update').fadeOut('slow') }, 3000);
              }
              else{
                   $.ajax({
			          url: "<?php echo site_url();?>/borrower/updateEmail",
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
		if(flag && flagMail){
			update_email();
			$('#set-email').hide();
			$('#cancel-email').hide();
			$('#edit-email').show();
			$('#email-label').show();
			$('#email').hide();
			$("#epass-label").hide();
			$('#epassword').hide();
			$('#epassword').val("");
		}
		else{

		}
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

		$("#update_email[type=button]").attr("disabled", "disabled");

												
	}

											
	function cancel_email(){
											
		var w = document.getElementById('cancel');
		var y = document.getElementById('update_email');
		var z = document.getElementById('set-email');

		y.style.display="inline";
		z.style.display="none";
		w.style.display="none";
		$("#email").hide();
		$('#error').hide();
		$('#error_update').html("");
		$("#email-label").show();               
		}

	function cancel(){
											
		var w = document.getElementById('npass-label');
		var x = document.getElementById('rnpass-label');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set-password');
		var a = document.getElementById('cancel-password');
		w.disabled=true;
		x.style.display="none";
		y.style.display="inline";
		z.style.display="none";
		a.style.display="none";

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