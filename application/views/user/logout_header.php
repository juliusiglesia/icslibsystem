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

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>dist/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>dist/css/signin.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>dist/js/jquery.js"></script>
  <style type="text/css" id="holderjs-style"></style></head>
<!-- NAVBAR
================================================== -->
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
          <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>dist/images/logo4.png" height="40px"></a>
        </div>
       <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class = "notif" href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:17px;" onclick = "this.style.color='white';"><span class="glyphicon glyphicon-envelope" ></span></a>
              <ul class="dropdown-menu">

                <li class="dropdown-header">Overdue Books</li>
                  <?php
					//--------
					
                    foreach ($overdue as $temps) {
                      echo "<li><a>"; 
          					  echo $temps['name']; 
                      echo "<br/>";
          					  echo "Fine:  Php ";
          						echo "${temps['user_fine']}";
          					  echo "</a></li>"; 
                    }
                  ?>
                 </a></li>
                 <li class="divider"></li>
                <li class="dropdown-header">Reserved Books</li>
                  <?php
                    foreach ($res as $temps) {
                      echo "<li><a>"; echo $temps['name']; echo "</a></li>"; 
                    } 
                  ?>
                 </a></li>
                 <li class="divider"></li>

              </ul>
            </li>
            <form class="navbar-form navbar-right" role="form" action="logout" > 
            <button type="submit" class="btn btn-success">Log out</button>
          </form>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>