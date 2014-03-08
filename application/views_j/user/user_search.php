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
        
		<div class="col-md-8.5 well1"> 
		
			<div class="row">
					<div class="user_search_area">
						<div class="container">
			
				<br />
				 <?php include 'user_search_bar_view.php'?>

				<table align= "center" id="result_engine" summary="Results" border="1" cellspacing="5" cellpadding="5">
						<thead>
							  <tr>
							  <?php
								if($value!=NULL)
									echo "<br/><br/><th style='width:100px;' abbr='lmID' scope='col' title='materialid'>MaterialID</th>
									<th style='width:50px;' abbr='CourseClassification' scope='col' title='type'>Type</th>
									<th title='material'>Material</th>
									<th title='waitlisted'>WAITLISTED</th>
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
								$rowNum 	 = 0;
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td> ${row['materialid']}</td>";
										if($row['type']== 'Book')
											$type = "<span class='glyphicon glyphicon-book'></span>";
										else if($row['type'] == 'CD')
											$type = "<span class='glyphicon glyphicon-headphones'></span>";
										else if($row['type'] == 'SP')
											$type = "<span class='glyphicon glyphicon-file'></span>";
										else if($row['type'] == 'Reference')
											$type = "<span class='glyphicon glyphicon-paperclip'></span>";
										else if($row['type']== 'Journals')
											$type = "<span class='glyphicon glyphicon-pencil'></span>";
										else if($row['type']== 'Magazines')
											$type = "<span class='glyphicon glyphicon-picture'></span>";
										else if($row['type'] == 'Thesis')
											$type = "<span class='glyphicon glyphicon-bookmark'></span>";
											
										echo "<td class = 'type' align='center'>". $type ."</td>";
										echo "<td><b> ${row['name']} </b> <br/> ${row['lname']}, ${row['fname']} ${row['mname']}</td>";
										$t_q = 0;
										foreach($total as $t_queue){
											if($t_queue['materialid']==$row['materialid']){
											  $t_q=$t_queue['tq'];
											}
										  }
										echo "<td>$t_q</td>";
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
											//$rowVal = $rowNum . "|" . $materialid;
											echo "<button class='btn btn-primary' data-toggle='modal' data-target='#container1' name='reserve' onclick = \"sendRow(".$rowNum.")\">RESERVE</button>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</td></tr>";
											$rowNum++;
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
		<div class="modal fade bs-example-modal-sm" id="container1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Reserve Material</h3>
                  </div>
                  <div id="details" class="modal-body">
				  <strong>Confirm reservation of library material?</strong>
                </div>
                 <div class="modal-footer" id="modFooter">
					<button class="btn reserve_button"  name="materialid"> Reserve </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                 </div>
                 </div>
            </div>
    </div>
		</div> <!-- ROW -->								
		</div> <!-- MAINBODY -->
		</div> <!-- CONTAINER -->


		<div class="container marketing">
<?php include 'home_footer.php'; ?>
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	var finalRow;
	
	function sendRow(numrow) {
			finalRow = numrow;
	}

		
	$(document).ready(function()
	{
		
		$('.reserve_button').on('click', function(){
				materialid = document.getElementsByClassName("hiddenForm")[finalRow].value;
					$.ajax({
  						type: "POST",
  						url: "<?php echo site_url('borrower/reserve');?>",
  						data: {materialid: materialid},
  						
						success: function(data)
  						{
  							//alert('You have successfully reserved the item');
  							location.reload();
							//$("#details").html('<b>You have successfully reserved the item.</b>');
							//$("#modFooter").html('<button class="btn" data-dismiss="modal" aria-hidden="true">Done</button>');
							//$("#myModalLabel").html('Success');
							
  						},
  						error: function()
  						{
  							alert('Reservation failed. Try again.');
  						}
  					});
		});
	});


</script>
