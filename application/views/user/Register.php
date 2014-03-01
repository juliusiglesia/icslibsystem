<?php include 'home_header.php'; ?>   
     <!-- START OF SIGN UP -->
<div class="container">
    <div class="row">
       <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><br/><br/><br/>
       		<legend><a href="#"><i class="glyphicon glyphicon-globe"></i></a> Sign up!</legend>
    
          <?php echo form_open("borrower/registration"); ?>
          <form action="borrower/registration" method="post" class="form" role="form">
		      
        	<div class="row">     		
        		<div id="error" class= "alert alert-danger col-xs-6 col-md-11">
          		<button id="error2" type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
          		<?php echo validation_errors('<p class="error">'); ?>
            </div>
        	</div>

          <div class="row"><br/>
            <div class="col-xs-4 col-md-4">
              <label for="fname"> First Name </label><br/>
              <input class="form-control" name="fname" value="<?php echo set_value('fname');?>" type="text" required/>
            </div>
            <div class="col-xs-4 col-md-4">
              <label for="mname"> Middle Name </label><br/>
              <input class="form-control" name="mname" value="<?php echo set_value('mname');?>" type="text" required/>
            </div>
            <div class="col-xs-4 col-md-4">
              <label for="lname"> Last Name </label><br/>
              <input class="form-control" name="lname" value="<?php echo set_value('lname');?>" type="text" required />
            </div>
          </div>

          <div class="row"><br/>
            <div class="col-xs-4 col-md-6">
              <label for="idnumber"> Employee/Student Number </label><br/>
              <input class="form-control" name="idnumber" id="idnumber" value="<?php echo set_value('idnumber');?>" type="text" onBlur="validate()" required/>
            </div>
            <div class="col-xs-4 col-md-6">
              <label for="email"> Email </label><br/>
              <input class="form-control" name="email" value="<?php echo set_value('email');?>" type="email" required>
            </div>
          </div>

          <div class="row"><br/>
            <div class="col-xs-4 col-md-6">
              <label for="password"> Password </label><br/>
              <input class="form-control" name="password" id="password" type="password"/>
            </div>
            <div class="col-xs-4 col-md-6">
              <label for="password_conf"> Re-enter password </label><br/>
              <input class="form-control" name="password_conf" id="password_conf" onBlur="validatePassword()" type="password"/>
            </div>
          </div><br/>

          <div class="row">
            <div class="col-xs-4 col-md-4">
                <label for="college"> College </label>
                <select id="college" name="college" class="form-control" onChange="checkCourse()">
  					      <option class="choose"></option>
                  <option value="CA">CA</option>
  		            <option value="CACAS">CACAS</option>
                  <option value="CAS">CAS</option>
                  <option value="CDC">CDC</option>
                  <option value="CEAT">CEAT</option>
                  <option value="CEM">CEM</option>
                  <option value="CHE">CHE</option>
                  <option value="CFNR">CFNR</option>
                  <option value="CVM">CVM</option>
                  <option value="CPAF">CPAF</option>
                  <option value="SESAM">SESAM</option>
                  <option value="GS">GS</option>
                </select>
            </div>
            <div class="col-xs-6 col-md-4 ">
            	  <label for="course">Course</label>
                <select id="course" name="course" class="form-control">
          			  <option class="choose"></option>
          			  <option id="CFNR" class="CFNR" value="BSF">BSF</option>
          			  <option id="CVM" class="CVM" value="BSDVM">BSDVM</option>
          			  <option id="CHE" class="CHE" value="BSN">BSN</option>
          			  <option id="CDC" class="CDC" value="BSDC">BSDC</option>	
          			  <option id="CEM" class="CEM" value="BSABM">BSABM</option>
                  <option id="CEM" class="CEM" value="BSAgEcon">BSAgEcon</option>
                  <option id="CEM" class="CEM" value="BSEcon">BSEcon</option>	
                  <option id="CA" class="CA" value="BSAgri">BSAgri</option>
          			  <option id="CA" class="CA" value="BSABE">BSABE</option>
          			  <option id="CA" class="CA" value="BSABT">BSABT</option>
          			  <option id="CA" class="CA" value="BSFT">BSFT</option>	
          			  <option id="CEAT" class="CEAT" value="BSChe">BSChe</option>
          			  <option id="CEAT" class="CEAT" value="BSCE">BSCE</option>
          			  <option id="CEAT" class="CEAT" value="BSEE">BSEE</option>
          			  <option id="CEAT" class="CEAT" value="BSIE">BSIE</option>								  
                  <option id="CAS" class="CAS" value="BACA">BACA</option>
                  <option id="CAS" class="CAS" value="BAPhilo">BAPhilo</option>
                  <option id="CAS" class="CAS" value="BASocio">BASocio</option>
                  <option id="CAS" class="CAS" value="BSAmath">BSAmath</option>
                  <option id="CAS" class="CAS" value="BSAphy">BSAphy</option>
                  <option id="CAS" class="CAS" value="BSBio">BSBio</option>
                  <option id="CAS" class="CAS" value="BSChem">BSChem</option>
                  <option id="CAS" class="CAS" value="BSCS">BSCS</option>
                  <option id="CAS" class="CAS" value="BSMath">BSMath</option>
                  <option id="CAS" class="CAS" value="BSMST">BSMST</option>
                  <option id="CAS" class="CAS" value="BSStat">BSStat</option>	  
                </select>
            </div>
          </div><br/>

          <label class="checkbox-inline" >
            <input type="radio" name="sex" id="inlineCheckbox1" value="M" checked/>
            Male
          </label>
          <label class="checkbox-inline">
            <input type="radio" name="sex" id="inlineCheckbox2" value="F" />
            Female
          </label>
          <br /><br />
          <button class="btn btn-lg btn-primary btn-block" type="submit" > Sign up</button>
          
          </form> <?php echo form_close()?>
          
        
        </div>
    </div>
</div>


         <!-- END OF SIGN UP -->
<hr class="featurette-divider">

  <link href="<?php echo base_url(); ?>dist/css/signup.css" rel="stylesheet">
  <script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
    
  <script>
		$('.CA').hide();
    $('.CEAT').hide();
    $('.CDC').hide();
    $('.CVM').hide();
    $('.CEM').hide();
    $('.SESAM').hide();
    $('.CHE').hide();
    $('.CFNR').hide();
    $('.CPAF').hide();
    $('.GS').hide();
    $('.CAS').hide();
    $('.CACAS').hide();

    loadError();

    function loadError(){
        if("<?php echo validation_errors('<p class="error">'); ?>"==""){
          $('#error').hide();
        }
        else{
          $('#error').show();
        }
    }

    function validate(){    

      var idnumber = document.getElementById('idnumber').value;
      var filter = /(^\d{4}-?\d{5}$|^\d{11}$)/;
          
      if (filter.test(idnumber)){       
      }
      else{
        alert('Please provide a valid idnumber');
        idnumber.focus;
      }
    }

    function validatePassword(){  

      var password = document.getElementById('password').value;
      var password_conf = document.getElementById('password_conf').value;
      if(password == password_conf){
      }else{
        alert('Please re-enter password');
        password_conf.focus;
      }
    }

    function checkCourse(){

      var val = document.getElementById('college').value;
      $('.CA').hide();
      $('.CEAT').hide();
      $('.CDC').hide();
      $('.CVM').hide();
      $('.CEM').hide();
      $('.SESAM').hide();
      $('.CHE').hide();
      $('.CFNR').hide();
      $('.CPAF').hide();
      $('.GS').hide();
      $('.CAS').hide();
      $('.CACAS').hide();
        
      if(val=="CAS"){ 
        $('.CAS').show();
      }
      else if(val=="CEAT"){
        $('.CEAT').show();
      }
      else if(val=="CDC"){
        $('.CDC').show();
      }
      else if(val=="CVM"){
        $('.CVM').show();
      }
      else if(val=="CEM"){
        $('.CEM').show();
      }
      else if(val=="SESAM"){
        $('.SESAM').show();
      }
      else if(val=="CHE"){
        $('.CHE').show();
      }
      else if(val=="CFNR"){
        $('.CFNR').show();
      }
      else if(val=="CPAF"){
        $('.CPAF').show();
      }
      else if(val=="GS"){
        $('.GS').show();
      }
      else if(val=="CA"){
        $('.CA').show();
      }
      else if(val=="CACAS"){
        $('.CACAS').show();
      }
      $('.choose').hide();
    }

  </script>

      <!-- /END THE FEATURETTES -->
<?php include 'home_footer.php'; ?>