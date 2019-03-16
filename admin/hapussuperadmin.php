<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
elseif(!isset($_GET['username'])){
  header("location:datasuperadmin");
}
$username = $_GET['username'];
if($username == 'emdeweier'){
  header("location:datasuperadmin");
}
else if($_SESSION['username'] != 'emdeweier'){
  header("location:dataadmin");
}
else{
$sql = mysql_query("SELECT * FROM admin WHERE username = '$username' AND level_admin = 'super'");
$data = mysql_fetch_array($sql);
if ($username != $data['username']) {
  header("location:datasuperadmin");
}
else {
  $query = mysql_query("DELETE FROM `admin` WHERE username = '$username' AND level_admin = 'super'");
  if($query){
    header("location:datasuperadmin");
  }
}
}
?>
