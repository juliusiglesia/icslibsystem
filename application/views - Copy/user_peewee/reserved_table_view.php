<!--

	SHOWS THE TABLE OF A USER'S CURRENTLY RESERVED BOOKS
	
-->

<table class="table table-hover tablesorter" id="myTable" summary="Results" border="1" cellspacing="5" cellpadding="5">
	<thead>
		<tr>
			<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
			<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
			<th width="5%" abbr="Type" scope="col" title="Type">Type</th>
			<th width="75%" abbr="CourseClassification" scope="col" title="Description">Description</th>
			<th width="5%" abbr="Queue" scope="col" title="Queue">Rank</th>
			<th width="5%" abbr="Action" scope="col" title="Action">Action</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
			<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
			<th width="5%" abbr="Type" scope="col" title="Type">Type</th>
			<th width="75%" abbr="CourseClassification" scope="col" title="Description">Description</th>
			<th width="5%" abbr="Queue" scope="col" title="Queue">Rank</th>
			<th width="5%" abbr="Action" scope="col" title="Action">Action</th>
		</tr>
	</tfoot>	
										
	<?php
		if($list!=NULL && $rank!=NULL && $total!=NULL){
			foreach($reserved as $row){
				echo "<form method ='post'>";
				echo "<tr>";
				echo "<td><span class='table-text'><center>";
					$tmp = $row['isbn'];
					if (preg_match('/^[+]/', $tmp)) {
						echo "---";
					} else {
						echo "${row['isbn']}";
					}
				echo "</td>";
				echo "<td><span class='table-text'><center> ${row['materialid']} </td>";
				echo "<td><center>";
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
												
				echo "$type";
				echo "</center></td>";
				/*echo "<td><span class='table-text'> <b>${row['name']}</b></span>
					 <span class='author'><br/>${row['authorname']}. 
					  ${row['year']}
					  </span></td>";*/
				echo "<td> <b>${row['name']}</b>
					 <br/>${row['fname']}
					  ${row['mname']} ${row['lname']}. 
					  ${row['year']}
					  </td>";
				foreach($rank as $q_rank){
							
				if($q_rank['materialid']==$row['materialid']){
					$rrank=$q_rank['queue'];
					}
				}
				foreach($total as $t_queue){
				if($t_queue['materialid']==$row['materialid']){
					 $t_q=$t_queue['tq'];
				}
				}
				  echo "<td><span class='table-text'><center> $rrank of $t_q </td>";
				  echo "<td><button type=\"submit\" class=\"cancel_reservation btn btn-primary\" data-dismiss=\"modal\" name = 'materialid' value='${row['materialid']}'>CANCEL</button>" . "</td>";
				  echo "</form>";
				  echo "</tr>";
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
<script src="<?php echo base_url();?>dist/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('.cancel_reservation').on('click', function(){
			if(confirm('Are you sure?'))
			{
				materialid = $(this).val();
					$.ajax({
  						type: "POST",
  						url: "<?php echo site_url('borrower/cancel_reservation');?>",
  						data: {materialid: materialid},
  						success: function()
  						{
  							alert('You have successfully cancelled the item');
  							location.reload();
  						},
  						error: function()
  						{
  							alert('Cancel failed. Try again.');
  						}
  					});
			}	

			else
			{

			}

		});
	});


</script>
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