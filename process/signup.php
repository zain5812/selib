<?php
	session_start();
	include "../include/conn.php";
	include "../include/functions.php";
	if(isset($_POST['isSubmit']) && $_POST['isSubmit']==md5("submit")){
		$userFullName=$_POST['userFullName'];
		$userName=$_POST['userName'];
		$userEmail=$_POST['userMail'];
		$userKey=$_POST['userPass'];
		date_default_timezone_set("Asia/Karachi");
		$cdate=date("Y-m-d");


		$query="INSERT INTO users (user_name,user_full_name,user_email,user_key,account_created_date)
				VALUES ('$userName','$userFullName','$userEmail','$userKey','$cdate')";


		if(mysqli_query($link,$query)){

			$_SESSION['userName']=$userName;
			$_SESSION['userFullName']=$userFullName;
			$_SESSION['userId']=getUserId($userName);
			$_SESSION['isLogin']=true;

			print "<script>alert('Account Created Successfully.')</script>";
			print "<script>window.open('../in/index.php','_self')</script>";
		}
	}
?>