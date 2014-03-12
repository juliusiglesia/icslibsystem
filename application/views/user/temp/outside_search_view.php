<?php 
	$email = $this->session->userdata('email');
	if($email)
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
				<?php
					if($this->session->userdata('email')){ 
						echo "<h1>Hi,"; 
						echo $this->session->userdata('fname');
						echo "!</h1><br/>";
				
						echo "<div class='col-md-3 sidebar'>";
						//<!--sidebar-->
						 include 'sidebar.php';
						}
					?>
				</div> <!--col-md-3-->

				<?php
					if($email){
						echo "<div class='col-md-9 section'>"; //if logged in
					}else{
						echo "<div class='col-md-12 section'>"; //if not logged in
						echo "<br/>";
					}
				?>
					<!--search bar-->
					
					<?php include 'search_bar.php'; ?>
					<!--

						JOHANA, DITO ILALAGAY YUNG FILTERS PARA SA ADVANCED SEARCH :)

					-->
										
					<br />
					<?php
						if($email){
							echo "<div class='alert-container'>";
							echo "<div style = 'display:none' id = 'success_reserve' class = 'alert alert-success'>  </div>";
							echo "<div style = 'display:none' id = 'success_cancel' class = 'alert alert-success'>  </div>";
							echo "</div>";
						}
					?>
					<div>
						<table class="table table-hover tablesorter" id="myTable" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
						<thead>
							<tr>
								<th width="10%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN</th>
								<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Material ID</th>
								<th width="1%" abbr="Type" scope="col" title="Type">Type</th>
								<th width="50%" abbr="Library Information" scope="col" title="Description">Library Information</th>
								<?php
									if($email){
										echo "<th width='1%' abbr='Queue' scope='col' title='Queue'>Queue</th>";
										echo "<th width='28%' abbr='Act' scope='col' title='Action'>Action</th>";
									}
								?>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th width="10%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN</th>
								<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Material ID</th>
								<th width="1%" abbr="Type" scope="col" title="Type">Type</th>
								<th width="50%" abbr="Library Information" scope="col" title="Description">Library Information</th>
								<?php
									if($email){
										echo "<th width='1%' abbr='Queue' scope='col' title='Queue'>Queue</th>";
										echo "<th width='28%' abbr='Act' scope='col' title='Action'>Action</th>";
									}
								?>
							</tr>
						</tfoot>

						<?php
								$reserved_flag=0;
								$waitlist_flag=0;
								$rowNum 	 = 0;
								if($value!=NULL){
									foreach($value as $row){
										echo "<tr>";
										echo "<td class='isbn'><span class='table-text'><center>";
										$tmp = $row['isbn'];
										if (preg_match('/^[+]/', $tmp)) {
										    echo "---";
										} else {
										    echo "${row['isbn']}";
										}
										echo "</center></span></td>";
										echo "<td class='matID'><span class='table-text'><center> ${row['materialid']}</span></center></td>";
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
											
										echo "<td class = 'type' align='center'>". $type ."</td>";
										echo "<td><span class='table-text'><b> ${row['name']} </b></span> <br/><span class='author'> ${row['lname']}, ${row['fname']} ${row['mname']}</span></td>";
										if($email){
											$t_q = 0;
											foreach($total as $t_queue){
												if($t_queue['materialid']==$row['materialid']){
												  $t_q=$t_queue['tq'];
												}
											  }
											echo "<td><span class='table-text'><center>".$t_q."</center></span></td>";
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
												$materialid=$row['materialid'];
												echo "<td><center>";
												echo "<span><button class='btn btn-primary reserve_button' name='reserve'  value='".$materialid."' disabled>Reserve</button>";
												echo "<button class='btn btn-danger cancel_button' name='reserve' value='".$materialid."' onclick = \"sendRow(".$rowNum.")\">Cancel</button></span></td></tr>";	
											}
											else if($reserved_flag==1){
												echo "<td><span class='table-text'><center>" . "BORROWED" . "</span></center></td>";
												echo "</tr>";	
											}
											else if($row['access']==3){
												echo "<td><span class='table-text'><center>" . "ROOM USE" . "</span></center></td>";
												echo "</tr>";
											}
											else if($this->session->userdata('classification') == 'F' && $row['access']==1){
													
													echo "<td><span class='table-text'><center>" . "STUDENT USE" . "</span></center></td>";
													echo "</tr>";	
												
											}
											else if($this->session->userdata('classification') == 'S' && $row['access']==2){
												
												echo "<td><span class='table-text'><center>" . "FACULTY USE" . "</span></center></td>";
												echo "</tr>";	
													
											}
											else{							
												echo "<td><center>" . "";
												$materialid=$row['materialid'];
												//$rowVal = $rowNum . "|" . $materialid;
												$borrowed_count = 0;
												
												echo "<span><button class='btn btn-primary reserve_button' name='reserve'  value='".$materialid."'>Reserve</button>";
												echo "<button class='btn btn-danger cancel_button' name='reserve' value='".$materialid."' onclick = \"sendRow(".$rowNum.")\" disabled>Cancel</button></span>";
												//echo "<input type='hidden' value='". $materialid ."' class='hiddenForm'/>";
												echo "</center></td></tr>";
												$rowNum++;
											}

											$reserved_flag=0;
											$waitlist_flag=0;
										}
									}
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
					


					</div> <!--end of library inventory tabs-->
				</div> <!--col-md-9-->
			</div> <!--row-->
		</div> <!--mainbody-->
	</div> <!--container-->

	<div class="container marketing">
		<?php include 'footer.php'; ?>
	</div> <!--container marketing-->


<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>

<script id="js">
			$(function(){

			var pagerOptions = {

			// target the pager markup - see the HTML block below
			container: $(".pager"),

			// use this url format "http:/mydatabase.com?page={page}&size={size}&{sortList:col}"
			ajaxUrl: null,

			// modify the url after all processing has been applied
			customAjaxUrl: function(table, url) { return url; },

			// process ajax so that the data object is returned along with the total number of rows
			// example: { "data" : [{ "ID": 1, "Name": "Foo", "Last": "Bar" }], "total_rows" : 100 }
			ajaxProcessing: function(ajax){
			if (ajax && ajax.hasOwnProperty('data')) {
			// return [ "data", "total_rows" ];
			return [ ajax.total_rows, ajax.data ];
			}
			},

			// output string - default is '{page}/{totalPages}'
			// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
			output: '{startRow} to {endRow} ({totalRows})',

			// apply disabled classname to the pager arrows when the rows at either extreme is visible - default is true
			updateArrows: true,

			// starting page of the pager (zero based index)
			page: 0,

			// Number of visible rows - default is 10
			size: 10,

			// Save pager page & size if the storage script is loaded (requires $.tablesorter.storage in jquery.tablesorter.widgets.js)
			savePages : true,

			//defines custom storage key
			storageKey:'tablesorter-pager',

			// if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
			// table row set to a height to compensate; default is false
			fixedHeight: true,

			// remove rows from the table to speed up the sort of large tables.
			// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
			removeRows: false,

			// css class names of pager arrows
			cssNext: '.next', // next page arrow
			cssPrev: '.prev', // previous page arrow
			cssFirst: '.first', // go to first page arrow
			cssLast: '.last', // go to last page arrow
			cssGoto: '.gotoPage', // select dropdown to allow choosing a page

			cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
			cssPageSize: '.pagesize', // page size selector - select dropdown that sets the "size" option

			// class added to arrows when at the extremes (i.e. prev/first arrows are "disabled" when on the first page)
			cssDisabled: 'disabled', // Note there is no period "." in front of this class name
			cssErrorRow: 'tablesorter-errorRow' // ajax error information row

			};

			$("table")
				.tablesorter({
						theme: 'blue',
						widthFixed: true,
						widgets: ['zebra']
					})

			.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
				var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') + ' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
				$('#display')
					.append('<li><span class="str">"' + e.type + msg + '</li>')
					.find('li:first').remove();
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			})

			.tablesorterPager(pagerOptions);

		});
	
	</script>
	
