<?php 
	include 'session.php'; 

	include 'db.php';

    $query              = "SELECT * FROM product WHERE category='Salwar Kamiz'";
    $stmt               = $db->prepare($query);
    $result             = $stmt->execute();

    $i=0;


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
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/banner-1.jpg" alt="" />
						</li>
						<li>
							<img src="themes/images/carousel/banner-2.jpg" alt="" />
							<div class="intro">
								<h1>Mid season sale</h1>
								<p><span>Up to 50% Off</span></p>
								<p><span>On selected items online and in stores</span></p>
							</div>
						</li>
					</ul>
				</div>			
			</section>
			<section class="header_text">
				We deliver for top quality Boutique. Original and New Design.
				<br/>Don't miss to by our new discount products.
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">													
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line"><strong>Feature </strong>Products</span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">									<?php while($row  = $stmt->fetch()){?>			
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $row['id'];?>"><img src="admin/assets/product-image/<?php echo $row['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="title"><?php echo $row['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="category"><?php echo $row['category'];?></a>
														<p class="price">৳ <?php echo $row['price'];?></p>
													</div>
												</li>
												<?php if($i++==3){ break;} }  $i=0;?>
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails">
												<?php while($row  = $stmt->fetch()){ ?>			
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $row['id'];?>"><img src="admin/assets/product-image/<?php echo $row['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="title"><?php echo $row['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="category"><?php echo $row['category'];?></a>
														<p class="price">৳ <?php echo $row['price'];?></p>
													</div>
												</li>
												<?php if($i++==3){ break;} }  $i=0; ?>
											</ul>
										</div>
									</div>							
								</div>
							</div>						
						</div>
						<br/>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line"><strong>Latest </strong>Products</span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-2" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">									<?php while($row  = $stmt->fetch()){ ?>			
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $row['id'];?>"><img src="admin/assets/product-image/<?php echo $row['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="title"><?php echo $row['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="category"><?php echo $row['category'];?></a>
														<p class="price">৳ <?php echo $row['price'];?></p>
													</div>
												</li>
												<?php if($i++==3){ break;} }  $i=0; ?>
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails">
												<?php while($row  = $stmt->fetch()){ ?>			
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $row['id'];?>"><img src="admin/assets/product-image/<?php echo $row['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="title"><?php echo $row['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="category"><?php echo $row['category'];?></a>
														<p class="price">৳ <?php echo $row['price'];?></p>
													</div>
												</li>
												<?php if($i++==3){ break;} }  $i=0; ?>
											</ul>
										</div>
									</div>							
								</div>
							</div>						
						</div>
					</div>
				</div>
			</section>
			<section class="our_client">
				<h4 class="title"><span class="text"><strong>Services</strong></span></h4>
				<div class="row feature_box">						
					<div class="span4">
						<div class="service">
							<div class="responsive">	
								<img src="themes/images/feature_img_2.png" alt="" />
								<h4>MODERN <strong>DESIGN</strong></h4>								
							</div>
						</div>
					</div>
					<div class="span4">	
						<div class="service">
							<div class="customize">			
								<img src="themes/images/feature_img_1.png" alt="" />
								<h4>FREE <strong>SHIPPING</strong></h4>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="service">
							<div class="support">	
								<img src="themes/images/feature_img_3.png" alt="" />
								<h4>24/7 LIVE <strong>SUPPORT</strong></h4>
							</div>
						</div>
					</div>	
				</div>		
			</section>
			<section class="our_client">
				<h4 class="title"><span class="text"><strong>Manufactures</strong></span></h4>
				<div class="row">
				
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/3.png"></a>
					</div>
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/4.png"></a>
					</div>					
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/14.png"></a>
					</div>
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/35.png"></a>
					</div>
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/1.png"></a>
					</div>
					<div class="span2">
						<a href="#"><img alt="" src="themes/images/clients/2.png"></a>
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
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container"
					});
				});
			});
		</script>
    </body>
</html>