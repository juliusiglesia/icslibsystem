<?php include 'admin_header.php' ?>
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
          <a class="navbar-brand" href="try.html"><img src="dist/images/logowhite.png" height="30px"></a>
        </div>
      </div>
    </div>
	
	<div class="mainBody">
		<!-- Nav tabs -->
		<div class="sidebarMain">
		<ul class="nav nav-pills nav-stacked">
		  <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
		  <li><a href="#overdue" data-toggle="tab">Overdue Books</a></li>
		  <li><a href="#reserved" data-toggle="tab" >Reserved Books</a></li>
		  <li><a href="#borrowed" data-toggle="tab">Borrowed Books</a></li>
		  <li><a href="#view" data-toggle="tab">View All Library Materials</a></li>
		  <li><a href="#add" data-toggle="modal">Add A New Material</a></li>
		</ul>
		</div>
		<div class="leftMain">
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active" id="overview"><h1>WELCOME ADMIN!</h1></div>
			
			
			<!--Overdue -->
			<div class="tab-pane fade" id="overdue">
			<h1>OVERDUE BOOKS</h1>
			<table id="overdue" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
			<thead>
              <tr>
                <th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Library Material ID</th>
                <th style="width:100px;" abbr="CourseClassification" scope="col" title="Course Classification">Course Classification</th>
                <th abbr="Type" scope="col" title="Type">Type</th>
                <th abbr="Title" scope="col" title="Title">Title</th>
                <th abbr="Author" scope="col" title="Author">Author</th>
                <th style="width:100px;" abbr="YrofPub" scope="col" title="Year of Publication">Year of Publication</th>
                <th abbr="Edition" scope="col" title="Edition">Edition</th>
                <th abbr="Accessibility" scope="col" title="Accessible For">Borrower</th>
                <th abbr="Action" scope="col" title="Action">Action</th>
              </tr>
            </thead>
              <tr>
                <td>L.Mat. ID 1</td>
                <td>CMSC1</td>
                <td>Type 1</td>
                <td>Title 1</td>
                <td>Author 1</td>
                <td>0001</td>
                <td>Edition 1</td>
                <td>Student 0</td>
                <td><input type="submit" value="Send Notif"/></td>
              </tr>
              <tr>
                <td>L.Mat. ID 2</td>
                <td>CMSC2</td>
                <td>Type 2</td>
                <td>Title 2</td>
                <td>Author 2</td>
                <td>0002</td>
                <td>Edition 2</td>
                <td>Student1</td>
                <td><input type="submit" value="Send Notif"/></td>
              </tr>
              <tr>
                <td>L.Mat. ID 3</td>
                <td>CMSC2</td>
                <td>Type 3</td>
                <td>Title 3</td>
                <td>Author 3</td>
                <td>0003</td>
                <td>Edition 3</td>
                <td>Student2</td>
                <td><input type="submit" value="Send Notif"/></td>
              </tr>

			</table>
			</div>
			
			<!--Reserved -->
			<div class="tab-pane fade" id="reserved">
			<h1>Reserved Books</h1>
			<table id="reserved" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
	 <thead>
              <tr>
                <th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Library Material ID</th>
                <th style="width:100px;" abbr="CourseClassification" scope="col" title="Course Classification">Course Classification</th>
                <th abbr="Type" scope="col" title="Type">Type</th>
                <th abbr="Title" scope="col" title="Title">Title</th>
                <th abbr="Author" scope="col" title="Author">Author</th>
                <th style="width:100px;" abbr="YrofPub" scope="col" title="Year of Publication">Year of Publication</th>
                <th abbr="Edition" scope="col" title="Edition">Edition</th>
                <th abbr="Accessibility" scope="col" title="Accessible For">Borrower</th>
                <th abbr="Action" scope="col" title="Action">Action</th>
              </tr>
            </thead>
              <tr>
                <td>L.Mat. ID 1</td>
                <td>CMSC1</td>
                <td>Type 1</td>
                <td>Title 1</td>
                <td>Author 1</td>
                <td>0001</td>
                <td>Edition 1</td>
                <td>Student 0</td>
                <td><input type="submit" value="Approve"/></td>
              </tr>
              <tr>
                <td>L.Mat. ID 2</td>
                <td>CMSC2</td>
                <td>Type 2</td>
                <td>Title 2</td>
                <td>Author 2</td>
                <td>0002</td>
                <td>Edition 2</td>
                <td>Student1</td>
                <td><input type="submit" value="Approve"/></td>
              </tr>
              <tr>
                <td>L.Mat. ID 3</td>
                <td>CMSC2</td>
                <td>Type 3</td>
                <td>Title 3</td>
                <td>Author 3</td>
                <td>0003</td>
                <td>Edition 3</td>
                <td>Student2</td>
                <td><input type="submit" value="Approve"/></td>
              </tr>
			</table>
			</div>
			
			
			<div class="tab-pane fade" id="borrowed">
<h1>Borrowed Books</h1>
<table id="borrowed" summary="Results" border="1" cellspacing="5" cellpadding="5" align = "center">
	 <thead>
              <tr>
                <th style="width:100px;" abbr="lmID" scope="col" title="Libary Material ID">Library Material ID</th>
                <th style="width:100px;" abbr="CourseClassification" scope="col" title="Course Classification">Course Classification</th>
                <th abbr="Type" scope="col" title="Type">Type</th>
                <th abbr="Title" scope="col" title="Title">Title</th>
                <th abbr="Author" scope="col" title="Author">Author</th>
                <th style="width:100px;" abbr="YrofPub" scope="col" title="Year of Publication">Year of Publication</th>
                <th abbr="Edition" scope="col" title="Edition">Edition</th>
                <th abbr="Accessibility" scope="col" title="Accessible For">Borrower</th>
              </tr>
            </thead>
              <tr>
                <td>L.Mat. ID 1</td>
                <td>CMSC1</td>
                <td>Type 1</td>
                <td>Title 1</td>
                <td>Author 1</td>
                <td>0001</td>
                <td>Edition 1</td>
                <td>Student 0</td>
              </tr>
              <tr>
                <td>L.Mat. ID 2</td>
                <td>CMSC2</td>
                <td>Type 2</td>
                <td>Title 2</td>
                <td>Author 2</td>
                <td>0002</td>
                <td>Edition 2</td>
                <td>Student1</td>
              </tr>
              <tr>
                <td>L.Mat. ID 3</td>
                <td>CMSC2</td>
                <td>Type 3</td>
                <td>Title 3</td>
                <td>Author 3</td>
                <td>0003</td>
                <td>Edition 3</td>
                <td>Student2</td>
              </tr>

			</table>			
			</div>
			<div class="tab-pane fade" id="view">...e</div>

			
			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="myModalLabel">Add a new material</h3>
				  </div>
				  <div class="modal-body">
				      <form class="form-signin" role="form">
						<h2 class="form-signin-heading">Fill up the necessary info: </h2>
						<input type="text" class="form-control" placeholder="Material ID (XXXX-XX)" required autofocus>
						<input type="text" class="form-control" placeholder="Course:" required autofocus>
						<input type="text" class="form-control" placeholder="Type" required autofocus>
						<input type="password" class="form-control" placeholder="Title:" required>
						<input type="password" class="form-control" placeholder="Author:" required>
					   <input type="password" class="form-control" placeholder="Year Published:" required>
					   <input type="password" class="form-control" placeholder="Edition:" required>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="submit">Add</button>
					 </form>
				  </div>
				</div>
			  </div>
			</div>			
		</div>
		</div>

	<div class="container marketing">
      <!-- FOOTER -->
	   <hr class="featurette-divider">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>© 2013 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a> | <a href="#">About</a> | <a href="#">Contact</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="dist/js/jquery-1.js"></script>
    <script src="dist/js/bootstrap.js"></script>
    <script src="dist/js/holder.js"></script>
  

</body></html>