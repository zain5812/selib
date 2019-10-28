<?php
session_start();
include "include/conn.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
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
        <li class="active"><a href="mem.php">Student</a></li> 
      </ul>
    </div>
  </div>
</nav>


  <div class="container">
    <form method="POST" class="form-inline" action="mem.php">
      <div class="form-group">
        <title>Enter Code to Access Course Content</title>
        <input type="text" name="accessCode" placeholder="Access Code" class="form-control" required autocomplete="off" />
        <input type="hidden" name="isSubmit" value="<?=md5('submit')?>">
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Access</button>
      </div>
    </form>

    <div class="jumbotron">

      <?php
        if(isset($_REQUEST['isSubmit']) && $_REQUEST['isSubmit']==md5('submit')){
            print "<table class='table'>";
            print "<tr><th>#</th><th>Title</th><th>Expired Date</th><th>Action</th></tr>";
            $accessCode=$_REQUEST['accessCode'];
            $query="SELECT c.access_code,c.course_id,cc.course_id,cc.cc_title,cc.cc_name,cc.expire_date 
              FROM courses as c,coursecontent as cc
              WHERE c.course_id=cc.course_id AND c.access_code='$accessCode'";
            $res=mysqli_query($link,$query) or die("Invalid Access Code");
            $count=0;
            $rows=mysqli_num_rows($res);
            if($rows>=1){
              while($row=mysqli_fetch_assoc($res)){
            ?>
                <tr>
                  <td><?=++$count?></td>
                  <td><?=$row['cc_title']?></td>
                  <td><?=$row['expire_date']?></td>
                  <td>
                    <a href="userFiles/<?=$row['cc_name']?>" role="Button" class="btn btn-primary btn-sm" download>
                        Download
                    </a>
                  </td>
                </tr>
            <?php
              }
              print "</table>";
            }else{
                print "<h3 align='center'>No Content Found...</h3>";
              }
        }else{

        }
      ?>
    </div>
  </div>


	




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>