<?php
	session_start();
	include "../include/conn.php";
	include "../include/functions.php";
	if(isset($_POST['isSubmit']) && $_POST['isSubmit']==md5("submit")){
		$userName=$_POST['userName'];
		$userKey=$_POST['userPass'];

		$query="SELECT * FROM users WHERE user_name='$userName' AND user_key='$userKey'";
		$res=mysqli_query($link,$query);
		if(mysqli_num_rows($res)==1){
			$row=mysqli_fetch_assoc($res);
			$_SESSION['userName']=$userName;
			$_SESSION['userFullName']=$row['user_full_name'];
			$_SESSION['userId']=getUserId($userName);
			$_SESSION['isLogin']=true;
			print "<script>window.open('../in/','_self')</script>";
		}
		print "<script>alert('Incorrect Username/Password.')</script>";
		print "<script>window.open('../index.php','_self')</script>";

	}
?>