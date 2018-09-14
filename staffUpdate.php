<?php
	session_start();
	require_once("common/connectDB.php");
	$num=$_POST['num'];
	$name=$_POST['name'];
	$sex=$_POST['sex'];
	$nation=$_POST['nation'];
	$department=$_POST['department'];
	$duty=$_POST['duty'];
	$fee=$_POST['fee'];
	$registtime=date('Y-m-d');
	
	$query0="SELECT * FROM checkin_staff where id='$num'";
	$result0=mysql_query($query0,$dbc) or die("信息抓取失败");
	$rs0=mysql_num_rows($result0);
	if($rs0==1){		//修改信息
		$query="UPDATE checkin_staff SET name='$name',sex='$sex',nation='$nation',department='$department',duty='$duty',fee='$fee' where id='$num'";
		$result=mysql_query($query,$dbc) or die("信息抓取失败");
		if($result){
    		echo 0;		//修改成功
    	}else{
    	    echo 1;		//修改失败
    	}
    }else{				//新增信息
    	$query2="INSERT INTO checkin_staff (id,name,sex,nation,department,duty,fee,registtime,idcode,signin,gift) VALUES('$num','$name','$sex','$nation','$department','$duty','$fee','$registtime','0','0','0')";
		$result2=mysql_query($query2,$dbc) or die("信息抓取失败");
        if($result2){
    		echo 2;		//添加成功
    	}else{
    	    echo 3;		//添加失败
    	}
    }

	mysql_close($dbc);
?>