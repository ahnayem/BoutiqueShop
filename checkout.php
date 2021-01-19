<?php 
	include 'session.php';

	if (!isset($_SESSION['user_id'])) {
            header('location: register.php');

    } else{

    	include 'db.php';

    	$id            		= $_SESSION['user_id'];

    	$query1              = "SELECT * FROM cart WHERE uid=:id";
	    $stmt1               = $db->prepare($query1);
	    $stmt1               -> bindValue(':id',$id, PDO::PARAM_STR);
	    $result1             = $stmt1->execute();
	    $row1				 = $stmt1->fetch();

    	if (!$row1) {
    		echo '<script type="text/javascript">alert("You have no cart item.");</script>';
    		?><script type="text/javascript">location.href = 'index.php' ?>;</script><?php
    	}

    	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])){

    		$id            		= $_SESSION['user_id'];

    		include 'db.php';

    		$query1              = "SELECT * FROM cart WHERE uid=:id";
		    $stmt1               = $db->prepare($query1);
		    $stmt1               -> bindValue(':id',$id, PDO::PARAM_STR);
		    $result1             = $stmt1->execute();
		    $row1				 = $stmt1->fetch();

	    	if (!$row1) {
	    		echo '<script type="text/javascript">alert("You have no cart item.");</script>';
	    		?><script type="text/javascript">location.href = 'index.php' ?>;</script><?php
	    	} else{
	    		
	    		// fetch cart info
    		$query              = "SELECT * FROM cart WHERE uid=:id";
		    $stmt               = $db->prepare($query);
		    $stmt               -> bindValue(':id',$id, PDO::PARAM_STR);
		    $result             = $stmt->execute();

		    $products = ''; $sum=0;
		    while ($row  = $stmt->fetch()) {
	        	$products = $products . ' -' .$row['name']. ' /  Color: ' .$row['color']. ' /  Size: ' .$row['size']. ' /  Qty: ' .$row['qty']. '<br>';
	        	$sum =$sum+$row['price'];
	        }

	        $price = $sum + 120;

		    // fetch user info
    		$queryU              = "SELECT * FROM user WHERE id=:id";
		    $stmtU               = $db->prepare($queryU);
		    $stmtU               -> bindValue(':id',$id, PDO::PARAM_STR);
		    $resultU             = $stmtU->execute();
		    $rowU 				 = $stmtU->fetch();


	    	// add to order list
	    	$name  = $rowU['name'];
	        $shipping = $_POST['shipping'];
	        $phone = $_POST['phone'];
	        $payment = $_POST['payment'];
	        $txn = $_POST['txn'];

	        $uid = $id;

	        $qr 	  = "INSERT INTO orders( uid, name, shipping, phone, payment, txn, products, price) 
	        			VALUES(:uid, :name, :shipping, :phone, :payment, :txn, :products, :price)";
	        			
	    	$st 	  = $db->prepare($qr);

	        $st     -> bindValue(':uid',$uid,PDO::PARAM_STR);
	        $st     -> bindValue(':name',$name,PDO::PARAM_STR);
	        $st     -> bindValue(':shipping',$shipping,PDO::PARAM_STR);
	        $st     -> bindValue(':phone',$phone,PDO::PARAM_STR);
	        $st     -> bindValue(':payment',$payment,PDO::PARAM_STR);
	        $st     -> bindValue(':txn',$txn,PDO::PARAM_STR);
	        $st     -> bindValue(':products',$products,PDO::PARAM_STR);
	        $st     -> bindValue(':price',$price,PDO::PARAM_STR);
	        $re     = $st->execute();

	        if ($re) {
	    		echo '<script type="text/javascript">alert("Order confirmed.");</script>';

	    		$queryC              = "DELETE FROM cart WHERE uid=:id";
			    $stmtC               = $db->prepare($queryC);
			    $stmtC               -> bindValue(':id',$id, PDO::PARAM_STR);
			    $resultC             = $stmtC->execute();

	    		header('location: order_history.php');
	    	}else{
	    		echo '<script type="text/javascript">alert("Oops! something went wrong.");</script>';
	    	}
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
				<h4><span>Check Out</span></h4>
			</section>	
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Account &amp; Billing Details</a>
								</div>
								<div id="collapseOne" class="accordion-body in collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span4"></div>
											<div class="span4">
												<form action="" method="post">
												<h4>Your Shipping Address</h4>
												<div class="control-group">
													<label class="control-label"><span class="required">*</span>Courier Service Point Adress:</label>
													<div class="controls">
														<textarea rows="3" id="textarea" class="input-xlarge" name="shipping" required></textarea>
													</div>
												</div>

												<div class="control-group">
													<label class="control-label">Contact No.</label>
													<div class="controls">
														<input type="text" name="phone" placeholder="" class="input-xlarge" name="phone" required>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label"><span class="required">*</span> Choose Payement Option:</label>
													<div class="controls">
														<select class="input-xlarge" name="payment" required>
															<option value=""> --- Please Select --- </option>
															<option value="Bkash">Bkash</option>
															<option value="Rocket">Rocket</option>
															<option value="Nagad">Nagad</option>
														</select>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label"><span class="required">*</span> Transaction ID:</label>
													<div class="controls">
														<input type="text" name="txn" placeholder="" class="input-xlarge" required>
													</div>
												</div>
												<div><button type="submit" name="order" class="btn btn-inverse">Confirm order</button></div>
												</form>
											</div>
											<div class="span4"></div>
										</div>
									</div>
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
    </body>
</html>