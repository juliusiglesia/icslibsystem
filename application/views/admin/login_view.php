<?php include 'header.php'; ?>  
			
		<div class="container">
			<div class="signin">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="form-signin-heading">Please sign in</h3>
				</div>
				<form id = "login_form" class="form-signin" role="form">
					<input type="email"name = "uname" class="form-control" placeholder="Email address" required autofocus>
					<input type="password" name = "pword" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="button" id = "submit">Sign in</button>
				</form>
			</div>
			<div id = "error_message" class = "alert alert-danger">  </div>
		</div>
		 <script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    
		<script type="text/javascript">
			
			function preventBack(){window.history.forward();}
			window.onunload=function(){null};			
			
			document.getElementById("error_message").style.display='none';
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
						url: "<?php echo base_url();?>admin/check_admin",
						type: "POST",
						dataType: "html",
						data: { uname: username, pword: password },

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
							if ( result != "1" ){  
								$("#error_message").show();
								$("#error_message").html( result );
								$("#error_message").fadeIn('slow');
							
							}
							else {
								window.location.href = "<?php echo site_url('admin/home'); ?>";
							}
						}
					});
			});
		</script>
		<?php include 'footer.php'; ?> 