<?php include 'Logout_header.php'; ?> 
<!-- books with requirements -->

				  
				 <b>Please secure the following:&nbsp&nbsp</b>
				  <br />
						<li> Consent of the Instructor</li>
						<li> Consent of the Owner</li>	
				   <br />
				  <b>Do you wish to continue?</b>
				 	<?php
					echo "<form action=\"inside_search\" role=\"form\" method=\"post\">";
					echo "<button class=\"btn btn-primary\" type=\"submit\">Cancel</button>";
					echo "</form>";
					echo "<form action=\"reserve_continue\" role=\"form\" method=\"post\">";
					echo "<button type=\"submit\" class=\"btn btn-default\" data-dismiss=\"modal\" name=\"yes\" value=\"{$materialid}\">Yes</button>";
					echo "</form>";
					?>
					
				  

<?php include 'home_footer.php'; ?>
