<?php include 'Logout_header.php'; ?> 
<table align= "center" id="result_waitlist" summary="waitlist" border="1" cellspacing="5" cellpadding="5">
            <thead>
              <tr>
                <th style="width:200px;" abbr="lmID" scope="col" title="author">Author</th>
                <th style="width:400px;" abbr="CourseClassification" scope="col" title="title">Title</th>
                <th abbr="Type" scope="col" title="year">Year of Publication</th>
                <th abbr="Author" scope="col" title="type">Type</th>
		<th abbr="Action" scope="col" title="reserve">RANK</th>
		
              </tr>
            </thead>
            <tbody>
              <?php
				
			if($list!=NULL && $rank!=NULL && $total!=NULL){
				 foreach($list as $row){
				     
						
						echo "<tr>";
						echo "<td> ${row['lname']}, ${row['fname']}, ${row['mname']} </td>";
						echo "<td> ${row['name']} </td>";
						echo "<td> ${row['year']} </td>";
						echo "<td> ${row['type']} </td>";
						foreach($rank as $q_rank){
							if($q_rank['materialid']==$row['materialid']){
								$rank=$q_rank['queue'];
							}
						}
						foreach($total as $t_queue){
						if($t_queue['materialid']==$row['materialid']){
							$t_q=$t_queue['tq'];
						}
						}
						echo "<td> $rank of $t_q </td>";
					
					
						
					/*}if($total!=NULL){
					      foreach($total as $t_row){
						if($row['materialid']==$t_row['materialid']){
							$total=$t_row['total'];
							
					}*/
					
					echo "</tr>";
					}
					}
			
					
		?>
            </tbody>
</table>
		<?php echo "<form action=\"inside_search\" role=\"form\" method=\"post\" align=\"center\">";
						
					echo "<button class=\"btn btn-primary\" type=\"submit\">Cancel</button>";
					echo "</form>" ; ?>
<?php include 'home_footer.php'; ?>
