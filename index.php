<?php
session_start();
include "include/conn.php";
include "include/functions.php";
deleteFiles();
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']){
	print "<script>window.open('in/index.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body{
			background: url('images/background.png');
			background-attachment: fixed;
			background-position: center;
			background-repeat: no-repeat;
			background-size: auto;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">SE-LIB</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="mem.php">Student</a></li> 
      </ul>
    </div>
  </div>
</nav>


	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5">
				<div class="jumbotron">
					<h2>Login</h2><hr>
					<form method="POST" action="process/login.php">
						<div class="form-group">
							<label type="username">Username</label>
							<input type="text" name="userName" placeholder="Username" class="form-control" required  autocomplete="off" />
						</div>
						<div class="form-group">
							<label type="password">Password</label>
							<input type="password" name="userPass" placeholder="Password" class="form-control" required />
							<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-small btn-primary">Login</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-5">
				<div class="jumbotron">
					<h2>Register</h2><hr>
					<form method="POST" action="process/signup.php">
						<div class="form-group">
							<label type="name">Full Name</label>
							<input type="text" name="userFullName" placeholder="Name" class="form-control" required />
						</div>
						<div class="form-group">
							<label type="username">Username</label>
							<input type="text" name="userName" placeholder="Username" class="form-control" required autocomplete="off" />
						</div>
						<div class="form-group">
							<label type="email">Email</label>
							<input type="email" name="userMail" placeholder="Email" class="form-control" required autocomplete="off" />
						</div>
						<div class="form-group">
							<label type="password">Password</label>
							<input type="password" name="userPass" placeholder="Password" class="form-control" required />
						</div>
						<div class="form-group">
							<label type="password">Re-Enter Password</label>
							<input type="password" name="userRePass" placeholder="Re-Enter Password" class="form-control" required />
							<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
						</div>
						<div class="form-group">
							<button class="btn btn-small btn-primary">Sign up</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>