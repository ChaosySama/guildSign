<?php
	session_start();
	require_once("common/connectDB.php");
	$query0="SELECT * FROM checkin_event where flag='1'";
	$result0=mysql_query($query0,$dbc) or die("信息抓取失败");
	$resultNum=mysql_num_rows($result0);
	if($resultNum!=0){
		echo "<script language='javascript'>";
        echo " alert('Event has already started!');";
    	echo " location='main.php';";
    	echo "</script>"; 
    	exit();
    }
	$startTime=$_POST['startTime'];
	$stopTime=$_POST['stopTime'];
	$range=trim($_POST['range']);
	$_SESSION['range']=$range;
	$giftNum=trim($_POST['giftNum']);
	$_SESSION['giftNum']=$giftNum;
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	$difftime=(strtotime($stopTime)-strtotime($startTime))/60;  //活动时长min
	$date=date('Y-m-d');

	if($difftime<1){
    	echo "<script language='javascript'>";
		echo " alert('stoptime must bigger than starttime');";
    	echo " location='start.php';";
    	echo "</script>";
        exit();
    }

	//添加活动
	$query="INSERT INTO checkin_event (latitude,longitude,starttime,totaltime,stoptime,`range`,number,giftnum,flag,date) VALUES('$latitude','$longitude','$startTime','$difftime','$stopTime','$range','0','$giftNum','1','$date')";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");

	//重置所有成员签到和礼品状态
	$query2="UPDATE checkin_staff SET signin='0', gift='0'";
	$result2=mysql_query($query2,$dbc) or die("信息抓取失败");
	echo "<script language='javascript'>";
	echo " alert('Event started!');";
    echo " location='main.php';";
    echo "</script>"; 
	mysql_close($dbc);
?>