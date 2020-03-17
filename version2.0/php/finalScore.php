<!doctype html>
<html>
<body>
	<?php
	include './sql_info.php';
	
	$Tno = $_POST["id"];
	//数据库连接
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	$course_result = mysqli_query($con,"SELECT Cno,Cname,Credit FROM course WHERE Tno = '" . $Tno ."'");
	
	echo "**********所授课程************<br>";
	echo "课号--课名---学分<br>";
	while($course_row = mysqli_fetch_array($course_result))
	{
		
	  	echo $course_row['Cno'] . " " . $course_row['Cname']. " " . $course_row['Credit'];
  	  	echo "<br />";
	}
	
	echo "<form action='ScoreIt.php' method='post'>";
	echo "<input type='hidden' name='Tno' value= '".$Tno."' >";
	echo "课号： <input type='number' name='Cno' ><br>";
	echo " <input type='submit' value='打分'> ";
	echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
	echo "</form>";
	?>
</body>
</html>