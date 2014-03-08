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
                <li><a href="<?php echo base_url(); ?>reserved_materials"><i class="fa fa-file-o fa-fw"></i>Reserved Books</a></li>
                <li><a href="<?php echo base_url(); ?>user_search"><i class="fa fa-bar-chart-o fa-fw"></i>Search Library</a></li>
            </ul>
        </div>
		
        <div class="col-md-8.5 well">
		
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="well well-sm">
							<div class="row" style="display:inline;">
									
								<p><h4>Books on Hand</h4>
								<table class="table table-hover" id="onhand" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
								<thead>
								  <tr>
									<th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Material ID</th>
									<th style="width:100px;" abbr="CourseClassification" scope="col" title="Course Classification">Title . Author . Year . (Type)</th>
								  	<th style="width:100px;" abbr="fine" scope="col" title="Course Classification">Fine</th>
								  </tr>
								</thead>
									<?php
									foreach($borrowed as $row){
									echo "<tr>";
									echo "<td> ${row['materialid']} </td>";
									echo "<td> ${row['fname']} ${row['mname']} ${row['lname']}. ${row['name']}. ${row['year']}. (${row['type']}) </td>";
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
							</div>
						</div>
					</div>
				</div>
			</div>
					
		
        </div>
    </div>
	</div>		
	</div>


	<div class="container marketing">
<?php include 'home_footer.php'; ?>