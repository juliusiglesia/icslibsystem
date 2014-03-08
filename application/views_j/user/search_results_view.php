<?php 

	if($this->session->userdata('email'))
		include 'logout_header.php'; 
	else
		include 'home_header.php';

?>

	<!--
	
			HOME PAGE - BORROWER

	-->
	<style>
		.sidebar{border-right: 1px solid #eee; height:700px;}
		th{text-align: center;}
	</style>
	
	<br/><br/>
	<div class="container">
		<div class="mainbody">
			<div class="row">
				<h1>Hi, <?php echo $this->session->userdata('fname'), "!"?></h1>
				<br/>
				<div class="col-md-3 sidebar">
					<!--sidebar-->
					<?php include 'sidebar.php';?>
				</div> <!--col-md-3-->

				<div class="col-md-9 section">
					<!--search bar-->
					
					<?php include 'search_bar.php'; ?>

					<!--

						JOHANA, DITO ILALAGAY YUNG FILTERS PARA SA ADVANCED SEARCH :)

					-->

					<br/>

					<div>
						<table class="table table-hover" id="onhand" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
						<thead>
							<tr>
								<th width="10%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN</th>
								<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Material ID</th>
								<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">Type</th>
								<th width="65%" abbr="CourseClassification" scope="col" title="Description">Description</th>
								<th width="5%" abbr="ISBN" scope="col" title="Fine">Queue</th>
								<th width="5%" abbr="ISBN" scope="col" title="Fine">Action</th>
							</tr>
						</thead>

						<?php
								$reserved_flag=0;
								$waitlist_flag=0;
								$rowNum 	 = 0;
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td>${row['isbn']}</td>";
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
					</table>
					</div>	


					</div> <!--end of library inventory tabs-->
				</div> <!--col-md-9-->
			</div> <!--row-->
		</div> <!--mainbody-->
	</div> <!--container-->

	<!-- MODAL -->
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
    <!-- END MODAL -->


	<div class="container marketing">
		<?php include 'footer.php'; ?>
	</div> <!--container marketing-->


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
