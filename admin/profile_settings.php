<?php 
	include 'session.php';

	if (!isset($_SESSION['admin_id'])) {
            header('location: ../admin_login.php');
    } else{
    	$id            		= $_SESSION['admin_id'];

    	include 'db.php';

        $query1              = "SELECT * FROM admin WHERE id = :admin_id";
        $stmt1               = $db->prepare($query1);
        $stmt1               -> bindValue(':admin_id',$id, PDO::PARAM_STR);
        $result1             = $stmt1->execute();
        $row1                = $stmt1->fetch();

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])){
    	include 'db.php';

        $name  = $_POST['name'];
        $email  = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];

        $query      = "UPDATE admin SET 
                            name       = :name,
                            email       = :email,
                            password   = :password,
                            phone      = :phone,
                            city 	   = :city


                            WHERE id   = :id
                        ";
        $stmt       = $db->prepare($query);
        $stmt       -> bindValue(':name',$name,PDO::PARAM_STR);
        $stmt       -> bindValue(':email',$email,PDO::PARAM_STR);
        $stmt       -> bindValue(':password',$password,PDO::PARAM_STR);
        $stmt       -> bindValue(':phone',$phone,PDO::PARAM_STR);
        $stmt       -> bindValue(':city',$city,PDO::PARAM_STR);
        $stmt       -> bindValue(':id',$id,PDO::PARAM_STR);
        $result     = $stmt->execute();

        if ($result) {
            ?><script type="text/javascript">alert("Info update successfully");</script><?php
            header('location: profile.php');
        } else{
        	?><script type="text/javascript">alert("Oops! Something went wrong");</script><?php
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])){
    	include 'db.php';

    	$id          = $_SESSION['admin_id'];

        $tmp_image   = $_FILES["image"]["tmp_name"];
    	$image       = $_FILES["image"]["name"];


    	//image upload
    	$target_dir  = "assets/img/";
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

                if(!move_uploaded_file($tmp_image, $target_dir.$newfilename)){
                	echo " <script >alert('not moved')</script>";
                }

            }
        }

	    $query      = "UPDATE admin SET 
	                        photo       = :photo
	                        WHERE id   = :id
	                    ";
	    $stmt       = $db->prepare($query);
	    $stmt       -> bindValue(':photo',$newfilename,PDO::PARAM_STR);
	    $stmt       -> bindValue(':id',$id,PDO::PARAM_STR);
	    $result     = $stmt->execute();

	    if ($result) {
	        ?><script type="text/javascript">alert("Info update successfully");</script><?php
	        header('location: profile.php');
	    } else{
	    	?><script type="text/javascript">alert("Something went wrong");</script><?php
	    }
    }
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Profile Edit</title> 
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
				  <li class="active">Edit</li>
				</ol>
			</div>
            <div id="page-inner">
				<div class="row">
	                <div class="col-lg-6">
	                    <div class="card">
	                        <div class="card-action">
	                         	<form action="" method="POST">
									<div class="row">
										<div class="input-field col s12">
										  <input placeholder="Name" type="text" name="name" class="validate" value="<?php echo $row1['name']; ?>" required>
										</div>
									</div>
										
									 <div class="row">
										<div class="input-field col s12">
										  <input id="email" placeholder="Email" value="<?php echo $row1['email']; ?>" type="email" name="email" class="validate" required>
										</div>
									 </div>
										
									 <div class="row">
										<div class="input-field col s12">
										  <input id="password" placeholder="New password" value="" type="password" name="password" class="validate" required>
										</div>
									 </div>

									 <div class="row">
										<div class="input-field col s12">
										  <input placeholder="Phone"  value="<?php echo $row1['phone']; ?>" name="phone" type="text" class="validate" required>
										</div>
									</div>

									<div class="row">
										<div class="input-field col s12">
										  <input placeholder="City"  value="<?php echo $row1['city']; ?>" name="city" type="text" class="validate" required>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s12">
									  		<button type="submit" name="edit" class="waves-effect waves-light btn">Edit Profile</button>
										</div>
								  	</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-4 col-sm-4">
						<div class="row">
							<div class="card">
		                    	<div class="card-image waves-effect waves-block waves-light">
								   <img class="activator" src="assets/img/<?php echo $row1['photo']; ?>">
								</div>
		                    </div>
		                </div>

		                <div class="row">
		                	<form action="" method="post" enctype="multipart/form-data">
								<div class="row" style="align-items: center;">
									<div class="input-field col s12">
								  		<input type="file" name="image">
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
								  		<button type="submit" name="upload" class="waves-effect waves-light btn">Change Photo</button>
									</div>
								</div>
							</form>
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