<?php
	session_start();
	require_once("common/connectDB.php");
	$query="UPDATE checkin_event SET flag='0'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	unset($_SESSION['range']);
	unset($_SESSION['giftNum']);
	mysql_close($dbc);
?>