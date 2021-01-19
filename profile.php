<?php 
	include 'session.php';

	if (!isset($_SESSION['user_id'])) {
            header('location: register.php');
    } else{
    	$id            		= $_SESSION['user_id'];

    	include 'db.php';

        $query              = "SELECT * FROM user WHERE id = :user_id";
        $stmt               = $db->prepare($query);
        $stmt               -> bindValue(':user_id',$id, PDO::PARAM_STR);
        $result             = $stmt->execute();
        $row                = $stmt->fetch();

        $timestamp = strtotime($row['date']);
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
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>
				
		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="themes/js/jquery.fancybox.js"></script>
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
							<li><a href="logout.php">Logout</a></li>		
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
			
			<section class="main-content">
				<div class="row">
					<div class="span12">													
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line"><strong>Profile</strong> Details</span></span></span>
								</h4>
							</div>						
						</div>
					</div>
				</div>
			</section>
			<br>
			<section class="main-content">				
				<div class="row">						
					<div class="span12">
						<div class="row">
							<div class="span1"></div>
							<div class="span3" style="font-size: 17px">
								<address>
									<strong>Name:</strong> <span><?php echo $row['name']; ?></span><br>
									<strong>Email:</strong> <span> <?php echo $row['email']; ?></span><br>
									<strong>Phone:</strong> <span> <?php echo $row['phone']; ?></span><br>
									<strong>City:</strong> <span> <?php echo $row['city']; ?></span><br>
									<strong>Member From:</strong> <span> <?php echo date('d M Y', $timestamp); ?></span><br>
								</address>									
							</div>
							<div class="span4">
								<a href="images/profile-photo/<?php echo $row['photo']; ?>" class="thumbnail" data-fancybox-group="group1"><img alt="" src="images/profile-photo/<?php echo $row['photo']; ?>"></a>
							</div>
							<div class="span1"></div>
							<div class="span3">
								<div class="block">
									<span><h4>Profile Settings</h4></span>	
									<ul class="nav nav-list">
										<li><a href="profile_edit.php">EDIT PROFILE</a></li>
										<li><a href="order_history.php">ORDER HISTORY</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
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
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});
				
				$('#myCarousel-2').carousel({
                    interval: 2500
                });								
			});
		</script>
    </body>
</html>