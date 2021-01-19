<?php 
	include 'session.php'; 

	include 'db.php';

    $pid  = $_REQUEST['pid'];

    $query              = "SELECT * FROM product WHERE id=:pid";
    $stmt               = $db->prepare($query);
    $stmt               -> bindValue(':pid',$pid, PDO::PARAM_STR);
    $result             = $stmt->execute();
    $row                = $stmt->fetch();


    //related product

    $cat = '';
    if ($row['category']=='Salwar Kamiz') {
    	$cat = 'Salwar Kamiz';
    } elseif ($row['category']=='Handmade') {
    	$cat = 'Handmade';
    } else {
    	$cat = 'Jewelry';
    }

    $queryRP              = "SELECT * FROM product WHERE category=:cat";
    $stmtRP               = $db->prepare($queryRP);
    $stmtRP               -> bindValue(':cat',$cat, PDO::PARAM_STR);
    $resultRP             = $stmtRP->execute();

    $i=0;

    $queryC              = "SELECT * FROM comment WHERE pid=:pid ORDER BY date DESC";
    $stmtC               = $db->prepare($queryC);
    $stmtC               -> bindValue(':pid',$pid, PDO::PARAM_STR);
    $resultC             = $stmtC->execute();


    //add to cart

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addtocart'])){


    	if (!isset($_SESSION['user_id'])) {
    		echo '<script type="text/javascript">alert("You are not logged in.");</script>';
    		?><script type="text/javascript">location.href = 'register.php' ?>;</script><?php
	    } else{

	    	$uid  = $_SESSION['user_id'];
	        $qty = $_POST['qty'];
	        $color = $_POST['color'];
	        $size = $_POST['size'];
	        $pid = $_POST['pid'];
	        $name = $_POST['name'];
	        $photo = $_POST['photo'];
	        $price = $_POST['price']*$qty;


	        $qr 	  = "INSERT INTO cart(uid, pid, name, qty, price, color, size, photo) 
	        			VALUES(:uid, :pid, :name, :qty, :price, :color, :size, :photo)";
	        			
	    	$st 	  = $db->prepare($qr);

	        $st     -> bindValue(':uid',$uid,PDO::PARAM_STR);
	        $st     -> bindValue(':pid',$pid,PDO::PARAM_STR);
	        $st     -> bindValue(':name',$name,PDO::PARAM_STR);
	        $st     -> bindValue(':qty',$qty,PDO::PARAM_STR);
	        $st     -> bindValue(':price',$price,PDO::PARAM_STR);
	        $st     -> bindValue(':color',$color,PDO::PARAM_STR);
	        $st     -> bindValue(':size',$size,PDO::PARAM_STR);
	        $st     -> bindValue(':photo',$photo,PDO::PARAM_STR);

	    	$re   = $st->execute();

	    	if ($re) {
	    		echo '<script type="text/javascript">alert("Added to cart.");</script>';
	    		?><script type="text/javascript">location.href = 'cart.php' ?>;</script><?php
	    	}else{
	    		echo '<script type="text/javascript">alert("Oops! something went wrong.");</script>';
	    		header('location: product_details.php?pid='.$pid);
	    	}
	    }
    }


    // comment
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])){

    	if (!isset($_SESSION['user_id'])) {
    		echo '<script type="text/javascript">alert("You are not logged in.");</script>';
    		?><script type="text/javascript">location.href = 'register.php' ?>;</script><?php
	    } else{
	    	$cuid  = $_SESSION['user_id'];
	        $comnt = $_POST['comnt'];
	        $pid = $_POST['pid'];

	        $q              = "SELECT * FROM user WHERE id = :cuid";
	        $s              = $db->prepare($q);
	        $s              -> bindValue(':cuid',$cuid, PDO::PARAM_STR);
	        $r              = $s->execute();
	        $r              = $s->fetch();

	        $cname = $r['name'];

	        $qr 	  = "INSERT INTO comment(pid, name, comment) 
	        			VALUES(:pid, :name, :comnt)";
	        			
	    	$st 	  = $db->prepare($qr);

	        $st     -> bindValue(':pid',$pid,PDO::PARAM_STR);
	        $st     -> bindValue(':name',$cname,PDO::PARAM_STR);
	        $st     -> bindValue(':comnt',$comnt,PDO::PARAM_STR);
	        $re     = $st->execute();

	        if ($re) {
	    		echo '<script type="text/javascript">alert("Comment added.");</script>';
	    		header('location: product_details.php?pid='.$pid);
	    	}else{
	    		header('location: product_details.php?pid='.$pid);
	    	}


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
				<br>
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">						
					<div class="span12">
						<div class="row">
							<div class="span4">
								<a href="admin/assets/product-image/<?php echo $row['photo'];?>" class="thumbnail" data-fancybox-group="group1"><img alt="" src="admin/assets/product-image/<?php echo $row['photo'];?>"></a>
								<br>
							</div>
							<div class="span8">
								<address>
									<strong>Product Name:</strong> <span><?php echo $row['name'];?></span><br>
									<strong>Category:</strong> <span><?php echo $row['category'];?></span><br>
									<strong>Availability:</strong> <span>In Stock</span><br>								
								</address>									
								<h4><strong>Price: ৳ <?php echo $row['price'];?></strong></h4>
							</div>
							<div class="span5">
								<form class="form-inline" action="product_details.php" method="POST">
									<input type="hidden" name="pid" value="<?php echo $pid;?>">
									<input type="hidden" name="photo" value="<?php echo $row['photo'];?>">
									<input type="hidden" name="name" value="<?php echo $row['name'];?>"><input type="hidden" name="price" value="<?php echo $row['price'];?>">
									<p>&nbsp;</p>
									<label>Qty:</label>
									<input type="text" class="span1" name="qty" value="1"><br><br>

									<label for="color">Choose Color:</label>
									<select name="color" id="color" style="display: block;">
									  <option value="Pink">Pink</option>
									  <option value="Green">Green</option>
									  <option value="Red">Red</option>
									</select><br>

									<label for="size">Choose Size:</label>
									<select name="size" id="size" style="display: block;">
									  <option value="M">M</option>
									  <option value="L">L</option>
									  <option value="X">X</option>
									</select><br>
									<button class="btn btn-inverse" name="addtocart" type="submit">Add to cart</button>
								</form>
							</div>							
						</div>
						<div class="row">
							<div class="span12">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Description</a></li>
									
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" id="home">
										<p><?php echo $row['description'];?></p>
									</div>
								</div>							
							</div>
							<div class="span12">	
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-1" class="carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails listing-products">
												<?php while($rowRP  = $stmtRP->fetch()){ ?>		
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $rowRP['id'];?>"><img src="admin/assets/product-image/<?php echo $rowRP['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $rowRP['id'];?>" class="title"><?php echo $rowRP['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $rowRP['id'];?>" class="category"><?php echo $rowRP['category'];?></a>
														<p class="price">৳ <?php echo $rowRP['price'];?></p>
													</div>
												</li>
												<?php if($i++==3){ break;} }  $i=0; ?>
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails listing-products">
												<?php while($rowRP  = $stmtRP->fetch()){ ?>		
												<li class="span3">
													<div class="product-box">
														<span class="sale_tag"></span>
														<p><a href="product_details.php?pid=<?php echo $rowRP['id'];?>"><img src="admin/assets/product-image/<?php echo $rowRP['photo'];?>" alt="" /></a></p>
														<a href="product_details.php?pid=<?php echo $rowRP['id'];?>" class="title"><?php echo $rowRP['name'];?></a><br/>
														<a href="product_details.php?pid=<?php echo $row['id'];?>" class="category"><?php echo $rowRP['category'];?></a>
														<p class="price">৳ <?php echo $rowRP['price'];?></p>
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
			<section class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<form action="product_details.php" method="POST">
								<h4 class="title"><span class="pull-left"><span class="text"><span class="line"><strong>Post Review</strong></span></span></span></h4>
								<div class="control-group"  style="margin-left: 15px;margin-right: 15px">
									<input type="hidden" name="pid" value="<?php echo $pid;?>">
									<div class="controls">
										<textarea rows="3" id="textarea" name="comnt" class="span12"></textarea>
									</div>
									<div class="controls">
										<button type="submit" name="comment" class="btn btn-inverse pull-right">Comment</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
			<section class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<h4 class="title"><span class="pull-left"><span class="text"><span class="line"><strong>All Review</strong></span></span></span></h4>
					<?php while($rowC  = $stmtC->fetch()){ $date = strtotime($rowC['date']); ?>
						<div style="margin-left: 15px;margin-right: 15px">
							<h4><?php echo $rowC['name'];?><span style="font-size: 10px;margin-left: 10px"> (<?php echo date('d/m/Y', $date); ?>)</span></h4>
							<p style="margin-left: 20px; margin-right: 20px; text-align: justify;"><?php echo $rowC['comment'];?></p><hr>
						</div>
					<?php }  ?>
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