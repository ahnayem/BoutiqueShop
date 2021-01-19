<?php 
	include 'session.php';

	if (!isset($_SESSION['admin_id'])) {
            header('location: ../admin_login.php');
    } else{
    	$id            		= $_SESSION['admin_id'];

    	include 'db.php';

        $query              = "SELECT * FROM admin WHERE id = :id";
        $stmt               = $db->prepare($query);
        $stmt               -> bindValue(':id',$id, PDO::PARAM_STR);
        $result             = $stmt->execute();
        $row                = $stmt->fetch();

        $timestamp = strtotime($row['date']);


        //dashboard info (Products)
        $queryPr              = "SELECT count(*) FROM product";
        $stmtPr               = $db->prepare($queryPr);
        $resultPr             = $stmtPr->execute();
        $rowPr                = $stmtPr->fetch();

        // orders
        $queryO              = "SELECT count(*) FROM orders";
        $stmtO               = $db->prepare($queryO);
        $resultO             = $stmtO->execute();
        $rowO                = $stmtO->fetch();

        // customers
        $queryC              = "SELECT count(*) FROM user";
        $stmtC               = $db->prepare($queryC);
        $resultC             = $stmtC->execute();
        $rowC                = $stmtC->fetch();
    }
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Dashboard</title> 
	<link href="assets/materialize/css/material-icon.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='assets/css/google-font.css' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css"> 
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand waves-effect waves-dark" href="dashboard.php"><i class="large material-icons">track_changes</i> <strong>admin</strong></a>
				
				<div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
            </div>
            <ul class="nav navbar-top-links navbar-right"> 
				  <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b><?php echo $row['name']; ?></b> <i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
	    </nav>

			<ul id="dropdown1" class="dropdown-content">
				<li><a href="profile.php"><i class="fa fa-user fa-fw"></i> My Profile</a>
				</li>
				<li><a href="profile_settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
				</li> 
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>

	        <nav class="navbar-default navbar-side" role="navigation">
	            <div class="sidebar-collapse">
	                <ul class="nav" id="main-menu">
	                    <li>
	                        <a href="dashboard.php" class="active-menu waves-effect waves-dark"><i class="fa fa-dashboard"></i> Dashboard</a>
	                    </li>
						<li>
	                        <a href="order.php" class="waves-effect waves-dark"><i class="fa fa-bar-chart-o"></i> Orders</a>
	                    </li>
	                    <li>
	                        <a href="all_product.php" class="waves-effect waves-dark"><i class="fa fa-table"></i> All Product</a>
	                    </li>
	                    <li>
	                        <a href="add_product.php" class="waves-effect waves-dark"><i class="fa fa-fw fa-file"></i> Add Product</a>
	                    </li>
	                    <li>
	                        <a href="edit_product.php" class="waves-effect waves-dark"><i class="fa fa-edit"></i> Edit Product</a>
	                    </li>
	                    <li>
	                        <a href="messages.php" class="waves-effect waves-dark"><i class="fa fa-envelope"></i> Messages</a>
	                    </li>
	                </ul>

	            </div>
	        </nav>
      
		<div id="page-wrapper">
		    <div class="header"> 
                <h1 class="page-header">
                    Dashboard
                </h1>
				<ol class="breadcrumb">
				  <li><a href="dashboard.php">Home</a></li>
				  <li><a href="dashboard.php">Dashboard</a></li>
				  <li class="active">Data</li>
				</ol>
									
			</div>
            <div id="page-inner">
				<div class="dashboard-cards"> 
	                <div class="row">
	                    <div class="col-xs-12 col-sm-6 col-md-3">
							<div class="card horizontal cardIcon waves-effect waves-dark">
								<div class="card-image purple">
								<i class="material-icons dp48">view_quilt</i>
								</div>
								<div class="card-stacked purple">
									<div class="card-content">
									<h3><?php echo $rowPr[0]; ?></h3> 
									</div>
									<div class="card-action">
										<strong>PRODUCTS</strong>
									</div>
								</div>
							</div>
	                    </div>
	                    <div class="col-xs-12 col-sm-6 col-md-3">
							<div class="card horizontal cardIcon waves-effect waves-dark">
								<div class="card-image orange">
								<i class="material-icons dp48">shopping_cart</i>
								</div>
								<div class="card-stacked orange">
									<div class="card-content">
									<h3><?php echo $rowO[0]; ?></h3> 
									</div>
									<div class="card-action">
										<strong>ORDERS</strong>
									</div>
								</div>
							</div> 
	                    </div>
	                    <div class="col-xs-12 col-sm-6 col-md-3">
							<div class="card horizontal cardIcon waves-effect waves-dark">
								<div class="card-image green">
									<i class="material-icons dp48">supervisor_account</i>
								</div>
								<div class="card-stacked green">
									<div class="card-content">
										<h3><?php echo $rowC[0]; ?></h3> 
									</div>
									<div class="card-action">
										<strong>CUSTOMERS</strong>
									</div>
								</div>
							</div> 
	                    </div>
	                    <div class="col-xs-12 col-sm-6 col-md-3">
							<div class="card horizontal cardIcon waves-effect waves-dark">
								<div class="card-image blue">
									<i class="material-icons dp48">equalizer</i>
								</div>
								<div class="card-stacked blue">
									<div class="card-content">
										<h3>24,225</h3> 
									</div>
								<div class="card-action">
									<strong>VISITORS</strong>
								</div>
								</div>
							</div> 
	                    </div>
	                </div>
				</div>
	        </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/materialize/js/materialize.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
    <script src="assets/js/custom-scripts.js"></script> 
 

</body>

</html>