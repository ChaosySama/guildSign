<?php
	session_start();
  require_once("common/connectDB.php");
  header("Content-type: text/html; charset=utf-8");
  $randname="";
  checkError();
  $ss = new SaeStorage();
  $date = date("Y").date("m").date("d")."/";
  $allowtype = array("csv");
  $arr = explode(".", $_FILES["file"]["name"]);
  $hz = $arr[count($arr) - 1];
  if (!in_array($hz, $allowtype)) {
      echo "<script>alert('不是CSV文件!');location='test.php';</script>";
    exit;
  }
  $randname = date("Y").date("m").date("d").date("H").date("i").date("s").rand(100, 999).".".$hz;
  $filepath="csv/".$date.$randname;
  $ss->upload('staff',$filepath,$_FILES['file']['tmp_name']);
	echo $ss->getUrl("staff",$filepath);//输出文件在storage的访问路径
  $address=$ss->getUrl("staff",$filepath);
  $query="INSERT INTO checkin_csv (fpath,addr) VALUES('$filepath','$address')";
  $status=mysql_query($query,$dbc)or die("Error!");
  echo '<script type="text/javascript">alert("上传成功!");</script>';

  $content1 = file_get_contents($address);
$arr1=explode("\r",$content1);			//$arr1[1]第二行
foreach($arr1 as $r){
	$u=explode(",",$r);					//$u[1]第二个   对象存放为json形式
}
  
  mysql_close($dbc);
  

  function checkError() {
  //step 1 使用$_FILES['pic']["error"] 检查错误
  if ($_FILES["sp_file"]["error"] > 0) {
    switch ($_FILES["sp_file"]["error"]) {
      case 1:
        echo "<script>alert('上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值');location='ordersp.php';</script>";
        break;
      case 2:
        echo "<script>alert('上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值');location='ordersp.php';</script>";
        break;
      case 3:
        echo "<script>alert('文件只有部分被上传');location='ordersp.php';</script>";
        break;
      case 4:
        echo "<script>alert('没有文件被上传');location='ordersp.php';</script>";
        break;
      default:
        echo "<script>alert('末知错误');location='ordersp.php';</script>";
    }
    exit;
  }
};


?>
