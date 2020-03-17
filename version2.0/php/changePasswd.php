<!doctype html>
<html>

<body>
<?php 
//数据库登录所需的参数
include './sql_info.php';

//从form中读取参数。接口一定要统一！！！不然会传参失败
$id = $_POST["id"];
$OldPasswd = $_POST["OldPasswd"];
$NewPasswd = $_POST["NewPasswd"];
$NewRepPasswd = $_POST["NewRepPasswd"];
$kind = $_POST["kind"]; //标记用户是学生还是老师

//防止非法输入
if($id == "" || $OldPasswd == "" || $NewPasswd == "" || $NewRepPasswd == "" ){
	echo "<script>alert('禁止输入为空');history.go(-1);</script>";exit();
}
if($NewPasswd != $NewRepPasswd){
	echo "<script>alert('两次密码输入不同');history.go(-1);</script>";exit();
}
if(strlen($NewPasswd)>=15){
   echo "<script>alert('密码太长');history.go(-1);</script>";exit();
}
	
//数据库连接
$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }	
	
if($kind == "student")
{
	$result = mysqli_query($con,"SELECT * FROM student WHERE Sno = '" . $id."'");//查询与该id有关的信息
	$row = mysqli_fetch_array($result);//row是一个包含id相关信息的数组
	if($row['passwd'] == "" ) //当找不到id时，row[passwd]为空
		echo "<script>alert('id不存在');history.go(-1);</script>";//history.go(-1)是返回上一界面
	
	elseif($OldPasswd != $row['passwd']){//找到了id，但密码错误
			echo "<script>alert('密码错误');history.go(-1);</script>";
	}
		
			
	else{
		mysqli_query($con,"UPDATE student SET passwd = ".$NewPasswd." WHERE Sno =  '" . $id."'");//update语句
		echo "<script>alert('修改成功');history.go(-1);</script>";
	}
	
	
}
else//同上，仅有部分参数变化
{
	$result = mysqli_query($con,"SELECT * FROM teacher WHERE Tno = " . $id);
	$row = mysqli_fetch_array($result);
	if($row['passwd'] == "" )
		echo "<script>alert('id不存在');history.go(-1);</script>";
	
	elseif($OldPasswd != $row['passwd']){
			echo "<script>alert('密码错误');history.go(-1);</script>";
	}
		
			
	else{
		mysqli_query($con,"UPDATE teacher SET passwd = ".$NewPasswd." WHERE Tno = " . $id);
		echo "<script>alert('修改成功');history.go(-1);</script>";
	}
}

mysql_close($con);
?>
</body>
</html>