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
                <li><a href="<?php echo base_url(); ?>reserved_materials"><span class="glyphicon glyphicon-folder-close"></span><i class="fa fa-home fa-fw"></i>Library Inventory</a></li>
                <li><a href="<?php echo base_url(); ?>profile"><span class="glyphicon glyphicon-user"></span><i class="fa fa-file-o fa-fw"></i>Manage Profile</a></li>
                <li class="active"><a href="#"><span class="glyphicon glyphicon-search"></span><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
            
		<div class="col-md-8.5 well"> 
		<div class="row">
			<div class="user_search_area">
			<div class="container">
			
				<br />
				 <?php include 'search_bar_view.php'?>

				<tr>
					<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>
				<tr>
					<td align="left" valign="top" height="20" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px; padding-top: 0px" nowrap>


				<table style="display:none;" id="hidethis" style="padding-left: 0px; padding-right: 0px; padding-top: 2px; padding-bottom: 2px; width: 100%; bordercolor: #111111" width="100%" border="0" >
					<tr>
						<td valign="middle" width="160" align="left" bgcolor="#ffffff" rowspan="2" nowrap>&nbsp; <b>Format:</b></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="0" class="radio" />Book</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" 	value="4" class="radio" />Thesis</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="2" class="radio" />SP</label></td>                      
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="3" class="radio" />Journal</label></td>
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />CD</label></td>		
						<td valign="middle" width="90" align="left" style="vertical-align: middle" bgcolor="#ffffff" nowrap><label><input type="checkbox" name="mtype" value="8" class="radio" />Reference</label></td>	
					</tr>
				</table>

				<br /> 


						</td>
					</tr>
				</table>
				 

				<table align= "center" id="result_engine" summary="Results" border="1" cellspacing="5" cellpadding="5">
						<thead>
							  <tr>
							  <?php
								if($value!=NULL)
									echo "<th style='width:100px;' abbr='lmID' scope='col' title='materialid'>MaterialID</th>
									<th style='width:50px;' abbr='CourseClassification' scope='col' title='type'>Type</th>
									<th title='material'>Material</th>
									<th title='action'>ACTION</th>";
								else
									echo "<b/><br/><center>Search Library Materials</center>";
								?>
								
							  </tr>
							</thead>
							<tbody>
							  <?php
								$reserved_flag=0;
								$waitlist_flag=0;
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td> ${row['materialid']}</td>";
										echo "<td> ${row['type']} </td>";
										echo "<td><b> ${row['name']} </b> <br/> ${row['lname']}, ${row['fname']} ${row['mname']}</td>";
										if($material!=NULL){
											foreach ($material as $here){ 
												if($row['materialid']==$here['materialid']){
													$waitlist_flag=1;
												}
											 } 
										}
										if($matid!=NULL){
											foreach ($matid as $tuples){ 
												if($row['materialid']==$tuples['materialid']){
													$reserved_flag=1;
												}
											 } 
										}
						
										if($waitlist_flag==1){
											echo "<td>" . "<center>WAITLISTED</center>" . "</td>";
											echo "</tr>";	
										}
										else if($reserved_flag==1){
											echo "<td>" . "<center>BORROWED</center>" . "</td>";
											echo "</tr>";	
										}
										else if($row['access']==3){
											echo "<td>" . "<center>ROOM USE</center>" . "</td>";
											echo "</tr>";
										}
										else if($this->session->userdata('classification') == 'F' && $row['access']==1){
												
												echo "<td>" . "<center>STUDENT USE</center>" . "</td>";
												echo "</tr>";	
											
										}
										else if($this->session->userdata('classification') == 'S' && $row['access']==2){
											
											echo "<td>" . "<center>FACULTY USE</center>" . "</td>";
											echo "</tr>";	
												
										}
										else{							
											
										
												echo "<td>" . "";
										$materialid=$row['materialid'];
										echo "<button  type = 'submit' class='reserve_button'  name='materialid'  value='{$materialid}'' name='reserve'>RESERVE</button>" . "</td>";
										//echo "<td><button class = "btn btn-primary"  value = "{$materialid}"> RESERVE </button> </td>";
										echo "</tr>";

										}
						$reserved_flag=0;
						$waitlist_flag=0;
									}
								}
								
							?>
							</tbody>
					</table>
				</div> <!--for row class-->
				</div> <!--for container class-->
				</div> <!--for search_container class-->
			 </div> <!--for col class-->
			
		</div> <!-- ROW -->								
		</div> <!-- MAINBODY -->
		</div> <!-- CONTAINER -->


		<div class="container marketing">
<?php include 'home_footer.php'; ?>
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.reserve_button').on('click', function(){
			if(confirm('Are you sure?'))
			{
				materialid = $(this).val();
					$.ajax({
  						type: "POST",
  						url: "<?php echo site_url('borrower/reserve');?>",
  						data: {materialid: materialid},
  						success: function()
  						{

  							alert('You have successfully reserved the item');
  							location.reload();
  						},
  						error: function()
  						{
  							alert('Reservation failed. Try again.');
  						}
  					});
			}	

			else
			{
			}

		});
	});


</script>