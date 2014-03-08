<?php include 'admin_header.php'?></div>
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
					<li id = "view-nav" class="active">
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
                <br />
                <br />
                <div id="main-page">
                    <div id = "main-content">
						
                        <form method="post"  style="width: 800px ; margin-left: auto; margin-right: auto;" role="form">
                         <label for="filter"><span class="label label-default">Filter by:</span></label>
                                <select name="filter">
                                    <option value="none">Any Field</option>
                                    <option value="author">Author</option>
                                    <option value="subject">Course</option>
                                    <option value="title">Title</option>
                                </select>
						<input type="text" name="search"  size="80"/>
						<input class = "btn btn-primary" type="submit" value="Search" name="search_books"/> 
                          <label for="type"<span class="label label-default">Type:</span></label>
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

                         <label for="access"><span class="label label-default">Accessible by:</span></label>
                                <select name="access"> 
                                        <option value="allAccess">---</option>
                                        <option value="1">Student</option>
                                        <option value="2">Faculty</option>
                                        <option value="3">Room Use</option>
                                        <option value="4">Student/Faculty</option>
                                </select>
						  <span class="label label-default">Availability:</span>
								<input type="radio" name="avail" value="1" id="available"/>
								<label for="available">Available</label>
								<input type="radio" name="avail" value="0" id="notavail"/>
								<label for="notavail">Not Available</label>
                                    <input type="radio" name="avail" value="allAvail" id="avail" checked="true"/>
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
											<td style='width:1%;' scope='col'><b><center>ISBN</center></b></th>
                                            <th style='width:10%;' scope='col'><center>Library Material ID</center></th>
                                            <td style='width:1%;' scope='col'><b><center>Type</center></b></th>
                                            <th style='width:45%;' scope='col' ><center>Library Information</center></th>
                                            <th style='width:1%;' scope='col'><center>Req.</center></th>
                                            <th style='width:1%;' scope='col' ><center>Available Copies</center></td>
                                            <td style='width:1%;' scope='col'><b><center>Action</center></b></td>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr class='info'>
											<td style='width:1%;' scope='col'><b><center>ISBN</center></b></th>
                                            <th style='width:10%;' scope='col'><center>Library Material ID</center></th>
                                            <td style='width:1%;' scope='col'><b><center>Type</center></b></th>
                                            <th style='width:45%;' scope='col' ><center>Library Information</center></th>
                                            <th style='width:1%;' scope='col'><center>Req.</center></th>
                                            <th style='width:1%;' scope='col' ><center>Available Copies</center></td>
                                            <td style='width:1%;' scope='col'><b><center>Action</center></b></td>
                                            </tr>
                                            </tfoot>";
                                        echo "<tbody>";
										$prevMat = (object) array(
												'materialid' => null,
												'course' => null,
												'type' => null,
												'name' => null,
												'year' => null,
												'edvol' => null,
												'access' => null,
												'available' => null,
												'requirement' => null,
												'quantity' => null,
											);
											
										$rowAuthors = null;
										$rowAuthor = null;
                                        foreach ($sql2->result() as $q){
											
											if($prevMat->materialid == null){
												$prevMat->materialid = $q->materialid;
												$prevMat->course = $q->course;
												$prevMat->type = $q->type;
												$prevMat->name = $q->name;
												$prevMat->year = $q->year;
												$prevMat->edvol = $q->edvol;
												$prevMat->access = $q->access;
												$prevMat->available = $q->available;
												$prevMat->requirement = $q->requirement;
												$prevMat->borrowedcount = $q->borrowedcount;
												$prevMat->quantity = $q->quantity;
											}
											
											if($prevMat->materialid == $q->materialid){
												$rowAuthors .= $q->lname . " " . $q->fname . " " . $q->mname . " |";
												$rowAuthor .= $q->lname . ", " . $q->fname . " " . $q->mname . "<br />";
												continue;
												
											}else if($prevMat->materialid != $q->materialid && $prevMat->materialid != null){
												
												echo "<tr>";
												if($q->type == 'Book' || $q->type == 'Reference'){											
													echo "<td><br /><center>ISBN</center></td>";
												}
												else echo "<td>---</td>";
												
												echo "<td><center>" . $prevMat->materialid . "</center></td>";

												if($q->type == 'Book')
													$type = "<span class='glyphicon glyphicon-book'></span>";
												else if($q->type == 'CD')
													$type = "<span class='glyphicon glyphicon-headphones'></span>";
												else if($q->type == 'SP')
													$type = "<span class='glyphicon glyphicon-file'></span>";
												else if($q->type == 'Reference')
													$type = "<span class='glyphicon glyphicon-paperclip'></span>";
												else if($q->type == 'Journals')
													$type = "<span class='glyphicon glyphicon-pencil'></span>";
												else if($q->type == 'Magazines')
													$type = "<span class='glyphicon glyphicon-picture'></span>";
												else if($q->type == 'Thesis')
													$type = "<span class='glyphicon glyphicon-bookmark'></span>";	
												echo "<td><center><br />" . $type . "</center></td>";
												
												echo "<td><span class='title'><b>" . $prevMat->name. ".</b></span><br /><span class='author'>". $rowAuthor
												.$prevMat->year."</span></td>";

												if($q->requirement==0){
													$req = "none";
												}else if($q->requirement==1){
													$req = "COI";
												}else if($q->requirement==2){
													$req = "COO";
												}
												echo "<td><br /><center>" . $req . "</center></td>";
												$availcopy = $q->quantity - $q->borrowedcopy;
												echo "<td><br /><center>" . $availcopy ."/" .$q->quantity. "</center></td>";
												
												$rowVal = $prevMat->materialid . "|" . $prevMat->course . "|" . $prevMat->name . "|" . $prevMat->year . "|" . $prevMat->type . "|" . $prevMat->access . "|" . $prevMat->available . "|" . $prevMat->borrowedcount . "|" . $prevMat->requirement . "|" . $prevMat->quantity;
												echo "<td><button type='button' class='updateButton btn btn-default' name='".$prevMat->materialid."' value='UPDATE' onclick=\"alertID('rowVal_".$prevMat->materialid."','rowAuthor_".$prevMat->materialid."')\" data-toggle='modal'/><span class='glyphicon glyphicon-edit'></button>
													<input value='".$rowVal."' id = 'rowVal_".$prevMat->materialid."' hidden disabled/></a>
													<input value='".$rowAuthors."' id = 'rowAuthor_".$prevMat->materialid."' hidden disabled /></a>
													<a href ='delete?flag=".$prevMat->materialid."' name = 'delete'><button type='button' class='btn btn-danger' value='DELETE' onclick=\"alertIT(); return false;\"><span class='glyphicon glyphicon-remove'></button></a></td>";
												echo "</tr>";
												$rowAuthors = null;
											}
											$rowAuthors = $q->lname . " " . $q->fname . " " . $q->mname . " |";
											$rowAuthor = $q->lname . ", " . $q->fname . " " . $q->mname . "<br />";
											$prevMat->materialid = $q->materialid;
											$prevMat->course = $q->course;
											$prevMat->type = $q->type;
											$prevMat->name = $q->name;
											$prevMat->year = $q->year;
											$prevMat->edvol = $q->edvol;
											$prevMat->access = $q->access;
											$prevMat->available = $q->available;
											$prevMat->requirement = $q->requirement;
											$prevMat->quantity = $q->quantity;
                                        }
										
										
										
												echo "<tr>";
												if($q->type == 'Book' || $q->type == 'Reference'){											
													echo "<td><br /><center>ISBN</center></td>";
												}
												else echo "<td>---</td>";
												
												echo "<td><center>" . $prevMat->materialid . "</center></td>";

												if($q->type == 'Book')
													$type = "<span class='glyphicon glyphicon-book'></span>";
												else if($q->type == 'CD')
													$type = "<span class='glyphicon glyphicon-headphones'></span>";
												else if($q->type == 'SP')
													$type = "<span class='glyphicon glyphicon-file'></span>";
												else if($q->type == 'Reference')
													$type = "<span class='glyphicon glyphicon-paperclip'></span>";
												else if($q->type == 'Journals')
													$type = "<span class='glyphicon glyphicon-pencil'></span>";
												else if($q->type == 'Magazines')
													$type = "<span class='glyphicon glyphicon-picture'></span>";
												else if($q->type == 'Thesis')
													$type = "<span class='glyphicon glyphicon-bookmark'></span>";	
												echo "<td><center><br />" . $type . "</center></td>";
												
												echo "<td>" . $prevMat->name. ".<br />". $rowAuthor// . $q->lname .", ".$q->fname." ".$q->mname 
												. $prevMat->year . ", ". $prevMat->type.".</td>";
												
												if($q->requirement==0){
													$req = "none";
												}else if($q->requirement==1){
													$req = "COI";
												}else if($q->requirement==2){
													$req = "COO";
												}
												echo "<td><br /><center>" . $req . "</center></td>";
												$availcopy = $q->quantity - $q->borrowedcopy;
												echo "<td><br /><center>" . $availcopy ."/" .$q->quantity. "</center></td>";
												$rowVal = $prevMat->materialid . "|" . $prevMat->course . "|" . $prevMat->name . "|" . $prevMat->year . "|" . $prevMat->type . "|" . $prevMat->access . "|" . $prevMat->available . "|" . $prevMat->borrowedcount . "|" . $prevMat->requirement . "|" . $prevMat->quantity;
												
												echo "<td>
													<button type='button' class='updateButton btn btn-default' name='".$prevMat->materialid."' value='UPDATE' onclick=\"alertID('rowVal_".$prevMat->materialid."','rowAuthor_".$prevMat->materialid."')\" data-toggle='modal'/><span class='glyphicon glyphicon-edit'></button>
													<input value='".$rowVal."' id = 'rowVal_".$prevMat->materialid."' hidden disabled/></a>
													<input value='".$rowAuthors."' id = 'rowAuthor_".$prevMat->materialid."' hidden disabled/></a>
													<a href ='delete?flag=".$prevMat->materialid."' name = 'delete'><button type='button' class='btn btn-danger' value='DELETE' onclick=\"alertIT(); return false;\"><span class='glyphicon glyphicon-remove'></button></a></td>";
												echo "</tr>";
												$rowAuthors = null;
                                       echo "</tbody>";
                                    echo "</table>"; 
                                }
                         ?>
                         </div>
                    </div>
                </div>

                <!-- FOOTER -->
		<footer> <a href="#" class="back-to-top"><span class='glyphicon glyphicon-chevron-up'></span></a>
			<center><p id="small">2013 CMSC 128 AB-6L. All Rights Reserved. <a href="#">Privacy</a> | <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a> </p></center>
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
								<td><input type="number" name="quantity" id="quantity" min="0" max="100" required /></td>
								<td><span style="color: red;" name="helpquantity"></td>
								</tr>
								
								<tr>
								<td><label>Author</label></td>
								<td><input type="text" id="lname[0]" placeholder = "Last Name" required /></td>
								<td><input type="text" id="fname[0]" placeholder = "First Name" required /></td>
								<td><input type="text" id="mname[0]" placeholder = "Middle Name" required /></td>
								<td><input type="button" value="x" onclick="deleteRow(this)" disabled/></td>
								<td><input type="button" value="+" onClick="addRow()"  /></td>
								<td><span style="color: red;" name="helpauthor"/></td>
								<td><input type="hidden" name="numberOfAuthors" value="1"/></td>
								</tr>		
													
                        </table>
						<table>
							<tr>
							<td><input type="hidden" name="fnameOfAuthors" id="fnameOfAuthors" value=" "/></td>
							<td><input type="hidden" name="mnameOfAuthors" id="mnameOfAuthors" value=" "/></td>
							<td><input type="hidden" name="lnameOfAuthors" id="lnameOfAuthors" value=" "/></td>
							<td><input type="hidden" name="numberOfAuthors" id="numberOfAuthors" value="0"/></td>
							</tr>
						</table>
						<input type = "submit"  name="submit" onclick="submitForm()"/>
                        </form>

                  </div>
                  <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="resetN()">Cancel</button>
                  </div>
                 </div>
                </div>
            </div></div></div>

		<script src="<?php echo base_url();?>dist/js/jquery.js"></script>
		<script src="<?php echo base_url();?>dist/js/holder.js"></script>
		<script src="<?php echo base_url();  ?>js/jquery.tablesorter.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>dist/js/bootstrap.js"></script>
    <script>
        $(document).ready(function() { 
            $("#myTable").tablesorter();
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
                })
        }); 
    </script>
		
	<script type="text/javascript">
		var n = 1;
		function resetN(){
			n=1;
		}
			function submitForm(){
				var arr_fname = new Array();
				var arr_mname = new Array();
				var arr_lname = new Array();
				
				var assign_arr_fname = document.getElementById("fnameOfAuthors");
				var assign_arr_mname = document.getElementById("mnameOfAuthors");
				var assign_arr_lname = document.getElementById("lnameOfAuthors");
				var assign_num = document.getElementById("numberOfAuthors");
					
				for(var i=0;i<n;i++){
					arr_fname[i] = document.getElementById("fname["+i+"]").value;
					arr_mname[i] = document.getElementById("mname["+i+"]").value;
					arr_lname[i] = document.getElementById("lname["+i+"]").value;
				}
				assign_arr_fname.value = arr_fname;
				assign_arr_mname.value = arr_mname;
				assign_arr_lname.value = arr_lname;
				assign_num.value = n;
			}
	
			function deleteRow(row){
				n-=1;
				var i=row.parentNode.parentNode.rowIndex;
				document.getElementById('formTable').deleteRow(i);
			}
		
			function addRow(){				
				var x=document.getElementById('formTable');
				// deep clone the targeted row
				var new_row = x.rows[9].cloneNode(true);
				
				// set the innerHTML of the first row 
				new_row.cells[0].innerHTML = '';
				
				var inp6 = new_row.cells[7].getElementsByTagName('input')[0];;
				inp6.value = n;
				
				// grab the input from the first cell and update its ID and value
				var inp3 = new_row.cells[1].getElementsByTagName('input')[0];
				inp3.id = "lname["+n+"]";
				inp3.placeholder = 'Last Name';
				inp3.required = true;
				inp3.pattern = "[A-Za-z]+";
				inp3.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp1 = new_row.cells[2].getElementsByTagName('input')[0];
				inp1.id = "fname["+n+"]";
				inp1.placeholder = 'First Name';
				inp1.required = true;
				inp1.pattern = "[A-Za-z]+";
				inp1.value = '';
				
				// grab the input from the first cell and update its ID and value
				var inp2 = new_row.cells[3].getElementsByTagName('input')[0];
				inp2.id = "mname["+n+"]";
				inp2.placeholder = 'Middle Name';
				inp2.required = true;
				inp2.pattern = "[A-Za-z]+";
				inp2.value = '';
				
				
				var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
				inp4.disabled = false;
				
				var inp5 = new_row.cells[5].getElementsByTagName('input')[0];
				inp5.disabled = false;
								
				// append the new row to the table
				x.appendChild(new_row);
				n+=1;
		}
	</script>
	
    <script>
		function alertID(loc,loc1){

		var str = document.getElementById(loc).value;
		var authors = document.getElementById(loc1).value.toString();
		str = str.split("|");
		authors = authors.split("|");
		document.getElementById("materialid").value = str[0].toString();
		document.getElementById("course").value = str[1].toString();
		document.getElementById("name").value = str[2].toString();

		document.getElementById("year").value = parseInt(str[3]);
		document.getElementById("type").value = str[4];
		document.getElementById("access").value = parseInt(str[5]);
		var x = document.getElementsByClassName("updateButton");

		if(str[6] == '1')
		document.getElementsByName("available")[0].checked = true;
		else if(str[6] == '0')
		document.getElementsByName("available")[1].checked = true;

		if(str[8] == '1')
		document.getElementsByName("requirement")[0].checked = true;
		else if(str[8] == '0')
		document.getElementsByName("requirement")[1].checked = true;
		document.getElementById("quantity").value = parseInt(str[9]);

		for(var i=0;i<authors.length-1;i++){
		var author = authors[i].split(" ");

		document.getElementById("lname["+i+"]").value = author[0].toString();
		document.getElementById("fname["+i+"]").value = author[1].toString();
		document.getElementById("mname["+i+"]").value = author[2].toString();
		if(authors.length-1 > 1 && i!=authors.length-2){addRow();}
		
		}
		
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
				//add.fname.onblur = validateAuthorF;
				//add.mname.onblur = validateAuthorM;
				//add.lname.onblur = validateAuthorL;
				add.year.onblur = validateYear;
				//add.edvol.onblur = validateEdition;
				//add.borrowedcount.onblur = validateBorrowedCount;
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
			/*
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
			*/
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
			
			/*function validateBorrowedCount(){
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
			}*/		
			
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
			
			/*function validateEdition(){
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
			}*/
			
		</script>
</body></html>