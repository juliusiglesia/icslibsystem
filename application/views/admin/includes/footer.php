<footer>
	<a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
</footer>
<script >
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