<TABLE align="center" style=" width:100%;" cellspacing=0 cellpadding="2" border="1">
	<TBODY>
		<TR>
			<TD style="padding: 6px; color: #222222" align="left">
			 	<!-- Begin Box 1 -->
				<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">
					<tr>
						<?php
							$email = $this->session->userdata('email');
							base_url();
							if($email)
								echo "<form method='post' action='try_search'>";
							else
								echo "<form method='post' action='outside_search'>";
						?>
						<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">

								<td align="left">
									Filter by: 
									<select size="1" id="category" name="category">
										<option value="keyword" SELECTED>Any Field</option>
										<option value="author">Author</option>
										<option value="course">Course Subject</option>
										<option value="name">Title</option>
										
									</select>
								</td>					
							<td align="left">	
								<input type= "textbox" name="searchbox" value="" size="50" style="width: 360px" />
								<input type="submit" value="Search" name="eventSubmit_doSearchadvanced" id="defaultButton" />
								<a class="btn collapse-data-btn" id="s_advance" href="#update">Advanced Search</a>
								<a class="btn collapse-data-btn" id="s_basic" href="#update">Basic Search</a>
							</td>
						</table>	

						<table id="s_adv_table" cellspacing="0"  border="0" >
							<tr>
								<td align="left">
									Type: 
									<select size="1" id="s_type" name="s_type">
										<option value="All" SELECTED>All</option>
										<option value="Book">Book</option>
										<option value="SP">SP</option>
										<option value="Thesis">Thesis</option>
										<option value="References">Reference</option>
										<option value="CD">CD</option>
										<option value="Journals">Journal</option>
										<option value="Magazines">Magazine</option>
									</select>
								</td>
								<td align="left">
									Accessibility: 
									<select size="1" id="s_accessibility" name="s_accessibility">
										<option value="student" SELECTED>Student</option>
										<option value="faculty">Faculty</option>
										<option value="roomuse">Room Use</option>
										<option value="both">Student/Faculty</option>
									</select>
								</td>
								<td align="left" id="s_radio" name="s_access_val"><b>Filter: </b>
									<input type="radio" id="s_access_val" name="s_access_val" value="available" checked="TRUE"/>Available
									<input type="radio" id="s_access_val" name="s_access_val" value="notavailable"/>Not Available
									<input type="radio" id="s_access_val" name="s_access_val" value="both"/>Both
								</td>
							</tr>



						</form>	
						
						</table>	

					</tr>	
				</table>				 
			 	
			</TD>
		</TR>
	</TBODY>
</TABLE> <!--end of search bar-->




	<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
	<script type="text/javascript">

	$('#s_basic').hide();
	$('#s_adv_table').hide();

	$('#s_advance').click(function(){
		$('#s_advance').hide();
		$('#s_basic').show();
		$('#s_adv_table').show();
		<?php  
			$this->session->set_userdata('searchtype', 1); 
		?>
		var search = "<?php echo $this->session->userdata('searchtype')?>";


	});

	$('#s_basic').click(function(){
		$('#s_advance').show();
		$('#s_basic').hide();
		$('#s_adv_table').hide();
		<?php  
			$this->session->set_userdata('searchtype', 0); 
		?>
		var search = "<?php echo $this->session->userdata('searchtype')?>";

	});

	</script>
