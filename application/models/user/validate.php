<?php include 'header.php'; ?> 
		<div id="resendEmailAlertSucceed" class="alert alert-info alert-dismissable" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Check your email inbox.</strong> We've already resent your verification code.
		</div>
		
		<div id="resendEmailAlertFail" class="alert alert-danger alert-dismissable" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Invalid email address.</strong> Please type your email address again.
		</div>

    <div class="signin">
      <div class="panel panel-info">
        <div class="panel-heading"><h3 class="form-signin-heading">Verify your account:</h3></div>
		
		 <?php echo form_open("borrower/verify_account"); ?>
        <form class="form-signin" action="borrower/verify_account" role="form" method = "post">
          <input type="email" id="email" class="form-control" placeholder="Email address" value="<?php echo set_value('username');?>" name="email" required autofocus>
          <input type="text" id="vercode" class="form-control" placeholder="Verification Code" name = "code" required>
		  <a href="#" id="resendEmail" onclick="resendEmailFxn()">Resend email verification</a>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>
        <?php echo form_close(); ?>
     </div>
   </div>
<script src="<?php echo base_url(); ?>dist/js/jquery-1.js"></script>
<script type="text/javascript">
function resendEmailFxn(){

	var x = document.getElementById("email");
	var y = document.getElementById("resendEmail");
	var z = document.getElementById("resendEmailAlertFail");
	var a = document.getElementById("resendEmailAlertSucceed");
	
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (filter.test(x.value)){
		a.style.display = "block";
	}
	else{
		z.style.display = "block";
		x.focus;	
	}

}

$(document).ready(function(){
	var flag = 0;
	
	$("#submit").click(function(){
		if(flag ==0){
		$("#details").html('<b>Verification code has been resent to your mail.</b><br><br><input type="email" class="form-control" placeholder="Enter verification code" required autofocus>	');
		flag = 1;
		}
		else if(flag ==1){
		flag = 2;
		$("#details").html('<b>Verification code accepted</b><br><br><input type="password" class="form-control" placeholder="New Password" required><br><input type="password" class="form-control" placeholder="Verify New Password" required>');
		}
		else{
		$("#details").html('Your password has been reset. Please do not forget it again.');
		$("#modal-footer").html('<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="done">Done</button>');
		}
	});
	
	$("#cancel").click(function(){
		flag = 0;
		$("#details").replaceWith('<div id="details" class="modal-body"><input type="email" class="form-control" placeholder="Enter Email address" required autofocus>');
	});
	
	$("#done").click(function(){
		flag = 0;
		$("#details").replaceWith('<div id="details" class="modal-body"><input type="email" class="form-control" placeholder="Enter Email address" required autofocus>');
	});
	
 });
</script>
 
<?php include 'home_footer.php'; ?>  