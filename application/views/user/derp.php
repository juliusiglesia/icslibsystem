<p><h4>Books on Hand</h4>
			<table class="table table-hover" id="onhand" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
			<thead>
              <tr>
                <th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Material ID</th>
                <th style="width:100px;" abbr="CourseClassification" scope="col" title="Course Classification">infoooooo!</th>
              </tr>
            </thead>
				<?php
				foreach($borrowed as $row){
				echo "<tr>";
				echo "<td> ${row['materialid']} </td>";
				echo "<td> ${row['fname']} ${row['mname']} ${row['lname']}. ${row['name']}. ${row['year']}. (${row['type']}) </td>";
				echo "</tr>";
				}
				?>
			</table>
						
			<!--Reserved -->

			<p><h4>Reserved Books</h4>
			<table class="table table-hover" summary="Results" border="1" cellspacing="5" cellpadding="5">
	 <thead>
              <tr>
				<tr>
                <th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Material ID</th>
                <th style="width:550px;" abbr="CourseClassification" scope="col" title="Course Classification">infoooooo!</th>
                <th abbr="Action" scope="col" title="Action">Action</th>
              </tr>
			  
            </thead>
			
			
				<?php
				foreach($borrowed as $row){
				echo "<tr>";
				echo "<td> ${row['materialid']} </td>";
				echo "<td> ${row['fname']} ${row['mname']} ${row['lname']}. ${row['name']}. ${row['year']}. (${row['type']}) </td>";

				echo "</tr>";
				}
				?>
                
			  
			</table>
			
			</p>
			
			<!-- Modal window for cancelling material reservations -->
			
			<div class="modal fade" id="cancel_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="myModalLabel">Cancel Reservation</h3>
				  </div>
				  <div class="modal-body">
				      <form class="form-signin" role="form">
						<h4 class="form-signin-heading">You chose to cancel your reservation for this material. Do you wish to continue?</h4>				
				  </div>
				  <div class="modal-footer">
					<input href="#no" data-dismiss="modal" onclick="" type="submit" value="No" class="btn btn-primary"/>
					<input href="#yes" data-dismiss="modal" onclick="" type="submit" value="Yes" class="btn btn-primary" data-toggle="modal" data-target="#cancel_dialog"/>
					 </form>
				  </div>
				</div>
			  </div>
			</div>
			
			<!-- Confirm cancelling the reservation -->
			
			<div class="modal fade" id="cancel_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="myModalLabel">Reservation Cancelled</h3>
				  </div>
				  <div class="modal-body">
				      <form class="form-signin" role="form">
						<h4 class="form-signin-heading">The library material reservation has been successfully cancelled.</h4>						
				  </div>
				  <div class="modal-footer">
					<input href="#ok" data-dismiss="modal" onclick="" type="submit" value="Done" class="btn btn-primary"/>
					 </form>
				  </div>
				</div>
			  </div>
			</div>