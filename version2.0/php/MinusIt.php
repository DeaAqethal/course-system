<!doctype html>
<html>

<body>
	<?php 
	include './sql_info.php';
	
	$Tno = $_POST["Tno"];
	$Cno = $_POST["Cno"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$course_result = mysqli_query($con,"SELECT * FROM course WHERE Cno = '" . $Cno."'");
	
	$course_row = mysqli_fetch_array($course_result);
	if($course_row['Cno']==""){
		echo "<script>alert('此课号不存在');history.go(-1);</script>";
	}else{
		if($course_row['Tno']==$Tno){
			$minus_result = mysqli_query($con,"DELETE FROM `course` WHERE (`Cno` = '".$Cno."');");
		
			echo "<script>alert('取消课程成功');history.go(-1);</script>";
		}else{
			echo "<script>alert('你不是此课的授课老师');history.go(-1);</script>";
		}
	
	}
	
	
	?>
</body>
</html>