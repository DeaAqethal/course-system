<!doctype html>
<html>

<body>
	<?php 
	include './sql_info.php';
	
	$Tno = $_POST["Tno"];
	$Cno = $_POST["Cno"];
	$Cname = $_POST["Cname"];
	$Credit = $_POST["Credit"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$course_result = mysqli_query($con,"SELECT * FROM course WHERE Cno = '" . $Cno."'");
	
	$course_row = mysqli_fetch_array($course_result);
	if($course_row['Cno']!=""){
		echo "<script>alert('此课号已存在');history.go(-1);</script>";
	}else{
		$add_result = mysqli_query($con,"INSERT INTO `course` (`Cno`, `Tno`, `Credit`, `Cname`) VALUES ('".$Cno."', '".$Tno."', '".$Credit."', '".$Cname."');");
		
		echo "<script>alert('增加课程成功');history.go(-1);</script>";
		
	}
	
	
	?>
</body>
</html>