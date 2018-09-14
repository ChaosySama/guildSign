<?php
	session_start();
	require_once("common/connectDB.php");
	$num=$_POST['num'];
	$lastPw=$_POST['lastPw'];
	$lpw=sha1(mysql_real_escape_string($lastPw));
	$confirmPw=$_POST['confirmPw'];
	$cpw=sha1(mysql_real_escape_string($confirmPw));
	
	$query="SELECT * FROM checkin_manage where id='$num'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	$rsdata=mysql_fetch_array($result);
	if($rsdata['password']!=$lpw){
    	echo 0;				//原密码错误
        exit();
    }else{
        if($lpw==$cpw){
        	echo 1;			//新密码和原密码相同
            exit();
        }else{
        	$query1="UPDATE checkin_manage SET password='$cpw' where id='$num'";
			$result1=mysql_query($query1,$dbc) or die("信息抓取失败");
            unset($_SESSION['loginId']);
            echo 2;			//修改成功
            exit();
        }
    }
	mysql_close($dbc);
?>