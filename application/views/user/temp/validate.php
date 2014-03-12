
<?php include 'header.php'; ?> 
		<div id="resendEmailAlertSucceed" class="alert alert-info alert-dismissable" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Check your email inbox.</strong> We've already resent your verification code.
		</div>
		
		<div id="resendEmailAlertFail" class="alert alert-danger alert-dismissable" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Invalid email address.</strong> Please type your email address again.
		</div>

	<div class="container">

	    <div class="signin">
	      <div class="panel panel-info">
	        <div class="panel-heading">
	        	<h3 class="form-signin-heading">Verify your account:</h3>
	        </div>

	         <form>
	         </form>
	        <form class="form-signin" id = "login_form" action="verify_account" role="form" method = "post">
	        	  <input type="email" id="email" class="form-control" placeholder="Email address" value="<?php echo set_value('username');?>" name="email" required autofocus>
		          <input type="text" id="vercode" class="form-control" placeholder="Verification Code" name = "code" required>
				  <a href="#" id="resendEmail" data-toggle="modal" data-target="#myModal">Resend email verification</a>
		          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</form>

	     </div>
   		</div>
	</div>


   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        <span id="error_message"></span>
      </div>
      <form class="form-signin" action="borrower/resendEmail" role="form" method = "post">
      		<?php echo form_open("borrower/resendEmail"); ?>        
	        <div class="modal-body">
			        <input type="email" id="email1" class="form-control" placeholder="Email address" value="" name="email1">    
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <input class="btn btn-primary" id="sub" name="sub" type="button" value="Resend">
	      </div>
	       <?php echo form_close(); ?>
	    </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>dist/js/jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	var flag = 0;
	
	/*$("#submit").click(function(){
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
	*/
	$("#cancel").click(function(){
		flag = 0;
		$("#details").replaceWith('<div id="details" class="modal-body"><input type="email" class="form-control" placeholder="Enter Email address" required autofocus>');
	});
	/*
	$("#done").click(function(){
		flag = 0;
		$("#details").replaceWith('<div id="details" class="modal-body"><input type="email" class="form-control" placeholder="Enter Email address" required autofocus>');
	});
	*/
	
 });
</script>
 
<?php include 'home_footer.php'; ?>  