<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="shortcut icon" href="<?php echo base_url();?>dist/images/favicon.png">

	<title>ICS-iLS</title>

	<link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/style2.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/date_picker.css" rel="stylesheet">
	<link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet" /> <!--for chart -->

	<style type="text/css" id="holderjs-style"></style></head>

	<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
	<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
	<script src="<?php echo base_url();?>dist/js/bootbox.min.js"></script>		
	
	<body>
		 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><img src="<?php echo base_url();?>dist/images/logo4.png" height="30px"></a>
                </div>
				<!--<div class="alert alert-success" id="returned">
					<a href="#" class="close" data-dismiss="alert" id="boton_cerrar">&times;</a> 
					<strong>Successfully returned material!</strong>     
				</div>-->
                <form class="navbar-form navbar-right" role="form">
                    <!-- Split button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default" data-toggle="dropdown">
					<span class="glyphicon glyphicon-cog"></span>
				  </button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url();?>admin/settings">Settings</a></li>
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>admin/logout">Log-out</a></li>
                  </ul>
                </div>
                </form>
			 </div>
		</div>
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
					<li id = "add-nav">
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
		<form name="update" id="update" class="form-horizontal">
		<h2 class="form-signin-heading">Update Library Material: </h2>
		<h4><?php echo $update_details->name; ?></h4>
		<div class="alert-container">
			<div style="display:none" id="success_update" class = "alert alert-success"></div>
			<div style="display:none" id="fail_update" class = "alert alert-danger"></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Library Material ID</label>
			<label id="preclass" name="preclass" class="col-sm-1 control-label"><?php $code = explode("-", $update_details->materialid); echo $code[0] . "-"; ?></label>
			<div class="col-sm-1">
				<input type="hidden" id="previous_matID" name="previous_matID" value="<?php echo $update_details->materialid;?>">
				<input type="text" class="form-control" id="matID" placeholder="A1" name="materialid" pattern="[A-Za-z0-9]+"  required value="<?php $code = explode("-", $update_details->materialid); echo $code[1]; ?>">
			</div>
				<span style="color: red;" name="helpmaterialid"> </span>
			
		</div>
		<div class="form-group">
			<label for="type" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-2">
				<select name="type" id="type" class="form-control">
					<option value="Book" <?php if ($update_details->type == "Book") echo 'selected'; ?>> Book </option>
					<option value="SP" <?php if ($update_details->type == "SP") echo 'selected'; ?>> SP </option>
					<option value="Reference" <?php if ($update_details->type == "Reference") echo 'selected'; ?>> Reference </option>
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
				<input type="text" class="form-control" value="<?php
					if ($update_details->type == 'Book' || $update_details->type == 'Magazines' ||
						$update_details->type == 'Reference' || $update_details->type == 'Journals') echo $update_details->isbn; ?>" name="isbn" id="isbn" pattern="[0-9]+" placeholder="ISBN"/>
			</div>
			<span style="color: red;" name="helpisbn">
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
				<input type="text" name="name" value="<?php echo $update_details->name;?>" class="form-control" id="title" placeholder="Title" name="materialid" pattern="[A-Z][A-Za-z0-9\(\)\/\ \.\,\-\'\?\!]+" required>
			</div>
			<span style="color: red;" name="helpname">
		</div>
		<div class="form-group">
			<label for="year" class="col-sm-2 control-label">Year of Publication</label>
			<div class="form-inline col-sm-2">
				<input type="number" name="year" value="<?php echo $update_details->year;?>" class="form-control" id="year" placeholder="YYYY" name="year" min="1950" max="2014" pattern="[0-9][0-9][0-9][0-9]" required>
			</div>
			<span style="color: red;" name="helpyear">
		</div>
		<div class="form-group">
			<label for="ed" class="col-sm-2 control-label">Edition</label>
			<div class="form-inline col-sm-2">
				<input type="text" name="edvol" value="<?php echo $update_details->edvol;?>" class="form-control" id="ed" placeholder="Edition (optional)" name="edvol" pattern="[0-9]">
			</div>
			<span style="color: red;" name="helpedvol">
		</div>
		<div class="form-group">
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
		<div class="form-group">
			<label for="availability" class="col-sm-2 control-label">Availability</label>
			<div class="col-sm-2">
				<input type="radio" name="available" id="yes" value="1" <?php if ($update_details->available == "1") echo 'checked'; ?>> Yes
				<input type="radio" name="available" value="0" <?php if ($update_details->available == "0") echo 'checked'; ?>> No
			</div>
		</div>
		<div class="form-group">
			<label for="availability" class="col-sm-2 control-label">Requirements</label>
			<div class="col-sm-6">
				<input type="radio" name="requirement" id="none" value="0" <?php if ($update_details->requirement == "0") echo 'checked'; ?>> None
				<input type="radio" name="requirement" value="1" <?php if ($update_details->requirement == "1") echo 'checked'; ?>> Letter of the Owner / Consent of Instructor
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Author</label>
			<div class="form-inline col-sm-6">
				<table id="formTable">
				<?php
					echo "<span style='color: red;' name='helpauthor'>";
					$num_authors = count($update_details->author);
					for ($i=0; $i<$num_authors; $i++){
						echo "<tr>";
						echo "<td><input type='text' name='fname' value='{$update_details->author[$i]->fname}' class='form-control' pattern='[A-Za-z]+' required placeholder='First Name'></td>";
						echo "<td><input type='text'  name='mname' value='{$update_details->author[$i]->mname}' class='form-control' pattern='[A-Za-z]+' required placeholder='Middle Name'></td>";
						echo "<td><input type='text'  name='lname' value='{$update_details->author[$i]->lname}' class='form-control' pattern='[A-Za-z]+' required placeholder='Last Name'></td>";
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
			<div class="col-sm-offset-2 col-sm-10">
				<button onclick="updateDetails()" class="btn btn-danger" id="updateButton" name="update">Update</button>
			</div>
		</div>
		
		<br>
		</div>	
		</div>	
		</div>	
		</div>
		<!-- FOOTER -->
			<footer>
			<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
			</footer>
			
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
	
<script>
		function updateDetails(){
			var correct = false;
			var type = update.type.value;
			if (type == 'Book' || type == 'Reference' || type == 'Journals' || type == 'Magazines')
				correct = validateISBN();
				
			if (validateMaterialID() && validateName() && validateEdition())
					bootbox.dialog({
						message: "Save changes to this library material?",
						title: "Confirmation",
						buttons: {
							yes: {
								label: "Save.",
								className: "btn-primary",
								callback: function() {
									
									var preclass = document.getElementById("preclass").innerHTML;
									var previous_matID = update.previous_matID.value;
									var materialid = preclass + update.materialid.value;
									var type = update.type.value;
									if (type == 'Book' || type == 'Reference' || type == 'Journals' || type == 'Magazines')
										var isbn = update.isbn.value;
									else var isbn = "+" + materialid;
									if (type == 'Book' || type == 'Reference' || type == 'CD')
										var course = update.course.value;
									else var course = null;
									var name = update.name.value;
									var year = update.year.value;
									var edvol = update.edvol.value;
									var access = update.access.value;
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
									//console.log(authors);
									
									$.ajax({
										type: "POST",
										url: "<?php echo base_url();?>admin/update_execution",
										data: { previous_matID : previous_matID, 
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
												setTimeout(function() { $('#success_update').fadeOut('slow') }, 5000);	
											}
										}
									});
								}
							},
							no: {
								label: "No.",
								className: "btn-default"
							}
						}
					});
					else {
						$("#success_update").hide();
						$("#fail_update").show();
						$("#fail_update").html("Some library material details are not valid!");
						$("#fail_update").fadeIn('slow');
						document.body.scrollTop = document.documentElement.scrollTop = 0;
					}
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
				inp1.pattern = "[A-Za-z]+";
				inp1.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
				//inp2.name = 'mname';
				inp2.placeholder = 'Middle Name';
				inp2.required = true;
				inp2.pattern = "[A-Za-z]+";
				inp2.value = '';
				
				
				// grab the input from the first cell and update its ID and value
				var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
				//inp3.name = 'lname';
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
				msg = "Invalid input. ";
				str = update.materialid.value;
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
				type = update.type.value;
				
				if(type == "Book"){
					//add.isbn.disabled = false;
					update.course.disabled = false;
					//add.isbn.placeholder = "ISBN-10";
					document.getElementById("preclass").innerHTML = update.course.value + "-";
					//update.materialid.value = array[1];
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'block';
				}
				else if(type == "SP"){
					//add.isbn.disabled = true;
					//array = update.materialid.value.split("-");
					document.getElementById("preclass").innerHTML = "SP" + update.year.value + "-";
					update.course.disabled = true;
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'none';
				}
				else if(type == "Reference"){
					//add.isbn.disabled = false;
					update.course.disabled = false;
					//add.isbn.placeholder = "ISBN-10";
					document.getElementById("preclass").innerHTML = "R" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'block';
				}
				else if(type == "CD"){
					//add.isbn.disabled = true;
					update.course.disabled = false;
					document.getElementById("preclass").innerHTML = "CD" + "-";
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'block';
				}
				else if(type == "Journals"){
					//add.isbn.disabled = false;
					update.course.disabled = true;
					//add.isbn.placeholder = "ISBN-8";
					document.getElementById("preclass").innerHTML = "J" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'none';
				}
				else if(type == "Magazines"){
					//add.isbn.disabled = false;
					update.course.disabled = true;
					//add.isbn.placeholder = "ISBN-8";
					document.getElementById("preclass").innerHTML = "M" + "-";
					document.getElementById("isbn_div").style.display = 'block';
					document.getElementById("course_div").style.display = 'none';
				}
				else if(type == "Thesis"){
					//add.isbn.disabled = false;
					update.course.disabled = true;
					//add.isbn.placeholder = "ISBN-8";
					document.getElementById("preclass").innerHTML = "T" + "-";
					document.getElementById("isbn_div").style.display = 'none';
					document.getElementById("course_div").style.display = 'none';
				}
			}
			
			function validateISBN(){
				msg = "Invalid input. ";
				str = update.isbn.value;
				pattern = update.isbn.pattern;
				
				if(update.type.value == "Book" || update.type.value == "Reference" ){
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
			}
			
		</script>
	</body>
</html>