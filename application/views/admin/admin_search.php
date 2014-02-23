<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!--TO BE PUT in a js file -->
    <script type="text/javascript">
      function toggle() {
       if( document.getElementById("hidethis").style.display=='none' ){
         document.getElementById("hidethis").style.display = 'table-row'; // set to table-row instead of an empty string
       }else{
         document.getElementById("hidethis").style.display = 'none';
       }
      }
      </script>

    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>ICS-iLS</title>

    <link href="<?php echo base_url();?>dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/signin.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/style.css" rel="stylesheet">

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
                    <li id = "view-nav" class="active" >
                        <a href="<?php echo base_url();?>admin/admin_search2">View All Library Materials</a>
                    </li>
                    <li id = "add-nav" >
                        <a href="<?php echo base_url();?>admin/add_material">Add A New Material</a>
                    </li>
                    <li id = "generate-nav" >
                        <a href="<?php echo base_url();?>admin/print_inventory" target = "_blank" >Generate Report</a>
                    </li>
                </ul>
            </div>   

        <div class="leftMain">
                <br />
                <br />
                <div id="main-page">
                    <div id = "main-content">
						
                        <form method="post">
						
                         <label for="filter">Filter by:</label>
                                <select name="filter">
                                    <option value="none">Any Field</option>
                                    <option value="author">Author</option>
                                    <option value="subject">Course</option>
                                    <option value="title">Title</option>
                                </select>
                          <label for="type">Type:</label>
                                <select name="type">
                                    <option value="allTypes">All</option>
                                    <option value="book">Book</option>
                                    <option value="sp">SP</option>
                                    <option value="thesis">Thesis</option>
                                    <option value="references">References</option> 
                                    <option value="cd">CD</option>
                                    <option value="journals">Journals</option>
                                    <option value="magazine">Magazines</option>
                                </select>          

                         <label for="access">Accessible by:</label>
                                <select name="access"> 
                                        <option value="allAccess">---</option>
                                        <option value="1">Student</option>
                                        <option value="2">Faculty</option>
                                        <option value="3">Room Use</option>
                                        <option value="4">Student/Faculty</option>
                                </select>
                                <br />
                                    Availability:
                                    <input type="radio" name="avail" value="1" id="available"/>
                                    <label for="available">Available</label>
                                    <input type="radio" name="avail" value="0" id="notavail"/>
                                    <label for="notavail">Not Available</label>
                                    <input type="radio" name="avail" value="allAvail" id="avail" checked="true"/>
                                    <label for="available">Both</label>

                         <input type="text" name="search"/>

                         <input type="submit" value="Search" name="search_books"/>
                        </form>
                         <br/>
                         <br/>
                         <?php
                                    if($this->input->post('insert') != ''){
                                        $materialid = $this->input->post('materialid');
                                        $course = $this->input->post('course');
                                        $type = $this->input->post('type');
                                        $name = $this->input->post('name');
                                        $year = $this->input->post('year');
                                        $edvol = $this->input->post('edvol');
                                        $access = $this->input->post('access');
                                        $available = $this->input->post('available');
                                        $requirement = $this->input->post('requirement');

                                        $fname = $this->input->post('fname');
                                        $mname = $this->input->post('mname');
                                        $lname = $this->input->post('lname');
                                    
                                        $query = $this->db->get_where('librarymaterial', array('materialid' => $materialid));

                                        if( $query->num_rows() > 0 ) {
                                            echo "Material ID already exists!";
                                        } 
                                        else {
                                            echo "L. Mat. ID: ".$materialid."<br>";
                                            echo "Type: ".$type."<br>";
                                            echo "Course Classification: ".$course."<br>";
                                            echo "Title: ".$name."<br>";
                                            echo "Author: ".$fname." ".$mname." ".$lname."<br>";
                                            echo "Year of Publication: ".$year."<br>";
                                            echo "Edition: ".$edvol."<br>";
                                            echo "Accessibility: ".$access."<br>";
                                            echo "Availability: ".$available."<br>";
                                            echo "Requirements: ".$requirement."<br>";
                                    
                                            echo "<h3>Successfully Added</h3>";
                                        }
                                    }   
                            ?>
                         
                         <?php
                                if($sql2->num_rows()==0){
                                    echo "No library material available";
                                    echo "<a href='admin_search'> Back </a><br>";
                                }else{
                                        echo "<table id='myTable' class='tablesorter' summary='Results' border='1' cellspacing='5' cellpadding='5' align = 'center'>
                                            <thead>
                                            <tr class='info'>
                                            <th style='width:10%;' scope='col'><center>Material ID</center></th>
                                            <th style='width:10%;' scope='col'><center>Course Class</center></th>
                                            <th style='width:28%;' scope='col' ><center>Material</center></th>
                                            <td style='width:7%;' scope='col'><center>Accessibility</center></td>
                                            <td style='width:7%;' scope='col' ><center>Availability</center></td>
                                            <th style='width:12%;' scope='col'><center>Borrowed Count</center></th>
                                            <th style='width:7%;' scope='col'><center>Req.</center></th>
                                            <th style='width:9%;' scope='col'><center>Book Count</center></th>
                                            <td style='width:10%;' scope='col'><center>Action</center></td>
                                            </tr>
                                            </thead>";
                                        
                                        echo "<tbody>";    
                                        foreach ($sql2->result() as $q){
                                                                                            
                                            echo "<tr>";
                                            echo "<td><center>" . $q->materialid . "</center></td>";
                                            echo "<td><center>" . $q->course . "</center></td>";
                                            echo "<td>" . $q->name. ".<br />" . $q->lname .", ".$q->fname." ".$q->mname 
                                            . ".<br />". $q->year . ", ". $q->type.".</td>";

                                                if($q->access==1) //student
                                                    $access = "Student";
                                                else if($q->access==2)//faculty
                                                    $access = "Faculty";
                                                else if($q->access==3)//room use
                                                    $access = "Room Use";
                                                else if($q->access==4)//student/faculty
                                                    $access = "Student/Faculty";

                                            echo "<td><center>" . $access . "</center></td>";

                                                if($q->available==0) //not available
                                                    $avail = "Not available";
                                                else if($q->available=1)//available
                                                    $avail = "Available";

                                            echo "<td><center>" . $avail  . "</center></td>";
                                            echo "<td><center>" . $q->borrowedcount . "</center></td>";

                                            if($q->requirement==0){
                                                $req = "none";
                                            }else if($q->requirement==1){
                                                $req = "consent of instructor";
                                            }else if($q->requirement==2){
                                                $req = "consent of owner";
                                            }
                                            echo "<td><center>" . $req . "</center></td>";
                                            echo "<td><center>" . $q->quantity . "</center></td>";
                                            $rowVal = $q->materialid . "|" . $q->course . "|" . $q->name . "|" . $q->lname ."|" . $q->fname . "|" . $q->mname . "|" . $q->year . "|" . $q->type . "|" . $q->access . "|" . $q->available . "|" . $q->borrowedcount . "|" . $q->requirement . "|" . $q->quantity;
                                            echo "<td><button type='button' class='updateButton btn btn-default' name='".$q->materialid."' value='UPDATE' onclick=\"alertID('rowVal_".$q->materialid."' )\" data-toggle='modal'/>UPDATE</button>
                                                <input value='".$rowVal."' id = 'rowVal_".$q->materialid."' hidden disabled/></a>
                                                <a href ='delete?flag=".$q->materialid."' name = 'delete'><button type='button' class='btn btn-danger' value='DELETE' onclick=\"alertIT(); return false;\">DELETE</button></a></td>";
                                            echo "</tr>";
                                        }
                                       echo "</tbody>";
                                    echo "</table>"; 
                                }
                         ?>
                         </div>
                    </div>
                </div>

                 <footer>
                    <p class="pull-right"><a href="#"> <img src="<?php echo base_url();?>images/top_icon.PNG" alt="back to top" width="50" height="50"/> </a></p>
                    <p>2013 Company, Inc. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Contact</a> </p>
                  </footer>
      
    <div class="modal fade" id="container1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Edit Material</h3>
                  </div>
                  <div id="details" class="modal-body">

        <form onsubmit="myFunction()" name="add" id="add" action="update_page" method="post" >
			<table id="formTable">
                                <tr>
								<td><label>Material ID</label></td>
								<td><input type="text" name="materialid" id="materialid" readonly /></td>
								</tr>     
								
                                <tr>
								<td><label>Title</label></td>
								<td><textarea name="name" id="name" cols="40" rows="5" required> </textarea></td>
								<td><span style="color: red;" name="helpname"></td>
								</tr>
								
								<tr>
                                <td><label>Type</label></td>
                                <td>
                                <select name="type" id="type" required>
                                <option value="Book">Book </option>
                                <option value="SP">SP </option>
                                <option value="Thesis">Thesis </option>
                                <option value="References">References</option>
                                <option value="CD">CD </option>
                                <option value="Journals"> Journals</option>
                                <option value="Magazines">Magazine </option>
                                </select>
                                </td>
                                </tr>
                                
								
                                <tr>
								<td><label>Course Classification</label></td>
								<td><select id="course" name="course">
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
								<td><label>Author</label></td>
								<td><input type="text" id="lname" required /></td>
								<td><input type="text" id="fname" required /></td>
								<td><input type="text" id="mname" required /></td>
								</tr>							
							
                                <tr>
                                <td><label>Availability</label></td>
                                <td>
                                <input type="radio" name="available" value="1" />YES
                                <input type="radio" name="available" value="0" />NO
                                </td>
                                </tr>
                                
                                <tr>
                                <td><label>Accessibility</label></td>
                                <td>
                                <select name="access" id="access">
                                <option value="1">Student </option>
                                <option value="2">Faculty </option>
                                <option value="3">Room Use </option>
                                <option value="4">Student/Faculty </option>
                                </select>
                                </td>
                                </tr>
                            
                                <tr>
								<td><label>Year Published</label></td>
                                <td><input type="number" name="year" id="year" min="1950" max="2013" required/></td>
								<td><span style="color: red;" name="helpyear"></td>
								</tr>
								
                                <tr>
								<td><label>Requirement</label></td>
								<td><input type="radio" name="requirement" value="1"/>COI/COO
                                <input type="radio" name="requirement" value="0" />NONE</td>
								</tr>
																
                                <tr>
								<td><label>Quantity</label></td>
								<td><input type="number" name="quantity" id="quantity" min="0" max="100" required/></td>
								<td><span style="color: red;" name="helpquantity"></td>
								</tr>
													
                        </table>
						
						<input type = "submit"  name="submit" />
                        </form>

                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                  </div>
                 </div>
                </div>
            </div></div></div>


    <script src="<?php echo base_url();?>dist/js/jquery.js"></script>
    <script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>dist/js/holder.js"></script>
    <script src="<?php echo base_url();  ?>js/jquery-latest.js" type="text/javascript"></script>
    <script src="<?php echo base_url();  ?>js/jquery.tablesorter.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() { 
            $("#myTable").tablesorter();
        }); 
    </script>
	
    <script>
      function alertID(loc){
      var str = document.getElementById(loc).value;
      str = str.split("|");
      document.getElementById("materialid").value = str[0].toString();
      document.getElementById("course").value = str[1].toString();
      document.getElementById("name").value = str[2].toString();
	  document.getElementById("lname").value = str[3].toString();
	  document.getElementById("fname").value = str[4].toString();
	  document.getElementById("mname").value = str[5].toString();
      document.getElementById("year").value = parseInt(str[6]);
      document.getElementById("type").value = str[7];
      document.getElementById("access").value = parseInt(str[8]);
      var x = document.getElementsByClassName("updateButton");
      
      if(str[9] == '1')
      document.getElementsByName("available")[0].checked = true;
      else if(str[9] == '0')
      document.getElementsByName("available")[1].checked = true;
           
      if(str[11] == '1')
      document.getElementsByName("requirement")[0].checked = true;
      else if(str[11] == '0')
      document.getElementsByName("requirement")[1].checked = true;
      document.getElementById("quantity").value = parseInt(str[12]);
    
    for (var i = 0; i < x.length; i++){
      x[i].setAttribute('data-target', '#container1');
      
      }
    }
        function alertIT(){
            var x;
            var r=confirm("Are you sure you want to delete this?");
            if (r)
            {
            alert ("You have successfully deleted the data!");
            }
            else
            {
            //alert ("GOING BACK TO SEARCH!");
            return false;
            }
            document.getElementById("").innerHTML=x;
            return true;
        }
        
        function myFunction(){
            alert("You have successfully edited the informations!");    
        }
        
    </script>
	
	<script type="text/javascript">
			window.onload = function() {
				add.materialid.onblur = validateMaterialID;
				add.type.onblur = disableClassification;
				add.name.onblur = validateName;
				add.fname.onblur = validateAuthorF;
				add.mname.onblur = validateAuthorM;
				add.lname.onblur = validateAuthorL;
				add.year.onblur = validateYear;
				add.edvol.onblur = validateEdition;
				add.borrowedcount.onblur = validateBorrowedCount;
				add.quantity.onblur = validateQuantity;
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
				if (msg == "") return true;
			}
			
			function disableClassification(){
				type = add.type.value;
				if(type == "SP" || type == "Journals" || type == "Magazines" ){
					add.course.disabled = true;
				}
				else if(type == "Book" || type == "Thesis" || type == "CD" || type == "References" ){
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
				if (!str.match(/^[A-Za-z0-9\ \.\,\-\'\?\!]+$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpname")[0].innerHTML = msg;
				if (msg == "") return true;
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
				if (msg == "") return true;
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
				if (msg == "") return true;
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
				if (msg == "") return true;
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
				if (msg == "") return true;
			}
			
			function validateBorrowedCount(){
				msg = "Invalid input. ";
				str = add.borrowedcount.value;
				if (str == "") {
					msg+="Borrowed count is required. ";
				}
				if (!str.match(/^[0-9]+$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpborrowedcount")[0].innerHTML = msg;
				if (msg == "") return true;
			}		
			
			function validateQuantity(){
				msg = "Invalid input. ";
				str = add.quantity.value;
				if (str == "") {
					msg+="Quantity is required. ";
				}
				if (!str.match(/^[0-9]+$/)) {
					msg+="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";

				document.getElementsByName("helpquantity")[0].innerHTML = msg;
				if (msg == "") return true;
			}					
			
			function validateEdition(){
				msg = "Invalid input. ";
				str = add.edvol.value;
				if (str == "") {
					add.edvol.value = "NULL";
				}
				else if (!str.match(/^[A-Za-z0-9\(\)]+$/) && str != "") {
					msg="Characters are invalid.";
				}
				if (msg == "Invalid input. ") msg="";
				
				document.getElementsByName("helpedvol")[0].innerHTML = msg;
				if (msg == "") return true;
			}
			
		</script>
</body></html>