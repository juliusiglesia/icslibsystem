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

				<table width='70%' align= "center" id="result_engine" summary="Results" border="1" cellspacing="5" cellpadding="5">
						<thead>
							  <tr>
							  <?php
								if($value!=NULL)
									echo "<br/><br/>
									<th width='5%'title='materialid'>MaterialID</th>
									<th width='5%' abbr='type' scope='col' title='type'>Type</th>
									<th width='44%' title='material'>Material</th>
									<th width='1%' title='waitlisted'>WAITLISTED</th>
									<th width='15%' title='action'>ACTION</th>";
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
								$rowNumCancel = 0;
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td class= 'matID' ><center><span class='table-text'> ${row['materialid']}</center></span></td>";
										
										if($row['type']== 'Book')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Book'><span class='glyphicon glyphicon-book'></span></a>";
										else if($row['type'] == 'CD')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='CD'><span class='glyphicon glyphicon-headphones'></span></a>";
										else if($row['type'] == 'SP')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='SP'><span class='glyphicon glyphicon-file'></span></a>";
										else if($row['type'] == 'Reference')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Reference'><span class='glyphicon glyphicon-paperclip'></span></a>";
										else if($row['type']== 'Journals')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Journal'><span class='glyphicon glyphicon-pencil'></span></a>";
										else if($row['type']== 'Magazines')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Magazine'><span class='glyphicon glyphicon-picture'></span></a>";
										else if($row['type'] == 'Thesis')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesi'><span class='glyphicon glyphicon-bookmark'></span></a>";
										
										echo "<td><center>".$type."</center></td>";
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
											echo "<td>";
											echo "<span class='action'><button class='btn btn-danger cancel_button' name='reserve' value='".$materialid."' onclick = \"sendRow(".$rowNum.")\">Cancel</span></button>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</td>";
											echo "</tr>";
										}
										else if($reserved_flag==1){
											echo "<td>" . "<center>BORROWED</center>" . "</td>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</tr>";	
										}
										else if($row['access']==3){
											echo "<td>" . "<center>ROOM USE</center>" . "</td>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</tr>";
										}
										else if($this->session->userdata('classification') == 'F' && $row['access']==1){
												
											echo "<td>" . "<center>STUDENT USE</center>" . "</td>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</tr>";	
											
										}
										else if($this->session->userdata('classification') == 'S' && $row['access']==2){
											
											echo "<td>" . "<center>FACULTY USE</center>" . "</td>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</tr>";	
												
										}
										else{							
											echo "<td>" . "";
											$materialid=$row['materialid'];
											echo "<span class='action'><button class='reserve_button btn btn-primary' name='reserve' value='".$materialid."' onclick = \"sendRow(".$rowNum.")\">Reserve</button>";
											echo "<button class='cancel_button btn btn-danger' name='reserve' value='".$materialid."' onclick = \"sendRow(".$rowNum.")\">Cancel</button></span>";
											echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
											echo "</td></tr>";
										}
										$rowNum++;
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
<script src="<?php echo base_url();?>dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>
<script type="text/javascript">
	var finalRow;
	
	function sendRow(numrow) {
			finalRow = numrow;
	}
	
	function sendRowCancel(numrow){
		finalRowCancel = numrow;
	}
		
	$(document).ready(function()
	{
		//for tooltip
		$("a.tooltipLink").tooltip();
	
		$('.reserve_button').click( function(){

				materialid = document.getElementsByClassName("hiddenForm")[finalRow].value;
				var thisButton = $(this);
				var parent = $(this).parent();
				//var materialid = $.trim(parent.siblings('.matID').text());
			//	var isbn = $.trim(parent.siblings('.isbn').text());	
				
				thisButton.attr('disabled', true);
				thisButton.next().removeAttr('disabled');
				
				bootbox.confirm("Reserve this material?", function(result){
					if(result){
					
					$.ajax({
  						type: "POST",
  						url: "<?php echo site_url('borrower/reserve');?>",
  						data: {materialid: materialid},
  						
						success: function(data)
						{
								$('.cancel_button').show();
								$(this).hide();
								//thisButton.attr('disabled', 'disabled');
  						},
  						error: function()
  						{
  							alert('Reservation failed. Try again.');
  						}
  					});
					}//end if
				});//end bootbox
		});
	});


</script>
