<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>
	
	<body>
		<div class="container">
			<div class="signin">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="form-signin-heading">Please sign in</h3>
				</div>
				<form id = "login_form" class="form-signin" role="form">
					<input type="email"name = "uname" class="form-control" placeholder="Username" required autofocus>
					<input type="password" name = "pword" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="button" id = "submit">Sign in</button>
				</form>
			</div>
			<div id = "message">  </div>
		</div>
		
		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>

		<script type="text/javascript">
			
			$("#login_form").keypress(function(event){
				if(event.keyCode == 13){
					event.preventDefault();
					$("#submit").click();
				}
			});
			
			$("#submit").click( function(){				
				username = $("#login_form").find("input[name='uname']").val();
				password = $("#login_form").find("input[name='pword']").val();

				$.ajax({
						url: "<?php echo site_url();?>/admin/check_admin",
						type: "POST",
						dataType: "html",
						data: { uname: username, pword: password },

						beforeSend: function() {
							$("#message").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
						},

						error: function(xhr, textStatus, errorThrown) {
							$('#message').html(textStatus);
						},

						success: function( result ){
							if ( result != "1" ){  
								$("#message").addClass("alert alert-danger");
								$("#message").html( result );
								$("#message").fadeIn('slow');							
							}
							else {
								window.location.href = "<?php echo site_url();?>/admin/home";
							}
						}
					});
			});
		</script>
		
	</body>
</html> 