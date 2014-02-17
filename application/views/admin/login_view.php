<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

		<title>ICS-iLS</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
		<style type="text/css" id="holderjs-style"></style>
	</head>

  <body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>dist/images/logowhite.png" height="30px"></a>
				</div>
			</div>
		</div>
		<div id = "response-message"> </div>
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
			</div>

		<!-- FOOTER -->
			<div class = "container marketing" >
				<footer>
					<p class="pull-right"><a href="#"> Back to Top </a></p>
					<p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
				</footer>
			</div><!-- /.container -->
		</div>
		
		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
    
		<script type="text/javascript">
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
							$("#response-message").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong> Loading </strong></div>");
							$("#response-message").fadeIn('slow');
						},

						error: function(xhr, textStatus, errorThrown) {
							$("#response-message").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><span>" + textStatus + "</span></div>");
							$("#response-message").fadeIn('slow');
						},

						success: function( result ){
							if ( result != "1" ){  
								$("#response-message").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error logging in!</strong> <span>" + result + "</span></div>");
								$("#response-message").fadeIn('slow');
							}
							else {
								window.location.href = "<?php echo site_url('admin/home'); ?>";
							}
						}
					});
			});
		</script>
	</body>
</html>