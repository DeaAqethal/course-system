<!doctype html>
<html>
<body>
	<?php 
	include './sql_info.php';
	
	$Sno = $_POST["Sno"];
	$Cno = $_POST["Cno"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$del_result = mysqli_query($con,"SELECT * FROM student_course WHERE Sno = '".$Sno."' AND Cno = '".$Cno."';");
	$del_row = mysqli_fetch_array($del_result);
	if($del_row['Sno'] ==""){
		echo "<script>alert('未选该课程');history.go(-1);</script>";
	}
	else{
		echo $Sno , $Cno;
		mysqli_query($con,"DELETE FROM student_course WHERE (`Sno` = '".$Sno."') and (`Cno` = '".$Cno."');"); 
		echo "<script>alert('撤课成功');history.go(-1);</script>";
	}
	
	
	
	?>
</body>
</html>