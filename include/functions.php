<?php
	function getUserId($userName){
		global $link;
		$query="SELECT user_id FROM users WHERE user_name='$userName'";
		$res=mysqli_query($link,$query);
		$data=mysqli_fetch_array($res);
		return $data[0];
	}

	function courseBox($courseId,$courseTitle){
		?>
		<div class="col-md-3">
			<form id="<?=$courseId?>" method="POST" action="course_des.php" >
				<input type="hidden" name="ci" value="<?=$courseId?>" />
				<input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
				<button class="blk" onClick="submitForm('<?=$courseId?>')">
					<h3 align="center"><?=$courseTitle?></h3><hr>
					<img src="../images/course.jpg" width="100%" class="img-thumbnail"/>
				</button>
			</form>
		</div>
		<?php
	}

	function deleteFiles(){
		global $link;
		date_default_timezone_set("Asia/Karachi");
		$today=date("Y-m-d");
		$query="SELECT cc_name FROM coursecontent WHERE expire_date='$today'";
		$res=mysqli_query($link,$query);
		while($row=mysqli_fetch_array($res)){
			@unlink("userFiles/$row[0]");
		}
		$query="DELETE FROM coursecontent WHERE expire_date='$today'";
		mysqli_query($link,$query);
	}

	function getCourseInfo($courseId){
		global $link;
		$query="SELECT * FROM courses WHERE course_id='$courseId'";
		$res=mysqli_query($link,$query);
		$row=mysqli_fetch_assoc($res);
		return $row;
	}

	function deleteContent($id){
		global $link;
		$query="DELETE FROM coursecontent WHERE cc_id='$id'";
		return mysqli_query($link,$query);
	}
?>