<?php
	session_start();
	if(!isset($_SESSION['loginId'])){
		echo "<script language='javascript'>";
    	echo " location='manage.html';";
    	echo "</script>"; 
    	exit();
	}
	require_once("common/connectDB.php");
	
	$query="SELECT * FROM checkin_event where flag='1'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	$resultNum=mysql_num_rows($result);
	mysql_close($dbc);
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>管理操作</title>
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body id="body-1">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-md-offset-3 col-sm-7 col-sm-offset-2 col-xs-10 col-xs-offset-1 col-lg-5 col-lg-offset-1" id="logindev">
  					<a class="btn btn-danger btn-lg btn-block mybtn"
                    <?php 
						if($resultNum==1){
        					echo " disabled ";
                        }else {
                        	echo " href='start.php' ";
                        }
                    ?>
                    >开始活动</a>
  					<a href="gift.php" class="btn btn-danger btn-lg btn-block mybtn">礼品领取</a>
  					<a href="change.php" class="btn btn-danger btn-lg btn-block mybtn">修改信息</a>
  					<a href="information.php" class="btn btn-danger btn-lg btn-block mybtn">数据信息</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-lg btn-block mybtn" 
                    <?php 
						if($resultNum==0){
        					echo "disabled";
                        }else {
                        	echo " onclick='stopevent();' ";
                        }
                    ?>>活动结束</a>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>