<?php 
	include 'session.php';

	if (!isset($_SESSION['admin_id'])) {
            header('location: ../admin_login.php');
    } else{

    	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])){

    		include 'db.php';

			$name = $_POST['product_name'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$category = $_POST['category'];
			
			$tmp_image                  = $_FILES["image"]["tmp_name"];
        	$image                      = $_FILES["image"]["name"];


	    	//image upload
	    	$target_dir  = "assets/product-image/";
            $target_file = $target_dir . basename($image);
            $target_file = bin2hex(random_bytes(8));
            $target_file = hash_hmac('sha256', $target_file, 'boutiqueshop');
            
            $uploadOk    = 1;

            $imageFileType  = pathinfo($target_file,PATHINFO_EXTENSION);
            $check          = getimagesize($tmp_image);

            if($check !== false) {
                $uploadOk = 1;
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                
                } else {
                    $uploadOk = 1;
                    $extension      = 'jpg';

                    $prod           = $target_file;
                    $newfilename    = $prod .".".$extension;

                    move_uploaded_file($tmp_image, $target_dir.$newfilename);

                }
            }

            //insert into database
            $query 	  = "INSERT INTO product(name, description, price, category, photo) 
	        			VALUES(:name, :description, :price, :category, :photo)";
	        			
	    	$stmt 	  = $db->prepare($query);

	        $stmt     -> bindValue(':name',$name,PDO::PARAM_STR);
	        $stmt     -> bindValue(':description',$description,PDO::PARAM_STR);
	        $stmt     -> bindValue(':price',$price,PDO::PARAM_STR);
	        $stmt     -> bindValue(':category',$category,PDO::PARAM_STR);
	        $stmt     -> bindValue(':photo',$newfilename,PDO::PARAM_STR);

	    	$result   = $stmt->execute();

	    	if ($result) {
	    		?><script type="text/javascript">alert("Product Added successfully.");</script><?php
	    	}else{
	    		?><script type="text/javascript">alert("Oops! something went wrong.");</script><?php
	    	}

		}
    }
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Add Product</title> 
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
	                        <a href="all_product.php" class="waves-effect waves-dark"><i class="fa fa-table"></i> All Product</a>
	                    </li>
	                    <li>
	                        <a href="add_product.php" class="active-menu waves-effect waves-dark"><i class="fa fa-fw fa-file"></i> Add Product</a>
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

        <div id="page-wrapper" >
		  	<div class="header"> 
                <h1 class="page-header">
                    Add Product
                </h1>
				<ol class="breadcrumb">
				  <li><a href="dashboard.php">Home</a></li>
				  <li><a href="all_product.php">Product</a></li>
				  <li class="active">Add</li>
				</ol>
			</div>
		
            <div id="page-inner"> 
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="card">
                        	<div class="card-content"><br>
                        		<form action="" method="POST" enctype="multipart/form-data">
									<div class="row">
									<div class="input-field col s12">
									  <input id="product_name" name="product_name" type="text" class="validate" required>
									  <label for="product_name" class="">Product Name</label>
									</div>
									</div>

									<div class="row">
									<div class="input-field col s12">
									   <textarea id="textarea" name="description" class="validate materialize-textarea" required></textarea>
											<label for="textarea">Description</label>
									</div>
									</div>

									<div class="row">
									<div class="input-field col s12">
									  <input id="price" name="price" type="text" class="validate" required>
									  <label for="price" class="">Price</label>
									</div>
									</div><br>

									<div class="row">
										<div class=" col s3" required>
										 	 <label for="category">Choose a Category:</label>
											<select name="category" id="category" style="display: block;">
											  <option value="Salwar Kamiz">Salwar Kamiz</option>
											  <option value="Handmade">Handmade</option>
											  <option value="Jewelry">Jewelry</option>
											</select>
										</div>
									</div><br>

									<div class="row">
									<div class="input-field col s12">
										<label for="file">Upload Product Photo:</label><br><br>
									    <input id="file" name="image" type="file" required>
									</div>
									</div><br>

									<div class="row">
									<div class="input-field col s12">
									  <button type="submit" name="add" class="waves-effect waves-light btn">Add Product</button>
									</div>
									</div>
								</form>
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
	<script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/custom-scripts.js"></script> 
 

</body>

</html>
