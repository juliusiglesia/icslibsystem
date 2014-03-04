<?php include 'logout_header.php'; ?>

	<!--
	
			BORROWER SIDEBAR
	
	-->
	<br/><br/>
	<div class="container">
	<div class="mainBody">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo base_url(); ?>profile"><i class="fa fa-home fa-fw"></i>Profile</a></li>
                <li><a href="<?php echo base_url(); ?>borrowed_materials"><i class="fa fa-list-alt fa-fw"></i>Books on Hand</a></li>
                <li><a href="<?php echo base_url(); ?>reserved_materials"><i class="fa fa-file-o fa-fw"></i>Reserved Books</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>user_search"><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
        
		<div class="col-md-8.5 well"> 
		<div class="row">
			<div class="user_search_area">
			<div class="container">
			
				<br />
				 <?php include 'user_search_bar_view.php'?>

				<tr>
					<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
				<tr>
					<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>


				<table style="display:none;" id="hidethis" style="padding-left: 0px; padding-right: 0px; padding-top: 2px; padding-bottom: 2px; width: 100%; bordercolor: #111111" width="100%" border="0" >
					<tr>
						<td valign="middle" width="160" align="left" bgcolor="#dedede" rowspan="2" nowrap>&nbsp; <b>Format:</b></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="0" class="radio" />Book</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" 	value="4" class="radio" />Thesis</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="2" class="radio" />SP</label></td>                      
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="3" class="radio" />Journal</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />CD</label></td>		
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />Reference</label></td>	
					</tr>
				</table>

				<br /> 


						</td>
					</tr>
				</table>
				 

				<div class="panel-heading"><h3 class="form-signin-heading">Search Results: </h3></div>
				<br />
				<br />
				<table align= "center" id="result_engine" summary="Results" border="1" cellspacing="5" cellpadding="5">
						<thead>
							  <tr>
							  <?php
								if($value!=NULL)
									echo "<th style='width:100px;' abbr='lmID' scope='col' title='materialid'>MaterialID</th>
									<th style='width:100px;' abbr='CourseClassification' scope='col' title='type'>Type</th>
									<th title='material'>Material</th>
									<th title='action'>ACTION</th>";
								else
									echo "<center>SEARCH</center>";
								?>
								
							  </tr>
							</thead>
							<tbody>
							  <?php
							if($value!=NULL){
								foreach($value as $row){
									echo "<tr>";
									echo "<td> ${row['materialid']}</td>";
									echo "<td> ${row['type']} </td>";
									echo "<td><b> ${row['name']} </b> <br/> ${row['lname']}, ${row['fname']} ${row['mname']}</td>";
									
										
									
									echo "<td>" . "<form action=\"reserve\" role=\"form\" method=\"post\">";
									$materialid=$row['materialid'];
									echo "<button type=\"submit\" class=\"btn btn-default\" data-dismiss=\"modal\" name=\"materialid\" value=\"{$materialid}\">RESERVE</button>" . "</form>" . "</td>";
									echo "</tr>";
								}
							}
							
						?>
							</tbody>
					</table>
				</div> <!--for row class-->
				</div> <!--for container class-->
				</div> <!--for search_container class-->
			 </div> <!--for col class-->
					

			<!-- modal for books with requirements -->

			<div class="modal fade" id="reserve" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title" id="myModalLabel">REQUIREMENTS</h3>
							  </div>
							  <div class="modal-body">
							  <b>Please secure the following:&nbsp&nbsp</b>
							  <br />
									<li> Consent of the Instructor</li>
									<li> Consent of the Owner</li>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								 </form>
							  </div>
							</div>
						  </div>
						  
			</div>	

			<!-- modal for books without requirements -->

			<div class="modal fade" id="reserve1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title" id="myModalLabel">Hi there!</h3>
							  </div>
							  <div class="modal-body">
							  <b>You chose to reserve this book.</b>
							  <br />
							  <b>Do you wish to continue?</b>
							  </div>
							  <div class="modal-footer">
								<button class="btn btn-primary" type="submit">Cancel</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
								
							  </div>
							</div>
						  </div>
						  
			</div> <!-- MODAL -->
			
			
		</div> <!-- ROW -->								
		</div> <!-- MAINBODY -->
		</div> <!-- CONTAINER -->


		<div class="container marketing">
<?php include 'home_footer.php'; ?>