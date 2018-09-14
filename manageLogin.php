<?php
	session_start();
	require_once("common/connectDB.php");
	$manageNumber=$_POST['manageNumber'];
	$managePw=$_POST['managePassword'];
	$pw=sha1(mysql_real_escape_string($managePw));
	$query="SELECT * FROM checkin_manage where id='$manageNumber' and password='$pw'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	$resultNum=mysql_num_rows($result);
	if($resultNum!=1){
		echo "<script language='javascript'>";
        echo " alert('工号或者密码输入错误!');";
    	echo " location='manage.html';";
    	echo "</script>"; 
    }else {
    	$_SESSION['loginId']=$manageNumber;
        echo "<script language='javascript'>";
    	echo " location='main.php';";
    	echo "</script>"; 
    }
	mysql_close($dbc);
?>
<!DOCTYPE HTML>
