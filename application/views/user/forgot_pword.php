<?php include 'header.php'; ?>  
  <br />
  <br />

    <div class="signin">
      <div class="panel panel-info">
        <div class="panel-heading"><h3 class="form-signin-heading">Please sign in</h3></div>
        <form id = "signin" class="form-signin" action = "login" role="form" method = "post">
          <input id = "username" type="text" class="form-control" placeholder="Email address" value="<?php echo set_value('username');?>" name="username" required autofocus>
          <input id ="password" type="password" class="form-control" placeholder="Password" name = "password"required>
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
				  <div id="details" class="modal-body"><form id = "details_form"><input id = "email" type="email" class="form-control" placeholder="Enter Email address" required autofocus></form>
				  </div>
				  <div  id="modal-footer" class="modal-footer">
					<button class="btn btn-primary" id="submit">Submit</button>
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
				  </div>
				 </div>
				</div>
			</div>
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{		
	var flag = 0;
	var email;
	var verf_code;	
	
	$("#submit").click(function(){

		if(flag ==0)
		{ //email verification
			email = $("#email").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('borrower/forgot_password');?>",
				data: {'email':email,
					   'action': 'verify_email'
					  },
				dataType: "JSON",
				success: function(data) 
				{
					
						if(data.stat == 'success')
						{
							$("#details").html('<b>'+data.message+'.</b><br><br><form id = "details_form"><input id = "code_input" type="email" class="form-control" placeholder="Enter verification code" required autofocus></form>	');
							verf_code = data.verf_code;
							flag = 1;

						}
						else
						{
							$("#details").html('<b>'+data.message+' ' +data.stat+'.</b><br><br><form id = "details_form"><input id = "email" type="email" class="form-control" placeholder="Enter Email address" required autofocus></form>	');
							flag = 0;
								
						}
				},
				error: function()
				{
					alert('Error!');
				}

			});


		}

		else if(flag == 1)
		{  //code verification
			var code_input = $("#code_input").val();
				$.ajax({
					url:"<?php echo site_url('borrower/forgot_password');?>",
					type: "POST",
					data: {'code_input':code_input,
							'verf_code': verf_code,
							'action': 'verify_code'
						  },
					dataType: "JSON",
					success: function(data)
					{
							if(data.stat == 'success')
							{
								$("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
								flag = 2;	
							}
							else
							{
								$("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "code_input" class="form-control" placeholder="Enter verification code" required autofocus></form>');
								flag = 1;
							}
					},

					error: function()
					{
						alert('Ooops. Error.');
					}

				});
				
		}

		else if(flag == 2){ //change password
			var new_password = $("#new_password").val();
			var retype_new_pw = $("#retype_new_pw").val();
			
				if(new_password == retype_new_pw)
				{
					$.ajax({
						url: "<?php echo site_url('borrower/forgot_password');?>",
						type: "POST",
						data: {'new_password': new_password,
								'retype_new_pw': retype_new_pw,
								'email': email,
								'action': 'change_pw'

						},
						dataType: "JSON",
						success: function(data)
						{
								if(data.stat == 'success')
								{
										$('#details').html('<b>'+data.message+'</b>');
										$("#modal-footer").html('<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="done">Done</button>');	
								}
								else
								{
									$("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
									flag = 2;
								}
						},
						error: function()
						{
							alert('Please try again.');
						}
					});
				}

				else
				{
					$("#details").html('<b>Passwords must match</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
					flag = 2;
				}
			
			
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