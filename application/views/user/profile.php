<script type = "text/javascript" src = "<?php echo base_url();?>script/jquery-2.1.0.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>dist/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>dist/js/holder.js"></script>


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
				<!--h1>Hi, <?php echo $this->session->userdata('fname'), "!"?></h1-->
				<br/>
				<div class="col-md-3 sidebar">
					<!--sidebar-->
					<?php include 'sidebar.php';?>
				</div> <!--col-md-3-->

				<div class="col-md-9 section">
					<!--search bar-->
					<?php include 'search_bar.php';?>



		<?php 
			echo "<div class='alert-container'>";
			echo "<div style = 'display:none' id = 'success_cancel' class = 'alert alert-success'>  </div>";
			echo "<div style = 'display:none' id = 'failed' class = 'alert alert-danger'>  </div>";
			echo "</div>";
		?>

	<br/>
		<!--library inventory tabs-->
		<div class="nav">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#onhand-link" data-toggle="tab">BOOKS ON HAND</a></li>
				<li><a href="#reserved_link" data-toggle="tab">RESERVED BOOKS</a></li>
			</ul>

			<!--tab-content-->
			<div class="tab-content">
				<div id="onhand-link" class="tab-pane active">
					
					<table class="table table-hover" id="onhand-table" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
						<thead>
							<tr>
								<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
								<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
								<th width="5%" abbr="type" scope="col" title="Type">Type</th>
								<th width="75%" abbr="CourseClassification" scope="col" title="Description">Description</th>
								<th width="5%" abbr="ISBN" scope="col" title="Fine">Fine</th>
							</tr>
						</thead>

						<?php foreach($borrowed as $row){
							echo "<tr>";
							echo "<td><center><span class='table-text'>";
								$tmp = $row['isbn'];
								if (preg_match('/^[+]/', $tmp)) {
									echo "---";
								} else {
									echo "${row['isbn']}";
								}
							echo "</center></span></td>";
							echo "<td><center><span class='table-text'> ${row['materialid']} </span></center> </td>";
							echo "<td><center> ";
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
															
							echo "$type</center></td>";
							echo "<td><span class='table-text'><b>${row['name']}</b></span><br><span class='author'>${row['authorname']}. ${row['year']}.</span></td>";
							echo "<td><span class='table-text'><center>";
								if("${row['user_fine']}" > 0){
									echo "${row['user_fine']}";
								}else{
									echo "0";
								}
							echo "</center></span></td>";
							echo "</tr>";
						}?>
					</table>

				</div> <!--end of onhand tab-->

				<div id="reserved_link" class="tab-pane">
					
					
										
					<?php
						if($list!=NULL && $rank!=NULL && $total!=NULL){
						?>
							<table class="table table-hover" summary="Results" border="1" cellspacing="5" cellpadding="5">
							<thead>
								<tr>
									<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
									<th width="12%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
									<th width="5%" abbr="Type" scope="col" title="Type">Type</th>
									<th width="70%" abbr="CourseClassification" scope="col" title="Description">Description</th>
									<th width="7%" abbr="Queue" scope="col" title="Queue">Rank</th>
									<th width="5%" abbr="Action" scope="col" title="Action">Action</th>
								</tr>
							</thead>
						<?php
							foreach($reserved as $row){
								echo "<tr>";
								echo "<td>";
									$tmp = $row['isbn'];
									if (preg_match('/^[+]/', $tmp)) {
										echo "---";
									} else {
										echo "${row['isbn']}";
									}
								echo "</td>";
								echo "<td> ${row['materialid']} </td>";
								echo "<td>";
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
										$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesis'><span class='glyphicon glyphicon-bookmark'></span></a>";
															
								echo "$type";
								echo "</td>";
								echo "<td> <b>${row['name']}</b>
									 <br/>${row['authorname']}. 
									  ${row['year']}
									  </td>";
								foreach($rank as $q_rank){
											
									if($q_rank['materialid']== $row['materialid']){
										$rrank=$q_rank['queue'];
										//echo "<td> ${rrank} of ";
										//echo "${q_rank['queue']} ";
									}
									
								}
								//var_dump($rrank);
								foreach($total as $t_queue){
									if($t_queue['materialid']==$row['materialid']){
										 $t_q=$t_queue['tq'];
										 //echo "${t_q} </td>";
									}
								}
								  echo "<td> ${rrank} of ${t_q} </td>";
								  echo "<td><button class=\"cancel_button btn btn-danger\" data-dismiss=\"modal\" name = 'materialid' value='${row['materialid']}'><span class='glyphicon glyphicon-remove'></button>" . "</td>";
								  echo "</tr>";
							  }
						}
						
						else{
							echo "<div>No reserved books!</div>";
						}
					?>			  
					</table>
				</div> <!--end of reserved tab-->
			</div> <!--end of tab-content-->
		</div> <!--end of library inventory tabs-->
				

				</div> <!--col-md-9-->
			</div> <!--row-->
		</div> <!--mainbody-->
	</div> <!--container-->



	<div class="container marketing">

		 <!-- FOOTER -->
      <footer>
        <!--<p class="pull-right"><a href="#"> <img src="<?php //echo base_url(); ?>images/top_icon.PNG" alt="back to top" width="50" height="50"/> </a></p>-->
        <!--<p>2013 AB-6L DevTeam. <a href="#">FAQ</a> | <a href="#">Operations Manual</a> | <a href="#">About</a> </p>-->
      </footer>

    </div><!-- /.container -->

	</div> <!--container marketing-->

 
</body></html>

<script type="text/javascript">
		//$("a.tooltipLink").tooltip();
		
		$('#message').click(function(){
			$.ajax({
				url: "<?php echo base_url();?>borrower/get_message",
				dataType : "json",
				beforeSend: function() {
					//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
					$("#error_message").html("loading...");
				},

				error: function(xhr, textStatus, errorThrown) {
						$('#error_message').html(textStatus);
				},

				success: function( result ){
					var overdue = result['overdue'];
					var str = "";
					
					if( overdue.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
	                else{
	                   for( var i = 0; i < overdue.length; i++){
	                   		str += "<li><a>" + overdue[i].name + " <br /> Fine: Php " + overdue[i].user_fine + "</a> </li>";
	                   } 
	                }
					
					$('#overdue').html( str );
	                
	                var reserved = result['reserved'];
	                if( reserved.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
	                else{
	                   for( var i = 0; i < reserved.length; i++){
	                   		str += "<li><a>" + reserved[i].name + "</a> </li>";
	                   } 
	                }

	                $('#reserved').html( str );
	                
					var readytoclaim = result['readytoclaim'];
	                if( readytoclaim.length == 0 ){  str += "<li><a><i> None </i></a></li>"; }
	                else{
	                   for( var i = 0; i < readytoclaim.length; i++){
	                   		str += "<li><a>" + readytoclaim[i].name + " until <b>" + readytoclaim[i].claimdate + " </b></a> </li>";
	                   } 
	                }

	                $('#ready').html( str );
	                
				}
			});
		});

</script>

<script type="text/javascript">
	document.getElementById("success_cancel").style.display='none';
	$(".cancel_button").click( function(){
		var thisButton = $(this);
		materialid = $(this).val();
		var str = "Cancel reservation for " + materialid + "?";
		
		bootbox.dialog({
			message: str,
			title: "Cancel Reservation",
			buttons:{
				yes:{
					label: "Ok",
					className: "btn-primary",
					callback: function() {
						$.ajax({
							type: "POST",
							url: "<?php echo site_url('borrower/cancel_reservation');?>",
							data: {materialid: materialid},
							success: function()
							{
								thisButton.attr('disabled', true);
								thisButton.prev().removeAttr('disabled');
								$("#success_cancel").fadeIn('slow');
								$("#success_cancel").show();
								$("#success_cancel").html("Successfully <strong>cancelled</strong> reservation!");
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								setTimeout(function() { $('#success_cancel').fadeOut('slow') }, 3000);	
							},
							error: function()
							{
								$("#failed").fadeIn('slow');
								$("#failed").show();
								$("#failed").html("<strong>Failed</strong> to cancel reservation! Please try again.");
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								setTimeout(function() { $('#failed').fadeOut('slow') }, 3000);
							}
						});
					}
				},
				no: {
				label: "Cancel",
				className: "btn-default"
				}
			}
		});
	});	
</script>