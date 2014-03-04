<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ICS-iLS</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>dist/css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

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
          <a class="navbar-brand" href="<?php echo base_url();?>"><img src=" <?php echo base_url();?>dist/images/logowhite.png" height="30px"></a>
        </div>
        <div class="navbar-collapse collapse">


          <form class="navbar-form navbar-right" action="login" role="form" method="post">
            <div class="form-group">
              <input placeholder="Email" class="form-control" type="text" value="<?php echo set_value('username');?>" name="username">
            </div>
            <div class="form-group">
              <input placeholder="Password" class="form-control" type="password" name="password">
            </div>
            <button type="submit" name="login" class="btn btn-success">Sign in</button>
          </form>



        </div><!--/.navbar-collapse -->
      </div>
    </div>