<?php include 'home_header.php'; ?> 
   <!--Putting it here for nonsense problem-->
 
    <br />
	 <?php include 'user_search_bar_view.php'?>

	<tr>
		<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
	<tr>
		<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>


<table style="display:none;" id="hidethis" style="padding-left: 0px; padding-right: 0px; padding-top: 2px; padding-bottom: 2px; width: 100%; bordercolor: #111111" width="100%" border="0" >
								<tr>
				                  <td valign="middle" width="160" align="left" bgcolor="#ffffff" rowspan="2" nowrap>&nbsp; <b>Type of Material:</b></td>
				                  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="0" class="radio" />Book</label></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="4" class="radio" />Thesis</label></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="2" class="radio" />SP</label></td>                      
							      <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="3" class="radio" />Journal</label></td>
							      <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="8" class="radio" />CD</label></td>		
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="radio" name="mtype" value="8" class="radio" />Reference</label></td>	
								</tr>
								
								<tr>
				                  <td valign="middle" width="160" align="left" bgcolor="#ffffff" rowspan="2" nowrap>&nbsp; <b>Filter By:</b></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />Author</label></td>	
								</tr>
</table>

<br /> 


		</td>
	</tr>
</table>
 

<br />
<br />
<table align= "center" id="result_engine" summary="Results" border="1" cellspacing="5" cellpadding="5">
            <thead>
              <tr>
              <?php
								if($value!=NULL)
									echo "<th style='width:100px;' abbr='lmID' scope='col' title='materialid'>MaterialID</th>
									<th style='width:50px;' abbr='CourseClassification' scope='col' title='type'>Type</th>
									<th title='material'>Material</th>";
								else
									echo "<b/><br/><center>Search Library Materials</center>";
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
										
									}
								}		
							?>
            </tbody>
</table>
 </div>
	    

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
			  
</div>

<?php include 'home_footer.php'; ?>