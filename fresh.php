<?php
	session_start();
	require_once("common/connectDB.php");
	//状态栏动态刷新
	$query="SELECT * FROM checkin_event where flag='1'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	$data=mysql_fetch_array($result);
	$nowtime=date('H:i');
	$nowT=strtotime($nowtime);
	if($data){
		$number=$data['number'];
		$giftnum=$data['giftnum'];
        $starttime=$data['starttime'];
        $stoptime=$data['stoptime'];
        $startT=strtotime($starttime);
		$stopT=strtotime($stoptime);
        $aT=date("H:i",$startT);
        $oT=date("H:i",$stopT);
        if(($startT-$nowT)>0 || ($nowT-$stopT)>0){
			$Aflag=2;		//当前时间不在活动范围内，Overtime
        }else {
        	$Aflag=1;		//Active
        }
    } else {
        $number="NULL";
		$giftnum="NULL";
        $aT="NULL";
        $oT="NULL";
    	$Aflag=0;			//Stopped
    }
	$arr = array ('number'=>$number,'giftnum'=>$giftnum,'Aflag'=>$Aflag,'aT'=>$aT,'oT'=>$oT,'nT'=>$nowtime);
	exit(json_encode($arr));
	mysql_close($dbc);
?>