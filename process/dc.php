<?php
session_start();
	include "../include/conn.php";
	include "../include/functions.php";
	$userId=$_SESSION['userId'];
	if(isset($_REQUEST['id']) && $_REQUEST['id']==md5("delok")){
		$contentId=hex2bin($_REQUEST['d']);
		$courseId=hex2bin($_REQUEST['c']);
		$fileName=hex2bin($_REQUEST['f']);
		if(deleteContent($contentId)){
			unlink("../userFiles/$fileName");
			print "<script>alert('Content Course Successfully.')</script>";
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
		die(mysqli_error($link));
	}

?>