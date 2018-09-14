<?php
	session_start();
	require_once("common/connectDB.php");
	$num=$_POST['num'];
	//工号是否已存在
	$query0="SELECT * FROM checkin_staff where id='$num'";
	$result0=mysql_query($query0,$dbc) or die("信息抓取失败");
	$rs0=mysql_num_rows($result0);
	if($rs0!=0){
		echo 0;
        exit();
    }

	mysql_close($dbc);
?>