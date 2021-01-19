<?php 
	include 'session.php';

	if (!isset($_SESSION['user_id'])) {
            header('location: register.php');
    } else{
    	$id            		= $_SESSION['user_id'];

    	include 'db.php';

    	$query              = "SELECT * FROM cart WHERE uid=:id ORDER BY date DESC";
	    $stmt               = $db->prepare($query);
	    $stmt               -> bindValue(':id',$id, PDO::PARAM_STR);
	    $result             = $stmt->execute();

        $i=0; $sum=0;
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
			<section class="header_text sub">
				<h4><span>SHOPPING CART</span></h4>
			</section>
			<section class="main-content">				
				<div class="row">
					<div class="span12">					
						<h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>SL</th>
									<th>Image</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Color</th>
									<th>Size</th>
									<th>Total Price</th>
								</tr>
							</thead>
							<tbody>
								<?php while($row  = $stmt->fetch()){ $i++; ?>				
								<tr>
									<td><?php echo $i; ?></i></td>
									<td><img alt="" src="admin/assets/product-image/<?php echo $row['photo'];?>" width="100" height="100"></td>
									<td><?php echo $row['name'];?></td>
									<td><?php echo $row['qty'];?></td>
									<td><?php echo $row['color'];?></td>
									<td><?php echo $row['size'];?></td>
									<td><?php echo $row['price'];?></td>
								</tr>
								<?php $sum=$sum+$row['price'];} ?>			  
							</tbody>
						</table>
						<hr/>
						<div style="margin-left: 20px;margin-right: 40px">
							<h4>Total Details including VAT & TAX:</h4>
							<p class="cart-total right">
								<strong>Sub-Total</strong>: <?php echo $sum;?> Tk<br>
								<strong>Shipping Cost</strong>: <?php echo $sum=($sum+100);?> Tk<br>
								<strong>Servicec Charge</strong>: <?php echo $total=($sum+20);?> Tk<br>
								<strong>Total</strong>: <?php echo $total;?> Tk<br>
							</p>
							<hr/>
						</div>
						<form action="checkout.php" method="post">
						<p class="buttons center">				
							<a href="index.php" class="btn">Continue Shopping</a>
							<button class="btn btn-inverse" type="submit" name="checkout" id="checkout">Checkout</button>
						</p>
						</form>					
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
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>		
    </body>
</html>