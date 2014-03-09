<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>	
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

						<input type="text" id = "searchReservedBooks" name ="search"  size="80"/>
						<input class = "btn btn-primary" type="button" id = "searchReservedButton" value="Search"/> 
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
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
		<!-- Footer -->
		<?php include 'includes\footer.php'; ?>

		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/jquery.tablesorter.widgets.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>dist/js/widget-pager.js"></script>
		<!--script src="<?php echo base_url();?>dist/js/dynamic.js"></script-->
		<!--script src="<?php echo base_url();?>dist/js/modernizr.js"></script-->
		
		<script id="js">

			$('#user-nav').addClass('active');
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
				$("#logout").click(function(){
					window.location.href = "<?php echo site_url('admin/logout'); ?>";
				});	
		</script>
	</body>
</html>