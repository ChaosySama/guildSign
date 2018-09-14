<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	if(!isset($_SESSION['loginId'])){
		echo "<script language='javascript'>";
    	echo " location='manage.html';";
    	echo "</script>"; 
    	exit();
	}
	$manageid=$_POST['staffNum'];
	require_once("common/connectDB.php");
	$query0="SELECT * FROM checkin_manage where id='$manageid'";
	$result0=mysql_query($query0,$dbc) or die("信息抓取失败");
	$resultNum=mysql_num_rows($result0);
	if($resultNum!=1){
		echo "<script language='javascript'>";
        echo " alert('工号错误');";
        echo " location='change.php';";
    	echo "</script>"; 
    	exit();
    }
	$rs=mysql_fetch_array($result0);
	mysql_close($dbc);
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>修改管理人员密码</title>
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
				<div class="col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-2 col-lg-5 col-lg-offset-1 " id="logindev">
					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="num">工号</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">工号</div>
      						<input type="text" class="form-control input-lg" id="num" placeholder="工号显示" name="num" value="<?php echo $manageid; ?>" required="" disabled>
    					</div>
  					</div>
                    <div class="form-group" style="width:100%;">
    					<label class="sr-only" for="lastPw">原密码</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">原密码</div>
      						<input type="password" class="form-control input-lg" id="lastPw" placeholder="输入原密码" name="lastPw" onblur="checkpwnum(this);" required="" autofocus="">
    					</div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="newPw">新密码</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">新密码</div>
      						<input type="password" class="form-control input-lg" id="newPw" placeholder="输入新密码" name="newPw" onblur="checkpwnum(this);" required="">
    					</div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="confirmPw">确认密码</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">确认密码</div>
      						<input type="password" class="form-control input-lg" id="confirmPw" placeholder="输入确认密码" name="confirmPw" onblur="checkpw();" required="">
    					</div>
  					</div>
  					<button class="btn btn-danger btn-lg btn-block"  id="subpw" disabled="disabled">提交</button>
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