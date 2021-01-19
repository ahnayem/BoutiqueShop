<?php 
	include 'session.php';

	if (!isset($_SESSION['admin_id'])) {
            header('location: ../admin_login.php');
    } else{
    	$id            		= $_SESSION['admin_id'];

    	include 'db.php';

        $query              = "SELECT * FROM admin WHERE id = :admin_id";
        $stmt               = $db->prepare($query);
        $stmt               -> bindValue(':admin_id',$id, PDO::PARAM_STR);
        $result             = $stmt->execute();
        $row                = $stmt->fetch();

        $timestamp = strtotime($row['date']);
    }
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Profile</title> 
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
				  <li><a class="dropdown-button waves-effect waves-dark" href="#!" data-activates="dropdown1"><i class="fa fa-user fa-fw"></i> <b>John Doe</b> <i class="material-icons right">arrow_drop_down</i></a></li>
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
	                        <a href="dashboard.php" class="waves-effect waves-dark"><i class="fa fa-dashboard"></i> Dashboard</a>
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
                    Profile
                </h1>
				<ol class="breadcrumb">
				  <li><a href="dashboard.php">Home</a></li>
				  <li><a href="profile.php">Profile</a></li>
				  <li class="active">Info</li>
				</ol>
									
			</div>
            <div id="page-inner">
				<div class="row">
	                <div class="col-md-12">
                         <div class="row">
                         	<div class="col-md-6 col-sm-4">
		                        <div class="card blue-grey darken-1">
									<div class="card-content white-text">
								  		<p><STRONG>Name:</STRONG> <?php echo $row['name']; ?></p>
			                         	<p><STRONG>Email:</STRONG> <?php echo $row['email']; ?></p>
			                         	<p><STRONG>Phone:</STRONG> <?php echo $row['phone']; ?></p>
			                         	<p><STRONG>City:</STRONG> <?php echo $row['city']; ?></p>
									</div>
							  </div>
                			</div>
                         	<div class="col-md-4 col-sm-4">
		                    <div class="card">
								<div class="card-image waves-effect waves-block waves-light">
								  <img class="activator" src="assets/img/<?php echo $row['photo']; ?>">
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