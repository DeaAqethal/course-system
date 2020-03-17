<!doctype html>
<html>
<body>
	<?php 
	include './sql_info.php';
	
	$Tno = $_POST["id"];
	
	echo "<form action='AddIt.php' method='post'>";
	echo "<input type='hidden' name='Tno' value= '".$Tno."' >";
	echo "课号： <input type='number' name='Cno' ><br>";
	echo "课名： <input type='text' name='Cname' ><br>";
	echo "学分： <input type='number' name='Credit' min = '1' max = '5'><br>";
	echo " <input type='submit' value='增加'> ";
	echo "<input type='button' value='返回' onClick=\"history.go(-1)\">";
	echo "</form>";
	?>
</body>
</html>