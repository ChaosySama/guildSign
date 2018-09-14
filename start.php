<?php
	session_start();
	if(!isset($_SESSION['loginId'])){
		echo "<script language='javascript'>";
    	echo " location='manage.html';";
    	echo "</script>"; 
    	exit();
	}
	require_once("common/connectDB.php");
	
	//活动状态验证
	$query="SELECT * FROM checkin_event where flag='1'";
	$result=mysql_query($query,$dbc) or die("信息抓取失败");
	$resultNum=mysql_num_rows($result);
	if($resultNum!=0){
		echo "<script language='javascript'>";
        echo " alert('Event has already started!');";
    	echo " location='main.php';";
    	echo "</script>"; 
    	exit();
    }

	$query2="SELECT * FROM checkin_staff ";
	$result2=mysql_query($query2,$dbc) or die("信息抓取失败");
	$staffnumber=mysql_num_rows($result2);		//所有公会成员数

	$query3="SELECT * FROM checkin_event ORDER BY id DESC";
	$result3=mysql_query($query3,$dbc) or die("信息抓取失败");
	$resultdata=mysql_fetch_array($result3);
	$gAdvice=ceil($resultdata['number']/$staffnumber*100);		//推荐礼品百分比
	$gAdviceNum=ceil($gAdvice/100 * $staffnumber);				//推荐礼品数量

	if(isset($_SESSION['giftNum'])){
		$gNum=trim($_SESSION['giftNum']);
	}
	if(isset($_SESSION['range'])){
		$range=trim($_SESSION['range']);
	}
	mysql_close($dbc);
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>活动设置</title>
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="clockpicker/dist/bootstrap-clockpicker.min.css">
		<link rel="stylesheet" type="text/css" href="clockpicker/assets/css/github.min.css">	
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body id="body-1">
		<nav class="navbar navbar-default navbar-fixed-top mynav">
			<div class="container">
				<ul class="nav nav-pills" style="margin-left:20%;float:left">
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle dropstyle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">功能</a>
						<ul class="dropdown-menu">
							<li><a href="main.php">首页</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="gift.php">礼物领取</a></li>
							<li><a href="change.php">修改信息</a></li>
							<li><a href="information.php">数据信息</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav nav-pills" style="margin-right:20%;float:right">
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle dropstyle" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false" onclick="fresh();">状态</a>
						<ul class="dropdown-menu">
							<li><a>签到人数：<span id="Qnum"></span></a></li>
							<li><a>礼品剩余：<span id="Gnum"></span></a></li>
							<li role="separator" class="divider"></li>
							<li><a>活动状态：<span id="Aflag"></span></a></li>
                            <li><a>开始时间：<span id="aT"></span></a></li>
                            <li><a>结束时间：<span id="oT"></span></a></li>
                            <li><a>当前时间：<span id="nT"></span></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-2 col-lg-5 col-lg-offset-1" id="logindev">
			<form class="form-inline" action="startevent.php" method="post" id="form-1">
  				<div class="form-group" style="width:100%;">
    				<label class="sr-only" for="startTime">开始时间</label>
    				<div class="input-group" style="width:100%;">
      					<div class="input-group-addon">开始时间</div>
      					<div class="input-group clockpicker" data-autoclose="true">
    						<input type="text" class="form-control" id="startTime" name="startTime" value="00:00">
    						<span class="input-group-addon">
        						<span class="glyphicon glyphicon-time"></span>
    						</span>
						</div>
    				</div>
  				</div>
  				<div class="form-group" style="width:100%;">
    				<label class="sr-only" for="stopTime">结束时间</label>
    				<div class="input-group" style="width:100%;">
      					<div class="input-group-addon">结束时间</div>
      					<div class="input-group clockpicker" data-autoclose="true">
    						<input type="text" class="form-control" id="stopTime" name="stopTime" value="00:00">
    						<span class="input-group-addon">
        						<span class="glyphicon glyphicon-time"></span>
    						</span>
						</div>
    				</div>
  				</div>
  				<div class="form-group" style="width:100%;">
    				<label class="sr-only" for="range">范围(米)</label>
    				<div class="input-group" style="width:100%;">
      					<div class="input-group-addon">范围(米)</div>
                        <input type="text" class="form-control input-lg" id="range" placeholder="输入范围" name="range" value="<?php if($range) {echo $range;} else {echo 100;} ?>" onblur="checkstart(this);" required="">
    				</div>
  				</div>
  				<div class="form-group" style="width:100%;">
    				<label class="sr-only" for="giftNum">礼品数量</label>
    				<div class="input-group" style="width:100%;">
      					<div class="input-group-addon">礼品数量</div>
                        <input type="text" class="form-control input-lg" id="giftNum" placeholder="推荐数量为<?php echo $gAdviceNum; ?>" name="giftNum" value="<?php echo $gNum; ?>" onblur="checkstart(this);" required="">
    				</div>
  				</div>
                <input type="hidden" name="latitude" id="latitude" value="">
                <input type="hidden" name="longitude" id="longitude" value="">
  				<button class="btn btn-danger btn-block btn-lg mybtn" id="starte" disabled="disabled">开始活动</button>
			</form>
			</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="clockpicker/dist/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript" src="clockpicker/assets/js/highlight.min.js"></script>
	<script type="text/javascript">
        //时间选择控件
		$('.clockpicker').clockpicker();
        
        //获取经纬度
        function getLocation(){
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(showMap, handleError, {enableHighAccuracy:true, maximumAge:1000});
			}else{
				alert('您的浏览器不支持使用HTML 5来获取地理位置服务');
			}
		}

		function showMap(value){
			var longitude = value.coords.longitude;
			var latitude = value.coords.latitude;
            $('#latitude').val(latitude.toFixed(6));
            $('#longitude').val(longitude.toFixed(6));
        }

		function handleError(value){
			switch(value.code){
				case 1:
					alert('位置服务被拒绝');
					break;
				case 2:
					alert('暂时获取不到位置信息');
					break;
				case 3:
					alert('获取信息超时');
					break;
				case 4:
					alert('未知错误');
				break;
			}
		}
        window.onload = getLocation();
	</script>
</html>