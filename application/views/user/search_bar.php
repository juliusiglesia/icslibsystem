<TABLE align="center" style=" width:100%;" cellspacing=0 cellpadding="2" border="1">
	<TBODY>
		<TR>
			<TD style="padding: 6px; color: #222222" align="left">
			 	<!-- Begin Box 1 -->
				<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">
					<tr>
						<?php
							$email = $this->session->userdata('email');
							
							if($email){
								echo "<form method='post' action='";
								echo site_url();
								echo "/borrower/search_all'>";
							}
							else{
								echo "<form method='post' action='";
								echo site_url();
								echo "/borrower/outside_search'>";
							}
						?>
						<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">

								<td align="left">
									Filter by: 
									<select size="1" id="category" name="category">
										<option value="keyword">Any Field</option>
										<option value="author">Author</option>
										<option value="course">Course Subject</option>
										<option value="name">Title</option>
										
									</select>
								</td>					
							<td align="left">	
								<input type= "textbox" name="searchbox" size="50" style="width: 360px" value="<?php if(isset($input)) echo $input; ?>" />
								<input type="submit" value="Search" name="bsc_search_btn" id="bsc_search_btn" />
								<input type="submit" value="Search" name="adv_search_btn" id="adv_search_btn" />
								<a class="btn collapse-data-btn" id="s_advance" href="#update">Advanced Search</a>
								<a class="btn collapse-data-btn" id="s_basic" href="#update">Basic Search</a>
							</td>
						</table>	

						<table id="s_adv_table" cellspacing="0"  border="0" >
							<tr>
								<td align="left">
									Type: 
									<select size="1" id="s_type" name="s_type">
										<option value="All">All</option>
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
										<option value="student">Student</option>
										<option value="faculty">Faculty</option>
										<option value="roomuse">Room Use</option>
										<option value="both">Student/Faculty</option>
									</select>
								</td>
								<td align="left" id="s_radio" name="s_access_val"><b>Filter: </b>
									<input type="radio" id="s_access_val" name="s_access_val" value="available"/>Available
									<input type="radio" id="s_access_val" name="s_access_val" value="notavailable"/>Not Available
									<input type="radio" id="s_access_val" name="s_access_val" value="both" CHECKED/>Both
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




	<script type = "text/javascript" src = "<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript">

	$('#s_basic').hide();
	$('#s_adv_table').hide();
	$('#adv_search_btn').hide();

	setBar();

	$('#s_advance').click(function(){
		$('#s_advance').hide();
		$('#s_basic').show();
		$('#s_adv_table').show();
		$('#adv_search_btn').show();
		$('#bsc_search_btn').hide();
	});

	$('#s_basic').click(function(){
		$('#s_advance').show();
		$('#s_basic').hide();
		$('#s_adv_table').hide();
		$('#adv_search_btn').hide();
		$('#bsc_search_btn').show();
	});

	function setBar(){
		<?php
		if(!isset($srch)) $srch = 0;

		if($srch == 0 ){
		}
		else{
			echo "$('#s_advance').hide();";
			echo "$('#s_basic').show();";
			echo "$('#s_adv_table').show();";
			echo "$('#adv_search_btn').show();";
			echo "$('#bsc_search_btn').hide();";

			if(isset($s_type)){
			echo "$(\"option[value='${s_type}']\").attr('selected', true);";
			} else {
				echo "$(\"option[value='All']\").attr('selected', true);";
			}

			if(isset($s_accessibility)){
				echo "$(\"option[value='${s_accessibility}']\").attr('selected', true);";
			} else {
				echo "$(\"option[value='both']\").attr('selected', true);";
			}

			if(isset($s_access_val)){
				echo "$(\"input[value='${s_access_val}']\").attr('checked', true);";
			} else {
				echo "$(\"input[value='both']\").attr('checked', true);";
			}

		}

		if(isset($category)){
			echo "$(\"option[value='${category}']\").attr('selected', true);";
		} else {
			echo "$(\"option[value='keyword']\").attr('selected', true);";
		}



		?>
	}


	</script>
