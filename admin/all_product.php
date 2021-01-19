<?php 
	include 'session.php';

	if (!isset($_SESSION['admin_id'])) {
            header('location: ../admin_login.php');
    } else{
    	$id            		= $_SESSION['admin_id'];

    	include 'db.php';

        $query              = "SELECT * FROM product";
        $stmt               = $db->prepare($query);
        $result             = $stmt->execute();

        $i=0;
    }

    if (isset($_POST['delete'])){

    	include 'db.php';

    	$pid = $_POST['pid'];

    	$query              = "DELETE FROM product WHERE id=:pid";
        $stmt               = $db->prepare($query);
        $stmt               -> bindValue(':pid',$pid, PDO::PARAM_STR);
        $result             = $stmt->execute();

        if ($result) {
    		?><script type="text/javascript">alert("Product deleted.");</script><?php
    		header("Refresh:0");
    	}else{
    		?><script type="text/javascript">alert("Oops! something went wrong.");</script><?php
    	}

    }
 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | All Product</title> 
	<link href="assets/materialize/css/material-icon.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/materialize/css/materialize.min.css" media="screen,projection" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='assets/css/google-font.css' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="assets/js/Lightweight-Chart/cssCharts.css">

    <style type="text/css">
    	.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
			    text-align: center!important;
			}
    </style> 
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
	                        <a href="all_product.php" class="active-menu waves-effect waves-dark"><i class="fa fa-table"></i> All Product</a>
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
                    All Product
                </h1>
				<ol class="breadcrumb">
				  <li><a href="dashboard.php">Home</a></li>
				  <li><a href="all_product.php">Product</a></li>
				  <li class="active">List</li>
				</ol>
			</div>
            <div id="page-inner">
				<div class="dashboard-cards"> 
	                <div class="row">
		                <div class="col-md-12">
		                    <div class="card">
		                        <div class="card-content">
		                            <div class="table-responsive">
		                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		                                    <thead>
		                                        <tr>
		                                            <th>SL</th>
		                                            <th>Name</th>
		                                            <th>Category</th>
		                                            <th>Price</th>
		                                            <th>Action</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    	<?php 

		                                    		while($row  = $stmt->fetch()){ $i++; ?>
		                                    		<tr class="<?php echo ($i%2==0) ? "even" : "odd"?>">
		                                    			<td><?php echo $i; ?></td>
			                                            <td><?php echo $row['name']; ?></td>
			                                            <td><?php echo $row['category']; ?></td>
			                                            <td><?php echo $row['price']; ?></td>
			                                            <td class="center">
			                                            	<form action="all_product.php" method="POST">
																<div class="card-image">
																	<input name='pid' type='hidden' value="<?php echo $row['id']; ?>">
																	<button class="btn badge red" type="submit" name="delete"><i class="material-icons dp48">delete</i></button>
																	<a href="edit_product.php?pid=<?php echo $row['id']; ?>"><span class="new badge" data-badge-caption=""><i class="material-icons dp48">mode_edit</i></span></a>
																</div>
															</form>
			                                            </td>
			                                        </tr>

		                                    		<?php } ?>
		                                    </tbody>
		                                </table>
		                            </div>
		                            
		                        </div>
		                    </div>
		                    <!--End Advanced Tables -->
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
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script src="assets/js/custom-scripts.js"></script> 
 

</body>

</html>