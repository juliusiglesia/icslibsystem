<!--
	
	SEARCH PAGE NG BORROWER

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

					<br/>
					<!--

						JOHANA, DITO YUNG TABLE NUNG SEARCH RESULTS :)

					-->
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
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td> ${row['materialid']}</td>";
										echo "<td> ${row['type']} </td>";
										echo "<td><b> ${row['name']} </b> <br/> ${row['lname']}, ${row['fname']} ${row['mname']}</td>";
										echo "<td></td>";
										
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
											echo "<button type = 'submit' class='reserve_button'  name='materialid'  value='{$materialid}'' name='reserve'>RESERVE</button>" . "</td>";
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
				</div> <!--col-md-9-->
			</div> <!--row-->
		</div> <!--mainbody-->
	</div> <!--container-->


	<div class="container marketing">
		<?php include 'home_footer.php'; ?>
	</div> <!--container marketing-->