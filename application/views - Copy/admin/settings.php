<?php include 'admin_header.php'?></div>
        <div class="mainBody">
            <!-- Nav tabs -->
            <div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav" >
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
		<div class="alert-container">
			<div class="alert alert-success alert-dismissable" id="info_succ" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Update successful!</strong> Information successfully updated.
			</div>
			
			<div class="alert alert-success alert-dismissable" id="pword_succ" style="display:none;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Update successful!</strong> Password successfully updated.
			</div>
		</div>
		<div id="settings_container">
		
		<h2>Administrator Settings</h2><br />
		
		
			<table id="settingsForm">
				<tr>
					<td><label>*Fine: </label></td>
					<td><input type="text" value="3.00" name="fine" pattern="[0-9]+" id="fine" disabled required></td>
				</tr>
				<tr>
					<td><label>*Start of Semester: </label></td>
					<td><input type="date" value="2013-11-11" name="start_sem" id="start_sem" disabled required></td>
				</tr>
				<tr>
					<td><label>*End of Semester: </label></td>
					<td><input type="date" value="2014-03-29" name="end_sem" id="end_sem" disabled required></td>
					
				</tr>
				
				<tr>
				<td><br /></td>
				</tr>
				
				</table>

					<input type="submit" id="cancel_1" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel1()">
					<input type="button" id="save_1" name="insert" class="btn btn-primary" value="Update" onclick="validate_info()" style="display: none;">
					<input type="submit" id="upd_info" class="btn btn-primary" align="right" value="Update Info" onclick="update1()" />
				
				<hr style="border:1px dashed #A8A8FF; text-align:center;"></td>
				
				<tr>
					
				<table>
					<td><h4>Edit Password</h4></td>
					<tr>
<tr>
					<td><label>Current Password:</label></td>
					<td><input type="password" id="currpw" name="currpw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
					</tr>
				<tr>
					<td><label>Retype Current Password:</label></td>
					<td><input type="password" id="crepw" name="crepw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				<tr>
					<td><label>New Password:</label></td>
					<td><input type="password" id="newpw" name="newpw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
				<tr>
					<td><label>Retype New Password:</label></td>
					<td><input type="password" id="nrepw" name="nrepw" value="" pattern="\w{0,}\d{1,}\w{0,}" disabled></td>
				</tr>
					
					<tr>
					<td><br /></td>
					</tr>
				
				</table>
				
		<input type="submit" id="cancel_2" name="insert" class="btn" value="Cancel" style="display: none;" onclick="cancel2()">
		<input type="button" id="save_2" name="insert" class="btn btn-primary" value="Save" style="display: none;" onclick="valPword()">
		<input type="submit" id="upd_pword" name="insert" class="btn btn-primary" value="Update Password" onclick="update2()">
		<br>
		
		</div>
		</div>
		</div>
		</div>
		<footer>
        <center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
      </footer>

    </div>

	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
	<script>		
	
	/*
			UPDATE INFORMATION VALIDATION
	*/
		function update1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info = document.getElementById('upd_info');
			
			fine.disabled=false;
			start_sem.disabled=false;
			end_sem.disabled=false;
			cancel_1.style.display='inline';
			save_1.style.display='inline';
			upd_info.style.display='none';
			
		
		}
		
		function cancel1(){
		
			var fine = document.getElementById('fine');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var cancel_1 = document.getElementById('cancel_1');
			var save_1 = document.getElementById('save_1');
			var upd_info= document.getElementById('upd_info');
			
			fine.disabled=true;
			start_sem.disabled=true;
			end_sem.disabled=true;
			cancel_1.style.display='none';
			save_1.style.display='none';
			upd_info.style.display='inline';
		
		}
		
				
		function validate_info(){
		
			var fine = document.getElementById('fine');
			var filter = /^([0-9\.\])+(([0-9\-]{2})+$/; 
			var upd_info = document.getElementById('upd_info');
			var cancel1 = document.getElementById('cancel1');
			var save1 = document.getElementById('save1');
			var start_sem = document.getElementById('start_sem');
			var end_sem = document.getElementById('end_sem');
			var info_succ = document.getElementById('info_succ');

			if (!filter.test(fine.value)){
				alert('Invalid fine value.');
				fine.focus;	
				return false;
			}
			
			else if(end_sem.value < start_sem.value){
				
				alert('End of semester date should occur later than the start of semester date.');
				return false;
			}
			
			else{
				fine.disabled=true;
				start_sem.disabled=true;
				end_sem.disabled=true;
				info_succ.style.display='block';	
				cancel_1.style.display='none';
				save_1.style.display='none';
				upd_info.style.display='inline';
							
			}
		
		}
		
		/*
				UPDATE PASSWORD VALIDATION
		*/
		
		function update2(){
		
			var newpw = document.getElementById('newpw');
			var currpw = document.getElementById('currpw');
			var repw = document.getElementById('repw');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');
			
			newpw.disabled=false;
			currpw.disabled=false;
			repw.disabled=false;
			cancel_2.style.display='inline';
			save_2.style.display='inline';
			upd_pword.style.display='none';
		
		}
		
		function cancel2(){
		
			var newpw = document.getElementById('newpw');
			var currpw = document.getElementById('currpw');
			var repw = document.getElementById('repw');
			var cancel_2 = document.getElementById('cancel_2');
			var save_2= document.getElementById('save_2');
			var upd_pword= document.getElementById('upd_pword');
			
			newpw.disabled=true;
			currpw.disabled=true;
			repw.disabled=true;
			cancel_2.style.display='none';
			save_2.style.display='none';
			upd_pword.style.display='inline';
		
		}
		
		function valPword(){
			
			var currpw=document.getElementById('currpw');
			var newpw = document.getElementById('newpw');
			var repw = document.getElementById('repw');
			var upd_pword = document.getElementById('upd_pword');
			var save_2 = document.getElementById('save_2');
			var cancel_2 = document.getElementById('cancel_2');
			var pword_succ = document.getElementById('pword_succ');
													
			if (newpw.value!=repw.value || (newpw.value == '' || repw.value == '')) {
				alert('Please retype your password.');
				newpw.focus;
				return false;
			}
			else{
				currpw.value = newpw.value;
				newpw.value='';
				repw.value='';
				newpw.disabled=true;
				currpw.disabled=true;
				repw.disabled=true;
				cancel_2.style.display='none';
				save_2.style.display='none';
				upd_pword.style.display='inline';
				pword_succ.style.display='block';
				
			}
		
		}
	</script>

	</body>
</html>