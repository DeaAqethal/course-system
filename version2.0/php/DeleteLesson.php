<!doctype html>
<html>
<body>
	<?php 
	include './sql_info.php';
	
	$Sno = $_POST["id"];
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	
	$student_course_result = mysqli_query($con,"SELECT Cno,Cname,Tname,Tdept,TLevel FROM student_course NATURAL JOIN course NATURAL JOIN teacher WHERE Sno = '" . $Sno."'");
	
	echo "**********已选课程************<br>";
	echo "课号--课名-----授课老师-专业--职称<br>";
	while($student_course_row = mysqli_fetch_array($student_course_result))
	{
		
	  	echo $student_course_row['Cno'] . " " . $student_course_row['Cname']. " " . $student_course_row['Tname']. " " . $student_course_row['Tdept']. " " . $student_course_row['TLevel'];
  	  	echo "<br />";
	}
	echo "****************************<br>";
	
	echo "<form action='DeleteIt.php' method='post'>";
	echo "<input type='hidden' name='Sno' value= '".$Sno."' >";
	echo "课号： <input type='number' name='Cno' ><br>";
	echo " <input type='submit' value='撤课'> ";
	echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
	echo "</form>";
	
	?>
</body>
</html>