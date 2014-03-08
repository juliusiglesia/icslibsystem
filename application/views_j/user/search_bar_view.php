	 <div class="user_search_area">
      <div class="panel panel-info">
		<div class="panel-heading"><h3 class="form-signin-heading">Advanced Search: </h3></div>
	  
	  <br />
	  <br />
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; bordercolor: #111111" width="100%" id="abc">
	<tr>
		<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
		<TABLE align="center" style="border-collapse: collapse; background-color: #efefef; bordercolor: #999999" cellspacing=0 cellpadding="2" border="1">
			<TBODY>
				<TR>
					<TD style="padding: 6px; color: #222222" align="left">
				 	<!-- Begin Box 1 -->
						<table bgcolor="#ffffff" cellspacing="0" cellpadding="2" border="0" style=" width:100%; border-collapse: collapse; bordercolor: #111111">
							<tr>
							<form action="advanced_search" method="post">
								<td align="left"><big>Search:&nbsp;</big>&nbsp;&nbsp;
								<input type= "textbox" name="searchbox" size="50" style="width: 360px" />
									
									<input type="submit" value="Advanced Search" name="eventSubmit_doSearchadvanced" id="defaultButton" />
									<input type="reset" value="    Reset    " name="btnReset" />
								
									&nbsp;	
									<?php
										base_url();
										if($this->session->userdata('email'))
											echo "<a href='user_search'>Basic Search</a>";
										else
											echo "<a href='outside_search'>Basic Search</a>";
									?>
								</td>	
							</tr>
							<tr>
									
									<td align="left"><b>Category: </b>&nbsp;&nbsp;&nbsp;	
										<input type="radio" name="category" value="name" checked="TRUE">&nbsp;Title&nbsp;&nbsp;
										<input type="radio" name="category" value="author">&nbsp;Author&nbsp;&nbsp;
										<input type="radio" name="category" value="course">&nbsp;Course Subject&nbsp;&nbsp;
										</td>		
								</tr>
								
								<tr>
										<td align="left"><b>Filter: &nbsp;&nbsp;&nbsp;</b>
										
											<input type="checkbox" name="type[]" value="Book" checked="TRUE"/>&nbsp;Book&nbsp;&nbsp;
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
				 	<!-- End Box 1 -->
				 	</TD>
				</TR>
			</TBODY>
		</TABLE>
		</td>
	</tr>
