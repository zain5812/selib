<?php
session_start();
if(!isset($_SESSION['isLogin']) || !@$_SESSION['isLogin']){
	print "<script>window.open('../index.php','_self')</script>";
}
if(!isset($_POST['isSubmit']) || @$_POST['isSubmit']!=md5('submit')){
	print "<script>window.open('index.php','_self')</script>";
}
include "../include/conn.php";
include "../include/functions.php";
$course=getCourseInfo($_POST['ci']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Course Description</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.tbl-box{
			max-height: 500px;
			overflow-y: auto;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SE-LIB</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="#" data-toggle="modal"  data-target="#myModal">Upload Content</a></li>
    </ul>
  </div>
</nav>
	

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Content</h4>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="../process/add_content.php">
        	<div class="form-group">
        		<label>Title</label>
        		<input type="text" name="content_title" placeholder="Content Title" class="form-control" required />
        		<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
        		<input type="hidden" name="ci" value="<?=$course['course_id']?>">
        	</div>

        	<div class="form-group">
        		<input type="file" name="content_att" required />
        	</div>

        	<div class="form-group">
        		<button class="btn btn-sm btn-primary" type="submit" >Upload</button>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      	<span>This Content will delete after 2 days</span>
      </div>
    </div>

  </div>
</div>






	<div class="container">
		<h2 align="center"><?=$course['course_title']?></h2>
		<form method="POST" action="../process/add_course.php">
			<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label>Course Name</label>
					<input type="text" class="form-control" name="courseName" value="<?=$course['course_title']?>" placeholder="Course Name" required />
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Access Code</label>
					<input type="text" class="form-control" name="ac" value="<?=$course['access_code']?>" placeholder="Access Code" required />
				</div>
				<input type="hidden" name="isUpdate" value="<?=md5('update')?>">
				<input type="hidden" name="ci" value="<?=$course['course_id']?>">
			</div>
			</div>
			<div align="center">
				<button class="btn btn-primary btn-md" style="width:50%" type="submit">Update</button>
			</div>
		</form>


		<div class="jumbotron">
			<h2 align="center">Content of Course</h2><hr>
			<div class="tbl-box">
				<?php
				$q="SELECT * FROM coursecontent WHERE course_id='".$course['course_id']."'";
				$res=mysqli_query($link,$q);
				$rows=mysqli_num_rows($res);
				$count=0;
				if($rows>=1){
				print "<table class='table'>";
				print "<tr><th>#</th><th>Title</th><th>Expired Date</th><th>Action</th></tr>";
				while($row=mysqli_fetch_assoc($res)){
				?>
					<tr>
						<td><?=++$count?></td>
						<td><?=$row['cc_title']?></td>
						<td><?=$row['expire_date']?></td>
						<td>
							<a href="../userFiles/<?=$row['cc_name']?>" role="Button" class="btn btn-primary btn-sm" download>
								Download
							</a>
							<?php
							$id=md5('delok');
							$d=bin2hex($row['cc_id']);
							$c=bin2hex($row['course_id']);
							$f=bin2hex($row['cc_name']);
							?>
							<a class="btn btn-danger btn-sm" role="button"
							href="../process/dc.php?id=<?=$id?>&d=<?=$d?>&c=<?=$c?>&f=<?=$f?>">
							Delete
							</a>
						</td>
					</tr>
				<?php
					}
					print "</table>";
				}else{
					print "<h3 align='center'>No Content Found...</h3>";
				}
				?>

			</div>
		</div>
	</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>