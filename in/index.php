<?php
session_start();
if(!isset($_SESSION['isLogin']) && !$_SESSION['isLogin']){
	print "<script>window.open('../index.php','_self')</script>";
}
include "../include/conn.php";
include "../include/functions.php";
$userId=$_SESSION['userId'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.blk{
			background: #e1e3e4;
			padding:5px;
			cursor:pointer;
			border: none;
			border-radius: 5px;
			width: 100%;
		}
	</style>
	<script type="text/javascript">
		function submitForm(id){
			document.getElementById(id).submit();
		}
	</script>
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
      <a class="navbar-brand" href="../">SE-LIB</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#" data-toggle="modal"  data-target="#myModal">Add Course</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../process/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Course</h4>
      </div>
      <div class="modal-body">
        <form method="GET" action="../process/add_course.php">
        	<div class="form-group">
        		<label>Course Title</label>
        		<input type="text" name="course_title" placeholder="Course Title" class="form-control" required />
        		<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
        	</div>
        	<div class="form-group">
        		<button class="btn btn-sm btn-primary" type="submit" >Add</button>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      	<span>Access Code for this course will generate soon</span>
      </div>
    </div>

  </div>
</div>


	<?php
		if(isset($_REQUEST['c'])){
			?>
			<div class="alert alert-success alert-dismissible">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Success!</strong> Access Code = <?=$_REQUEST['c']?>
			</div>
			<?php
		}
	?>

	<div class="container-fluid">
		<h2>Courses</h2><hr>
		<div class="row">
			<?php
				$query="SELECT * FROM courses WHERE courses.user_id='$userId'";
				$res=mysqli_query($link,$query);
				$i=1;
				while($row=mysqli_fetch_assoc($res)){
					courseBox($row['course_id'],$row['course_title']);
					if($i%4==0)
						print "</div><div class='row'>";
					$i++;
				}
			?>
		</div>
	</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>