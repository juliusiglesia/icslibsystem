			<?php

/*
*	Filename: add_material_view.php
*	Project Name: ICS Library System
*	Date Created: 29 January 2014
*	Created by: Mac Emerson B. Reyes
*
*/	

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<<<<<<< HEAD
<?php include 'admin_header.php';?></div>
=======
<?php include 'admin_header.php'?></div>
>>>>>>> 5fd38ac4c3936aaa9fac9514aa9af01f2f8cbe62
        <div class="mainBody">
            <!-- Nav tabs -->
            <div class="sidebarMain">
				<ul class="nav nav-pills nav-stacked">
					<li id = "reserved-nav">
						<a href="<?php echo base_url();?>admin/reservation"><span class="glyphicon glyphicon-import"></span> &nbsp;Reserved Books</a>
					</li>
					<li id = "borrowed-nav" >
						<a href="<?php echo base_url();?>admin/borrowed_books"><span class="glyphicon glyphicon-export"></span> &nbsp;Borrowed Books</a>
					</li>
					<li id = "view-nav" >
						<a href="<?php echo base_url();?>admin/admin_search"><span class="glyphicon glyphicon-search"></span> &nbsp;View All Materials</a>
					</li>
					<li id = "add-nav" class="active">
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
		<div id="container">
		<form name="add" id="add" method="post" action="admin_search" onsubmit="return showModal()" class="form-horizontal">
		<h2 class="form-signin-heading">Fill up the necessary info: </h2>
		<div class="form-group">
			<label class="col-sm-2 control-label">Library Material ID</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="matID" placeholder="(e.g. CS1-A1, CS-01, C-1)" name="materialid" pattern="[A-Z0-9]+-[A-Z0-9]+"  required>
			</div>
				<span style="color: red;" name="helpmaterialid"> </span>
			
		</div>
		<div class="form-group">
			<label for="type" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-2">
				<select name="type" id="type" class="form-control" onClick="disableISBN()">
					<option value="Book" >Book</option>
					<option value="SP">SP</option>
					<option value="Reference">Reference</option>
					<option value="CD">CD</option>
					<option value="Journals">Journals</option>
					<option value="Magazines">Magazines</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="type" class="col-sm-2 control-label">ISBN</label>
			<div class="col-sm-2">
				<input type="text" class="form-control"  name="isbn" id="isbn" pattern="[0-9]+" placeholder="ISBN" required/>
			</div>
			<span style="color: red;" name="helpisbn">
		</div>
		<div class="form-group">
			<label for="course" class="col-sm-2 control-label">Course Classification</label>
			<div class="col-sm-2">
				<select name="course" id="course" class="form-control">
					<option value="CS1">CMSC 1</option>
					<option value="CS2">CMSC 2</option>
					<option value="CS11">CMSC 11</option>
					<option value="CS21">CMSC 21</option>
					<option value="CS22">CMSC 22</option>
					<option value="CS55">CMSC 55</option>
					<option value="CS56">CMSC 56</option>
					<option value="CS57">CMSC 57</option>
					<option value="CS100">CMSC 100</option>
					<option value="CS123">CMSC 123</option>
					<option value="CS124">CMSC 124</option>
					<option value="CS125">CMSC 125</option>
					<option value="CS127">CMSC 127</option>
					<option value="CS128">CMSC 128</option>
					<option value="CS129">CMSC 129</option>
					<option value="CS130">CMSC 130</option>
					<option value="CS131">CMSC 131</option>
					<option value="CS132">CMSC 132</option>
					<option value="CS137">CMSC 137</option>
					<option value="CS140">CMSC 140</option>
					<option value="CS141">CMSC 141</option>
					<option value="CS142">CMSC 142</option>
					<option value="CS150">CMSC 150</option>
					<option value="CS161">CMSC 161</option>
					<option value="CS165">CMSC 165</option>
					<option value="CS170">CMSC 170</option>
					<option value="CS178">CMSC 172</option>
					<option value="CS180">CMSC 180</option>
					<option value="CS191">CMSC 191</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">Title</label>
			<div class="col-sm-4">
				<input type="text" name="name" class="form-control" id="title" placeholder="Title" name="materialid" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required>
			</div>
			<span style="color: red;" name="helpname">
		</div>
		<div class="form-group">
			<label for="year" class="col-sm-2 control-label">Year of Publication</label>
			<div class="form-inline col-sm-2">
				<input type="number" name="year" class="form-control" id="year" placeholder="YYYY" name="year" min="1950" max="2014" pattern="[0-9][0-9][0-9][0-9]" required>
			</div>
			<span style="color: red;" name="helpyear">
		</div>
		<div class="form-group">
			<label for="ed" class="col-sm-2 control-label">Edition</label>
			<div class="form-inline col-sm-2">
				<input type="text" name="edvol" class="form-control" id="ed" placeholder="Edition (optional)" name="edvol" pattern="[0-9]">
			</div>
			<span style="color: red;" name="helpedvol">
		</div>
		<div class="form-group">
			<label for="access" class="col-sm-2 control-label">Accessibility</label>
			<div class="col-sm-3">
			<select name="access" id="access" class="form-control" required>
				
					<option value="4">Student/Faculty</option>
					<option value="1">Student</option>
					<option value="2">Faculty</option>
					<option value="3">Room Use</option>				
			</select>
			</div>
		</div>
		<div class="form-group">
			<label for="availability" class="col-sm-2 control-label">Availability</label>
			<div class="col-sm-2">
				<input type="radio" name="available" value="1" checked> Yes
				<input type="radio" name="available" value="0" disabled> No
			</div>
		</div>
		<div class="form-group">
			<label for="availability" class="col-sm-2 control-label">Requirements</label>
			<div class="col-sm-6">
				<input type="radio" name="requirement" value="0" checked> None
				<input type="radio" name="requirement" value="1"> Letter of the Owner / Consent of Instructor
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Author</label>
			<div class="form-inline col-sm-6">
				<table id="formTable">
				<tr>
					<td><input type="text" name="fname" class="form-control" placeholder="First Name" name="materialid" pattern="[A-Za-z]+" required></td>
					<td><input type="text" name="mname" class="form-control" placeholder="Middle Name" name="materialid" pattern="[A-Za-z]+" required></td>
					<td><input type="text" name="lname" class="form-control" placeholder="Last Name" name="materialid" pattern="[A-Za-z]+" required></td>
					<td><input type="button" value="+" onClick="addRow()"></td>
					<td><input type="button" value="x" onclick="deleteRow(this)" disabled ></td></td>
					<td><span style="color: red;" name="helpauthor"></td>
					<td><input type="hidden" name="numberOfAuthors" value="1"/></td>
				</tr>
				
				</table>
			</div>
		</div>		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-danger" id="addButton" name="insert" value="Add">
			</div>
		</div>
		</form>
		<br>
		<div class="modal fade" id="container1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-sm" >
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title" id="myModalLabel">Successfully added material</h3>
					  </div>
					  <div id="details" class="modal-body">
						

					  </div>
					  <div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Done</button>
					  </div>
					 </div>
					</div>
		</div>	
		</div>	
		</div>	
		</div>	
		</div>
		<!-- FOOTER -->
			<footer>
			<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
			</footer>
			
	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script type="text/javascript">
			var n = 1;
			
			function deleteRow(row){
				n--;
				
				var i=row.parentNode.parentNode.rowIndex;
				document.getElementById('formTable').deleteRow(i);
			}
		
			function addRow(){
				n++;
				
				var x=document.getElementById('formTable');
				// deep clone the targeted row
				var new_row = x.rows[0].cloneNode(true);
				
				// set the innerHTML of the first row 
				//new_row.cells[0].innerHTML = '';
				
				var inp6 = new_row.cells[6].getElementsByTagName('input')[0];
				inp6.value = n;
				
				// grab the input from the first cell and update its ID and value
				var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
				inp1.name += n;
				inp1.placeholder = 'First Name';
				inp1.required = true;
				inp1.pattern = "[A-Za-z]+";
				inp1.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
				inp2.name += n;
				inp2.placeholder = 'Middle Name';
				inp2.required = true;
				inp2.pattern = "[A-Za-z]+";
				inp2.value = '';
				
				
				// grab the input from the first cell and update its ID and value
				var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
				inp3.name += n;
				inp3.placeholder = 'Last Name';
				inp3.required = true;
				inp3.pattern = "[A-Za-z]+";
				inp3.value = '';
				
				
				var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
				inp4.disabled = false;
				
				var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
				inp5.disabled = false;
				
				
				// append the new row to the table
				x.appendChild(new_row);
			}
			
			window.onload = function() {
				add.materialid.onblur = validateMaterialID;
<<<<<<< HEAD
				add.type.onchange = disableFeatures;
				add.isbn.onchange = validateISBN;
=======
				add.type.onblur = disableFeatures;
				add.isbn.onblur = validateISBN;
>>>>>>> 5fd38ac4c3936aaa9fac9514aa9af01f2f8cbe62
				add.name.onblur = validateName;
				add.fname.onblur = validateAuthorF;
				add.mname.onblur = validateAuthorM;
				add.lname.onblur = validateAuthorL;
				add.year.onblur = validateYear;
				add.edvol.onblur = validateEdition;
				$('#container1').modal('hide');
			}
			
			
			function showModal(){
			/*	if(validateMaterialID() && disableClassification && validateName() && validateAuthorF() && validateAuthorM() && validateAuthorL() && validateYear() && validateEdition()){
				
				matID = "Material ID: <b>";
				matID += add.materialid.value + "</b><br />";
				
				type = "Type: <b>";
				type += add.type.value + "</b><br />";
				
				course = "Course Classification: <b>";
				course += add.course.value +"</b><br />";
				
				year = "Year of Publication: <b>";
				year += add.year.value +"</b><br />";
				
				if(add.edvol.value == ""){
					ed = "";
				}
				else{
					ed = "Edition: <b>";
					ed += add.edvol.value + "<br /></b>";
				}
				
				ac = "Accessibility: <b>";
				
				v = add.access.value
				
				if(v==4) ac += "Student/Faculty";
				else if(v==3) ac+= "Room Use";
				else if(v==2) ac+= "Faculty";
				else if(v==1) ac+= "Student";
				ac += "</b><br />";
				
				av = "Availability: <b>";
				av += "Available" +"</b><br />";

				re = "Requirement: <b>";
				r = document.getElementsByName('requirement');
					if(r[0].checked) req = "None";
					else req = "Letter of the Owner/Consent of Instructor";			
				re += req + "</b><br />";

				
				title = "Title: <b>";
				title += add.name.value +"</b><br />";
				
				if(n==1){
					aut = "Author: <b>";
					fname = add.fname.value;
					mname =  add.mname.value;
					lname =  add.lname.value;
					aut += fname + " " + mname + " " +  lname + "</b><br />";
				}
				
				if(n>1){
					var x=document.getElementById('formTable');
					var rowCount = x.getElementsByTagName('tr').length;
					aut = "Authors: ";
					
					for(i=0;i<rowCount;i++){
						name = "";
						name += x.rows[i].cells[0].innerHTML + x.rows[i].cells[1].innerHTML + x.rows[i].cells[2].innerHTML ;
						name += "<br />";
						aut += name;
					}
				}
				
				addedMaterial = matID + type + course + year + ed + ac + av+ re + title + aut;
				document.getElementById('details').innerHTML = addedMaterial;
				
				$('#container1').modal('show');
				
				window.setTimeout(function(){ 
				$("#container1").modal('hide'); }, 2000);
				
				flag = 0;
				$('#container1').on('hidden.bs.modal', function(){
					flag = 1;
					alert("hi1");
					//$("#add").submit();
					return true;
				});
				}
				return false;*/
			}
			
			function validateMaterialID(){
				msg = "Invalid input. ";
				str = add.materialid.value;
				if (str == "") {
					msg+="Library Material ID is required. ";
				}
				if (!str.match(/^[A-Z0-9]+-[A-Z0-9]+$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpmaterialid")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function disableFeatures(){
				type = add.type.value;
				if(type == "Book"){
					add.isbn.disabled = false;
					add.course.disabled = false;
					add.isbn.placeholder = "ISBN-10";
				}
				else if(type == "SP"){
					add.isbn.disabled = true;
					add.course.disabled = true;
				}
				else if(type == "Reference"){
					add.isbn.disabled = false;
					add.course.disabled = false;
					add.isbn.placeholder = "ISBN-10";
				}
				else if(type == "CD"){
					add.isbn.disabled = true;
					add.course.disabled = false;
				}
				else if(type == "Journals"){
					add.isbn.disabled = false;
					add.course.disabled = true;
					add.isbn.placeholder = "ISBN-8";
				}
				else if(type == "Magazines"){
					add.isbn.disabled = false;
					add.course.disabled = true;
					add.isbn.placeholder = "ISBN-8";
				}
			}
			
			function validateISBN(){
				msg = "Invalid input. ";
				str = add.isbn.value;
				pattern = add.isbn.pattern;
				
				if(add.type.value == "Book" || add.type.value == "Reference" ){
					if (str == "") {
						msg+="ISBN-10 is required. ";
					}
					if (!str.match(/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/)) {
						msg+="Characters are invalid.";
						pattern = "[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]";
					}
					if (msg == "Invalid input. ") msg="";

					document.getElementsByName("helpisbn")[0].innerHTML = msg;
					if (msg == ""){ 
						return true;
					}
				}
				else{
					if (str == "") {
						msg+="ISBN-8 is required. ";
					}
					if (!str.match(/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/)) {
						msg+="Characters are invalid.";
						pattern = "[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]";
					}
					if (msg == "Invalid input. ") msg="";

					document.getElementsByName("helpisbn")[0].innerHTML = msg;
					if (msg == ""){ 
						return true;
					}
				}
				
			}
			
			function validateName(){
				msg = "Invalid input. ";
				str = add.name.value;
				if (str == "") {
					msg+="Title is required. ";
				}
				if (!str.match(/^[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpname")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function validateAuthorF(){
				msg = "Invalid input. ";
				strf = add.fname.value;
				if (strf == "") {
					msg+="First name of the author is required. ";
				}
				else if (!strf.match(/^[A-Za-z]+$/)){
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpauthor")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function validateAuthorM(){
				msg = "Invalid input. ";
				strm = add.mname.value;
				if (strm == "") {
					msg+="Middle name of the author is required. ";
				}
				else if (!strm.match(/^[A-Za-z]+$/)){
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpauthor")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function validateAuthorL(){
				msg = "Invalid input. ";
				strl = add.lname.value;
				if (strl == "") {
					msg+="Last name of the author is required. ";
				}
				else if (!strl.match(/^[A-Za-z]+$/)){
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpauthor")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function validateYear(){
				msg = "Invalid input. ";
				str = add.year.value;
				if (str == "") {
					msg+="Year of publication is required. ";
				}
				if (!str.match(/^[0-9][0-9][0-9][0-9]$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpyear")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
			function validateEdition(){
				msg = "Invalid input. ";
				str = add.edvol.value;
				if (str == "") {
					add.edvol.value = "";
				}
				else if (!str.match(/^[0-9]+$/) && str != "") {
					msg="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";
				
				document.getElementsByName("helpedvol")[0].innerHTML = msg;
				if (msg == ""){ 
					return true;
				}
			}
			
		</script>
	</body>
</html>