<?php include 'home_header.php'; ?>   
  
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="row" id="container">
      <div class="container">
          <img src="<?php echo base_url(); ?>dist/css/banner5.png" class="img-responsive">
      </div>
    </div>



    <div class="container marketing" id="fixsize">
    <br/>
      <div class="row">
        <div class="col-lg-4">
          <img id="icons" alt="50x50" src="<?php echo base_url(); ?>dist/images/search.png">
          <h3>Search</h3>
          <p>Select from a wide range of learning materials in the field of computer science.</p>
          <p><a class="btn btn-default" href="outside_search" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
                <img id="icons" alt="50x50" src="<?php echo base_url(); ?>/dist/images/clock.png">
                <h3>Library Hours</h3>
                <p>Library is open every Mondays to Fridays, from 8am to 12nn and 1pm to 5pm.</p>
              </div><!-- /.col-lg-4 -->        

        <div class="col-lg-4">
                <img id="icons" alt="50x50" src="<?php echo base_url(); ?>/dist/images/cmp.png">
                <h3>ICS Courses</h3>
                <p>Check out all the cool courses that Institute of Computer Science offers.</p>
                <p><a class="btn btn-default" href="http://ics.uplb.edu.ph/courses/ugrad" role="button">View details »</a></p>
              </div><!-- /.col-lg-4 -->
        
      </div><!-- /.row -->
      <!-- /END THE FEATURETTES -->
      <?php include "home_footer.php"; ?>