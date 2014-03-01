<!DOCTYPE html>
<html lang="en"><head>
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
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/date_picker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet" /> <!--for chart -->

	<style type="text/css" id="holderjs-style"></style></head>

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
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="30px"></a>
                </div>
				<!--<div class="alert alert-success" id="returned">
					<a href="#" class="close" data-dismiss="alert" id="boton_cerrar">&times;</a> 
					<strong>Successfully returned material!</strong>     
				</div>-->
                <form class="navbar-form navbar-right" role="form">
                    <!-- Split button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default" data-toggle="dropdown">
					<span class="glyphicon glyphicon-cog"></span>
				  </button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
                  </ul>
                </div>
                </form>

            </div>
        </div>

		<div class="mainBody">
		
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav"  class="active" >
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
						<input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
						<input class = "btn btn-primary" type="button" id = "searchReservedButton" value="Search"/> 
						<div class="alert-container">
							<div id = "success_notify" class = "alert alert-success">  </div>
							<div id = "success_claim" class = "alert alert-success">  </div>
						</div>
						<br />
                        <br/>
							<table class="tablesorter">
								<thead>
									<tr>
										<th ><center>ISBN</center></th>
										<th><center>Library Material ID</center></th>
										<td><center><b>Type</center></b></td>
										<th><center>Library Information</center></th>
										<th><center>Borrower</center></th>
										<th><center>Start Date</center></th>
										<th><center>Rank</center></th>
										<th><center>Action</center></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th><center>ISBN</center></th>
										<th><center>Library Material ID</center></th>
										<th><center>Type</center></th>
										<th><center>Library Information</center></th>
										<th><center>Borrower</center></th>
										<th><center>Start Date</center></th>
										<th><center>Rank</center></th>
										<th><center>Action</center></th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									$rank = 0;
									$i = 0;
								
									foreach($reservations as $row){
										echo "<tr id = '${row['materialid']}-${row['idnumber']}'>";
										echo "<td class = 'isbn' ><center><span class='table-text'>${row['isbn']}</span></center> </td>";
										echo "<td class = 'materialid' ><center><span class='table-text'>${row['materialid']} </span></center></td>";
										
										
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
											
										echo "<td class = 'type' align='center'> <br />". $type ."</td>";
										

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
										echo "<td class = 'idnumber' ><center><span class='table-text'> <br /> ${row['idnumber']}</span></center> </td>";
										
										if( $row['started'] == 0 ){
											echo "<td align='center'><span class='table-text'> Not yet notified </span></td>";
											echo "<td align='center'><span class='table-text'> ${row['queue']}/${row['total']}</span> </td>";
											echo "<td align='center'><button class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button>";
											echo "<button class='sendClaim btn btn-primary' name='claim' value='${row['id']}'  disabled>Claim</button>";
											echo "</td>";
										} else {
											echo "<td><span class='table-text'> ${row['startdate']}</span> </td>";
											echo "<td><span class='table-text'>${row['queue']}/${row['total']}</span> </td>";
											echo "<td><button class='sendNotif btn btn-primary' name='notify' value='${row['id']}' disabled>Notify</button>";
											echo "<button class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button>";
											echo "</td>";
										}
										echo "</tr>";
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
					</div>
				</div>
				
			</div>
		
		 <!-- FOOTER -->
		<footer><a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
        	<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a></p></center>
		</footer>

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>js/jquery.tablesorter.js" type="text/javascript"></script>
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
			
			
			document.getElementById("success_notify").style.display='none';
			document.getElementById("success_claim").style.display='none';
			$(document).ready(function(){		
				var currentData = <?php echo json_encode($reservations); ?>;


				function printAuthor( data ){
					var ret = "";
					for( var i = 0; i < data.length; i++ ){
						ret += "<span>" + data[i].lname +  ",";
						ret += data[i].fname;
						ret += data[i].mname +  " </span> <br />";
					}

					return ret;
				}

				function printEdition( data ){
					if( data != null ){
						if( data % 10 == 1 )
							return "<span> "+ data +"st Edition </span>."; 
						if( data % 10 == 2 )
							return "<span> "+ data +"nd Edition </span>."; 
						if( data % 10 == 3 )
							return "<span> "+ data +"rd Edition </span>."; 
						else 
							return "<span> "+ data +"th Edition </span>."; 
					}
				}

				function printDate( data, date ){
					if( data == 0 ){
						return "<td class='table-text' align = 'center' >Not yet notified </td>";
					} else {
						return "<td class='table-text' align = 'center' >" + date + "</td>";
					}
				}

				function printButton( condition ){
					if( condition == 0 ){
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}' disabled>Claim</button> </td>";
					} else {
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}' disabled>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button> </td>";
					}					
				}


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
								
							$('#error').html(result);
							if( result != "" ){
								$('tbody').html("");
								//alert(result.length);

								for( i = 0; i < result.length; i++ ){
									$('tbody').append("<tr id ='" + result[i].materialid + "-" + result[i].isbn + "' > <td class = 'isbn' class='table-text' align = 'center' > " + result[i].isbn + "  </td><td class = 'materialid' class='table-text' align = 'center'> " + result[i].materialid + "  </td> <td class = 'type' class='table-text' align = 'center' > " + result[i].type + " </td> <td class='table-text'>" + "<span class = 'name' > <strong> " + result[i].name + " </strong> </span>" + printAuthor(result[i].author) + "<span class = 'year' > " + result[i].year + " </span>." + printEdition( result[i].edvol ) + "</td> <td class = 'idnumber' class='table-text' align = 'center' > " + result[i].idnumber + "  </td> " + printDate( result[i].started, result[i].claimdate ) + "<td class='table-text' align = 'center' > " + result[i].queue + " </td> " + printButton( result[i].started ) + "</tr>");
									
								}
								$('table').trigger('update');
							} else {
								$('tbody').html(" no result ");
								//alert("Failed to notify");
								$("table").tablesorter();


							}
							$('table').trigger('update');
							
						}
					});
				});

				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});
				
				$(".sendClaim").click( function(){
					var thisButton = $(this);
					var parent = $(this).parent();
					var idnumber = $.trim(parent.siblings('.idnumber').text());
					var materialid = $.trim(parent.siblings('.materialid').text());
					var isbn = $.trim(parent.siblings('.isbn').text());
			
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
								//alert("Student has been notified");
								document.getElementById("success_notify").style.display='none';

								$("#success_claim").show();
								$("#success_claim").html("Successfully claimed!");
								$("#success_claim").fadeIn('slow');
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								setTimeout(function() { $('#success_claim').fadeOut('slow') }, 5000);
								$("#"+materialid+"-"+isbn).html("");	
							} else {
								//alert("Failed to notify");
							}
						}
					});
				});
				
				$(".sendNotif").click( function(){
					var thisButton = $(this);
					var parent = $(this).parent();
					var idnumber = $.trim(parent.siblings('.idnumber').text());
					var materialid = $.trim(parent.siblings('.materialid').text());
					var isbn = $.trim(parent.siblings('.isbn').text());

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
							$('#error').html(result);
							if( result != "1" ){

								// alert here if success
								thisButton.attr('disabled', true);
								thisButton.next().removeAttr('disabled');

								//alert("Success!")
								$("#success_notify").show();
								$("#success_notify").html("Successfully notified!");
								$("#success_notify").fadeIn('slow');
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								setTimeout(function() { $('#success_notify').fadeOut('slow') }, 5000);

							} else {
								//alert("Fail!");
							}
						}
					});
				});
			});
		</script>
	</body>
</html>