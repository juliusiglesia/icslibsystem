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
                    <li id = "view-nav" class="active" >
                        <a href="<?php echo base_url();?>admin/admin_search">View All Library Materials</a>
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
                <div id="main-page">
                    <div id = "main-content">         
                        <form method="post">

                        <a href='add_material'> Add Material </a><br>

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
                                    echo "<a href='admin'> Back </a><br>";
                                }else{
                                        echo "<table id='myTable' class='tablesorter'>
                                            <thead>
                                            <tr>
                                            <th><center>Material ID</center></th>
                                            <th><center>Course Class</center></th>
                                            <th><center>Title</center></th>
                                            <th><center>Author</center></th>
                                            <th><center>Year Published</center></th>
                                            <th><center>Type</center></th>
                                            <td><center>Accessibility</center></td>
                                            <td><center>Availability</center></td>
                                            <th><center>Borrowed Count</center></th>
                                            <th><center>Requirement</center></th>
                                            <th><center>Rating</center></th>
                                            <th><center>Quantity</center></th>
                                            <td><center>Action</center></td>
                                            </tr>
                                            </thead>";
                                        
                                        echo "<tbody>";    
                                        foreach ($sql2->result() as $q){
                                        
                                            $url1 = 'update';
                                            $url1 = rawurlencode($url1);
                                            $url1 .= "?flag=".urlencode($q->materialid);
                                            
                                            $url2 = 'delete';
                                            $url2 = rawurlencode($url2);
                                            $url2 .= "?flag=".urlencode($q->materialid);
                                                     
                                            echo "<tr>";
                                            echo "<td><center>" . $q->materialid . "</center></td>";
                                            echo "<td><center>" . $q->course . "</center></td>";
                                            echo "<td><center>" . $q->name."</center></td>";
                                            echo "<td><center>" . $q->lname .", ".$q->fname." ".$q->mname . "</center></td>";
                                            echo "<td><center>" . $q->year . "</center></td>";
                                            echo "<td><center>" . $q->type  . "</center></td>";

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
                                            echo "<td><center>" . $q->rating . "</center></td>";
                                            echo "<td><center>" . $q->quantity . "</center></td>";
                                            $rowVal = $q->materialid . "|" . $q->course . "|" . $q->name . "|" . $q->lname . "|" . $q->year . "|" . $q->type . "|" . $q->access . "|" . $q->available . "|" . $q->borrowedcount . "|" . $q->requirement . "|" . $q->rating . "|" . $q->quantity;
                                            echo "<td><input type='button' class='updateButton' name='".$q->materialid."' value='UPDATE' onclick=\"alertID('rowVal_".$q->materialid."' )\" data-toggle='modal'/><input value='".$rowVal."' id = 'rowVal_".$q->materialid."' hidden disabled/></a></td>";
                                            echo "<td><center><a href ='delete?flag=".$q->materialid."' name = 'delete'><input type='button' value='DELETE' onclick=\"alertIT(); return false;\"></a></center></td>";
                                            echo "</tr>";
                                        }
                                       echo "</tbody>";
                                    echo "</table>"; 
                                }
                         ?>
                         </div>
                    </div>
                </div>
    <div class="modal fade" id="container1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Edit Material</h3>
                  </div>
                  <div id="details" class="modal-body">

                    <table>
                        <form onsubmit="myFunction()" action="update_page" method="post" id="update_form">

                                <tr><td><label>Material ID</label></td><td><input type='text' name='materialid' id='materialid' /><td></tr>                         
                                <tr><td><label>Title</label></td><td><input type='text' name='name' id='name'  required /> <td></tr>
                                <tr><td><label>Course Class</label></td><td><input type='text' name='course' id='course'  /> <td></tr>
                                
                                <tr>
                                <td><label>Availability</label></td>
                                <td>
                                <input type='radio' name='available' value='1' />YES
                                <input type='radio' name='available' value='0' />NO
                                </td>
                                </tr>
                                
                                <tr>
                                <td><label>Accessibility</label></td>
                                <td>
                                <select name='access' id='access'>
                                <option value='1'>Student </option>
                                <option value='2'>Faculty </option>
                                <option value='3'>Room Use </option>
                                <option value='4'>Student/Faculty </option>
                                </select>
                                </td>
                                </tr>
                            
                                <tr>
                                <td><label>Type</label></td>
                                <td>
                                <select name='type' id='type'>
                                <option value='Book'>Book </option>
                                <option value='SP'>SP </option>
                                <option value='Thesis'>Thesis </option>
                                <option value='References'>References</option>
                                <option value='CD'>CD </option>
                                <option value='Journals'> Journals</option>
                                <option value='Magazine'>Magazine </option>
                                </select>
                                </td>
                                </tr>
                                
                                <tr><td><label>Year Published</label></td>
                                <td><input type='text' name='year' id='year' required/><td></tr>
                                <tr><td><label>Requirement</label></td><td>
                                <input type='radio' name='requirement' value='1' />COI/COO
                                <input type='radio' name='requirement' value='0' />NONE</td></tr>
                                <tr><td><label>Quantity</label></td><td><input type='text' name='quantity' id='quantity'  required/> <td></tr>
                                <tr><td><label>Borrowed Copy</label></td><td><input type='text' name='borrowedcount' id='borrowedcount' required/> <td></tr>
                                <tr><td><input type = 'submit'/></td></tr>
                        </table>
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
    <script src="<?php echo base_url();?>js/jquery-latest.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/jquery.tablesorter.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() { 
            $("#myTable").tablesorter();
            
            $("#logout").click(function(){
                window.location.href = "<?php echo site_url('admin/logout'); ?>";
            });
        }); 

        function alertID(loc){
      var str = document.getElementById(loc).value;
      str = str.split("|");
      document.getElementById("materialid").value = str[0].toString();
      document.getElementById("course").value = str[1].toString();
      document.getElementById("name").value = str[2].toString();
      document.getElementById("year").value = parseInt(str[4]);
      document.getElementById("type").value = str[5];
      document.getElementById("access").value = parseInt(str[6]);
      var x = document.getElementsByClassName("updateButton");
      
      if(str[7] == '1')
      document.getElementsByName("available")[0].checked = true;
      else if(str[7] == '0')
      document.getElementsByName("available")[1].checked = true;
      
      document.getElementById("borrowedcount").value = parseInt(str[8]);
      
      if(str[9] == '1')
      document.getElementsByName("requirement")[0].checked = true;
      else if(str[9] == '0')
      document.getElementsByName("requirement")[1].checked = true;
      document.getElementById("quantity").value = parseInt(str[11]);
    
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
            alert ("GOING BACK TO SEARCH!");
            return false;
            }
            document.getElementById("").innerHTML=x;
            return true;
        }
        
        function myFunction(){
            alert("You have successfully edited the informations!");    
        }
        
    </script>
</body>
</html>
