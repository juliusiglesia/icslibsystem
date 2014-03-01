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
				                  <td valign="middle" width="160" align="left" bgcolor="#dedede" rowspan="2" nowrap>&nbsp; <b>Type of Material:</b></td>
				                  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="0" class="radio" />Book</label></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="4" class="radio" />Thesis</label></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="2" class="radio" />SP</label></td>                      
							      <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="3" class="radio" />Journal</label></td>
							      <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="8" class="radio" />CD</label></td>		
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="radio" name="mtype" value="8" class="radio" />Reference</label></td>	
								</tr>
								
								<tr>
				                  <td valign="middle" width="160" align="left" bgcolor="#dedede" rowspan="2" nowrap>&nbsp; <b>Filter By:</b></td>
								  <td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#dedede" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />Author</label></td>	
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
            <?php
				if($value!=NULL)
				echo "<th style='width:100px;' abbr='lmID' scope='col' title='materialid'>MaterialID</th>
					<th style='width:100px;' abbr='CourseClassification' scope='col' title='type'>Type</th>
					<th  abbr='Type' scope='col' title='material'>Material</th>
				else
					echo "<center>SEARCH</center>";
			?>
            </thead>
            <tbody>
              <?php
			if($value!=NULL){
				foreach($value as $row){
					echo "<tr>";
					echo "<td> ${row['materialid']}</td>";
					echo "<td> ${row['type']} </td>";
					echo "<td><b> ${row['name']} </b> <br/> ${row['lname']}, ${row['fname']} ${row['mname']}</td>";
					echo "</tr>";
				}
			}
		?>
            </tbody>
</table>
 </div>


<?php include 'home_footer.php'; ?>