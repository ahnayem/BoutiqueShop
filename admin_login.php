<?php
	include 'session.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

		$email = $_POST['email'];
		$password = $_POST['password'];

		include 'db.php';

		$query              = "SELECT * FROM admin";
        $stmt               = $db->prepare($query);
        $result             = $stmt->execute();
        $row                = $stmt->fetch();


        if ($email == $row['email'] && $password == $row['password']) { 
			$_SESSION['admin_id'] = $row['id'];
            header("Location: admin/dashboard.php");
        } else{
        	?><script type="text/javascript">alert("Credentials mismatch!");</script><?php
        	header("Location: admin_login.php");
        }
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Online Boutique Shop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4" style="color: #000;">
					<form method="get" action="search.php">
						<input type="text" name="search" class="input-block-level search-query" Placeholder="eg. Salwar Kamiz">
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">				
							<li><a href="profile.php">My Account</a></li>
							<li><a href="cart.php">Your Cart</a></li>
							<li><a href="checkout.php">Checkout</a></li>					
							<li><a href="register.php">Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="salwar_kamiz.php">Salwar Kamiz</a></li>
							<li><a href="hand_made.php">Hand Made</a></li>			
							<li><a href="jewelry.php">Jewelry</a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
				<img class="pageBanner" src="themes/images/carousel/banner-3.jpg" alt="Login" >
				<h2><span>ADMIN  <span style="color:#eb4800;">|</span>  LOGIN</span></h2>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span3"></div>
					<div class="span6">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form action="admin_login.php" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="email" placeholder="Enter your email" id="email" name="email" class="input-xlarge" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" id="password" name="password" class="input-xlarge" required>
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" name="login" value="Sign into your account">
								</div>
							</fieldset>
						</form>				
					</div>
					<div class="span3"></div>				
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="index.php">Homepage</a></li>  
							<li><a href="contact.php">Contac Us</a></li>
							<li><a href="register.php">Login</a></li>							
						</ul>					
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="profile.php">My Account</a></li>
							<li><a href="cart.php">Cart</a></li>
							<li><a href="checkout.php">Checkout</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<p>Online Boutique Shop is a differentiated last mile e-commerce solution which provides a platform for MSMEs to offer e-commerce, connection to brands, payments as microfinance, and last-mile fulfillment to the customers...</p>
						<br/>
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright 2021 - Boutique Shop  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>


