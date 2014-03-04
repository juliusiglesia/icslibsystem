<?php 

	if($this->session->userdata('email'))
		include 'logout_header.php'; 
	else
		include 'home_header.php';

?>

	<!--
	
			HOME PAGE - BORROWER

	-->
	<style>
		.sidebar{border-right: 1px solid #eee; height:700px;}
		th{text-align: center;}
	</style>
	
	<br/><br/>
	<div class="container">
		<div class="mainbody">
			<div class="row">
				<h1>Hi, <?php echo $this->session->userdata('fname'), "!"?></h1>
				<br/>
				<div class="col-md-3 sidebar">
					<!--sidebar-->
					<?php include 'sidebar.php';?>
				</div> <!--col-md-3-->

				<div class="col-md-9 section">
					<!--search bar-->
					
					<?php include 'search_bar.php'; ?>

					<!--

						JOHANA, DITO ILALAGAY YUNG FILTERS PARA SA ADVANCED SEARCH :)

					-->



					<br/>
					<!--library inventory tabs-->
					<div class="nav">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#onhand" data-toggle="tab">BOOKS ON HAND</a></li>
							<li><a href="#reserved" data-toggle="tab">RESERVED BOOKS</a></li>
						</ul>

						<!--tab-content-->
						<div class="tab-content">
							<div id="onhand" class="tab-pane active">
								<?php include 'onhand_table_view.php';?>
							</div> <!--end of onhand tab-->

							<div id="reserved" class="tab-pane">
								<?php include 'reserved_table_view.php';?>
							</div> <!--end of reserved tab-->

						</div> <!--end of tab-content-->
					</div> <!--end of library inventory tabs-->
				</div> <!--col-md-9-->
			</div> <!--row-->
		</div> <!--mainbody-->
	</div> <!--container-->

	<div class="container marketing">
		<?php include 'footer.php'; ?>
	</div> <!--container marketing-->