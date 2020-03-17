<!doctype html>
<html>
<body>
	<?php 
	include './sql_info.php';
	
	$Sno = $_POST["Sno"];
	$Cno = $_POST["Cno"];
	$Comment = $_POST["Comment"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$student_course_result = mysqli_query($con,"SELECT * FROM student_course WHERE Sno = '" . $Sno."' AND Cno = '".$Cno."'");
	
	$student_course_row = mysqli_fetch_array($student_course_result);
	if($student_course_row['Cno']==""){
		echo "<script>alert('未选此课');history.go(-1);</script>";
	}
	else{
		if($student_course_row['Comment']!=""){
			echo "<script>alert('已评价此课');history.go(-1);</script>";
		}else{
			echo $Sno , $Cno;
			mysqli_query($con,"UPDATE student_course SET `Comment` = '".$Comment."' WHERE (`Sno` = '".$Sno."') and (`Cno` = '".$Cno."');"); 
			echo "<script>alert('评价成功');history.go(-1);</script>";
			
		}
	}
	

	
	
	
	?>
	
</body>
</html>