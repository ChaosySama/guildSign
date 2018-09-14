<?php
	session_start();
	if(!isset($_SESSION['loginId'])){
		echo "<script language='javascript'>";
    	echo " location='manage.html';";
    	echo "</script>"; 
    	exit();
	}
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>修改信息</title>
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">	
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
				<div class="col-md-5 col-md-offset-3 col-sm-7 col-sm-offset-2 col-xs-10 col-xs-offset-1 col-lg-5 col-lg-offset-1" id="logindev">
                    <form action="#" id="subform" method="post" >
					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="staffNum">输入工号</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">工号</div>
      						<input type="text" class="form-control input-lg" id="staffNum" placeholder="输入工号" name="staffNum" required="" autofocus="" oninput="checkid();">
    					</div>
  					</div>
                    <a href="javascript:void(0)" id="changemanage" disabled="disabled" class="btn btn-danger btn-lg btn-block mybtn">修改管理人员密码</a>
                    <a href="javascript:void(0)" id="changestaff" disabled="disabled" class="btn btn-danger btn-lg btn-block mybtn">修改工会人员信息</a>
                    </form>
  					<a href="addStaff.php" class="btn btn-danger btn-lg btn-block mybtn">新增工会人员</a>
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