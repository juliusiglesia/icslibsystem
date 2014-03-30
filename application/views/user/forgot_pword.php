<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>dist/images/fav.png">

    <title>ICS-iLS</title>

    <link href="<?php echo base_url(); ?>dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/modulestyle.css" rel="stylesheet">
    
  <style type="text/css" id="holderjs-style"></style></head>

  <script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>dist/js/holder.js"></script>


<!-- NAVBAR
================================================== -->
  <body id="body">
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<<<<<<< HEAD
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>dist/images/logo.png" height="70px"></a>
=======
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>dist/images/logo.png" height="50px" width="165px"></a>
>>>>>>> master
        </div>
      </div>
    </div>
	
	<br /><br />
    <div class="signin">
      <div class="panel panel-info">
        <div class="panel-heading"><h3 class="form-signin-heading">Please sign in</h3></div>
        
        <!-- <form id = "signin" class="form-signin" action = "<?php echo base_url();?>borrower/login/null" role="form" method = "post"> -->
       <!-- <input id = "username" type="text" class="form-control" placeholder="Email address" value="" name="username" required autofocus>
          <input id ="password" type="password" class="form-control" placeholder="Password" name = "password"required> -->

        <form id = "login_form" class="form-signin" role="form">
        <input type="text" placeholder="Email/ID Number" value="<?php echo $this->session->userdata('forgot');?>"  class="form-control"  name="uname" required autofocus>
        <input type="password" placeholder="Password" class="form-control" name="pword" required>
		<a href="#forgot" id="forgotText" data-toggle="modal"> Forgot password? </a>
        <button class="btn btn-lg btn-primary btn-block" type="button" id = "sign_in">Sign in</button>
        </form>
     </div>
 	<div class="alert-container">
		<div id = "failed">  </div>
		<div id = "verified"> </div>
	</div>
   </div>

<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="modal-title" id="myModalLabel">Forgot password<br /></h3>(Please don't close this window unless you're finished)
    </div>
    <div id="details" class="modal-body">	
	<form id = "details_form"><input id = "email" type="email" class="form-control" placeholder="Enter Email address" required autofocus></form>
    </div>
    <div  id="modal-footer" class="modal-footer">
	<div id='err'></div><button class="btn btn-primary" id="submit">Submit</button>
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
    </div>
   </div>
  </div>
</div>
			</div>
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>

<!-- 7:00am update -->
<script type="text/javascript">
    
      $("#login_form").keypress(function(event){
        if(event.keyCode == 13){
          event.preventDefault();
          $("#sign_in").click();
        }
      });
      
      $("#sign_in").click( function(){

		  username = $("#login_form").find("input[name='uname']").val();
		  password = $("#login_form").find("input[name='pword']").val();

		  $.ajax({
			  url: "<?php echo site_url();?>/borrower/check_user",
			  type: "POST",
			  dataType: "html",
			  data: { email: username, pword: password },

			  beforeSend: function() {
				$("#failed").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
			  },

			  error: function(xhr, textStatus, errorThrown) {
				 // $('#verified').html(textStatus);
			  },

			  success: function( result ){
				//if username DNE
				if(result == 0 ){
				  displayError('dne');
				}
				//username exists, but pword does not match
				else if(result ==2){
				  displayError('dnm');
				}
				//username is deactivated
				else if(result == 3){
					window.location.href = "<?php echo site_url('forgot_pword/deactivated'); ?>";
				  }
				//if username and password exists
				else {
				  window.location.href = "<?php echo site_url('borrower/home'); ?>";
				}
			  }

		  });
      });
    </script>
<!-- 7:00am update -->


<script type="text/javascript">
	function displayError(message){
		var finmessage;
		if(message == 'verified'){
			$("#verified").addClass("alert alert-success");
			$("#verified").show();
			$("#verified").html("Your acount is successfully activated.");
			$("#verified").fadeIn('slow');
		}
		else{
			if(message == 'done') finmessage = "Your acount is already activated.";
			else if(message =='dne') finmessage = "Your account does not exist.";
			else if(message = 'dnm') finmessage = "Password does not match username.";
			$("#verfied").hide();
			$("#failed").addClass("alert alert-danger");
			$("#failed").show();
			$("#failed").html(finmessage);
			$("#failed").fadeIn('slow');
			setTimeout(function() { $('#failed').fadeOut('slow') }, 5000);
		}
	};


	function showBootBox(){
       bootbox.dialog({
          message: "Your account is <strong>not yet activated</strong>.",
          title: "Acount Deactivated",
		  onEscape: function() {},
          buttons:{
          	yes:{
          	label: "Resend verification.",
          	className: "btn-primary",
          	callback: function() {
          		//title: "Verification sent."
          		//message: "Verification has been resent to your email."

          		var email = <?php echo "'$email'"; ?>;
          		var idnumber = <?php echo "'$idnumber'"; ?>;
          		var password = <?php echo "'$password'"; ?>;
          		$.ajax({
						type: "POST",
						url: "<?php echo site_url('borrower/resend_mail');?>",
						data: {email: email, 
								idnumber: idnumber,
								password: password},
								
						beforeSend: function() {
							$("#verfied").show();
							$("#verified").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
						},
						success: function(result)
						{
							if(result == "sent"){
								$("#verified").addClass("alert alert-success"); 
								$("#verified").html("Verification has been sent to your email.");
								$("#verified").fadeIn('slow');
							}
							else{
								$("#verified").hide();
								$("#failed").addClass("alert alert-danger");
								$("#failed").show();
								$("#failed").html("Connection error. Please try again.");
								$("#failed").fadeIn('slow');
							}
						},
						error: function()
						{
							$("#failed").addClass("alert alert-danger");
							$("#failed").show();
							$("#failed").html("An error has occured. Please try again.");
							$("#failed").fadeIn('slow');
						}
				});
          	}
          	},
            no: {
            label: "Cancel",
            className: "btn-default"
            }
           }
        });

	};

 $(document).ready(function(){   
  var flag = 0;
  var email;
  var verf_code;

	$('#forgot').on('hidden.bs.modal',function(e){
		flag=0;
		$("#details").replaceWith('<div id="details" class="modal-body"><input id="email" type="email" class="form-control" placeholder="Enter Email address" required autofocus>');
		$("#err").hide();
	});


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
		beforeSend: function (){
			$("#err").removeClass('alert alert-danger');
			$("#err").html("<img src='<?php echo base_url();?>dist/images/ajax-loader.gif' />");
		},		
        success: function(data) 
        {
            if(data.stat == 'success')
            {
			  $("#err").html("");
              $("#details").html('<b>'+data.message+'.</b><br><br><form id = "details_form"><input id = "code_input" type="email" class="form-control" placeholder="Enter verification code" required autofocus></form> ');
              verf_code = data.verf_code;
              flag = 1;
            }
			else if(data.stat =='failed')
			{
				$("#err").show();
				$("#err").addClass('alert alert-danger');
				$("#err").html(data.message);
				flag = 0;
			}
            else
            {
				$("#err").show();
				$("#err").addClass('alert alert-danger');
				$("#err").html(data.message);
				flag = 0;
                
            }
        },
        error: function(xhr, data, errorThrown)
        {	
			
			$("#err").show();
			$("#err").addClass('alert alert-danger');
			$("#err").html("An error occurred.");
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
		  beforeSend: function (){
			$("#err").removeClass('alert alert-danger');
			$("#err").html("<img src='<?php echo base_url();?>dist/images/ajax-loader.gif' />");
		  },
          success: function(data)
          {
              if(data.stat == 'success')
              {
				$("#err").html("");
                $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
                flag = 2; 
              }
              else
              {
				$("#err").show();
				$("#err").addClass('alert alert-danger');
				$("#err").html("Code denied.");
                $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "code_input" class="form-control" placeholder="Enter verification code" required autofocus></form>');
                flag = 1;
              }
          },

          error: function()
          {
            $("#err").show();
			$("#err").addClass('alert alert-danger');
			$("#err").html("An error has occured.");
          }

        });
        
    }

    else if(flag == 2){ //change password
      var new_password = $("#new_password").val();
      var retype_new_pw = $("#retype_new_pw").val();
      
        if(new_password == retype_new_pw)
        {
		
		if( new_password.length > 6){
		
			  $.ajax({
				url: "<?php echo site_url('borrower/forgot_password');?>",
				type: "POST",
				data: {'new_password': new_password,
					'retype_new_pw': retype_new_pw,
					'email': email,
					'action': 'change_pw'

				},
				dataType: "JSON",
				beforeSend: function (){
				$("#err").removeClass('alert alert-danger');
				$("#err").html("<img src='<?php echo base_url();?>dist/images/ajax-loader.gif' />");
				},		
				success: function(data)
				{
					if(data.stat == 'success')
					{$("#err").html("");
						$('#details').html('<b>'+data.message+'</b>');
						$("#modal-footer").html('<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="done">Done</button>'); 
					}
					else
					{$("#err").html("");
					  $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
					  flag = 2;
					}
				},
				error: function()
				{
					$("#err").show();
					$("#err").addClass('alert alert-danger');
					$("#err").html("An error has occured.");
				}
			  });
			}
		//password <6 character
		else{
			$("#err").show();
			$("#err").addClass('alert alert-danger');
			$("#err").html("Invalid password.");
			$("#details").html('<b>Password must be at least 6 characters</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
			flag = 2;
		}
			
        }
		//password don't match
        else
        {
			$("#err").show();
			$("#err").addClass('alert alert-danger');
			$("#err").html("Invalid password.");
			$("#details").html('<b>Passwords must match</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
			flag = 2;
        }
    }
  });
 });
</script>
	<?php
		if($message != 'null' || !isset($message)){
			if($message == 'verified'){
				echo "<script type='text/javascript'>displayError(";
				echo "'verified'";
				echo ")</script>";
			}else if($message == 'done' || $message =='dne' ||  $message =='dnm'){
				echo "<script type='text/javascript'>displayError(";
				echo "'$message'";
				echo ")</script>";
			}
			else if($message=='deactivated'){
				echo "<script type='text/javascript'>showBootBox()";
				echo "</script>";
			}
		}
	?>

<?php include 'home_footer.php'; ?>