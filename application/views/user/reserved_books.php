<?php include 'logout_header.php'; ?>

	<br/><br/>
	<div class="container">
	<div class="mainBody">
    <div class="row">
      <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-folder-close"></span><i class="fa fa-home fa-fw" ></i>Library Inventory</a></li>
                <li><a href="<?php echo base_url(); ?>profile"><span class="glyphicon glyphicon-user"></span><i class="fa fa-file-o fa-fw"></i>Manage Profile</a></li>
                <li><a href="<?php echo base_url(); ?>user_search"><span class="glyphicon glyphicon-search"></span><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
		
      <div class="col-md-8.5 well1">
		
		<div class="container">
		  <div class="row">
			<div class="col-md-9">
			  <div class="well2 well-sm">
				<div class="row" style="display:inline;">
									
			      <p><h4>Books on Hand</h4>
					<table class="table table-hover tablesorter" id="onhand" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
					  <thead>
						<tr>
						<th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Material ID</th>
						<th style="width:40px;" abbr="info" scope="col" title="Course Classification">Description</th>
						<th style="width:100px;" abbr="fine" scope="col" title="Course Classification">Fine</th>
						</tr>
					  </thead>
					  <?php
						foreach($borrowed as $row){
						  echo "<tr>";
						  echo "<td> ${row['materialid']} </td>";
						  echo "<td> <b>${row['name']}</b> <br/>${row['fname']} ${row['mname']} ${row['lname']}. ${row['year']}. (${row['type']}) </td>";
						  echo "<td>";
							if("${row['user_fine']}" > 0){
								echo "${row['user_fine']}";
							}
							else{
								echo "0";
							}
						  echo "</td>";
						  echo "</tr>";
						}
						?>
					</table>
					<div class="pager">
						<!--<img src="../addons/pager/icons/first.png" class="first" alt="First" />
						<img src="../addons/pager/icons/prev.png" class="prev" alt="Prev" />-->
						<span class="first" style="cursor:pointer">First</span>
						<span class="prev" style="cursor:pointer">Prev</span>
						<strong> <span class="pagedisplay"></span></strong> <!--this can be any element, including an input-->
						<span class="next" style="cursor:pointer">Next</span>
						<span class="last" style="cursor:pointer">Last</span>
						<br/>
						<span>Page size: </span>
						<select class="pagesize" title="Select page size">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="40">40</option>
						</select>
						<span>Go to: </span>
						<select class="gotoPage" title="Select page number"></select>
					</div>
					
				</div>
				<div class="row" style="display:inline;">
									
				  <p><h4>Reserved Books</h4>
					<table class="table table-hover" summary="Results" border="1" cellspacing="5" cellpadding="5">
					  <thead>
						<tr>
						<th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Material ID</th>
						<th style="width:550px;" abbr="CourseClassification" scope="col" title="Course Classification">Description</th>
						<th abbr="Action" scope="col" title="Action">Rank</th>
						<th abbr="Action" scope="col" title="Action">Action</th>
						</tr>			  
					  </thead>
										
					  <?php
						if($list!=NULL && $rank!=NULL && $total!=NULL){
						  foreach($res as $row){
						    echo "<form method ='post'>";
							echo "<tr>";
							echo "<td> ${row['materialid']} </td>";
							echo "<td> <b>${row['name']}</b> <br/>${row['fname']} ${row['mname']} ${row['lname']}.  ${row['year']}. (${row['type']}) </td>";
							foreach($rank as $q_rank){
							
							if($q_rank['materialid']==$row['materialid']){
							$rrank=$q_rank['queue'];
							}
						  }
						  foreach($total as $t_queue){
							if($t_queue['materialid']==$row['materialid']){
							  $t_q=$t_queue['tq'];
							}
						  }
						  echo "<td> $rrank of $t_q </td>";
						  echo "<td><button type=\"submit\" class=\"cancel_reservation\" data-dismiss=\"modal\" name = 'materialid' value='${row['materialid']}'>CANCEL</button>" . "</td>";
						  echo "</form>";
						  echo "</tr>";
						  }
						}
						?>			  
					</table>				
				  </p>						
			

    </div>
	</div>		
	</div>


	<div class="container marketing">
<?php include 'home_footer.php'; ?>

<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.cancel_reservation').on('click', function(){
			if(confirm('Are you sure?'))
			{
				materialid = $(this).val();
					$.ajax({
  						type: "POST",
  						url: "<?php echo site_url('borrower/cancel_reservation');?>",
  						data: {materialid: materialid},
  						success: function()
  						{
  							alert('You have successfully cancelled the item');
  							location.reload();
  						},
  						error: function()
  						{
  							alert('Cancel failed. Try again.');
  						}
  					});
			}	

			else
			{

			}

		});
	});


</script>
