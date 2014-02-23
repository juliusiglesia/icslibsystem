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
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>ICS-iLS</title>

    <link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">

    <style type="text/css" id="holderjs-style"></style></head>

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
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>dist/images/logowhite.png" height="30px"></a>
                </div>
                
                <form class="navbar-form navbar-right" role="form">
                    <button type="button" class="btn btn-success" id = "logout" >Log out</button>
                </form>

            </div>
        </div>
        <div class="mainBody">
            <!-- Nav tabs -->
            <div class="sidebarMain">
                <ul class="nav nav-pills nav-stacked">
                    <li id = "overview-nav">
                        <a href="<?php echo base_url();?>admin/home">Overview</a>
                    </li>
                    <li id = "reserved-nav" >
                        <a href="<?php echo base_url();?>admin/reservation">Reserved Books</a>
                    </li>
                    <li id = "borrowed-nav">
                        <a href="<?php echo base_url();?>admin/borrowed_books">Borrowed Books</a>
                    </li>
                    <li id = "view-nav"  >
                        <a href="<?php echo base_url();?>admin/admin_search">View All Library Materials</a>
                    </li>
                    <li id = "add-nav" class="active">
                        <a href="<?php echo base_url();?>admin/add_material">Add A New Material</a>
                    </li>
                    <li id = "generate-nav" >
                        <a href="<?php echo base_url();?>admin/print_inventory" target = "_blank" >Generate Report</a>
                    </li>
                </ul>
            </div>   

        <div class="leftMain">
        <div id="main-page">
        <div id = "main-content">
		<div id="container">
		<form name="add" method="post" action="admin_search">
			<table id="formTable">
				<tr>
					<td><label>Library Material ID</label></td>
					<td><input type="text" name="materialid" pattern="[A-Z0-9]+-[A-Z0-9]+" required></td>
					<td><label>(e.g. CS1-A1, CS-01, C-1)</label></td>
					<td><span style="color: red;" name="helpmaterialid"></td>
				</tr>
				<tr>
					<td><label>Type</label></td>
					<td><select name="type" required>
						<option value="Book" >Book</option>
						<option value="SP">SP</option>
						<option value="Reference">Reference</option>
						<option value="CD">CD</option>
						<option value="Journals">Journals</option>
						<option value="Magazines">Magazines</option>
					</select></td>
				</tr>
				<tr>
					<td><label>Course Classification</label></td>
					<td><select name="course" required>
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
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td><label>Title</label></td>
					<td><input type="text" name="name" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required></td>
					<td><span style="color: red;" name="helpname"></td>
				</tr>
				<tr>
					<td><label>Year of Publication</label></td>
					<td><input type="number" name="year" placeholder="YYYY" min="1950" max="2014" pattern="[0-9][0-9][0-9][0-9]" required></td>
					<td><span style="color: red;" name="helpyear"></td>
				</tr>
				<tr>
					<td><label>Edition(optional)</label></td>
					<td><input type="text" name="edvol" pattern="[0-9]" ></td>
					<td><span style="color: red;" name="helpedvol"></td>
				</tr>
				<tr>
					<td><label>Accessibility</label></td>
					<td><select name="access" required>
						<option value="4">Student/Faculty</option>
						<option value="1">Room Use</option>
						<option value="2">Student</option>
						<option value="3">Faculty</option>
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td><label>Availability</label></td>
					<td><input type="radio" name="available" value="1" checked > Yes</td>
					<td><input type="radio" name="available" value="0" disabled> No</td>
				</tr>
				<tr>
					<td><label>Requirements</label></td>
					<td><input type="radio" name="requirement" value="0" checked > None </td>
					<td><input type="radio" name="requirement" value="1"> Letter of the Owner / Consent of Instructor</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Author</label></td>
					<td><input type="text" name="fname" placeholder="First Name" pattern="[A-Za-z]+" required></td>
					<td><input type="text" name="mname" placeholder="Middle Name" pattern="[A-Za-z]+" required></td>
					<td><input type="text" name="lname" placeholder="Last Name" pattern="[A-Za-z]+" required></td>
					<td><input type="button" value="x" onclick="deleteRow(this)" disabled ></td>
					<td><input type="button" value="+" onClick="addRow()"></td>
					<td><span style="color: red;" name="helpauthor"/></td>
					<td><input type="hidden" name="numberOfAuthors" value="1"/></td>
				</tr>
		</table>
		<input type="submit" name="insert" value="Add">
		</form><br>
		</div>

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
				var new_row = x.rows[9].cloneNode(true);
				
				// set the innerHTML of the first row 
				new_row.cells[0].innerHTML = '';
				
				var inp6 = new_row.cells[7].getElementsByTagName('input')[0];;
				inp6.value = n;
				
				// grab the input from the first cell and update its ID and value
				var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
				inp1.name += n;
				inp1.placeholder = 'First Name';
				inp1.required = true;
				inp1.pattern = "[A-Za-z]+";
				inp1.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
				inp2.name += n;
				inp2.placeholder = 'Middle Name';
				inp2.required = true;
				inp2.pattern = "[A-Za-z]+";
				inp2.value = '';
				
				
				// grab the input from the first cell and update its ID and value
				var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
				inp3.name += n;
				inp3.placeholder = 'Last Name';
				inp3.required = true;
				inp3.pattern = "[A-Za-z]+";
				inp3.value = '';
				
				
				var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
				inp4.disabled = false;
				
				var inp5 = new_row.cells[5].getElementsByTagName('input')[0];
				inp5.disabled = false;
				
				
				
				// append the new row to the table
				x.appendChild(new_row);
			}
			
			window.onload = function() {
				add.materialid.onblur = validateMaterialID;
				add.type.onblur = disableClassification;
				add.name.onblur = validateName;
				add.fname.onblur = validateAuthorF;
				add.mname.onblur = validateAuthorM;
				add.lname.onblur = validateAuthorL;
				add.year.onblur = validateYear;
				add.edvol.onblur = validateEdition;
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
			
			function disableClassification(){
				type = add.type.value;
				if(type == "SP" || type == "Journals" || type == "Magazines" ){
					add.course.disabled = true;
				}
				else{
					add.course.disabled = false;
					add.course.value = "NULL";
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