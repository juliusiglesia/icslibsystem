<?php include 'header.php'; ?>  
  <br />
  <br />

    <div class="signin">
      <div class="panel panel-info">
        <div class="panel-heading"><h3 class="form-signin-heading">Please sign in</h3></div>
        <form class="form-signin" action = "login" role="form" method = "post">
          <input type="email" class="form-control" placeholder="Email address" value="<?php echo set_value('username');?>" name="username" required autofocus>
          <input type="password" class="form-control" placeholder="Password" name = "password"required>
		  <a href="#forgot" id="forgotText" data-toggle="modal"> Forgot password? </a>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
     </div>
   </div>
	
			<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="myModalLabel">Forgot password</h3>
				  </div>
				  <div id="details" class="modal-body"><input type="email" class="form-control" placeholder="Enter Email address" required autofocus>
				  </div>
				  <div  id="modal-footer" class="modal-footer">
					<button class="btn btn-primary" id="submit">Submit</button>
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
				  </div>
				 </div>
				</div>
			</div>
<script src="dist/js/jquery-1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var flag = 0;
	
	$("#submit").click(function(){
		if(flag ==0){
		$("#details").html('<b>Verification code has been sent to your mail.</b><br><br><input type="email" class="form-control" placeholder="Enter verification code" required autofocus>	');
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