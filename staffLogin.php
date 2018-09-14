<?php
	session_start();
	require_once("common/connectDB.php");
	header("Content-type: text/html; charset=utf-8");
	$id=$_POST['userNumber'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	

	//活动状态验证
	$nowtime=date('H:i');
	$nowT=strtotime($nowtime);
	$query0="SELECT * FROM checkin_event where flag='1'";
	$result0=mysql_query($query0,$dbc) or die("信息抓取失败");
	$rsnum=mysql_num_rows($result0);
	if($rsnum==0){
    	echo " <h1 style='position:relative;left:15%;top:30%;margin-top:height/2;font-size:80px;'>No event started</h1>";
        exit();
    }

	//时间验证
	$rs=mysql_fetch_array($result0);
	$starttime=$rs['starttime'];
	$stoptime=$rs['stoptime'];
	$startT=strtotime($starttime);
	$stopT=strtotime($stoptime);
	if(($startT-$nowT)>0 || ($nowT-$stopT)>0){
    	echo " <h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:80px;'>Not in right time range</h1>";
        echo " <h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:50px;'>Start time is:  ".date("H:i",$startT)."</h1>";
        echo " <h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:50px;'>Stop time is:  ".date("H:i",$stopT)."</h1>";
        exit();
    }
	


	//坐标验证
	$query5="SELECT * FROM checkin_event where flag='1'";
	$result5=mysql_query($query5,$dbc) or die("信息抓取失败");
	$rs5=mysql_fetch_array($result5);
	$latitude2=$rs5['latitude'];
	$longitude2=$rs5['longitude'];
	$range=$rs5['range'];
	/*
	 * 计算公式：D = R*arccos(sinX1*sinX2+cosX1*cosX2*cos(Y1-Y2))
	 * D:距离
	 * R:地球半径，单位米
	 * X1，X2：两点纬度
	 * Y1，Y2：两点经度
	 */
	$R = 6370856.0;
	$pi = pi();

	//经纬度数组,注意要转化为有理数形式（非角度形式）。
    $la1=$latitude*$pi/180;
    $la2=$latitude2*$pi/180;
	$lo1=$longitude*$pi/180;
    $lo2=$longitude2*$pi/180;
    $dis = abs($R*acos(sin($la1)*sin($la2)+cos($la1)*cos($la2)*cos($lo1-$lo2)));
    $diff= round($dis,2);	
	echo "<h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:80px;'>Distance is:  ".$diff." m</h1>";

	if($diff>$range){
        echo "<h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:80px;'>You are not in event range</h1>";
    	echo "<h1 style='position:relative;left:15%;top:20%;margin-top:height/2;font-size:80px;'>Event range is:  ".$range." m</h1>";
        exit();
    }

	//生成随机的唯一的验证码
	$flag=0;
	while($flag==0){
		$randcode=rand(1000,9999);
		$query="SELECT * FROM checkin_staff where idcode='$randcode'";
		$result=mysql_query($query,$dbc) or die("信息抓取失败");
		$resultNum=mysql_num_rows($result);
		if($resultNum==0){
			$flag=1;
    	}
    }


	//工号验证
	$idcode=$randcode;
	$query3="SELECT * FROM checkin_staff where id='$id'";
	$result3=mysql_query($query3,$dbc) or die("信息抓取失败");
	$rows=mysql_num_rows($result3); 
	if($rows==1){
        $query2="UPDATE checkin_staff SET idcode='$idcode', signin='1' where id='$id'";
		$result2=mysql_query($query2,$dbc) or die("信息抓取失败");
        echo " <h1 style='position:relative;left:15%;top:30%;margin-top:height/2;font-size:80px;'>Your Idcode is:  ".$idcode."</h1>";
    }else {
    	echo " <h1 style='position:relative;left:15%;top:30%;margin-top:height/2;font-size:80px;'>Your Idcode is not exsist!  </h1>";
    }
	mysql_close($dbc);
?>