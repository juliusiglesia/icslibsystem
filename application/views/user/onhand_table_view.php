<!--

	SHOWS THE TABLE OF A USER'S CURRENTLY BORROWED BOOKS

-->

<table class="table table-hover tablesorter" id="myTable" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
	<thead>
		<tr>
			<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
			<th width="15%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
			<th width="5%" abbr="type" scope="col" title="Type">Type</th>
			<th width="69%" abbr="Descp" scope="col" title="Description">Description</th>
			<th width="6%" abbr="ISBN" scope="col" title="Fine">Fine</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
			<th width="15%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
			<th width="5%" abbr="type" scope="col" title="Type">Type</th>
			<th width="69%" abbr="Descp" scope="col" title="Description">Description</th>
			<th width="6%" abbr="ISBN" scope="col" title="Fine">Fine</th>
		</tr>
	</tfoot>

	<?php
		foreach($borrowed as $row){
			echo "<tr>";
			echo "<td><center><span class='table-text'>";
				$tmp = $row['isbn'];
				if (preg_match('/^[+]/', $tmp)) {
					echo "---";
				} else {
					echo "${row['isbn']}";
				}
			echo "</center></span></td>";
			echo "<td><center><span class='table-text'> ${row['materialid']} </span></center> </td>";
			echo "<td><center> ";
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
											
			echo "$type</center></td>";
			echo "<td><span class='table-text'><b>${row['name']}</b></span><br><span class='author'>${row['fname']} ${row['mname']} ${row['lname']}. ${row['year']}.</span></td>";
			echo "<td><span class='table-text'><center>";
				if("${row['user_fine']}" > 0){
					echo "${row['user_fine']}";
				}else{
					echo "0";
				}
			echo "</center></span></td>";
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