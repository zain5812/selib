
<?php
	session_start();
	include "../include/conn.php";
	include "../include/functions.php";
	$userId=$_SESSION['userId'];
	if(isset($_GET['isSubmit']) && $_GET['isSubmit']==md5("submit")){
		$courseTitle=$_GET['course_title'];
		$accessKey=rand(11111,99999);
		date_default_timezone_set("Asia/Karachi");
		$cdate=date("Y-m-d");
		$userId=getUserId($_SESSION['userName']);

		$query="INSERT INTO courses (user_id,course_title,access_code,created_date) 
		VALUES ('$userId','$courseTitle','$accessKey','$cdate')";

		if(mysqli_query($link,$query)){
			print "<script>alert('Course Added Successfully.')</script>";
			print "<script>window.open('../in/index.php?c=$accessKey','_self')</script>";
		}
	}else if(isset($_POST['isUpdate']) && $_POST['isUpdate']==md5("update")){
		$courseId=$_POST['ci'];
		$courseTitle=$_POST['courseName'];
		$accessCode=$_POST['ac'];

		$query="UPDATE courses SET course_title='$courseTitle',access_code='$accessCode' WHERE course_id='$courseId' AND user_id='$userId'";
		if(mysqli_query($link,$query)){
			print "<script>alert('Course Updated Successfully.')</script>";
			?>
			<form id='frm' method="POST" action="../in/course_des.php">
				<input type="hidden" name="ci" value="<?=$courseId?>">
				<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
				<script type="text/javascript">
					document.getElementById('frm').submit();
				</script>
			</form>
			<?php
		}
	}
	else{
		print "<script>window.open('../index.php','_self')</script>";
	}
?>