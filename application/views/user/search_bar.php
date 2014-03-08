<TABLE align="center" style="border-collapse: collapse; background-color: #efefef; width:100%; bordercolor: #999999" cellspacing=0 cellpadding="2" border="1">
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
								echo "<form method='post' action='search_all'>";
							else
								echo "<form method='post' action='outside_search'>";
						?>
						<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">

								<td align="left">
									<select size="1" id="category" name="category">
										<option value="author">Author</option>
										<option value="course">Course Subject</option>
										<option value="name" SELECTED>Title</option>
										<option value="keyword">Any Keyword</option>
									</select>
								</td>
															
						<td align="left">	
								<input type= "textbox" name="searchbox" value="" size="50" style="width: 360px" />
								<input type="submit" value="Search" name="eventSubmit_doSearchadvanced" id="defaultButton" />
								<a class="btn collapse-data-btn" id="s_advance" href="#update">Advanced Search</a>
								<a class="btn collapse-data-btn" id="s_basic" href="#update">Basic Search</a>
						</table>	

						<table id="tabelTemp" bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style=" width:100%; border-collapse: collapse; bordercolor: #111111">
							<tr>		
							</tr>
							<tr>
								<td align="left" id="s_checkbox"><b>Filter: &nbsp;&nbsp;&nbsp;</b>
									<input type="checkbox" name="type[]" value="Book" />&nbsp;Book&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="Journal"/>&nbsp;Journal&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="SP"/>&nbsp;SP&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="Thesis"/>&nbsp;Thesis&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="CD"/>&nbsp;CD&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="Magazine"/>&nbsp;Magazine&nbsp;&nbsp;
									<input type="checkbox" name="type[]" value="Reference"/>&nbsp;Reference&nbsp;&nbsp;
								</td>
							</tr>			
						</form>	
						</td>
						</table>	

						<!--input type="button" id="s_basic" value="basic search"-->
						<!--input type="button" id="s_advance" value="advance search"-->
					</tr>	
				</table>				 
			 	
			</TD>
		</TR>
	</TBODY>
</TABLE> <!--end of search bar-->




	<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
	<script type="text/javascript">

	$('#filter').show();
	$('#s_radio').hide();
	$('#s_checkbox').hide();
	$('#s_basic').hide();

	$('#s_advance').click(function(){
		$('#s_radio').show();
		$('#s_checkbox').show();
		$('#s_basic').show();
		$('#s_advance').hide();

	});

	$('#s_basic').click(function(){
		$('#filter').show();
		$('#s_radio').hide();
		$('#s_checkbox').hide();
		$('#s_advance').show();
		$('#s_basic').hide();

	});

	</script>
