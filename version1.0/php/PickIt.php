<!doctype html>
<html>
<body>
	<?php 
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "159357";
	$db_name = "course_system";
	$charset = "utf8";
	
	$Sno = $_POST["Sno"];
	$Cno = $_POST["Cno"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$student_course_result = mysqli_query($con,"SELECT * FROM student_course WHERE Sno = '" . $Sno."' AND Cno = '".$Cno."'");
	
	$student_course_row = mysqli_fetch_array($student_course_result);
	if($student_course_row['Cno']!=""){
		echo "<script>alert('已选过此课');history.go(-1);</script>";
	}else{
		$pick_result = mysqli_query($con,"SELECT * FROM course WHERE Cno = '" . $Cno ."'");
		$pick_row = mysqli_fetch_array($pick_result);
		if($pick_row['Cno'] ==""){
			echo "<script>alert('找不到该课号');history.go(-1);</script>";
		}
		else{
			echo $Sno , $Cno;
			mysqli_query($con,"INSERT INTO student_course (Sno, Cno) VALUES ('".$Sno."', '".$Cno."');"); 
			echo "<script>alert('选课成功');history.go(-1);</script>";
		}
	}

	
	
	
	
	
	?>
</body>
</html>