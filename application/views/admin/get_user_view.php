<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>	

		<script type="text/javascript">

		function confirmDeleteAccount( thisDiv ){
			bootbox.dialog({
				message: "This account will be deleted. Are you sure you want to proceed?",
				title: "Delete Account",
				onEscape: function() {},
				buttons: {
					yes: {
						label: "Yes, continue.",
						className: "btn-primary",
						callback: function() {
							var password = prompt( "Please enter admin password" ).trim();
							if( password != "" ){
								$.ajax({
									type : "POST",
									url : "<?php echo base_url(); ?>admin/check_password",
									data : { password : password },
									success : function( result ){
													console.log( result );
													if( result == "1" ){
 														deleteAccount(thisDiv);
													} else {
														alert( "Wrong password!" );
													}
												}

								});								
							}
						}
					},
					no: {
						label: "No.",
						className: "btn-default"
					}
				}
			});
		}

		function deleteAccount( thisDiv ){
			var idnumber = thisDiv.parent().siblings('.idnumber').text().trim();
			$.ajax({
				type : "POST",
				url : "<?php echo base_url(); ?>admin/delete_account",
				data : { idnumber : idnumber },
				success : function( result ){
					if( result == "" ){
						console.log("Deleted");
						$('#'+idnumber).remove();
					}

					$('table').trigger('update');
				}
			});
		}

		</script>
	</head>		
	<body>
		<?php include 'includes\header.php'; ?>

		<div class="mainBody">
			<!-- Nav tabs -->
			<?php include 'includes\sidebar.php'; ?>
			
			<div class="leftMain">
				<div id="main-page">
					<div id = "main-content">
						<br />
						<br />
						<div id = "search" align="center">
						<input type="text" id = "searchUser" name ="search"  size="80"/>
						<input class = "btn btn-primary" type="button" id = "searchUserButton" value="Search"/>
						</div>
						<div id = "alert"> </div><br /><br />
	                
						<table class="table table-hover tablesorter" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th width="10%"><center>Student/Employee Number</center></th>
									<th width="55%"><center>Borrower Information</center></th>
									<th width="15%"><center>Status</center></th>
									<th width="20%"><center>Remove</center></th>
								</tr>
							</thead>
							
							<tbody>
								<?php  
									foreach ($users as $data){
										$data = (array)$data;
										echo "<tr id = '${data['idnumber']}'>";
										echo "<td class = 'idnumber' > ${data['idnumber']}  </td>";
										echo "<td>"; 
										echo "<strong><span class = 'fname'> ${data['fname']} </span> <span class = 'mname'> ${data['mname']}  </span> <span class = 'lname'> ${data['lname']}  </span> </strong> <br /> ${data['email']}  <br />"; 
										echo "<span class = 'college'> ${data['college']}  </span> - <span class = 'course'> ${data['course']} </span>"; 
										
										if( $data['classification'] == 'F' ) echo "<span class = 'classification'><i> (Faculty) </i> </span><br />"; 
										else echo "<span class = 'classification'><i> (Student) </i> </span><br />"; 
										echo "</td>";
										echo "<td> <strong> ${data['status']} </strong> </td>";
										echo "<td> <button class = 'btn btn-default' onclick = 'confirmDeleteAccount($(this))' > Delete Account </button> </td>";
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
		</div>
		
		 <!-- FOOTER -->
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
				})

				.tablesorterPager(pagerOptions);
			});
		
		</script>
		<script type="text/javascript">
			$('#user-nav').addClass('active');

			function printIdNumber( idnumber ){
				return "<td class = 'idnumber'> " + idnumber + "</td>"
			}

			function printStatus( status ){
				return "<td class = 'status'> <strong>" + status + "</strong></td>"
			}

			function printBorrowerInfo( fname, mname, lname, email, course, college, classification ){
				ret = "<td> <strong> <span class = 'fname'> " + fname + " </span><span class = 'fname'> " + mname + " </span><span class = 'fname'> " + lname + " </span> </strong> <br />";
				ret += "<span class = 'email'> " + email + " </span><br />";
				ret += "<span class = 'college'> " + college + "  </span> - <span class = 'course'> " + course + " </span>";
				
				if( classification == 'F' ) ret += "<span class = 'classification'><i> (Faculty) </i> </span><br />"; 
				else ret += "<span class = 'classification'><i> (Student) </i> </span><br />"; 

				ret += "</td>";

				return ret;
			}
			
			function printButton( ){
				return "<td> <button class = 'btn btn-default' onclick = 'confirmDeleteAccount($(this))' > Delete Account </button> </td>";
			}

			function updateContents( data ){
				var content = "";

				content += printIdNumber( data.idnumber );
				content += printBorrowerInfo( data.fname, data.mname, data.lname, data.email, data.course, data.college, data.classification );
				content += printStatus( data.status );
				content += printButton();
				
				return content;
			}

			$('#searchUserButton').click(function (){
				var search = $('#searchUser').val();
				$.ajax({
					type : "POST",
					url : "<?php echo base_url(); ?>admin/search_user",
					data : { search : search },
					dataType : "json",
					success : function( result ){
						if( result.length != 0 ){
							$('tbody').html("");
							for( var i = 0; i < result.length; i++ ){
								$('tbody').append("<tr id = '"+ result[i].idnumber  +"'>" + updateContents(result[i]) + "</tr>");	
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
		</script>
		<script>
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
			</script>
	</body>
</html>