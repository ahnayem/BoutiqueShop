<?php  
	ob_start();
	session_start();
	session_destroy();
	
	header('location: ../admin_login.php');
		
?>