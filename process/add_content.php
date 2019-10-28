<?php
	session_start();
	include "../include/conn.php";
	include "../include/functions.php";
	$userId=$_SESSION['userId'];
	if(isset($_POST['isSubmit']) && $_POST['isSubmit']==md5("submit")){
		$title=$_POST['content_title'];
		$file=$_FILES['content_att'];
		$courseId=$_POST['ci'];

		$ext=pathinfo($file['name'],PATHINFO_EXTENSION);
		$size=$file['size'];
		$fileName=rand(11111111,99999999).".".$ext;

		date_default_timezone_set("Asia/Karachi");
		$cdate=date("Y-m-d");
		$nextDay=strtotime("+2 Day");
		$expire=date("Y-m-d",$nextDay);

		
		if(move_uploaded_file($file['tmp_name'], "../userFiles/".$fileName)){
			$query="INSERT INTO coursecontent (course_id,cc_title,cc_name,uploaded_date,expire_date) VALUES
			 ('$courseId','$title','$fileName','$cdate','$expire')";
			 if(mysqli_query($link,$query)){
			 	print "<script>alert('Content Upload Successfully.')</script>";
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
	}
?>