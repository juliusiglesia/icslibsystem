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
						<form name="add" id="add" method="post" class="form-horizontal">

							<br />
							<h2> Add New Material </h2>
							<ol class="breadcrumb">
								<li><a href="<?php echo site_url();?>/admin/home">Home</a></li>
								<li class="active"> Add New Material </li>
							</ol>
							<div class="alert-container" style = 'height: 40px; margin-bottom: 19px;'>
									<div style="display:none" id="success_add" class = "alert alert-success"></div>
									<div style="display:none" id="fail_add" class = "alert alert-danger"></div>
							</div> 
							<div class="form-group">
								<label class="col-sm-2 control-label">Library Material ID</label>
								<label id="preclass" name="preclass" class="col-sm-1 control-label">CS1-</label>
								<div class="col-sm-1">
									<input type="text" maxlength="10" class="form-control" id="materialid" placeholder="A1" name="materialid" pattern="[A-Za-z0-9]+" required>
								</div>
								<span style="color: red;" id="helpmaterialid" name="helpmaterialid"></span>
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
									<input type="text" maxlength="10" class="form-control"  name="isbn" id="isbn" pattern="[0-9]+" placeholder="ISBN" required/>
								</div>
								<span style="color: red;" id="helpisbn" name="helpisbn">
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
									<input type="number" name="year" class="form-control" id="year" value="2014" placeholder="YYYY" min="1950" max="2014" pattern="/^[0-9][0-9][0-9][0-9]$/" required>
								</div>
								<span style="color: red;" name="helpyear">
							</div>
							<div id="edvol_div" class="form-group"><br />
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
									<input type="radio" name="available" id="yes" value="1" checked> Yes
									<input type="radio" name="available" value="0" disabled> No
								</div>
							</div>
							<div class="form-group"><br />
								<label for="availability" class="col-sm-2 control-label">Requirements</label>
								<div class="col-sm-6">
									<input type="radio" name="requirement" id="none" value="0" checked> None
									<input type="radio" name="requirement" value="1"> Letter of the Owner / Consent of Instructor
								</div>
							</div>
							<div class="form-group"><br />
								<label class="col-sm-2 control-label">Author</label>
								<div class="form-inline col-sm-6">
									<span style='color:red;' name='helpauthor'></span>
									<table id="formTable">
										<tr>
											<td><input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" pattern="[A-Za-z\ ]+" required></td>
											<td><input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name" pattern="[A-Za-z\ ]+" required></td>
											<td><input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" pattern="[A-Za-z\ ]+" required></td>
											<td><input type="button" value="+" onClick="addRow()"></td>
											<td><input type="button" value="x" onclick="deleteRow(this)" disabled ></td>
											<td><input type="hidden" name="numberOfAuthors" value="1"/></td>
										</tr>
									</table>
								</div> 
							</div>	
							</form>	
							<div class="form-group"><br />
								<div class="col-sm-offset-2 col-sm-10">
									<button onclick="addDetails()" class="btn btn-primary" id="addButton" name="add">Add</button>
									<a href="<?php echo site_url();?>/admin/add_multiple"><button type="button" class="btn btn-default">Add Multiple Material</button></a>
								</div>
							</div>
						<br>		
					</div>
				</div>
			</div>
		</div>

		<?php include 'includes/footer.php'; ?>
	
		<script>
		$('#add-nav').addClass('active');
			function finalcheckofadd() {
				if (validateName() && validateEdition() && disableFeatures() && validateAuthors())
				bootbox.dialog({
					message: "Confirm details of this library material?",
					title: "Confirmation",
					buttons: {
							yes: {
							label: "Save",
							className: "btn-primary",
							callback: function() {
															
								var preclass = document.getElementById("preclass").innerHTML;
								var materialid = preclass + add.materialid.value;
								var type = add.type.value;
							
								if (type == 'Book' || type == 'References' || type == 'Journals' || type == 'Magazines')
									var isbn = add.isbn.value;
								else var isbn = "+" + materialid;
							
								if (type == 'Book' || type == 'References' || type == 'CD')
									var course = add.course.value;
								else var course = null;
							
								var name = add.name.value;
								var year = add.year.value;
								var edvol = add.edvol.value;
								var access = add.access.value;
								
								var available;
								if(document.getElementById("yes").checked) available = 1;
								else available = 0;

								var requirement;
								if(document.getElementById("none").checked) requirement = 0;
								else requirement = 1;

								var authors_fname = document.getElementsByName("fname");
								var authors_mname = document.getElementsByName("mname");
								var authors_lname = document.getElementsByName("lname");
								
								authors=new Array();
								var i=0;
								while (authors_fname[i]) {
									array = new Array(authors_fname[i].value, authors_mname[i].value, authors_lname[i++].value);
									authors.push(array);
								}
															
								$.ajax({
									type: "POST",
									url: "<?php echo site_url();?>/admin/add_execution",
									data: { materialid : materialid,
											type : type,
											isbn : isbn,
											course : course,
											name : name,
											year : year,
											edvol : edvol,
											access : access,
											available : available,
											requirement: requirement,
											authors : authors,
										  },
									beforeSend: function() {
										//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
										$("#error_message").html("loading...");
									},

									error: function(xhr, textStatus, errorThrown) {
											$('#error_message').html(textStatus);
											//console.log(textStatus);
									},

									success: function( result ){

										if( result != "1" ){
											$("#success_add").show();
											$("#fail_add").hide();
											$("#success_add").html("Library material successfully added to the database!");
											$("#success_add").fadeIn('slow');
											document.body.scrollTop = document.documentElement.scrollTop = 0;
											setTimeout(function() { $("#success_add").html("Redirecting to View All Library Materials...");
																	window.location.href = "<?php echo site_url();?>/admin/show_recent/"+materialid; }, 2000);	
										}
									}
								});
							}
							},
							no: {
								label: "No",
								className: "btn-default"
							}
						}
					});
				else showError();
			}

			function showError(){
				$("#success_add").hide();
				$("#fail_add").show();
				$("#fail_add").html("Some library material details are not valid!");
				$("#fail_add").fadeIn('slow');
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			}

			function addDetails(){

				preclass = document.getElementsByName('preclass')[0].innerHTML;
				materialid = add.materialid.value;
				type = add.type.value;

				$.ajax({
					url: "<?php echo site_url();?>/admin/check_materialid",
					type: "POST",
					data: { preclass: preclass, materialid : materialid },
					success: function (result){
						if ($.trim(result) == '1'){

							$('#helpmaterialid').html("");

							if (type == 'Book' || type == 'References' || type == 'Journals' || type == 'Magazines') {

								isbn = add.isbn.value;
								type = add.type.value;
								
								$.ajax({
									url: "<?php echo site_url();?>/admin/check_isbn",
									type: "POST",
									data: { isbn : isbn , type : type },
									success: function (result){
										if ($.trim(result) == '1'){
											$('#helpisbn').html("");
											finalcheckofadd();
										}
										else if ($.trim(result) == '2') {
											$('#helpisbn').html("A library material with the same ISBN/ISSN already exists.");
											showError();
										}
										else if ($.trim(result) == '3') {
											$('#helpisbn').html("Invalid ISBN. Books and references require 10-digit ISBN. Journals and magazines require 8-digit ISSN.");
											showError();
										}
									}
								});
							}
							else finalcheckofadd();
						}
						else if ($.trim(result) == '2') {
							$('#helpmaterialid').html("Material ID already exists.");
							showError();
						}
						else if ($.trim(result) == '3') {
							$('#helpmaterialid').html("Invalid material id.");
							showError();
						}
					}
				});
			}

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
					
					var inp6 = new_row.cells[5].getElementsByTagName('input')[0];
					inp6.value = n;
					
					// grab the input from the first cell and update its ID and value
					var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
					//inp1.name = 'fname';
					inp1.placeholder = 'First Name';
					inp1.required = true;
					inp1.pattern = "[A-Za-z\ ]+";
					inp1.value = '';
					
					// grab the input from the first cell and update its ID and value
					var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
					//inp2.name = 'mname';
					inp2.placeholder = 'Middle Name';
					inp2.required = true;
					inp2.pattern = "[A-Za-z\ ]+";
					inp2.value = '';
					
					
					// grab the input from the first cell and update its ID and value
					var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
					//inp3.name = 'lname';
					inp3.placeholder = 'Last Name';
					inp3.required = true;
					inp3.pattern = "[A-Za-z\ ]+";
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
					add.type.onchange = disableFeatures;
					add.course.onchange = disableFeatures;
					add.isbn.onblur = validateISBN;
					add.name.onblur = validateName;
					add.year.onblur = disableFeatures;
					add.edvol.onblur = validateEdition;
					$('#container1').modal('hide');
				}
				

				function validateMaterialID(){
					
					preclass = document.getElementsByName('preclass')[0].innerHTML;
					materialid = add.materialid.value;
				
					$.ajax({
						url: "<?php echo site_url();?>/admin/check_materialid",
						type: "POST",
						data: { preclass: preclass, materialid : materialid },
						success: function (result){
							if ($.trim(result) == '1'){
								$('#helpmaterialid').html("");
								return true;
							}
							else if ($.trim(result) == '2') {
								$('#helpmaterialid').html("Material ID already exists.");
								return false;
							}
							else if ($.trim(result) == '3') {
								$('#helpmaterialid').html("Invalid material id.");
								return false;
							}
						}
					});
				}
				
				function disableFeatures(){
					type = add.type.value;
					year = add.year.value;

					if(type == "Book"){
						//add.isbn.disabled = false;
						add.course.disabled = false;
						//add.isbn.placeholder = "ISBN-10";
						document.getElementById("preclass").innerHTML = add.course.value + "-";
						//update.materialid.value = array[1];
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "SP"){
						//add.isbn.disabled = true;
						//array = update.materialid.value.split("-");
						document.getElementById("preclass").innerHTML = "SP" + add.year.value + "-";
						add.course.disabled = true;
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'none';
					}
					else if(type == "References"){
						//add.isbn.disabled = false;
						add.course.disabled = false;
						//add.isbn.placeholder = "ISBN-10";
						document.getElementById("preclass").innerHTML = "R" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "CD"){
						//add.isbn.disabled = true;
						add.course.disabled = false;
						document.getElementById("preclass").innerHTML = "CD" + "-";
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'none';
					}
					else if(type == "Journals"){
						//add.isbn.disabled = false;
						add.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "J" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "Magazines"){
						//add.isbn.disabled = false;
						add.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "M" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "Thesis"){
						//add.isbn.disabled = false;
						add.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "T" + "-";
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'none';
					}


					if (add.materialid.value != "") {
						validateMaterialID();
					}

					if (validateYear2())
						if (year < 1950 || year > 2014) {
							document.getElementsByName("helpyear")[0].innerHTML = "Invalid Input. Valid years are from 1950-2014 only.";
							return false;
						}
						else {
							document.getElementsByName("helpyear")[0].innerHTML = "";
							return true;
						}
				}
				
				function validateYear2(){
		
					str = add.year.value;
					if (str == "" || !str.match(/^[0-9][0-9][0-9][0-9]$/))
						return false
					else return true;
				}

				function validateISBN(){
				
					isbn = add.isbn.value;
					type = add.type.value;
					
					$.ajax({
						url: "<?php echo site_url();?>/admin/check_isbn",
						type: "POST",
						data: { isbn : isbn , type : type },
						success: function (result){
							if ($.trim(result) == '1'){
								$('#helpisbn').html("");
								//return true;
							}
							else if ($.trim(result) == '2') {
								$('#helpisbn').html("A library material with the same ISBN/ISSN already exists.");
								//return false;
							}
							else if ($.trim(result) == '3') {
								$('#helpisbn').html("Invalid ISBN. Books and references require 10-digit ISBN. Journals and magazines require 8-digit ISSN.");
								//return false;
							}
						}
					});
				}
				
				function validateName(){
					msg = "Invalid input. ";
					str = add.name.value;
					if (str == "") {
						msg+="Title is required. ";
					}
					if (!str.match(/^[A-Z][A-Za-z0-9\(\)\ \.\,\-\'\?\!\/]+$/)) {
						msg+="Characters are invalid.";
					}
					if (msg == "Invalid input. ") msg="";

					document.getElementsByName("helpname")[0].innerHTML = msg;
					if (msg == ""){ 
						return true;
					}
				}

				function validateAuthors(){
					
					var authors_fname = document.getElementsByName("fname");
					var authors_mname = document.getElementsByName("mname");
					var authors_lname = document.getElementsByName("lname");
								
					var i=0;
					var flag = 0;
					while (authors_fname[i]) {
						if (authors_fname[i].value == "" || !authors_fname[i].value.match(/^[A-Z][A-Za-z0-9\.\-\'\ ]+$/)) {
							flag = 1;
							break;
						}
						if (authors_mname[i].value == "" || !authors_mname[i].value.match(/^[A-Z][A-Za-z0-9\.\-\'\ ]+$/)){
							flag = 2;
							break;
						}
						if (authors_lname[i].value == "" || !authors_lname[i++].value.match(/^[A-Z][A-Za-z0-9\.\-\'\ ]+$/)){
							flag = 3;
							break;
						}
					}

					if (flag == 1) document.getElementsByName("helpauthor")[0].innerHTML = "First name invalid.";
					else if (flag == 2) document.getElementsByName("helpauthor")[0].innerHTML = "Middle name invalid.";
					else if (flag == 3) document.getElementsByName("helpauthor")[0].innerHTML = "Last name invalid.";
					else if (flag == 0) document.getElementsByName("helpauthor")[0].innerHTML = "";

					if (flag == 0) return true;
					else return false;
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
					else return false;
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
					else return false;
				}
		</script>
	</body>
</html>