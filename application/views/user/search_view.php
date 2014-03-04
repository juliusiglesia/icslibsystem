
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; bordercolor: #111111" width="100%" id="abc">
	<tr>
		<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
		<TABLE align="center" style="border-collapse: collapse; background-color: #efefef; bordercolor: #999999" cellspacing=0 cellpadding="2" border="1">
			<TBODY>
				<TR>
					<TD style="padding: 6px; color: #222222" align="left">
						<form method="post" action="advanced_search">
						<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">

								<td align="left">
									<select size="1" id="filter" name="filter">
										<option value="author">Author</option>
										<option value="course">Course Subject</option>
										<option value="name" SELECTED>Title</option>
										<option value="keyword">Any Keyword</option>
									</select>
								</td>
								
								<td align="left">
									
									<input type= "textbox" name="searchbox" size="50" style="width: 360px" />
									<input type="submit" value="Search" name="eventSubmit_doSearchadvanced" id="defaultButton" />
						</table>	

						<table id="tabelTemp" bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style=" width:100%; border-collapse: collapse; bordercolor: #111111">
							<tr>		
							</tr>
							<tr>		
									<td align="left" id="s_radio"><b>Category: </b>&nbsp;&nbsp;&nbsp;	
										<input type="radio" name="category" value="name">&nbsp;Title&nbsp;&nbsp;
										<input type="radio" name="category" value="author">&nbsp;Author&nbsp;&nbsp;
										<input type="radio" name="category" value="course">&nbsp;Course Subject&nbsp;&nbsp;
										</td>
		
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

							<input type="button" id="s_basic" value="basic search">
							<input type="button" id="s_advance" value="advance search">
				 	<!-- End Box 1 -->
				 	</TD>
				</TR>
			</TBODY>
		</TABLE>
		</td>
	</tr>

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
