<?php echo form_open("borrower/update_email"); ?>
	<form action="borrower/update_email" id="emailForm">
        <div class="row">     		
       		<div id="error" class= "alert alert-danger col-xs-6 col-md-11">
          	<button id="error2" type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
          	<?php echo validation_errors('<p class="error">'); ?>
            </div>
        </div>
		<i class="glyphicon glyphicon-send"></i> Email Address:&nbsp;<input id="email" name="email" type="text" value="<?php echo $this->session->userdata('email'); ?>" disabled>&nbsp;
		<label for="email" id ="email_label"><?php echo $this->session->userdata('email'); ?></label>
		<input type="button" id="update_email" value="Update Email" class="btn btn-primary btn-sm" onclick="edit()">
		<input type="button" id="set_email" value="Save" class="btn btn-primary btn-sm" onclick="validate()" style="display:none;" data-toggle="modal">
		<input type="button" id="cancel" value="Cancel" class="btn btn-primary btn-sm" onclick="cancel_email()" style="display:none;">
		<input type="submit" id="temp" name="temp" value="add">

</form><?php echo form_close(); ?>
	<!--To check if the profile has been successfully updated -->

	<div class="modal fade" id="email_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 class="modal-title" id="myModalLabel">Update Email</h3>
				</div>
				<div class="modal-body">
				  <form class="form-signin" role="form">
				  <h4 class="form-signin-heading">Your email has been successfully updated. </h4>						
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
	$("#email").hide();
	$("#temp").hide();

	emailSuccess();

	loadError();

    function loadError(){
        if("<?php echo "$temp"; ?>"=="FALSE"){
          $('#error').show();
          $('#update_email').click();
          //$("#update_password[type=button]").attr("disabled", "disabled");
        }
        else{
          $('#error').hide();
        }
    }

	function emailSuccess(){
		if("<?php echo "$status"; ?>"=="TRUE"){
			var z = document.getElementById('set_email');
			z.style.display="none";
			z.setAttribute('data-target','#email_dialog');
		}
	}

	function edit(){										
		var w = document.getElementById('cancel');
		var x = document.getElementById('email');
		var y = document.getElementById('update_email');
		var z = document.getElementById('set_email');
		x.disabled=false;
		y.style.display="none";
		z.style.display="inline";
		w.style.display="inline";
		$("#email").show();
		$("#email_label").hide();
		$("#update_password[type=button]").attr("disabled", "disabled");
	}
											
	function validate(){
											
		var email = document.getElementById('email');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var y = document.getElementById('update_email');
		var w = document.getElementById('cancel');

		if (filter.test(email.value)){
			w.style.display="none";
			y.style.display="inline";
			$("#temp").click();
		}
		else{
			alert('Please provide a valid email address');
			email.focus;	
		}
											
	}
											
	function cancel_email(){
											
		var w = document.getElementById('cancel');
		var x = document.getElementById('email');
		var y = document.getElementById('update_email');
		var z = document.getElementById('set_email');
		x.disabled=true;
		y.style.display="inline";
		z.style.display="none";
		w.style.display="none";
		$("#email").hide();
		$("#email_label").show();
		$('#error').hide();
		$("#update_password[type=button]").removeAttr("disabled"); 
		}
											
	</script>