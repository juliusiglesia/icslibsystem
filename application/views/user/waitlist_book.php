<?php include 'Logout_header.php'; ?> 
<!-- books without requirements -->

				  
				  <b>This book is already borrowed.</b>
				  <br />
				  <b>Do you wish to waitlist?</b>
				 	<?php
					echo "<form action=\"inside_search\" role=\"form\" method=\"post\">";
					echo "<button class=\"btn btn-primary\" type=\"submit\">Cancel</button>";
					echo "</form>";
					echo "<form action=\"waitlist_continue\" role=\"form\" method=\"post\">";
					
					echo "<button type=\"submit\" class=\"btn btn-default\" data-dismiss=\"modal\" name=\"yes\" value=\"{$materialid}\">Yes</button>";
					echo "</form>";
					?>
					
				  

<?php include 'home_footer.php'; ?>
