<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="shortcut icon" href="<?php echo base_url();?>dist/images/favicon.png">

		<title>ICS-iLS</title>

		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/date_picker.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet" />

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>		
		
	</head>		
	<body>
		 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="40px"></a>
                </div>
                <div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-cog" ></span></a>
				  
				  <ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
					<li><a href="#">Help</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
				  </ul>
            </div>

            </div>
        </div>

		<div class="mainBody">
			<script>
				function claim( thisDiv ){
					bootbox.dialog({
						message: "Are you sure that this material will now be claimed?",
						title: "Claim of material confirmation",
						onEscape: function() {},
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									var idnumber = parent.siblings('.idnumber').text().trim();
									var materialid = parent.siblings('.materialid').text().trim();
									var isbn = parent.siblings('.isbn').text().trim();
									if( isbn == "---" ) isbn = "+" + materialid;
									
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/claim_reservation",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											// show that notification is successful
											//$('#error').html(result);
											if( result != "1" ){
												thisButton.attr('disabled', 'disabled');
												// remove row
												
												$('#alert').addClass("alert alert-success");
												$("#alert").html("Successfully claimed!");
												$("#alert").fadeIn('slow');
												$("#"+materialid+"-"+idnumber).remove();
												$('table').tablesorter();
												$('table').trigger('update');
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
											} else {
												//alert("Failed to notify");
											}
										}
									});
								}
							},
							no: {
								label: "No.",
								className: "btn-default"
							}
						}
					});
				}
				
				function notify( thisDiv ){
					bootbox.dialog({
						message: "Are you sure that this material will now be claimed?",
						title: "Claim of material confirmation",
						onEscape: function() {},
						buttons: {
							yes: {
								label: "Yes, continue.",
								className: "btn-primary",
								callback: function() {
									var thisButton = thisDiv;
									var parent = thisDiv.parent();
									
									var idnumber = parent.siblings('.idnumber').text().trim();
									var materialid = parent.siblings('.materialid').text().trim();
									var isbn = parent.siblings('.isbn').text().trim();
									
									if( isbn == "---" ) isbn = "+" + materialid;

									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/notification",
										data: { materialid : materialid, idnumber : idnumber, isbn : isbn }, 

										beforeSend: function() {
											//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
											$("#error_message").html("loading...");
										},

										error: function(xhr, textStatus, errorThrown) {
												$('#error_message').html(textStatus);
										},

										success: function( result ){
											// show that notification is successful
											//$('#error').html(result);
											if( result != "1" ){

												// alert here if success
												thisButton.attr('disabled', true);
												thisButton.next().removeAttr('disabled');

												//alert("Success!")
												$('#alert').addClass("alert alert-success");
												$("#alert").html("The material can now be claimed!");
												$("#alert").fadeIn('slow');
												document.body.scrollTop = document.documentElement.scrollTop = 0;
												setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);

											} else {
												//alert("Fail!");
											}
										}
									});
								}
							},
							no: {
								label: "No.",
								className: "btn-default"
							}
						}
					});

					
				}

			</script>
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav"  class="active" ><br />
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
						<a href="<?php echo base_url();?>admin/borrowed_books"><span class="glyphicon glyphicon-export"></span> &nbsp;Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search"><span class="glyphicon glyphicon-search"></span> &nbsp;View All Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add A New Material&nbsp;&nbsp;&nbsp;</a>
					</li>
					<li id = "overview-nav">
						<a href="<?php echo base_url();?>admin/home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp;Overview</a>
					</li>	
				</ul>
			</div>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
						<br />

						<?php
							if( count($reservations) != 0 ){
						?>

						<input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
						<input class = "btn btn-primary" type="button" id = "searchReservedButton" value="Search"/> 
						<div id = "alert"> </div><br /><br />
	                
						<table class="table table-hover tablesorter" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th width="5%"><center>ISBN/ISSN</center></th>
									<th width="5%"><center>Library Material ID</center></th>
									<td width="5%"><center><b>Type</center></b></td>
									<th width="45%"><center>Library Information</center></th>
									<th width="5%"><center>Borrower</center></th>
									<th width="8%"><center>Start Date</center></th>
									<th width="5%"><center>Rank</center></th>
									<th width="22%"><center>Action</center></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th width="5%"><center>ISBN/ISSN</center></th>
									<th width="5%"><center>Library Material ID</center></th>
									<td width="5%"><center><b>Type</center></b></td>
									<th width="45%"><center>Library Information</center></th>
									<th width="5%"><center>Borrower</center></th>
									<th width="8%"><center>Start Date</center></th>
									<th width="5%"><center>Rank</center></th>
									<th width="22%"><center>Action</center></th>
								</tr>
							</tfoot>
							<tbody>
								<?php
									$rank = 0;
									$i = 0;
								
									foreach($reservations as $row){
										echo "<tr id = '${row['materialid']}-${row['idnumber']}'>";
										if($row['type'] == 'Book' || $row['type'] == 'Reference'){											
												echo "<td class = 'isbn'><span class='table-text'><center>" . $row['isbn'] ."</center></span></td>";
											}
											else echo "<td class = 'isbn' align='center'>---</td>";
										echo "<td class = 'materialid' ><center><span class='table-text'>${row['materialid']} </span></center></td>";
										
										
										if($row['type']== 'Book')
											$type = "<span class='glyphicon glyphicon-book'></span>";
										else if($row['type'] == 'CD')
											$type = "<span class='glyphicon glyphicon-headphones'></span>";
										else if($row['type'] == 'SP')
											$type = "<span class='glyphicon glyphicon-file'></span>";
										else if($row['type'] == 'References')
											$type = "<span class='glyphicon glyphicon-paperclip'></span>";
										else if($row['type']== 'Journals')
											$type = "<span class='glyphicon glyphicon-pencil'></span>";
										else if($row['type']== 'Magazines')
											$type = "<span class='glyphicon glyphicon-picture'></span>";
										else if($row['type'] == 'Thesis')
											$type = "<span class='glyphicon glyphicon-bookmark'></span>";
											
										echo "<td class = 'type' align='center'>". $type ."</td>";
										

										echo "<td>";
										echo "<b><span class ='title'>${row['name']}.</b></span><br />";									
										foreach ($row['author'] as $name) {
											$name = (array)$name;
											echo "<span class ='author'> ${name['lname']}, ${name['fname']} ${name['mname']}.</span>";
										}
										echo "<span class ='author' > ${row['year']}</span>" . ".";
										if( $row['edvol'] != NULL ){
											if( $row['edvol'] % 10 == 1 )
												echo "<span class ='author'> ${row['edvol']}st Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 2 )
												echo "<span class ='author'> ${row['edvol']}nd Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 3 )
												echo "<span class ='author'> ${row['edvol']}rd Edition </span>" . "."; 
											else 
												echo "<span class ='author'> ${row['edvol']}th Edition </span>" . ".";
										}
										echo "</td>";
										echo "<td class = 'idnumber' ><center><span class='table-text'>${row['idnumber']}</span></center> </td>";
										
											if( $row['started'] == 0 ){
												echo "<td align='center'><span class='table-text'> Not yet notified </span></td>";
												echo "<td align='center'><span class='table-text'> ${row['queue']}/${row['total']}</span> </td>";
												echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' ><span class='glyphicon glyphicon-bullhorn'></button>";
												echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><span class='glyphicon glyphicon-download'></button>";
												echo "</td>";
											} else {
												echo "<td><span class='table-text'> ${row['startdate']}</span> </td>";
												echo "<td align='center'><span class='table-text'>${row['queue']}/${row['total']}</span> </td>";
												echo "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><span class='glyphicon glyphicon-bullhorn'></button> ";
												echo "<button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><span class='glyphicon glyphicon-download'></button>";
												echo "</td>";
											}
										
										}
										?>
									</tbody>
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
						<?php 
	
							} else {
								echo "<h3> No reservations to be accepted </h3>";
							}
						?>
						
						</div>
					</div>
				</div>
				
			</div>
		
		 <!-- FOOTER -->
		<footer><a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
        <center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a></p></center>
		</footer>

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
				})

				.tablesorterPager(pagerOptions);

			});
		
		</script>

		<script>
			
			$(document).ready(function(){		
				function printAuthor( data ){
					var ret = "";
					if( data != null){
						for( var i = 0; i < data.length; i++ ){
							ret += "<span class ='author'>" + data[i].lname +  ", ";
							ret += data[i].fname + " ";
							ret += data[i].mname +  ".</span>";
						}
					}

					return ret;
				}

				function printEdition( data ){
					if( data != null ){
						if( data % 10 == 1 )
							return "<span class = 'author'> "+ data +"st Edition.</span>"; 
						if( data % 10 == 2 )
							return "<span class = 'author'> "+ data +"nd Edition.</span>"; 
						if( data % 10 == 3 )
							return "<span class = 'author'> "+ data +"rd Edition.</span>"; 
						else 
							return "<span class = 'author'> "+ data +"th Edition.</span>"; 
					}
					else{
						return "";
					}
				}

				function printISBN( data, type ){
					if(type == 'Book' || type == 'Reference'){											
						return data;
					}
					else return "---";
				}

				function printDate( data, date ){
					if( data == 0 ){
						return "<td><center><span class='table-text'>Not yet notified </span></center></td>";
					} else {
						return "<td><center><span class='table-text'>" + date + "</span></center></td>";
					}
				}
				
				function printButton( condition ){
					if( condition == 0 ){
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify'><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim' disabled><span class='glyphicon glyphicon-download'></button></td>";
					} else {
						return "<td align='center'><button onclick = 'notify($(this))' class='sendNotif btn btn-primary' name='notify' disabled><span class='glyphicon glyphicon-bullhorn'></button><button onclick = 'claim($(this))' class='sendClaim btn btn-primary' name='claim'><span class='glyphicon glyphicon-download'></button></td>";
					}					
				}
				
				function printType( type ){
					if( type == 'Book')
						type = "<center><span class='glyphicon glyphicon-book'></span></center>";
					else if( type == 'CD')
						type = "<center><span class='glyphicon glyphicon-headphones'></span></center>";
 					else if( type == 'SP')
						type = "<center><span class='glyphicon glyphicon-file'></span></center>";
					else if( type == 'References')
						type = "<center><span class='glyphicon glyphicon-paperclip'></span></center>";
					else if( type == 'Journals')
						type = "<center><span class='glyphicon glyphicon-pencil'></span></center>";
					else if( type == 'Magazines')
						type = "<center><span class='glyphicon glyphicon-picture'></span></center>";
					else if( type == 'Thesis')
						type = "<center><span class='glyphicon glyphicon-bookmark'></span></center>";
						
					return type;
				}

				$("#searchReservedBooks").keypress(function(event){
					if(event.keyCode == 13){
						event.preventDefault();
						$("#searchReservedButton").click();
					}
				});
		
				$("#searchReservedButton").click(function(){

					var search = $("#searchReservedBooks").val();	
					$.ajax({
						type: "POST",
						url: "<?php echo base_url();?>admin/search_reservations",
						dataType: "json",
						data: { search : search }, 

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
								$('#error_message').html(textStatus);
						},

						success: function( result ){
								
							if( result != "" ){
								$('tbody').html("");
								//alert(result.length);
								for( i = 0; i < result.length; i++ ){
									var content = "";
									content = content + "<tr id ='"+ result[i].materialid + "-" + result[i].idnumber +"' > ";
									content = content + "<td class = 'isbn' ><span class='table-text'> " + printISBN( result[i].isbn, result[i].type ) + "  </span></center></td>";
									content = content + "<td class = 'materialid' ><center><span class='table-text'> " + result[i].materialid + " </span></center></td>"; 
									content = content + "<td class = 'type' > " + printType(result[i].type) + " </td>";
									content = content + "<td><span class = 'title' > <strong> " + result[i].name + ".</strong> </span><br />" + printAuthor(result[i].author) + "<span class = 'author' > " + result[i].year + ".</span>" + printEdition( result[i].edvol ) + " </td>";
									content = content + "<td class = 'idnumber' ><center><span class='table-text'> " + result[i].idnumber + " </span></center></td>";
									content = content + printDate( result[i].started, result[i].claimdate );
									content = content + "<td align='center'><span class='table-text'>" + result[i].queue + "/" + result[i].total + "</span></td>";
									content = content + printButton( result[i].started ) + "</tr>";

									$('tbody').append( content );
									
								}
								$('table').trigger('update');
							} else {
								$('tbody').html("<td colspan = '8'><span style = 'center' > No results found </span> </td>");
								$("table").tablesorter();


							}
							$('table').trigger('update');
							
						}
					});
				});

				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});				
			});
		</script>
	</body>
</html>