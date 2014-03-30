 <!-- FOOTER -->
      <footer>
        <center><p id="small">&copy; 2013-2014 CMSC 128 AB-6L. All Rights Reserved. <a href="<?php echo site_url(); ?>/borrower/about_us">About Us</a> 
        	| <a href="<?php echo base_url();?>dist/pdf/user/ILS MANUAL.pdf" target="_blank">Operations Manual</a> 
        	| <a href="<?php echo base_url();?>dist/pdf/user/ILS FAQ.pdf" target="_blank">FAQs</a></p>
        </center>
		<a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
      </footer>

    </div><!-- /.container -->
<script>
	//back to top code
	var offset = 220;
	var duration = 500;
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > offset) {
			jQuery('.back-to-top').fadeIn(duration);
		} else {
			jQuery('.back-to-top').fadeOut(duration);
		}
	});

	jQuery('.back-to-top').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({scrollTop: 0}, duration);
		return false;
	});
//end code of back to top
</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>dist/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>dist/js/bootstrap.js"></script>

</body>
</html>