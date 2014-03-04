<?php include 'home_header.php'; ?>

<center>    <!-- START OF SIGN UP -->
<div class="container">
    <div class="row">
              INSERT SOMETHING HERE
        <div></div>
        <div class = "col-xs-10 col-sm-6 col-md-8">
          <img src='<?php echo base_url(); ?>dist/images/side.png' alt = '' width = "500" height = "500">
        </div>
       <div class="col-xs-10 col-sm-6 col-md-4"><br/><br/><br/>
          <legend><a href="#"><i class="glyphicon glyphicon-globe"></i></a> Sign up!</legend>
    
          <form action="<?php echo base_url()?>registration" method="post" class="form" role="form">

          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="idnumber"> Employee/Student Number </label> 
                <input class="form-control" name="idnumber" id="idnumber" value="<?php echo set_value('idnumber');?>" type="text" required />
                <img id="usr_verify_no" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/no.png">
                <img id="usr_verify_yes" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/yes.png">
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="email"> Email </label><br/>
              <input class="form-control" name="email" id="emailid" value="<?php echo set_value('email');?>" type="email" required>
              <!--<span id="error_message1"></span>-->
              <img id="usr1_verify_no" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/no.png">
              <img id="usr1_verify_yes" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/yes.png">
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="password"> Password </label><br/>
              <input class="form-control" name="password" id="password" type="password"/>
               <!--<span id="error_message2"></span>-->
              <img id="usr2_verify_no" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/no.png">
              <img id="usr2_verify_yes" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/yes.png">
            </div>
          </div>
          <div class = "row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="password_conf"> Re-enter password </label><br/>
              <input class="form-control" name="password_conf" id="password_conf" onblur="validatePassword()" type="password"/>
               <!--<span id="error_message3"></span>-->
              <img id="usr3_verify_no" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/no.png">
              <img id="usr3_verify_yes" height="15px" width="15px" src="<?php echo base_url(); ?>dist/images/yes.png">
            </div>
          </div><br/>

          <button class="btn btn-lg btn-primary" id="sign_up" type="button" > Sign up</button>        
          
        
        </div>
    </div>
</div>
</center>


         <!-- END OF SIGN UP -->
<hr class="featurette-divider">

  <link href="<?php echo base_url(); ?>dist/css/signup.css" rel="stylesheet">
  <script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>  
  <script>

  $('#add').hide();
  var flagSignUp = false;
    /*$('#button').click( function(){
      var value = $('#error_message').val();
      var value1 = $('#error_message1').val();
      var value2 = $('#error_message2').val();
      var value3 = $('#error_message3').val();

      if(value=="" && value1=="" && value2=="" && value3==""){
        $('#add').click();
      }
      else{
        alert('Enter valid input!');
      }
    });*/
    //employee number
    $('#usr_verify_no').hide();
    $('#usr_verify_yes').hide();

    //email
    $('#usr1_verify_no').hide();
    $('#usr1_verify_yes').hide();

    //password
    $('#usr2_verify_no').hide();
    $('#usr2_verify_yes').hide();

    //password_conf
    $('#usr3_verify_no').hide();
    $('#usr3_verify_yes').hide();


    $('#idnumber').blur( check_idnumber );

    $('#emailid').blur( check_email );

    $('#password').blur( check_password);

   function validatePassword(){  
      var password = document.getElementById('password').value;
      var password_conf = document.getElementById('password_conf').value;
      if(password == password_conf){
      }else{
        alert('Please re-enter password');
        password_conf.focus;
      }
    }

    function check_password(){
      var value = $('#password').val();
      $.ajax({
        url: "<?php echo base_url();?>borrower/checkpassword",
        type: "POST",
        data: { password : value},
        success: function(result){
          if($.trim(result)=="1"){
               //$('#error_message2').html("Password length must be atleast 8 characters");
               $('#usr2_verify_no').show();
               $('#usr2_verify_yes').hide();
               flagSignUp =  false;
            }
          else{
             //$('#error_message2').html("");
             $('#usr2_verify_yes').show();
             $('#usr2_verify_no').hide();
             flagSignUp =  true;
          }
        }
      });
    }

    function check_email(){
      var value = $('#emailid').val();
        $.ajax({
          url: "<?php echo base_url();?>borrower/checkemail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="2"){
                  //$('#error_message1').html("Email in use");
                  $('#usr1_verify_no').show();
                  $('#usr1_verify_yes').hide();
                flagSignUp =  false;
              }
              else if($.trim(result)=="1"){
                   $('#usr1_verify_no').show();
                    $('#usr1_verify_yes').hide();
                 flagSignUp =  false;
              }
              else if($.trim(result)=="0"){
                  $('#usr1_verify_yes').show();
                   $('#usr1_verify_no').hide();
                 flagSignUp =  true;
              }
            }
        });
    }

    function check_idnumber(){
        var value = $('#idnumber').val();
        $.ajax({
          url: "<?php echo base_url();?>borrower/checkidnumber",
          type: "POST",
          data: { idnumber : value},
          success: function(result){
            if($.trim(result)=="1"){
               //$('#error_message').html("Idnumber in use");
                $("#usr_verify_no").show();
                $("#usr_verify_yes").hide();
                flagSignUp =  false;
            }
            else if($.trim(result)=="2"){
               //$('#error_message').html("Not in sample table");
                $("#usr_verify_no").show();
                $("#usr_verify_yes").hide();
                 flagSignUp =  false;
            }
            else if($.trim(result)=="3"){
              // $('#error_message').html("Invalid idnumber");
                $("#usr_verify_no").show();
                $("#usr_verify_yes").hide();
              //src="<?php echo base_url(); ?>dist/images/search.png"
               flagSignUp =  false;
            }
            else if($.trim(result)=="0"){
              // $('#error_message').html("");
               $("#usr_verify_yes").show();
               $("#usr_verify_no").hide();
               flagSignUp =  true;
            }
          }
        } );
    }

    $('#sign_up').click( function(){
        if( flagSignUp ){
           var idnumber = document.getElementById('idnumber').value;
        var password = document.getElementById('password').value;
        var email = $('#emailid').val();

        $.ajax({
          url: "<?php echo base_url();?>borrower/registration",
          type: "POST",
          data: { idnumber : idnumber, password : password, email : email },

          success: function(result){
                alert('Verify');
                window.location.href = "borrower";
          },
          error: function()

        });

        } else {
          alert("false");
        }

    });


  </script>

<?php include 'home_footer.php'; ?>