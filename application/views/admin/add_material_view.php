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

<!DOCTYPE html>
<html lang="en">
	<?php include 'includes/head.php'; ?>
	<body>
        <?php include 'includes/header.php'; ?>
        <div class="mainBody">
            <!-- Nav tabs -->
            <?php include 'includes/sidebar.php'; ?> 

       <div class="leftMain">
        	<div id="main-page">
        		<div id = "main-content">
					<div id="container">
						<form name="add" id="add" method="post" action="admin_search" onsubmit="return showModal()" class="form-horizontal">
							<br />
							<h2> Add New Material </h2>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
								<li class="active"> Add New Material </li>
							</ol>
							<h2 class="form-signin-heading">Fill up the necessary info: </h2>
							<div class="form-group">
								<label class="col-sm-2 control-label">Library Material ID</label>
								<label id="preclass" class="col-sm-1 control-label">CS1-</label>
								<div class="col-sm-1">
									<input type="text" class="form-control" id="material" placeholder="A1" name="material" pattern="[A-Za-z0-9]+" required>
								</div>
								<input type="hidden" id="matID" name="materialid" />
								<span style="color: red;" name="helpmaterialid"></span>
							</div>
							<div class="form-group">
								<label for="type" class="col-sm-2 control-label">Type</label>
								<div class="col-sm-2">
									<select name="type" id="type" class="form-control" >
										<option value="Book" >Book</option>
										<option value="SP">SP</option>
										<option value="References">References</option>
										<option value="CD">CD</option>
										<option value="Journals">Journals</option>
										<option value="Magazines">Magazines</option>
										<option value="Thesis">Thesis</option>
									</select>
								</div>
							</div>
							<div id="isbn_div" class="form-group" style='display:block'>
								<label for="type" class="col-sm-2 control-label">ISBN</label>
								<div class="col-sm-2">
									<input type="text" class="form-control"  name="isbn" id="isbn" pattern="[0-9]+" placeholder="ISBN" required/>
								</div>
								<span style="color: red;" name="helpisbn">
							</div>
							<div id="course_div" class="form-group" style="display:block">
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
									<textarea type="text" name="name" class="form-control" id="title" placeholder="Title" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="2" cols="50"></textarea>
								</div>
								<span style="color: red;" name="helpname">
							</div>
							<div class="form-group"><br />
								<label for="year" class="col-sm-2 control-label">Year of Publication</label>
								<div class="form-inline col-sm-2">
									<input type="number" name="year" class="form-control" id="year" placeholder="YYYY" min="1950" max="2014" pattern="[0-9][0-9][0-9][0-9]" required>
								</div>
								<span style="color: red;" name="helpyear">
							</div>
							<div class="form-group"><br />
								<label for="ed" class="col-sm-2 control-label">Edition</label>
								<div class="form-inline col-sm-2">
									<input type="text" name="edvol" class="form-control" id="ed" placeholder="Edition (optional)" pattern="[0-9]">
								</div>
								<span style="color: red;" name="helpedvol">
							</div>
							<div class="form-group"><br />
								<label for="access" id="asdf" class="col-sm-2 control-label">Accessibility</label>
								<div class="col-sm-3">
								<select name="access" id="access" class="form-control" required>
									
										<option value="4">Student/Faculty</option>
										<option value="1">Student</option>
										<option value="2">Faculty</option>
										<option value="3">Room Use</option>				
								</select>
								</div>
							</div>
							<div class="form-group"><br />
								<label for="availability" class="col-sm-2 control-label">Availability</label>
								<div class="col-sm-2">
									<input type="radio" name="available" value="1" checked> Yes
									<input type="radio" name="available" value="0" disabled> No
								</div>
							</div>
							<div class="form-group"><br />
								<label for="availability" class="col-sm-2 control-label">Requirements</label>
								<div class="col-sm-6">
									<input type="radio" name="requirement" value="0" checked> None
									<input type="radio" name="requirement" value="1"> Letter of the Owner / Consent of Instructor
								</div>
							</div>
							<div class="form-group"><br />
								<label class="col-sm-2 control-label">Author</label>
								<div class="form-inline col-sm-6">
									<table id="formTable">
									<tr>
										<td><input type="text" name="fname1" id="fname1" class="form-control" placeholder="First Name" name="materialid" pattern="[A-Za-z]+" required></td>
										<td><input type="text" name="mname1" id="mname1" class="form-control" placeholder="Middle Name" name="materialid" pattern="[A-Za-z]+" required></td>
										<td><input type="text" name="lname1" id="lname1" class="form-control" placeholder="Last Name" name="materialid" pattern="[A-Za-z]+" required></td>
										<td><input type="button" value="+" onClick="addRow()"></td>
										<td><input type="button" value="x" onclick="deleteRow(this)" disabled ></td></td>
										<td><span style="color: red;" name="helpauthor"></td>
										<td><input type="hidden" name="numberOfAuthors" value="1"/></td>
									</tr>
									</table>
								</div>
							</div>		
							<div class="form-group"><br />
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" class="btn btn-default" id="addButton" name="insert" value="Add">
									<a href="<?php echo base_url();?>admin/add_multiple"><button type="button" class="btn btn-primary">Add Multiple Material</button></a>
								</div>
							</div>
						</form><br/>
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
		</div></div></div></div>

		<!-- Footer -->
		<?php include 'includes/footer.php'; ?>
	<script type="text/javascript">

			$('#add-nav').addClass('active');
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
				inp1.name = 'fname' + n;
				inp1.id = 'fname' + n;
				inp1.placeholder = 'First Name';
				inp1.required = true;
				inp1.pattern = "[A-Za-z]+";
				inp1.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
				inp2.name = 'mname' + n;
				inp2.id = 'mname' + n;
				inp2.placeholder = 'Middle Name';
				inp2.required = true;
				inp2.pattern = "[A-Za-z]+";
				inp2.value = '';
				
				
				// grab the input from the first cell and update its ID and value
				var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
				inp3.name = 'lname' + n;
				inp3.id = 'lname' + n;
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
				add.material.onblur = validateMaterialID;
				add.type.onchange = disableFeatures;
				if (document.getElementById("course_div").style.display == 'block') add.course.onchange = disableFeatures;
				if (document.getElementById("isbn_div").style.display == 'block') add.isbn.onblur = validateISBN;
				add.name.onblur = validateName;
				add.year.onchange = disableFeatures;
				add.course.onchange = disableFeatures;
				add.edvol.onblur = validateEdition;
				$('#container1').modal('hide');
			}
			
			function validateMaterialID(){
				msg = "Invalid input. ";
				str = add.material.value;
				if (str == "") {
					msg+="Library Material ID is required. ";
				}
				if (!str.match(/^[A-Za-z0-9]+$/)) {
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
					//add.isbn.disabled = false;
					add.isbn.disabled = false;
					add.course.disabled = false;
					//add.isbn.placeholder = "ISBN-10";
					document.getElementById("preclass").innerHTML = add.course.value + "-";
					//update.materialid.value = array[1];
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'block';
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "SP"){
					document.getElementById("isbn").value = Math.floor(Math.random()*1000000000+1);
					document.getElementById("preclass").innerHTML = "SP" + add.year.value + "-";
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'none';
					//add.isbn.disabled = true;
					//add.course.disabled = true;
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "References"){
					add.isbn.disabled = false;
					add.course.disabled = false;
					document.getElementById("preclass").innerHTML = "R" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'block';
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "CD"){
					document.getElementById("isbn").value = Math.floor(Math.random()*1000000000+1);
					document.getElementById("preclass").innerHTML = "CD" + "-";
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'block';
					//add.isbn.disabled = true;
					//add.course.disabled = false;
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "Journals"){
					//add.isbn.disabled = false;
					//add.course.disabled = true;
					document.getElementById("preclass").innerHTML = "J" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'none';
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "Magazines"){
					//add.isbn.disabled = false;
					//add.course.disabled = true;
					document.getElementById("preclass").innerHTML = "M" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'none';
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
				else if(type == "Thesis"){
					document.getElementById("isbn").value = Math.floor(Math.random()*1000000000+1);
					document.getElementById("preclass").innerHTML = "T" + "-";
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'none';
					//add.isbn.disabled = true;
					//add.course.disabled = true;
					document.getElementById("matID").value = document.getElementById("preclass").innerHTML + document.getElementById("material").value;
				}
			}
			
			function validateISBN(){
				msg = "Invalid input. ";
				str = add.isbn.value;
				pattern = add.isbn.pattern;
				
				if(add.type.value == "Book" || add.type.value == "References" ){
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
			
			<?php
				if($this->session->flashdata('feedback1') != FALSE){
					$back1 = "Invalid input. Material ID already exists.";
					$back2 = "";
					
					$data = array();
					$i = 0;
					foreach($this->session->flashdata('feedback1') as $value){
						$data[$i++] = $value;
					}
				}
				else if($this->session->flashdata('feedback3') != FALSE){
					$back1 = "";
					$back2 = "Invalid input. ISBN already exists.";
					$data = array();
					$i = 0;
					foreach($this->session->flashdata('feedback3') as $value){
						$data[$i++] = $value;
					}
				}
				else{
					$back1 = "";
					$back2 = "";
					$data = array("CS128-","Book","","CS128","","","","4","","","1",array("","","",""));
				}
			?>
			
			var prompt1 = <?php echo json_encode($back1);?>;
			document.getElementsByName("helpmaterialid")[0].innerHTML = prompt1;
			
			var prompt2 = <?php echo json_encode($back2);?>;
			document.getElementsByName("helpisbn")[0].innerHTML = prompt2;
			
			var jArray = <?php echo json_encode($data);?>;
			var m = jArray[10];
			var i = 1, j= 1, f, m, l, mat;
				
			if(jArray[1] == "Book"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "SP"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				document.getElementById('course_div').style.display = 'none';
				document.getElementById('isbn_div').style.display = 'none';
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "References"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "CD"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				document.getElementById('course_div').style.display = 'none';
				document.getElementById('isbn_div').style.display = 'none';
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "Journals"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				document.getElementById('course_div').style.display = 'none';
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "Magazines"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				document.getElementById('course_div').style.display = 'none';
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
			if(jArray[1] == "Thesis"){
				document.getElementById('matID').value = jArray[0];
				
				mat = jArray[0].split("-");
				
				document.getElementById('preclass').innerHTML = mat[0] + '-';
				document.getElementById('material').value = mat[1];
				document.getElementById('type').value = jArray[1];
				document.getElementById('isbn').value = jArray[2];
				document.getElementById('course').value = jArray[3];
				document.getElementById('title').value = jArray[4];
				document.getElementById('year').value = jArray[5];
				document.getElementById('ed').value = jArray[6];
				document.getElementById('access').value = jArray[7];
				document.getElementById('course_div').style.display = 'none';
				document.getElementById('isbn_div').style.display = 'none';
				
				while(m != 1){
					addRow();
					m = m - 1;
				}
				
				while(i <= jArray[10]){
					f = 'fname' + i;
					m = 'mname' + i;
					l = 'lname' + i;
					
					document.getElementById(f).value = jArray[11][j++];
					document.getElementById(m).value = jArray[11][j++];
					document.getElementById(l).value = jArray[11][j++];
					
					i++;
				}
			}
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