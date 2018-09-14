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
		<title>新增公会人员</title>
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
					<div class="form-group" style="width:100%;margin-top:50%;">
    					<label class="sr-only" for="num">工号</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">工号</div>
                            <input type="text" class="form-control input-lg" id="num" placeholder="工号,例:“000000”" name="num" value="" onblur="checknum();" required="" autofocus="">
    					</div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="name">姓名</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">姓名</div>
      						<input type="text" class="form-control input-lg" id="name" placeholder="姓名,例:“王尼玛”" name="name" value="" onblur="checkinfo(this);" required="">
    					</div>
  					</div>
  					<div class="form-group" style="width:100%;">
                        <div class="input-group" style="width:100%;">
      						<div class="input-group-addon">性别</div>
    						<select class="form-control input-lg" id="sex" name="sex">
								<option>男</option>
								<option>女</option>
							</select>
                        </div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="nation">民族</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">民族</div>
      						<input type="text" class="form-control input-lg" id="nation" placeholder="民族,例:“汉”" name="nation" value="" onblur="checkinfo(this);" required="">
    					</div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">部门</div>
    						<select class="form-control input-lg" id="department" name="department">
								<option>1-1</option>
								<option>1-2</option>
								<option>1-3</option>
								<option>1-4</option>
                                <option>2-1</option>
								<option>2-2</option>
								<option>2-3</option>
								<option>2-4</option>
                                <option>3-1</option>
								<option>3-2</option>
								<option>3-3</option>
								<option>3-4</option>
							</select>
                        </div>
  					</div>
  					<div class="form-group" style="width:100%;">
                        <div class="input-group" style="width:100%;">
      						<div class="input-group-addon">职位</div>
    						<select class="form-control input-lg" id="duty" name="duty">
								<option>员工</option>
								<option>主任</option>
								<option>课长</option>
								<option>部长</option>
							</select>
                        </div>
  					</div>
  					<div class="form-group" style="width:100%;">
    					<label class="sr-only" for="fee">会费</label>
    					<div class="input-group" style="width:100%;">
      						<div class="input-group-addon">会费</div>
      						<input type="text" class="form-control input-lg" id="fee" placeholder="会费,例:“5”" name="fee" value="" onblur="checkinfo(this);" required="">
    					</div>
  					</div>
  					<button class="btn btn-danger btn-lg btn-block" id="substaff" disabled="disabled">新增</button>
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