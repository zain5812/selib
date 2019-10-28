<?php
	session_start();
	session_destroy();
	$_SESSION=null;
	print "<script>alert('Logout Successfully')</script>";
	print "<script>window.open('../index.php','_self')</script>";
?>