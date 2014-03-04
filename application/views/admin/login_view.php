<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="<?php echo base_url();?>dist/images/favicon.png">

	<title>ICS-iLS</title>

	<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/date_picker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet" /> <!--for chart -->

	<style type="text/css" id="holderjs-style"></style></head>

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
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="30px"></a>
                </div>
				<!--<div class="alert alert-success" id="returned">
					<a href="#" class="close" data-dismiss="alert" id="boton_cerrar">&times;</a> 
					<strong>Successfully returned material!</strong>     
				</div>-->
                <form class="navbar-form navbar-right" role="form">
                    <!-- Split button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default" data-toggle="dropdown">
					<span class="glyphicon glyphicon-cog"></span>
				  </button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
                  </ul>
                </div>
                </form>

            </div>
        </div>
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
			<div id = "error_message" class = "alert alert-danger">  </div>
			<center><div style="display:none" id="dvloader"><img src="<?php echo base_url();?>dist/images/ajax-loader.gif" /></div></center>
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
							$("#error_message").html("Loading...");
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
								$("#dvloader").show();
								window.location.href = "<?php echo site_url('admin/home'); ?>";
							}
						}
					});
			});
		</script>
		<?php include 'footer.php'; ?>  