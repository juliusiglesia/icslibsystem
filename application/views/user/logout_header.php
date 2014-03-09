<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>dist/images/fav.png">

    <title>ICS-iLS</title>

    <link href="<?php echo base_url(); ?>dist/css/bootstrap.css" rel="stylesheet">

    <script type="text/javascript">
           
      function toggle() {
       if( document.getElementById("hidethis").style.display=='none' ){
         document.getElementById("hidethis").style.display = 'table-row'; // set to table-row instead of an empty string
       }else{
         document.getElementById("hidethis").style.display = 'none';
       }
      }
      </script>

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>dist/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/modulestyle.css" rel="stylesheet">
  <style type="text/css" id="holderjs-style"></style></head>
<!-- NAVBAR
==================================================-->
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
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>dist/images/logo4.png" height="40px"></a>
        </div>
       <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>borrower/profile" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-home" ></span></a></li>
            <li class="dropdown">
              <a  id = "message" class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-envelope" ></span></a>
                <?php
                 // if($overdue || $res || $readytoclaim){ echo "<span class='glyphicon glyphicon-exclamation-sign'></span>"; }
                ?>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Overdue Books</li>
                <li><a>
                <div  id = "overdue">
                <?php
                    if(!$overdue){  echo "<i> None </i>"; }
                    else{
                      foreach ($overdue as $temps) {
                        echo $temps['name']; 
                        echo "<br/>";
                        echo "Fine:  Php ";
                        echo "${temps['user_fine']}";
                      }
                    }
                  ?>
                </div>
                 </a></li>
                 <li class="divider"></li>
                 <li  class="dropdown-header">Reserved Books</li>
                 <li><a>
                    <div id = "reserved" >
                      <?php
                        if(!$res){ echo "<i> None </i>"; }
                        else{
                          foreach ($res as $temps) {
                            echo $temps['name'];
                          } 
                        }
                      ?>
                    </div>
                  </a></li>
                 </a></li>
                 <li class="divider"></li>
                 <li  class="dropdown-header">Ready to claim</li>
                 <li><a>
                  <div id="ready">
                    <?php
                      
                      if(!$readytoclaim){  echo "<i> None </i>"; }
                      else{
                        foreach ($readytoclaim as $temps) {
                          echo $temps['materialid'];  echo " until "; echo"<b>"; echo $temps['claimdate'];  echo"</b>";
                        } 
                      }
                    ?>
                  </div>
                 </a></li>
              </ul>
            </li>
            <form class="navbar-form navbar-right" role="form" action="logout" >
              <button type="submit" class="btn btn-link"><span class="glyphicon glyphicon-log-out" type="submit" style="font-size:17px;" onclick = "this.style.color='white';"><a href="/icslibsystem/logout?"></a></span></button>
              <!--li><a href="/icslibsystem/logout?"><span class="glyphicon glyphicon-log-out" type="submit" style="font-size:17px;" onclick = "this.style.color='white';"></span></a></li-->
            </form>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>