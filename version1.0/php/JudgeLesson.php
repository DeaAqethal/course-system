<!doctype html>
<html>
<body>
	<?php 
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "159357";
	$db_name = "course_system";
	$charset = "utf8";
	
	$Sno = $_POST["id"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$student_course_result = mysqli_query($con,"SELECT Cno,Cname,Tname,Tdept,TLevel,Comment   FROM student_course NATURAL JOIN course NATURAL JOIN teacher WHERE Sno = '" . $Sno."'");
	
	echo "**********已选课程************<br>";
	echo "课号--课名-----授课老师-专业--职称--评价<br>";
	while($student_course_row = mysqli_fetch_array($student_course_result))
	{
	  	echo $student_course_row['Cno'] . " " . $student_course_row['Cname']. " " . $student_course_row['Tname']. " " . $student_course_row['Tdept']. " " . $student_course_row['TLevel']. " " . $student_course_row['Comment'];
  	  	echo "<br />";
	}
	echo "****************************<br>";
	
	echo "<form action='JudgeIt.php' method='post'>";
	echo "<input type='hidden' name='Sno' value= '".$Sno."' >";
	echo "课号： <input type='number' name='Cno' ><br>";
	echo "评价： <input type='number' name='Comment' min='0' max='10' >分 (0~10分)<br>";
	echo " <input type='submit'  value='评价'> ";
	echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
	echo "</form>";
	
	?>
</body>
</html>
