<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

	<script>
		function returnBook( thisDiv ){
					bootbox.dialog({
						message: "Confirm return of borrowed material.",
						title: "Confirmation",
						buttons: {
							yes: {
								label: "Yes, continue",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									var fine = $.trim(parent.siblings('.fine').text());
									var materialid = $.trim(parent.siblings('.materialid').text());
									var isbn = $.trim(parent.siblings('.isbn').text());
									var idnumber = $.trim(parent.siblings('.idnumber').text());
							
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/material_returned",
										data: { isbn : isbn, materialid : materialid, fine : fine }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){

											if( result != "1" ){
												
												//thisButton.attr('disabled', 'disabled');
												// remove row
												//alert("Student has been notified");
												//document.getElementById("success_notify").style.display='none';

												$("#success_return").show();
												$("#success_return").html("Successfully returned!");
												$("#success_return").fadeIn('slow');
												$("#"+materialid+"-"+idnumber).html("");
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#success_return').fadeOut('slow') }, 5000);	
											} else {
												//alert("Failed to notify");
											}
										}
									});
								}
							},
							no: {
								label: "No",
								className: "btn-default"
							}
						}
					});
				}
	</script>
		
	<body>
		 <?php include 'includes/header.php'; ?>
        <div class="mainBody">
            <?php include 'includes/sidebar.php'; ?>

			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br /><br />
						<form method="post"  style="width: 800px ; margin-left: auto; margin-right: auto;" role="form" align="center">
                            <input type="text" name="search"  size="80"/>
                            <input class = "btn btn-primary" type="submit" value="Search" name="search_borrowed_books"/> 
                           <div class="alert-container" style = 'height: 40px; margin: 30px;'>
								<div style="display:none" id = "success_return" class = "alert alert-success">  </div>
							</div>   
                        </form>	

						<?php
						  if($this->input->post('returnButton') != ''){
							echo "wew";
						  }
						  	echo"<table border = '1' id='myTable' class='table table-hover'>
								<thead>
									<tr>
										<th width='10%'><center>ISBN/ISSN</center></th>
										<th width='11%'><center>ID Material</center></th>
										<th width='5%'><center>Type</center></th>
										<th width='42%'><center>Library Information</center></th>
										<th width='8%'><center>Borrower</center></th>
										<th width='8%'><center>Start Date</center></th>
										<th width='8%'><center>Due Date</center></th>
										<th width='5%'><center>Status</center></th>
										<th width='5%'><center>Action</center></th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>";
							echo "<tbody>";
                         	if($flag->num_rows ==0){		
                                    echo "<td colspan = '9' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No search results found.</center></td>";
                                    
                         	}else{
								date_default_timezone_set('Asia/Manila');
							    // Then call the date functions
							    $date = strtotime(date('Y-m-d'));
								//echo count($borrowed_books->result());
								//$i=0;
								foreach($borrowed_books->result() as $row){	
									$date2 = strtotime($row->expectedreturn);
									$days = $date-$date2;
									$finalfine = floor($days/(60*60*24))*$fine;
									echo "<tbody>";
									echo "<tr id = '{$row->materialid}-{$row->idnumber}'>";
									echo "<td class = 'isbn' ><center><span class='table-text'>{$row->isbn}</span></center> </td>";
									echo "<td class = 'materialid' ><center><span class='table-text'>{$row->materialid} </span></center></td>";
									
										if($row->type== 'Book')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Book'><span class='glyphicon glyphicon-book'></span></a>";
										else if($row->type == 'CD')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='CD'><span class='glyphicon glyphicon-headphones'></span></a>";
										else if($row->type == 'SP')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='SP'><span class='glyphicon glyphicon-file'></span></a>";
										else if($row->type == 'References')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='References'><span class='glyphicon glyphicon-paperclip'></span></a>";
										else if($row->type== 'Journals')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Journal'><span class='glyphicon glyphicon-pencil'></span></a>";
										else if($row->type== 'Magazines')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Magazine'><span class='glyphicon glyphicon-picture'></span></a>";
										else if($row->type == 'Thesis')
											$type = "<a data-toggle='tooltip' class='tooltipLink' data-original-title='Thesi'><span class='glyphicon glyphicon-bookmark'></span></a>";
									
									echo "<td align='center'>". $type . "</span></td>";
									echo "<td>	<b><span class='title'>" . $row->name. ".</span></b><br />";
									echo "<span class='table-text'>".$row->authorname."</span>";
									echo "<td class='idnumber'><span class='table-text'>". $row->idnumber. "</span></td>";
									echo "<td><span class='table-text'>". $row->start . "</span></td>";
									echo "<td><span class='table-text'>". $row->expectedreturn. "</span></td>";
									if($finalfine > 0){
										echo "<td align='center'><span class='table-text'>". "Overdue" . "</span></td>";
									}
									else{
										echo "<td></td>";
									}
									echo "<td><button onclick = 'returnBook($(this))' class='returnButton btn btn-primary' name='return'><span class='glyphicon glyphicon-remove'></span></button>";
									echo "</td></tr>";
								}//for	
							}
							echo "</tbody>";
							echo "</table>";
						?>
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
				</div>
				<div id = "error"> </div>
			</div>
			
		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>

		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
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
	<script>
	$('#borrowed-nav').addClass('active');
		//For back to top javascript//
			$("#logout").click(function(){
				window.location.href = "<?php echo site_url('admin/logout'); ?>";
				
				});
					$("a.tooltipLink").tooltip();
					//back to top code
					var offset = 220;
	                var duration = 500;
	                jQuery(window).scroll(function() {
	                    if (jQuery(this).scrollTop() > offset) {
	                        jQuery('.back-to-top').fadeIn(duration);
	                    } else {
	                        jQuery('.back-to-top').fadeOut(duration);
	                    }
	                });
	                
	                jQuery('.back-to-top').click(function(event) {
	                    event.preventDefault();
	                    jQuery('html, body').animate({scrollTop: 0}, duration);
	                    return false;
	                });
	                //end code of back to top
			
		function submitForm(){
			$("#return").submit();
		}
			
		</script>

	</body>
</html>