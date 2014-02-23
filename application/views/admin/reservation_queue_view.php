<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>ICS-iLS</title>

		<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
		<link href="<?php echo base_url();?>dist/css/dataTables.bootstrap.css"  rel="stylesheet" type="text/css" >
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
					<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>dist/images/logowhite.png" height="30px"></a>
				</div>
				
				<form class="navbar-form navbar-right" role="form">
					<button type="button" class="btn btn-success" id = "logout" >Log out</button>
				</form>

			</div>
		</div>

		<div class="mainBody">
			<!-- Nav tabs -->
			<div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "overview-nav">
						<a href="<?php echo base_url();?>admin/home">Overview</a>
					</li>
					<li id = "reserved-nav"  class="active" >
						<a href="<?php echo base_url();?>admin/reservation">Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
						<a href="<?php echo base_url();?>admin/borrowed_books">Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search">View All Library Materials</a>
					</li>
					<li id = "add-nav" >
						<a href="<?php echo base_url();?>admin/add_material">Add A New Material</a>
					</li>
					<li id = "generate-nav" >
						<a href="<?php echo base_url();?>admin/print_inventory" target = "_blank" >Generate Report</a>
					</li>
				</ul>
			</div>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">

			
						<form method="post"  style="width: 600px ; margin-left: auto; margin-right: auto;" role="form">
							<input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
							<input class = "btn btn-primary" type="submit" id = "searchReservedBooks" value="Search" name="search_books"/> 
							<div id = "success_notify" class = "alert alert-success">  </div>
							<div id = "success_claim" class = "alert alert-success">  </div>
							<br />
                        </form>
                         <br/>
        

<table class="tablesorter">
	<thead>
		<tr>
			<th>Material ID</th>
			<th>ISBN</th>
			<th>Type</th>
			<th>Borrower</th>
			<th>Material</th>
			<th>Start Date</th>
			<th>Rank</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
									echo "<script>  var rowCount = 0; </script>";
									$rank = 0;
									foreach($reservations as $row){
										echo 	"<script> 
													rowCount++; 
												</script>";
										echo "<tr id = '${row['materialid']}'>";

										echo "<td class = 'materialid' > ${row['materialid']} </td>";
										echo "<td class = 'isbn' > ${row['isbn']} </td>";
										echo "<td class = 'type' > ${row['type']} </td>";
										echo "<td class = 'idnumber' > ${row['idnumber']} </td>";

										echo "<td>";
										echo "<span class = 'name' ><b> ${row['name']}</span></b>" . ",";
										
										foreach ($row['author'] as $name) {
											$name = (array)$name;
											echo "<span > ${name['lname']}, ${name['fname']} ${name['mname']} </span>" . "<br />.";
										}

										
										echo "<span class = 'year' > ${row['year']}</span>" . ".";
										if( $row['edvol'] != NULL ){
											if( $row['edvol'] % 10 == 1 )
												echo "<span> ${row['edvol']}st Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 2 )
												echo "<span> ${row['edvol']}nd Edition </span>" . "."; 
											if( $row['edvol'] % 10 == 3 )
												echo "<span> ${row['edvol']}rd Edition </span>" . "."; 
											else 
												echo "<span> ${row['edvol']}th Edition </span>" . ".";
										}
										echo "</td>";
										
										if( $row['started'] == 0 ){
											echo "<td> Not yet notified </td>";
											echo "<td> ${row['queue']}/${row['total']} </td>";
											echo "<td><button class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button>";
											echo "<button class='sendClaim btn btn-primary' name='claim' value='${row['id']}'  disabled>Claim</button>";
											echo "</td>";
										} else {
											echo "<td> ${row['startdate']} </td>";
											echo "<td>${row['queue']}/${row['total']} </td>";
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
		<img src="../addons/pager/icons/first.png" class="first" alt="First" />
		<img src="../addons/pager/icons/prev.png" class="prev" alt="Prev" />
		<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
		<img src="../addons/pager/icons/next.png" class="next" alt="Next" />
		<img src="../addons/pager/icons/last.png" class="last" alt="Last" />
		<select class="pagesize" title="Select page size">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
		</select>
		<select class="gotoPage" title="Select page number"></select>
	</div>
					</div>
				</div>
				<!--button id="button" > button </button-->
				<div id = "error"> </div>
			</div>
		
		<footer>
            <a href="#" class="back-to-top"><img id="foot" src="<?php echo base_url();?>dist/images/top_icon.PNG" alt="Back to Top"></a>
            <p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
        </footer>

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();?>js/jquery.tablesorter.js" type="text/javascript"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
		
		<script id="js">$(function(){

	// **********************************
	//  Description of ALL pager options
	// **********************************
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

		// Initialize tablesorter
		// ***********************
		.tablesorter({
			theme: 'blue',
			widthFixed: true,
			widgets: ['zebra']
		})

		// bind to pager events
		// *********************
		.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
			var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
				' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
			$('#display')
				.append('<li><span class="str">"' + e.type + msg + '</li>')
				.find('li:first').remove();
		})

		// initialize the pager plugin
		// ****************************
		.tablesorterPager(pagerOptions);

		// Add two new rows using the "addRows" method
		// the "update" method doesn't work here because not all rows are
		// present in the table when the pager is applied ("removeRows" is false)
		// ***********************************************************************
		var r, $row, num = 50,
			row = '<tr><td>Student{i}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>' +
				'<tr><td>Student{j}</td><td>{m}</td><td>{g}</td><td>{r}</td><td>{r}</td><td>{r}</td><td>{r}</td><td><button type="button" class="remove" title="Remove this row">X</button></td></tr>';
		$('button:contains(Add)').click(function(){
			// add two rows of random data!
			r = row.replace(/\{[gijmr]\}/g, function(m){
				return {
					'{i}' : num + 1,
					'{j}' : num + 2,
					'{r}' : Math.round(Math.random() * 100),
					'{g}' : Math.random() > 0.5 ? 'male' : 'female',
					'{m}' : Math.random() > 0.5 ? 'Mathematics' : 'Languages'
				}[m];
			});
			num = num + 2;
			$row = $(r);
			$('table')
				.find('tbody').append($row)
				.trigger('addRows', [$row]);
			return false;
		});

		// Delete a row
		// *************
		$('table').delegate('button.remove', 'click' ,function(){
			var t = $('table');
			// disabling the pager will restore all table rows
			// t.trigger('disable.pager');
			// remove chosen row
			$(this).closest('tr').remove();
			// restore pager
			// t.trigger('enable.pager');
			t.trigger('update');
			return false;
		});

		// Destroy pager / Restore pager
		// **************
		$('button:contains(Destroy)').click(function(){
			// Exterminate, annhilate, destroy! http://www.youtube.com/watch?v=LOqn8FxuyFs
			var $t = $(this);
			if (/Destroy/.test( $t.text() )){
				$('table').trigger('destroy.pager');
				$t.text('Restore Pager');
			} else {
				$('table').tablesorterPager(pagerOptions);
				$t.text('Destroy Pager');
			}
			return false;
		});

		// Disable / Enable
		// **************
		$('.toggle').click(function(){
			var mode = /Disable/.test( $(this).text() );
			$('table').trigger( (mode ? 'disable' : 'enable') + '.pager');
			$(this).text( (mode ? 'Enable' : 'Disable') + 'Pager');
			return false;
		});
		$('table').bind('pagerChange', function(){
			// pager automatically enables when table is sorted.
			$('.toggle').text('Disable Pager');
		});

});</script>


		<script>
			
			
			document.getElementById("success_notify").style.display='none';
			document.getElementById("success_claim").style.display='none';
			$(document).ready(function(){		
				event.preventDefault();
				var currentData = <?php echo json_encode($reservations); ?>;

				//$('#reserved-materials').dataTable();

				function updateContents( current, result ){
					var exist = false;
					if( result.length != current.length ){
						for( var i = 0; i < result.length; i++  ){
							for( var j = 0; j < current.length; j++  ){
								if( result[i].id == current[j].id  ){
									exist = true;
								}
							}		
							if( !exist ) {
								$('#reserved-materials').prepend("<tr id ='" + result[i].materialid + "' > <td class = 'materialid' > " + result[i].materialid + "  </td> <td class = 'idnumber' > " + result[i].idnumber + "  </td> <td>" + "<span class = 'name' > " + result[i].name + " </span>, <span class = 'year' > " + result[i].year + " </span>." + printEdition( result[i].edvol ) + "<span> <br /> ( " + result[i].type + " )</span> </td> <td> " + printDate( result[i].started, result[i].startdate ) + " </td> <td> " + result[i].queue + " </td> <td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button> </td></tr>");
								//$('#reserved-materials').dataTable().fnAddData( result[i] );
							}
							
							exist = false;
						}
					}					
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
						return "<td>Not yet notified </td>";
					} else {
						return "<td>" + date + "</td>";
					}
				}

				function printButton( condition ){
					if( condition == 0 ){
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}'>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}' disabled>Claim</button> </td>";
					} else {
						return "<td><button click class='sendNotif btn btn-primary' name='notify' value='${row['id']}' disabled>Notify</button> <button click class='sendClaim btn btn-primary' name='claim' value='${row['id']}'>Claim</button> </td>";
					}

					
				}

				$("#searchReservedBooks").keyup(function(){
					var search = $("#searchReservedBooks").val();
				//alert(search);
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
								
							// show that notification is successful
							$('#error').html(result);
							if( result != "" ){
								$('tbody').html("");
								//alert(result.length);
								for( i = 0; i < result.length; i++ ){
									$('tbody').append("<tr id ='" + result[i].materialid + "' > <td class = 'materialid' > " + result[i].materialid + "  </td> <td class = 'isbn' > " + result[i].isbn + "  </td><td class = 'type' > " + result[i].type + " </td> <td class = 'idnumber' > " + result[i].idnumber + "  </td> <td>" + "<span class = 'name' > <strong> " + result[i].name + " </strong> </span>, Author,<span class = 'year' > " + result[i].year + " </span>." + printEdition( result[i].edvol ) + "<span>  <br /> ( " + result[i].type + " )</span> </td>" + printDate( result[i].started, result[i].claimdate ) + "<td> " + result[i].queue + " </td> " + printButton( result[i].started ) + "</tr>");
									
								}
								//$("#reserved-materials")
								//	.tablesorter({widthFixed: true, widgets: ['zebra']})
								//	.tablesorterPager({container: $("#pager")});
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

				function searchReservedMaterial( search ){
					
				}

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
								$("#"+materialid).html("");	
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

				$("#button").click(function(){
					$.ajax({

						url: "<?php echo base_url();?>update/reservation_queue",
						dataType: "json",

						beforeSend: function() {
							//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
							//$("#error_message").html("loading...");
						},

						error: function(xhr, textStatus, errorThrown) {
							//	$('#error_message').html(textStatus);
						},

						success: function( result ){
							alert(result.length);
							alert(rowCount);
							alert( currentData[0].id );
							updateContents( currentData, result );
							currentData = result;
							console.log( currentData );
							//$('#reserved-materials').dataTable( { currentData });
						}

					});
				});
			});
		</script>
	</body>
</html>