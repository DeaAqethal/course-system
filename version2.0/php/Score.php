<!doctype html>
<html>
<body>
	<?php
	include './sql_info.php';
	
	$Sno = $_POST["Sno"];
	$Cno = $_POST["Cno"];
	$Score = $_POST["Score"];
	//数据库连接
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$student_course_result = mysqli_query($con,"SELECT * FROM student_course WHERE Cno = '" . $Cno."'AND Sno = '".$Sno."';");
	
	$student_course_row = mysqli_fetch_array($student_course_result);
	if($student_course_row['Cno']==""){
		echo "<script>alert('此学号未选课');history.go(-1);</script>";
	}
	elseif($student_course_row['Score']!=""){
		echo "<script>alert('此学号已打分');history.go(-1);</script>";
	}
	else{
		$minus_result = mysqli_query($con,"UPDATE student_course SET `Score` = '".$Score."' WHERE (`Sno` = '".$Sno."') and (`Cno` = '".$Cno."');");
		echo "<script>alert('打分成功');history.go(-1);</script>";
	}

	
	?>
</body>
</html>