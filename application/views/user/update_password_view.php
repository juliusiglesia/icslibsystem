<?php echo form_open("borrower/update_password"); ?>
<form id="passForm">
	<i class="glyphicon glyphicon-lock"></i> Password&nbsp;
	<input id="password" name="password" type="password" value="<?php echo $this->session->userdata('password'); ?>" disabled>&nbsp;
	<input id="re_password" name="re_password" type="password" value="" style="display:none;">
	<input type="button" id="update_password" value="Update Password" class="btn btn-primary btn-sm" onclick="edit_password()">
	<input type="button" id="set_password" value="Save" class="btn btn-primary btn-sm" onclick="validate_password()" style="display:none;" data-toggle="modal">
	<input type="button" id="cancel_pword" value="Cancel" class="btn btn-primary btn-sm" onclick="cancel()" style="display:none;">
	<input type="submit" id="pass" value="change">
</form>
<?php echo form_close();?>
<!--To check if the profile has been successfully updated -->

<div class="modal fade" id="password_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title" id="myModalLabel">Update Password</h3>
			</div>
			<div class="modal-body">
			<form class="form-signin" role="form">
				<h4 class="form-signin-heading">Your password has been successfully updated. </h4>						
				</div>
				<div class="modal-footer">
				<input href="#ok" data-dismiss="modal" onclick="" type="submit" value="Done" class="btn btn-primary"/>
			</form>
			</div>
		</div>
	</div>
</div>

<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
<script type="text/javascript">

	$('#pass').hide();
	passSuccess();
	//$("#update_password").disabled;
	


	function passSuccess(){
		if("<?php echo "$passStatus"; ?>"=="TRUE"){
			var z = document.getElementById('set_password');
			z.style.display="none";
			z.setAttribute('data-target','#password_dialog');
		}
	}

	function edit_password(){
												
		var w = document.getElementById('password');
		var x = document.getElementById('re_password');
		var y = document.getElementById('update_password');
		var z = document.getElementById('set_password');
		var a = document.getElementById('cancel_pword');
		w.disabled=false;
		x.style.display="inline";
		y.style.display="none";
		z.style.display="inline";
		a.style.display="inline";
		$("#update_email[type=button]").attr("disabled", "disabled");
												
	}
											
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
			//z.setAttribute('data-target', '#password_dialog');
		}
	}
											
	function cancel(){
											
		var w = document.getElementById('cancel_pword');
		var x = document.getElementById('password');
		var y = document.getElementById('re_password');
		var z = document.getElementById('set_password');
		var a = document.getElementById('update_password');
		w.style.display="none";
		x.disabled=true;
		y.style.display="none";
		z.style.display="none";
		a.style.display="inline";
		$("#update_email[type=button]").removeAttr("disabled"); 
	}
									
</script>