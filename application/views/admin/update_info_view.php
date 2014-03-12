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
		        	<br />
					<h2> Update Library Material </h2>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url()?>/admin/home">Home</a></li>
						<li><a href="<?php echo site_url()?>/admin/update_material">View All Material</a></li>
						<li class="active"> Update Library Material </li>
					</ol>
			        <div id = "main-content">
						<div id="container">
							<form name="update" id="update" class="form-horizontal">
								<h2 class="form-signin-heading">Update Library Material: </h2>
								<h4><?php echo $update_details->name; ?></h4> 
								<div class="alert-container" style = 'height: 40px; margin-bottom: 19px;'>
									<div style="display:none" id="success_update" class = "alert alert-success"></div>
									<div style="display:none" id="fail_update" class = "alert alert-danger"></div>
								</div> 
								<div class="form-group">
									<label class="col-sm-2 control-label">Library Material ID</label>
									<label id="preclass" name="preclass" class="col-sm-1 control-label"><?php $code = explode("-", $update_details->materialid); echo $code[0] . "-"; ?></label>
									<div class="col-sm-1">
										<input type="hidden" id="previous_matID" name="previous_matID" value="<?php echo $update_details->materialid;?>">
										<input type="text" maxlength="10" class="form-control" id="materialid" placeholder="A1" name="materialid" pattern="[A-Za-z0-9]+"  required value="<?php $code = explode("-", $update_details->materialid); echo $code[1]; ?>">
									</div>
										<span style="color: red;" id="helpmaterialid" name="helpmaterialid"> </span>
								</div>
								<div class="form-group">
									<label for="type" class="col-sm-2 control-label">Type</label>
									<div class="col-sm-2">
										<select name="type" id="type" class="form-control">
											<option value="Book" <?php if ($update_details->type == "Book") echo 'selected'; ?>> Book </option>
											<option value="SP" <?php if ($update_details->type == "SP") echo 'selected'; ?>> SP </option>
											<option value="References" <?php if ($update_details->type == "References") echo 'selected'; ?>> References </option>
											<option value="Journals" <?php if ($update_details->type == "Journals") echo 'selected'; ?>> Journals </option>
											<option value="Magazines" <?php if ($update_details->type == "Magazines") echo 'selected'; ?>> Magazines </option>
											<option value="CD" <?php if ($update_details->type == "CD") echo 'selected'; ?>> CD </option>
											<option value="Thesis" <?php if ($update_details->type == "Thesis") echo 'selected'; ?>> Thesis </option>
										</select>
									</div>
								</div>
								<div id="isbn_div" class="form-group"
										<?php if ($update_details->type == 'Thesis' || $update_details->type == 'CD' ||
												$update_details->type == 'SP') echo "style='display:none'" ?>>
									<label for="type" class="col-sm-2 control-label">ISBN</label>
									<div class="col-sm-2">
										<input type="hidden" id="previous_isbn" name="previous_isbn" value="<?php
										if ($update_details->type == 'Book' || $update_details->type == 'Magazines' || $update_details->type == 'References' || $update_details->type == 'Journals') echo $update_details->isbn; ?>">
										<input type="text" maxlength="10" class="form-control" value="<?php
										if ($update_details->type == 'Book' || $update_details->type == 'Magazines' || $update_details->type == 'References' || $update_details->type == 'Journals') echo $update_details->isbn; ?>" name="isbn" id="isbn" pattern="[0-9]+" placeholder="ISBN"/>
									</div>
									<span style="color: red;" id="helpisbn" name="helpisbn"> </span>
								</div>
								<div id="course_div" class="form-group"
										<?php if ($update_details->type == 'Thesis' || $update_details->type == 'Journals' ||
												$update_details->type == 'Magazines' || $update_details->type == 'SP') echo "style='display:none'" ?>>
									<label for="course" class="col-sm-2 control-label">Course Classification</label>
									<div class="col-sm-2">
										<select name="course" id="course" class="form-control">
											<option value="CS1" <?php if ($update_details->course == "CS123") echo 'selected'; ?>> CMSC 1 </option>
											<option value="CS2" <?php if ($update_details->course == "CS2") echo 'selected'; ?>> CMSC 2</option>
											<option value="CS11" <?php if ($update_details->course == "CS11") echo 'selected'; ?>> CMSC 11</option>
											<option value="CS21" <?php if ($update_details->course == "CS21") echo 'selected'; ?>> CMSC 21</option>
											<option value="CS22" <?php if ($update_details->course == "CS22") echo 'selected'; ?>> CMSC 22</option>
											<option value="CS55" <?php if ($update_details->course == "CS55") echo 'selected'; ?>> CMSC 55</option>
											<option value="CS56" <?php if ($update_details->course == "CS56") echo 'selected'; ?>> CMSC 56</option>
											<option value="CS57" <?php if ($update_details->course == "CS57") echo 'selected'; ?>> CMSC 57</option>
											<option value="CS100" <?php if ($update_details->course == "CS100") echo 'selected'; ?>> CMSC 100</option>
											<option value="CS123" <?php if ($update_details->course == "CS123") echo 'selected'; ?>> CMSC 123</option>
											<option value="CS124" <?php if ($update_details->course == "CS124") echo 'selected'; ?>> CMSC 124</option>
											<option value="CS125" <?php if ($update_details->course == "CS125") echo 'selected'; ?>> CMSC 125</option>
											<option value="CS127" <?php if ($update_details->course == "CS127") echo 'selected'; ?>> CMSC 127</option>
											<option value="CS128" <?php if ($update_details->course == "CS128") echo 'selected'; ?>> CMSC 128</option>
											<option value="CS129" <?php if ($update_details->course == "CS129") echo 'selected'; ?>> CMSC 129</option>
											<option value="CS130" <?php if ($update_details->course == "CS130") echo 'selected'; ?>> CMSC 130</option>
											<option value="CS131" <?php if ($update_details->course == "CS131") echo 'selected'; ?>> CMSC 131</option>
											<option value="CS132" <?php if ($update_details->course == "CS132") echo 'selected'; ?>> CMSC 132</option>
											<option value="CS137" <?php if ($update_details->course == "CS137") echo 'selected'; ?>> CMSC 137</option>
											<option value="CS140" <?php if ($update_details->course == "CS140") echo 'selected'; ?>> CMSC 140</option>
											<option value="CS141" <?php if ($update_details->course == "CS141") echo 'selected'; ?>> CMSC 141</option>
											<option value="CS142" <?php if ($update_details->course == "CS142") echo 'selected'; ?>> CMSC 142</option>
											<option value="CS150" <?php if ($update_details->course == "CS150") echo 'selected'; ?>> CMSC 150</option>
											<option value="CS161" <?php if ($update_details->course == "CS161") echo 'selected'; ?>> CMSC 161</option>
											<option value="CS165" <?php if ($update_details->course == "CS165") echo 'selected'; ?>> CMSC 165</option>
											<option value="CS170" <?php if ($update_details->course == "CS170") echo 'selected'; ?>> CMSC 170</option>
											<option value="CS178" <?php if ($update_details->course == "CS178") echo 'selected'; ?>> CMSC 172</option>
											<option value="CS180" <?php if ($update_details->course == "CS180") echo 'selected'; ?>> CMSC 180</option>
											<option value="CS191" <?php if ($update_details->course == "CS191") echo 'selected'; ?>> CMSC 191</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-5">
										<textarea type="text" name="name" value="<?php echo $update_details->name;?>" class="form-control" id="title" placeholder="Title" pattern="[A-Z][A-Za-z0-9\(\)\/\ \.\,\-\'\?\!]+" required rows="2" cols="50"><?php echo $update_details->name;?></textarea>
									</div>
									<span style="color: red;" name="helpname">
								</div>
								<div class="form-group"><br />
									<label for="year" class="col-sm-2 control-label">Year of Publication</label>
									<div class="form-inline col-sm-2">
										<input type="number" name="year" value="<?php echo $update_details->year;?>" class="form-control" id="year" placeholder="YYYY" name="year" min="1950" max="2014" pattern="[0-9][0-9][0-9][0-9]" required>
									</div>
									<span style="color: red;" name="helpyear">
								</div>
								<div id="edvol_div" class="form-group"
										<?php if ($update_details->type == 'Thesis' || $update_details->type == 'CD' ||
												$update_details->type == 'SP') echo "style='display:none'" ?>><br/>
									<label for="ed" class="col-sm-2 control-label">Edition</label>
									<div class="form-inline col-sm-2">
										<input type="text" name="edvol" value="<?php if ($update_details->edvol != 0) echo $update_details->edvol;?>" class="form-control" id="ed" placeholder="Edition (optional)" name="edvol" pattern="[0-9]">
									</div>
									<span style="color: red;" name="helpedvol">
								</div>
								<div class="form-group"><br />
									<label for="access" class="col-sm-2 control-label">Accessibility</label>
									<div class="col-sm-3">
									<select name="access" id="access" class="form-control" required>
										
											<option value="4" <?php if ($update_details->access == "4") echo 'selected'; ?>> Student/Faculty</option>
											<option value="1" <?php if ($update_details->access == "1") echo 'selected'; ?>> Student</option>
											<option value="2" <?php if ($update_details->access == "2") echo 'selected'; ?>> Faculty</option>
											<option value="3" <?php if ($update_details->access == "3") echo 'selected'; ?>> Room Use</option>				
									</select>
									</div>
								</div>
								<div class="form-group"><br />
									<label for="availability" class="col-sm-2 control-label">Availability</label>
									<div class="col-sm-2">
										<input type="radio" name="available" id="yes" value="1" <?php if ($update_details->available == "1") echo 'checked'; ?>> Yes
										<input type="radio" name="available" value="0" <?php if ($update_details->available == "0") echo 'checked'; ?>> No
									</div>
								</div>
								<div class="form-group"><br />
									<label for="availability" class="col-sm-2 control-label">Requirements</label>
									<div class="col-sm-6">
										<input type="radio" name="requirement" id="none" value="0" <?php if ($update_details->requirement == "0") echo 'checked'; ?>> None
										<input type="radio" name="requirement" value="1" <?php if ($update_details->requirement == "1") echo 'checked'; ?>> Letter of the Owner / Consent of Instructor
									</div>
								</div>
								<div class="form-group"><br />
									<label class="col-sm-2 control-label">Author</label>
									<div class="form-inline col-sm-6">
										<span style='color: red;' name='helpauthor'></span>
										<table id="formTable">
										<?php
											$num_authors = count($update_details->author);
											for ($i=0; $i<$num_authors; $i++){
												echo "<tr>";
												echo "<td><input type='text' name='fname' value='{$update_details->author[$i]->fname}' class='form-control' pattern='[A-Za-z\ ]+' required placeholder='First Name'/></td>";
												echo "<td><input type='text'  name='mname' value='{$update_details->author[$i]->mname}' class='form-control' pattern='[A-Za-z\ ]+' required placeholder='Middle Name'/></td>";
												echo "<td><input type='text'  name='lname' value='{$update_details->author[$i]->lname}' class='form-control' pattern='[A-Za-z\ ]+' required placeholder='Last Name'/></td>";
												echo "<td><input type='button' value='+' onClick='addRow()'></td>";
												echo "<td><input type='button' value='x' onclick='deleteRow(this)'";
												if ($i==0) echo " disabled ";
												echo "></td>";
												echo "<td><input type='hidden' name='numberOfAuthors' value='{$num_authors}'/></td>";
												echo "</tr>";
											}
										?>
										</table>
									</div>
								</div>
							</form>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10"><br />
									<button onclick="updateDetails()" class="btn btn-default" id="updateButton" name="update">Update</button>
									<a href="<?php echo site_url()?>/admin/admin_search"><button type="button" class="btn btn-danger">Cancel</button></a>
								</div>
							</div>
							<br>
						</div>	
					</div>	
				</div>	
			</div>

		<?php include 'includes/footer.php'; ?>

		<script>

			function finalcheckofupdate() {
				if (validateName() && validateEdition() && disableFeatures() && validateAuthors())
				bootbox.dialog({
					message: "Save changes to this library material?",
					title: "Confirmation",
					buttons: {
							yes: {
							label: "Save",
							className: "btn-primary",
							callback: function() {
															
								var preclass = document.getElementById("preclass").innerHTML;
								var previous_matID = update.previous_matID.value;
								var materialid = preclass + update.materialid.value;
								var type = update.type.value;
							
								if (type == 'Book' || type == 'References' || type == 'Journals' || type == 'Magazines')
									var isbn = update.isbn.value;
								else var isbn = "+" + materialid;
							
								if (type == 'Book' || type == 'References' || type == 'CD')
									var course = update.course.value;
								else var course = null;
							
								var name = update.name.value;
								var year = update.year.value;
								var edvol = update.edvol.value;
								var access = update.access.value;
								var previous_isbn = update.previous_isbn.value;
								
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
									url: "<?php echo site_url()?>/admin/update_execution",
									data: { previous_matID : previous_matID, 
											previous_isbn : previous_isbn,
											materialid : materialid,
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
											$("#success_update").show();
											$("#fail_update").hide();
											$("#success_update").html("Library material successfully updated!");
											$("#success_update").fadeIn('slow');
											document.body.scrollTop = document.documentElement.scrollTop = 0;
											setTimeout(function() { $("#success_update").html("Redirecting to View All Library Materials...");
																	window.location.href = "<?php echo site_url()?>/admin/show_recent/"+materialid; }, 2000);	
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
				$("#success_update").hide();
				$("#fail_update").show();
				$("#fail_update").html("Some library material details are not valid!");
				$("#fail_update").fadeIn('slow');
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			}

			function updateDetails(){

				preclass = document.getElementsByName('preclass')[0].innerHTML;
				materialid = update.materialid.value;
				previous_matID = update.previous_matID.value;
				type = update.type.value;

				$.ajax({
					url: "<?php echo site_url()?>/admin/check_new_materialid",
					type: "POST",
					data: { preclass: preclass, materialid : materialid, previous_matID : previous_matID},
					success: function (result){
						if ($.trim(result) == '1'){

							$('#helpmaterialid').html("");

							if (type == 'Book' || type == 'References' || type == 'Journals' || type == 'Magazines') {

								isbn = update.isbn.value;
								type = update.type.value;
								previous_isbn = update.previous_isbn.value;

								$.ajax({
									url: "<?php echo site_url()?>/admin/check_new_isbn",
									type: "POST",
									data: { isbn : isbn , type : type , previous_isbn : previous_isbn},
									success: function (result){
										if ($.trim(result) == '1'){
											$('#helpisbn').html("");
											finalcheckofupdate();
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
							else finalcheckofupdate();
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
					update.materialid.onblur = validateMaterialID;
					update.type.onchange = disableFeatures;
					update.course.onchange = disableFeatures;
					update.isbn.onblur = validateISBN;
					update.name.onblur = validateName;
					update.year.onblur = disableFeatures;
					update.edvol.onblur = validateEdition;
					$('#container1').modal('hide');
				}
				

				function validateMaterialID(){
					
					preclass = document.getElementsByName('preclass')[0].innerHTML;
					materialid = update.materialid.value;
					previous_matID = update.previous_matID.value;

					$.ajax({
						url: "<?php echo site_url()?>/admin/check_new_materialid",
						type: "POST",
						data: { preclass: preclass, materialid : materialid, previous_matID : previous_matID},
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
					type = update.type.value;
					year = update.year.value;

					if(type == "Book"){
						//add.isbn.disabled = false;
						update.course.disabled = false;
						//add.isbn.placeholder = "ISBN-10";
						document.getElementById("preclass").innerHTML = update.course.value + "-";
						//update.materialid.value = array[1];
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "SP"){
						//add.isbn.disabled = true;
						//array = update.materialid.value.split("-");
						document.getElementById("preclass").innerHTML = "SP" + update.year.value + "-";
						update.course.disabled = true;
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'none';
					}
					else if(type == "References"){
						//add.isbn.disabled = false;
						update.course.disabled = false;
						//add.isbn.placeholder = "ISBN-10";
						document.getElementById("preclass").innerHTML = "R" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "CD"){
						//add.isbn.disabled = true;
						update.course.disabled = false;
						document.getElementById("preclass").innerHTML = "CD" + "-";
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'block';
						document.getElementById("edvol_div").style.display = 'none';
					}
					else if(type == "Journals"){
						//add.isbn.disabled = false;
						update.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "J" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "Magazines"){
						//add.isbn.disabled = false;
						update.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "M" + "-";
						document.getElementById("isbn_div").style.display = 'block';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'block';
					}
					else if(type == "Thesis"){
						//add.isbn.disabled = false;
						update.course.disabled = true;
						//add.isbn.placeholder = "ISBN-8";
						document.getElementById("preclass").innerHTML = "T" + "-";
						document.getElementById("isbn_div").style.display = 'none';
						document.getElementById("course_div").style.display = 'none';
						document.getElementById("edvol_div").style.display = 'none';
					}


					if (update.materialid.value != "") {
						validateMaterialID();
					}

					if (validateYear())
						if (year < 1950 || year > 2014) {
							document.getElementsByName("helpyear")[0].innerHTML = "Invalid Input. Valid years are from 1950-2014 only.";
							return false;
						}
						else {
							document.getElementsByName("helpyear")[0].innerHTML = "";
							return true;
						}
				}
				
				function validateISBN(){
				
					isbn = update.isbn.value;
					type = update.type.value;
					previous_isbn = update.previous_isbn.value;

					$.ajax({
						url: "<?php echo site_url()?>/admin/check_new_isbn",
						type: "POST",
						data: { isbn : isbn , type : type , previous_isbn : previous_isbn},
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
					str = update.name.value;
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
					str = update.year.value;
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
					str = update.edvol.value;
					if (str == "") {
						update.edvol.value = "";
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