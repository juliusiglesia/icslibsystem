	 <div class="user_search_area">
      <div class="panel panel-info">
		<div class="panel-heading"><h3 class="form-signin-heading">Search: </h3></div>
	  
	  <br />
	  <br />
<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; bordercolor: #111111" width="600" id="abc">
	<tr>
		<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
		<TABLE align="center" style="border-collapse: collapse; background-color: #efefef; width:100%; bordercolor: #999999" cellspacing=0 cellpadding="2" border="1">
			<TBODY>
				<TR>
					<TD style="padding: 6px; color: #222222" align="left">
				 	<!-- Begin Box 1 -->
						<table bgcolor="#dedede" cellspacing="0" cellpadding="2" border="0" style="width: 100%; border-collapse: collapse; bordercolor: #111111">
							<tr>
								<form action="user_search" method="post">
								<td align="left">
									<select size="1" name="filter">
										<option value="author">Author</option>
										<option value="course">Course Subject</option>
										<option value="name" SELECTED>Title</option>
										<option value="keyword">Any Keyword</option>
									</select>
								</td>
								<td align="left"><input type= "textbox" name="search" size="50" style="width: 360px" />&nbsp;</td>
								<td align="left">
									
									<input type="submit" value="    Search    " name="eventSubmit_doSearchadvanced" id="defaultButton" />&nbsp;&nbsp;
									<input type="reset" value="    Reset    " name="btnReset" /></td>
									<td align = "center"><button onclick="toggle()">Advanced Search</button></td>
									
								
								</form>
							</tr>	
						</table>				 
				 	<!-- End Box 1 -->
				 	</TD>
				</TR>
			</TBODY>
		</TABLE>
		</td>
	</tr>
