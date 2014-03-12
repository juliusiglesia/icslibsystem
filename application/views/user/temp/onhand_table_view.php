<!--

	SHOWS THE TABLE OF A USER'S CURRENTLY BORROWED BOOKS

-->

<table class="table table-hover" id="onhand" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
	<thead>
		<tr>
			<th width="5%" abbr="ISBN" scope="col" title="ISBN/ISSN">ISBN/ISSN</th>
			<th width="10%" abbr="lmID" scope="col" title="Library Material ID">Library Material ID</th>
			<th width="5%" abbr="type" scope="col" title="Type">Type</th>
			<th width="75%" abbr="CourseClassification" scope="col" title="Description">Description</th>
			<th width="5%" abbr="ISBN" scope="col" title="Fine">Fine</th>
		</tr>
	</thead>

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
			echo "<td><span class='table-text'><b>${row['name']}</b></span><br><span class='author'>${row['authorname']}. ${row['year']}.</span></td>";
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