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
	
	$course_result = mysqli_query($con,"SELECT Cno,Cname,Tname,Tdept,TLevel FROM teacher NATURAL JOIN course ");
	echo "**********所有课程************<br>";
	echo "课号--课名-----授课老师-专业--职称<br>";
	while($course_row = mysqli_fetch_array($course_result))
	{
		
	  	echo $course_row['Cno'] . " " . $course_row['Cname']. " " . $course_row['Tname']. " " . $course_row['Tdept']. " " . $course_row['TLevel'];
  	  	echo "<br />"; 
	}
	echo "*******************************<br>";
	
	echo "<form action='PickIt.php' method='post'>";
	echo "<input type='hidden' name='Sno' value= '".$Sno."' >";
	echo "课号： <input type='number' name='Cno' ><br>";
	echo " <input type='submit' value='选课'> ";
	echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
	echo "</form>";
	
	?>
	
</body>
</html>