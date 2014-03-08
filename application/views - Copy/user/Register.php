<?php include 'home_header.php'; ?>   
<center>    <!-- START OF SIGN UP -->
<div class="container">
    <div class="row">
              INSERT SOMETHING HERE
        <div></div>
        <div class = "col-xs-12 col-sm-6 col-md-8">
          <img src='<?php echo base_url(); ?>dist/images/side.png' alt = '' width = "500" height = "500">
        </div>
       <div class="col-xs-6 col-md-4"><br/><br/><br/>
          <legend><a href="#"><i class="glyphicon glyphicon-globe"></i></a> Sign up!</legend>
    
          <form action="<?php echo base_url()?>registration" method="post" class="form" role="form">

          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="idnumber" > Employee/Student Number </label><br/>
              <input class="form-control" name="idnumber" id="idnumber" value="<?php echo set_value('idnumber');?>" type="text" required />
              <span id="error_message" class="error_color"></span>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="email"> Email </label><br/>
              <input class="form-control" name="email" id="emailid" value="<?php echo set_value('email');?>" type="email" required>
              <span id="error_message1" class="error_color"></span>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="password"> Password </label><br/>
              <input class="form-control" name="password" id="password" type="password"/>
               <span id="error_message2" class="error_color"></span>
            </div>
          </div>
          <div class = "row"><br/>
            <div class="col-xs-4 col-md-12">
              <label for="password_conf"> Re-enter password </label><br/>
              <input class="form-control" name="password_conf" id="password_conf" onblur="validatePassword()" type="password"/>
               <span id="error_message3" class="error_color"></span>
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


    $('#idnumber').blur( check_idnumber );

    $('#emailid').blur( check_email );

    $('#password').blur( check_password);

   function validatePassword(){  
      var password = document.getElementById('password').value;
      var password_conf = document.getElementById('password_conf').value;
      if(password == password_conf){
      }else{
        $('#error_message3').html("Password does not match. Check passwords");
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
                   $('#error_message2').html("Password length must be atleast 8 characters");
               flagSignUp =  false;
            }
          else{
             $('#error_message2').html("");
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
                   $('#error_message1').html("Email in use");
                flagSignUp =  false;
              }
              else if($.trim(result)=="1"){
                   $('#error_message1').html("Invalid email");
                 flagSignUp =  false;
              }
              else if($.trim(result)=="0"){
                   $('#error_message1').html("");
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
               $('#error_message').html("Idnumber in use");
                flagSignUp =  false;
            }
            else if($.trim(result)=="2"){
               $('#error_message').html("Not in sample table");
                 flagSignUp =  false;
            }
            else if($.trim(result)=="3"){
               $('#error_message').html("Invalid idnumber");
               flagSignUp =  false;
            }
            else if($.trim(result)=="0"){
               $('#error_message').html("");
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
          }

        });

        } else {
          alert("false");
        }

    });


  </script>

<?php include 'home_footer.php'; ?>