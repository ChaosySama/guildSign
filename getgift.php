<?php
    session_start();
    require_once("common/connectDB.php");
    $idcode=$_POST['idcode'];
    $idcodeflag=$_POST['idcodeflag'];
    
    $query0="SELECT * FROM checkin_event where flag='1'";
    $result0=mysql_query($query0,$dbc) or die("信息抓取失败");
    $rows=mysql_num_rows($result0);
    if($rows!=1){
        echo 0;         //活动未开始 
        exit();
    }

    if($idcodeflag==0){     //验证码签到
        $query1="SELECT * FROM checkin_staff where idcode='$idcode'";
        $result1=mysql_query($query1,$dbc) or die("信息抓取失败");
        $rows1=mysql_num_rows($result1);
        if($rows1==0){
            echo 5;         //验证码错误
            exit();
        }
        $rs1=mysql_fetch_array($result1);
        if($rs1['signin']!=1){
            echo 3;         //未签到 
            exit();
        }
        if($rs1['gift']!=0){
            echo 6;         //重复签到 
            exit();
        }
    } else {
        $query11="SELECT * FROM checkin_staff where id='$idcode'";
        $result11=mysql_query($query11,$dbc) or die("信息抓取失败");
        $rs2=mysql_num_rows($result11);
        if($rs2!=1){
            echo 4;         //未匹配到
            exit();
        }
        $rs3=mysql_fetch_array($result11);
        if($rs3['gift']!=0){
            echo 6;         //重复签到 
            exit();
        }
    }

    $query="SELECT * FROM checkin_event where flag='1'";
    $result=mysql_query($query,$dbc) or die("信息抓取失败");
    $rsdata=mysql_fetch_array($result);
    $giftflag=0;        //未验证
    if($rsdata['giftnum']>0){
        $giftflag=1;    //已领
        $query4="UPDATE checkin_event SET number=number+1, giftnum=giftnum-1 WHERE flag ='1' ";
        $result4=mysql_query($query4,$dbc) or die("信息抓取失败");
    } else {
        $giftflag=2;    //验证但未领（礼品不够）
        $query5="UPDATE checkin_event SET number=number+1 WHERE flag ='1' ";
        $result5=mysql_query($query5,$dbc) or die("信息抓取失败");
    }

    if($idcodeflag==0){     //验证码签到
        $query2="UPDATE checkin_staff SET gift='$giftflag' where idcode='$idcode'";
        $result2=mysql_query($query2,$dbc) or die("信息抓取失败");
        if($result2){
            echo $giftflag;
        }
    } else {                //人工签到
        $query3="UPDATE checkin_staff SET gift='$giftflag', signin='1' where id='$idcode'";
        $result3=mysql_query($query3,$dbc) or die("信息抓取失败");
        if($result3){
            echo $giftflag;
        }
    }

    mysql_close($dbc);
?>