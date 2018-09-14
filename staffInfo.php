<?php
  session_start();
  header("Content-type: text/html; charset=utf-8");
  if(!isset($_SESSION['loginId'])){
    echo "<script language='javascript'>";
      echo " location='manage.html';";
      echo "</script>"; 
      exit();
  }
  require_once("common/connectDB.php");
  $query="SELECT * FROM checkin_staff ORDER by id";
  $result=mysql_query($query,$dbc) or die("信息抓取失败");
  mysql_close($dbc);
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=0.4, maximum-scale=1, user-scalable=0">
    <title>人员信息一览</title>
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
                <div style="position: relative;margin: 0 auto;margin-top: 20%;">
                    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>"   method="POST">
            <button class="btn btn-danger btn-lg mybtn" type="submit" name="all">所有人员</button>
            <button class="btn btn-warning btn-lg mybtn" type="submit" name="sign0">未签到</button>
            <button class="btn btn-success btn-lg mybtn" type="submit" name="sign1">已签到</button>
                        <button class="btn btn-info btn-lg mybtn" type="submit" name="gift1">已领取礼品</button>
            <button class="btn btn-primary btn-lg mybtn" type="submit" name="gift2">待补发礼品</button>
          </form>
                    <table class="table table-hover" style="background-color:white;">
                        <thead>
                      <tr>
                          <th>工号</th>
                          <th>姓名</th>
                          <th>性别</th>
                          <th>民族</th>
                          <th>部门</th>
                          <th>职位</th>
                                <th>会费</th>
                                <th>入会时间</th>
                                <th>签到状态</th>
                                <th>礼品状态</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                <?php 
            if(!isset($_POST['sign0']) && !isset($_POST['sign1']) && !isset($_POST['gift1']) && !isset($_POST['gift2'])){
                      while($userdata=mysql_fetch_array($result)){
                        echo '<tr>';
                        echo '<td>'. $userdata['id'] . '</td>';
                        echo '<td>'. $userdata['name'] . '</td>';
                        echo '<td>'. $userdata['sex'] . '</td>';
                        echo '<td>'. $userdata['nation'] . '</td>';
                        echo '<td>'. $userdata['department'] . '</td>';
                        echo '<td>'. $userdata['duty'] . '</td>';
                            echo '<td>'. $userdata['fee'] . '</td>';
                            echo '<td>'. $userdata['registtime'] . '</td>';
                            echo '<td>';
                            if($userdata['signin']==1){
                              echo "已签到";
                            }else{
                              echo "未签到";
                            }
                            echo '</td>';
                            echo '<td>';
                            if($userdata['gift']==0){
                              echo "未验证";
                            }else if($userdata['gift']==1){
                              echo "已领取礼品";
                            }else{
                              echo "礼品不足，待补发";
                            }
                            echo '</td>';
                        echo '</tr>';
                      }
                        }
            if(isset($_POST['sign0'])){
                          while($userdata=mysql_fetch_array($result)){
                                if($userdata['signin']==0){
                          echo '<tr>';
                          echo '<td>'. $userdata['id'] . '</td>';
                          echo '<td>'. $userdata['name'] . '</td>';
                          echo '<td>'. $userdata['sex'] . '</td>';
                          echo '<td>'. $userdata['nation'] . '</td>';
                          echo '<td>'. $userdata['department'] . '</td>';
                          echo '<td>'. $userdata['duty'] . '</td>';
                              echo '<td>'. $userdata['fee'] . '</td>';
                              echo '<td>'. $userdata['registtime'] . '</td>';
                              echo '<td>未签到</td>';
                              echo '<td>';
                              if($userdata['gift']==0){
                                echo "未验证";
                              }else if($userdata['gift']==1){
                                echo "已领取礼品";
                              }else{
                                echo "礼品不足，待补发";
                              }
                              echo '</td>';
                          echo '</tr>';
                                }
                      }
                        }
            if(isset($_POST['sign1'])){
                          while($userdata=mysql_fetch_array($result)){
                                if($userdata['signin']==1){
                          echo '<tr>';
                          echo '<td>'. $userdata['id'] . '</td>';
                          echo '<td>'. $userdata['name'] . '</td>';
                          echo '<td>'. $userdata['sex'] . '</td>';
                          echo '<td>'. $userdata['nation'] . '</td>';
                          echo '<td>'. $userdata['department'] . '</td>';
                          echo '<td>'. $userdata['duty'] . '</td>';
                              echo '<td>'. $userdata['fee'] . '</td>';
                              echo '<td>'. $userdata['registtime'] . '</td>';
                              echo '<td>已签到</td>';
                              echo '<td>';
                              if($userdata['gift']==0){
                                echo "未验证";
                              }else if($userdata['gift']==1){
                                echo "已领取礼品";
                              }else{
                                echo "礼品不足，待补发";
                              }
                              echo '</td>';
                          echo '</tr>';
                                }
                      }
                        }
            if(isset($_POST['gift1'])){
                          while($userdata=mysql_fetch_array($result)){
                                if($userdata['gift']==1){
                          echo '<tr>';
                          echo '<td>'. $userdata['id'] . '</td>';
                          echo '<td>'. $userdata['name'] . '</td>';
                          echo '<td>'. $userdata['sex'] . '</td>';
                          echo '<td>'. $userdata['nation'] . '</td>';
                          echo '<td>'. $userdata['department'] . '</td>';
                          echo '<td>'. $userdata['duty'] . '</td>';
                              echo '<td>'. $userdata['fee'] . '</td>';
                              echo '<td>'. $userdata['registtime'] . '</td>';
                              echo '<td>';
                              if($userdata['signin']==1){
                                echo "已签到";
                              }else{
                                echo "未签到";
                              }
                              echo '</td>';
                              echo '<td>已领取礼品</td>';
                          echo '</tr>';
                                }
                      }
                        }
            if(isset($_POST['gift2'])){
                          while($userdata=mysql_fetch_array($result)){
                                if($userdata['gift']==2){
                          echo '<tr>';
                          echo '<td>'. $userdata['id'] . '</td>';
                          echo '<td>'. $userdata['name'] . '</td>';
                          echo '<td>'. $userdata['sex'] . '</td>';
                          echo '<td>'. $userdata['nation'] . '</td>';
                          echo '<td>'. $userdata['department'] . '</td>';
                          echo '<td>'. $userdata['duty'] . '</td>';
                              echo '<td>'. $userdata['fee'] . '</td>';
                              echo '<td>'. $userdata['registtime'] . '</td>';
                              echo '<td>';
                              if($userdata['signin']==1){
                                echo "已签到";
                              }else{
                                echo "未签到";
                              }
                              echo '</td>';
                              echo '<td>礼品不足，待补发</td>';
                          echo '</tr>';
                                }
                      }
                        }
                ?>
                    </tbody>
          </table>
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