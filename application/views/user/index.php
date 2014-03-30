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
    <link href="<?php echo base_url(); ?>dist/css/modulestyle.css" rel="stylesheet">
    
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
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>dist/images/logo.png" height="70px"></a>
        </div>
        <div class="navbar-collapse collapse">

            <!-- <form class="navbar-form navbar-right" role="form" method="post" action="login"> -->
      <form id = "login_form" class="navbar-form navbar-right" role="form">
                <div class="form-group">
                 <!-- <input placeholder="Email" class="form-control" type="text" value="<?php echo set_value('username');?>" name="username"> -->
                    <input type="text" placeholder="Email/ID Number" class="form-control"  name="uname">
                </div>
                <div class="form-group">
                  <input placeholder="Password" class="form-control" type="password" name="pword">
                </div>
                   <button class="btn btn-primary" type="button" id = "sign_in">Sign in</button>
             <!--   <button type="submit" name="login" class="btn btn-primary">Sign in</button> -->
                
                <p>
                  <a href="<?php echo site_url()?>/borrower/register" name="signup">Create an account</a>
                  <span id="tab"></span>
                  <a href="#forgot" data-toggle="modal"> Forgot password? </a>
                </p>
          </form>

        </div><!--/.navbar-collapse -->
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
          },

          error: function(xhr, textStatus, errorThrown) {
              //$('#error_message').html(textStatus);
          },

          success: function( result ){
            //if username DNE
            if(result == 0 ){/*EDITED*/
              alert('Invalid input for email/idnumber');
              //window.location.href = "<?php echo site_url('forgot_pword/dne'); ?>";
              /*END OF EDITED*/
            }
            //username exists, but pword does not match
            else if(result ==2){
              window.location.href = "<?php echo site_url('forgot_pword/dnm'); ?>";
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

<script type="text/javascript">
  $(document).ready(function()
{   
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
        url: "<?php echo site_url('/borrower/forgot_password');?>",
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
    
  
   <div class="row" id="container">
      <div class="container">
         <center> <img src="<?php echo base_url(); ?>dist/images/banner.png" class="img-responsive"></center>
      </div>
    </div>

    <div class="container marketing" id="fixsize">
    <br/>
      <div class="row">
        <div class="col-lg-4">
          <img id="icons" alt="50x50" src="<?php echo base_url(); ?>dist/images/search.png">
          <h3>Looking for something?</h3>
      <p>Search for materials available in the library.</p>
          <p><a class="btn btn-primary" href="<?php echo site_url();?>/borrower/outside_search" role="button">Search now »</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
                <img id="icons" alt="50x50" src="<?php echo base_url(); ?>/dist/images/clock.png">
                <h3>When can you visit?</h3>
                <p>The library is open from <strong>Monday to Friday, 8am to 12nn and 1pm to 5pm</strong>.</p>
              </div><!-- /.col-lg-4 -->        

        <div class="col-lg-4">
                <img id="icons" alt="50x50" src="<?php echo base_url(); ?>/dist/images/cmp.png">
                <h3>Want to know more?</h3>
                <p>Take a look at the courses the Institute is offering.</p>
          <p><a class="btn btn-primary" href="http://ics.uplb.edu.ph/courses/ugrad" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
        
      </div><!-- /.row -->
      <!-- /END THE FEATURETTES -->

      <footer>
        <center><p id="small">&copy; 2013-2014 CMSC 128 AB-6L. All Rights Reserved. <a href="<?php echo site_url(); ?>/borrower/about_us">About Us</a> 
          | <a href="<?php echo base_url();?>dist/pdf/user/ILS Manual.pdf" target="_blank">Operations Manual</a> 
          | <a href="<?php echo base_url();?>dist/pdf/user/ILS FAQ.pdf" target="_blank">FAQs</a></p>
        </center>
      </footer>
</body></html>