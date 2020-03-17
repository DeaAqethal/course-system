<html>
<body>
<?php
	include './sql_info.php';

//从form中读取参数。接口一定要统一！！！不然会传参失败
$id = $_POST["id"];
$passwd = $_POST["passwd"];
$kind = $_POST["kind"]; //标记用户是学生还是老师
	
//数据库连接
$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }	

if($kind == "student")
{
	$id_result = mysqli_query($con,"SELECT * FROM student WHERE Sno = '" . $id ."'");//查询与该id有关的信息
	$id_row = mysqli_fetch_array($id_result);//row是一个包含id相关信息的数组
	
	if($id_row['passwd'] == "") 
		echo "<script>alert('id不存在 ');history.go(-1);</script>";
	elseif($passwd != $id_row['passwd'])
		echo "<script>alert('密码错误');history.go(-1);</script>";
	
	
	
	echo "欢迎学生:" . $id_row['Sname'] ."<br>" ;
	echo "学号:" . $id_row['Sno']."<br>";
	echo "性别:" . $id_row['Ssex']."<br>";
	echo "专业:" . $id_row['Sdept']."<br>";
	echo "班级:" . $id_row['Class']."<br>";
	
	$student_course_result = mysqli_query($con,"SELECT Cno,Cname,Tname,Tdept,TLevel FROM student_course NATURAL JOIN course NATURAL JOIN teacher WHERE Sno = '" . $id ."'");
	
	echo "**********已选课程************<br>";
	echo "课号--课名-----授课老师-专业--职称<br>";
	while($student_course_row = mysqli_fetch_array($student_course_result))
	{
		
	  	echo $student_course_row['Cno'] . " " . $student_course_row['Cname']. " " . $student_course_row['Tname']. " " . $student_course_row['Tdept']. " " . $student_course_row['TLevel'];
  	  	echo "<br />";
	}
	echo "****************************<br>";
	
	echo "<form action='PickLesson.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='选课'> ";
	echo "</form>";
	
	echo "<form action='DeleteLesson.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='撤课'> ";
	echo "</form>";
	
	echo "<form action='JudgeLesson.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='评价课程'> ";
	echo "</form>";
	echo "<input type='button' value='退出登录' onClick=\"location='../index.html'\">";
	
}
else//同上
{
	$result = mysqli_query($con,"SELECT * FROM teacher WHERE Tno = '" . $id ."'");
	$row = mysqli_fetch_array($result);
	if($passwd != $row['passwd']){
		if($row['passwd'] == "") 
			echo "<script>alert('id不存在');history.go(-1);</script>";
		else 
			echo "<script>alert('密码错误');history.go(-1);</script>";
	}
	
	
	echo "欢迎老师:" . $row['Tname'] ." " ;
	echo "学号:" . $row['Tno']." " ;
	echo "性别:" . $row['Tsex']." ";
	echo "专业:" . $row['Tdept']." ";
	echo "职称:" . $row['TLevel']." ";
	echo "<br>";
	$course_result = mysqli_query($con,"SELECT Cno,Cname,Credit FROM course WHERE Tno = '" . $id ."'");
	
	echo "**********所授课程************<br>";
	echo "课号--课名---学分<br>";
	while($course_row = mysqli_fetch_array($course_result))
	{
		
	  	echo $course_row['Cno'] . " " . $course_row['Cname']. " " . $course_row['Credit'];
  	  	echo "<br />";
	}
	echo "****************************<br>";
	echo "<form action='AddLesson.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='增加课程'> ";
	echo "</form>";
	
	echo "<form action='MinusLesson.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='取消课程'> ";
	echo "</form>";
	
	echo "<form action='finalScore.php' method='post'>";
	echo "<input type='hidden' name='id' value= '".$id."' >";
	echo " <input type='submit' value='课程打分'> ";
	echo "</form>";
	echo "<input type='button' value='退出登录' onClick=\"location='../index.html'\">";
}

mysql_close($con);
?>

</body>
</html>