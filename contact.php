<?php
	 include 'session.php';

	 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['msg'])){


    	include 'db.php';

	        $name = $_POST['name'];
	        $email = $_POST['email'];
	        $message = $_POST['message'];
	        

	        $qr 	  = "INSERT INTO message(name, email, message) 
	        			VALUES(:name, :email, :message)";
	        			
	    	$st 	  = $db->prepare($qr);

	        $st     -> bindValue(':name',$name,PDO::PARAM_STR);
	        $st     -> bindValue(':email',$email,PDO::PARAM_STR);
	        $st     -> bindValue(':message',$message,PDO::PARAM_STR);

	    	$re   = $st->execute();

	    	if ($re) {
	    		echo '<script type="text/javascript">alert("Message sent.");</script>';
	    	}else{
	    		echo '<script type="text/javascript">alert("Oops! something went wrong.");</script>';
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
							<?php 
								if (session_status()==0) {
									echo '<li><a href="logout.php">Logout</a></li>';
								} else {
									echo '<li><a href="register.php">Login</a></li>';
								}
							 ?>		
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
		<div class="container">
			<section class="header_text sub">
				<h4><span>Contact Us</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">				
					<div class="span5">
						<div style="text-align: center;">
							<h5>ADDITIONAL INFORMATION</h5>
							<p><strong>Phone:</strong>&nbsp;(123) 456-7890<br>
							<strong>Fax:</strong>&nbsp;+04 (123) 456-7890<br>
							<strong>Email:</strong>&nbsp;<a href="#">info@boutiqueshp.com</a>								
							</p>
							<br/>
							<h5>SECONDARY OFFICE IN Dhaka</h5>
							<p><strong>Phone:</strong>&nbsp;(113) 023-1125<br>
							<strong>Fax:</strong>&nbsp;+04 (113) 023-1145<br>
							<strong>Email:</strong>&nbsp;<a href="#">info2@boutiqueshp.com</a>					
							</p>
						</div>
					</div>
					<div class="span7">
						<div style="margin-left: 100px;">
							<p>Feel free to send your query and share your opinion with us.</p>
							<form method="post" action="contact.php">
								<fieldset>
									<div class="clearfix">
										<label for="name"><span>Name:</span></label>
										<div class="input">
											<input tabindex="1" size="18" id="name" name="name" type="text" value="" class="input-xlarge" placeholder="Name">
										</div>
									</div>
									
									<div class="clearfix">
										<label for="email"><span>Email:</span></label>
										<div class="input">
											<input tabindex="2" size="25" id="email" name="email" type="text" value="" class="input-xlarge" placeholder="Email Address">
										</div>
									</div>
									
									<div class="clearfix">
										<label for="message"><span>Message:</span></label>
										<div class="input">
											<textarea tabindex="3" class="input-xlarge" id="message" name="message" rows="7" placeholder="Message"></textarea>
										</div>
									</div>
									
									<div class="actions">
										<button tabindex="3" name="msg" type="submit" class="btn btn-inverse">Send message</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>				
				</div>
			</section>
		<section class="google_map">
			<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Rajshahi%20city,%20Bangladesh+(Boutique%20Shop)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
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
		</script>
    </body>
</html>