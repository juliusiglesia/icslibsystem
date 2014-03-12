<?php include 'home_header.php'; ?>   
<!-- START OF SIGN UP -->
<div class="container">
    <div class="row">
              INSERT SOMETHING HERE
        <div></div>
        <div class = "col-xs-12 col-sm-6 col-md-8">
          <img src='<?php echo base_url(); ?>dist/images/side.png' alt = '' width = "500" height = "500">
        </div>
       <div class="col-xs-6 col-md-4"><br/><br/><br/>
          <legend><center><a href="#"><i class="glyphicon glyphicon-globe"></i></a> Sign up!</center></legend>

          <form action="<?php echo site_url()?>/registration" method="post" class="form" role="form">

          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
               <div class="form-group">
                    <div class="col-sm-4">
                      <label for="idnumber"> ID Number </label> 
                    </div>
                  <div class="col-sm-8">
                    <input class="form-control" name="idnumber" id="idnumber" value="<?php echo set_value('idnumber');?>" type="text" required />
                     <div class="error-space">
                       <span id="error_message" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="email"> Email </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input class="form-control" name="email" id="emailid" value="<?php echo set_value('email');?>" type="email" required>
                     <div class="error-space">
                       <span id="error_message1" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="password"> Password </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input class="form-control" name="password" id="password" type="password"/>
                     <div class="error-space">
                       <span id="error_message2" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class = "row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="password_conf"> Re-enter password </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input class="form-control" name="password_conf" id="password_conf" onblur="validatePassword()" type="password"/>
                     <div class="error-space">
                       <span id="error_message3" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
      <div id="reg"></div>
          <div class = "row"><br/>
             <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                    </div>
                  <div class="col-sm-8">
                    <button class="btn btn-lg btn-primary" id="sign_up" type="button" > Sign up</button>
                  </div>
              </div>
            </div>
          </div>      
        </div>
    </div>
</div>
         <!-- END OF SIGN UP -->
<hr class="featurette-divider">
  <script src="<?php echo base_url(); ?>dist/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>dist/js/bootbox.min.js"></script>
  <link href="<?php echo base_url(); ?>dist/css/signup.css" rel="stylesheet">
  <script>

  $('#add').hide();
  var flagId = false;
  var flagEmail = false;
  var flagValidate = false;
  var flagPass = false;


    $('#idnumber').blur( check_idnumber );

    $('#emailid').blur( check_email );

    $('#password').blur( check_password);

   function validatePassword(){  
      var password = document.getElementById('password').value;
      var password_conf = document.getElementById('password_conf').value;
    
    if(password == password_conf){
      $('#error_message3').html("");
      flagValidate =  true;
      }else{
      $('#error_message3').html("Password does not match. Check passwords");
      flagValidate =  false;
      password_conf.focus;
    }
    }

    function check_password(){
      var password = $('#password').val();

      $.ajax({
        url: "<?php echo site_url();?>/borrower/checkpassword",
        type: "POST",
        data: { password : password},

        success: function(result){
          if($.trim(result)=="1"){
         $('#error_message2').html("Password length must be atleast 6 characters");
               flagPass =  false;
         validatePassword();
            }
          else{
             $('#error_message2').html("");
             flagPass =  true;
          }
        }
      });
    }

    function check_email(){
      var value = $('#emailid').val();
        $.ajax({
          url: "<?php echo site_url();?>/borrower/checkemail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="2"){
        $('#error_message1').html("Email in use");
                flagEmail =  false;
              }
              else if($.trim(result)=="1"){
                $('#error_message1').html("Invalid email");
                flagEmail =  false;
              }
              else if($.trim(result)=="0"){
        $('#error_message1').html("");
                flagEmail =  true;
              }
            }
        });
    }

    function check_idnumber(){
        var value = $('#idnumber').val();
        $.ajax({
          url: "<?php echo site_url();?>/borrower/checkidnumber",
          type: "POST",
          data: { idnumber : value},
          success: function(result){
            if($.trim(result)=="1"){
               $('#error_message').html("Idnumber in use");
                flagId =  false;
            }
            else if($.trim(result)=="2"){
               $('#error_message').html("Not in sample table");
                 flagId =  false;
            }
            else if($.trim(result)=="3"){
               $('#error_message').html("Invalid idnumber");
               flagId =  false;
            }
            else if($.trim(result)=="0"){
               $('#error_message').html("");
               flagId =  true;
            }
          }
        } );
    }

    $('#sign_up').click( function(){
    check_idnumber();
    check_email();
    check_password();
    
        if( flagId && flagEmail && flagValidate && flagPass ){
    
          var idnumber = document.getElementById('idnumber').value;
          var password = document.getElementById('password').value;
          var email = $('#emailid').val();

        $.ajax({
          url: "<?php echo site_url();?>/borrower/registration",
          type: "POST",
          data: { idnumber : idnumber, password : password, email : email },

      beforeSend: function() {
        $("#reg").removeClass('alert alert-danger');
        $("#reg").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
      },
      
      success: function(result){

        if(result.trim() == "sent"){
          $("#reg").hide();
          bootbox.dialog({
          message: "One last step: verify your account. <strong>Pleace check your email for the verification link</strong>.",
          title: "<h3>Successful registration!<h3>",
          buttons:{
            no: {
            label: "Ok",
            className: "btn-primary",
            callback: function() {
               window.location.href = "borrower";
            }
            }
          }
          });
        }
        else{
          $("#reg").addClass("alert alert-danger");
          $("#reg").html("<center>Connection error. Try again.</center>");
        }
        },
      error: function(){
        $("#reg").addClass("alert alert-danger");
        $("#reg").html("<center>An error has occurred. Try again.</center>");
      }
        });
        }
    });

  </script>

<?php include 'home_footer.php'; ?>