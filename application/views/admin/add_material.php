<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>ICS-iLS</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="dist/css/carousel.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#"><img src="dist/images/logowhite.png" height="30px"></a>
        </div>
      </div>
  </div>



    <div class="container">

      <form class="form-signin" role="form" method="post" action="<?php echo $PHP_SELF;?>">
        <h2 class="form-signin-heading">Fill up the necessary info: </h2>
	<select name="mydropdown" class="form-control" placeholder="Course" required autofocus >
		<option value="main" SELECTED>COURSE</option>		
		<option value="2">CMSC 2</option>
		<option value="11">CMSC 11</option>
		<option value="21">CMSC 21</option>
		<option value="22">CMSC 22</option>
		<option value="others">OTHERS</option>
	</select>
	<input type="text" class="form-control" placeholder="Material ID (XXXX-XX)" required autofocus>

	<input type="text" class="form-control" placeholder="Type" required autofocus>
        <input type="password" class="form-control" placeholder="Title:" required>
        <input type="password" class="form-control" placeholder="Author:" required>
       	<input type="password" class="form-control" placeholder="Year Published:" required>
       	<input type="password" class="form-control" placeholder="Edition:" required>
	
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>

    </div> <!-- /container -->

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
   
  

   <!-- FOOTER -->
  <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>© 2013 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="dist/js/jquery-1.js"></script>
    <script src="dist/js/bootstrap.js"></script>
    <script src="dist/js/holder.js"></script>
  

</body></html>
