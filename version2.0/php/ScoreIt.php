<!doctype html>
<html>
<body>
	<?php
	include './sql_info.php';
	
	$Tno = $_POST["Tno"];
	$Cno = $_POST["Cno"];
	//数据库连接
	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }	
	$course_result = mysqli_query($con,"SELECT * FROM course WHERE Cno = '" . $Cno."'");
	
	$course_row = mysqli_fetch_array($course_result);
	if($course_row['Tno']!=$Tno){
		echo "<script>alert('你不是此课老师');history.go(-1);</script>";
	}
	else{
		$student_course_result = mysqli_query($con,"SELECT Sno,Sname,Score FROM student NATURAL JOIN student_course WHERE Cno = '" . $Cno ."'");
	
		echo "**********课程学生************<br>";
		echo "学号--姓名--分数<br>";
		while($student_course_row = mysqli_fetch_array($student_course_result))
		{

			echo $student_course_row['Sno'] . " " . $student_course_row['Sname'] . " " . $student_course_row['Score'];
			echo "<br />";
		}

		echo "<form action='Score.php' method='post'>";
		echo "<input type='hidden' name='Cno' value= '".$Cno."' >";
		echo "学号： <input type='number' name='Sno' ><br>";
		echo "成绩： <input type='number' name='Score'  min=0 max=100 ><br>";
		echo " <input type='submit' value='打分'> ";
		echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
		echo "</form>";
	}

	
	?>
</body>
</html>
