<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
elseif(!isset($_GET['username'])){
  header("location:dataadmin");
}
$username = $_GET['username'];
$sql = mysql_query("SELECT * FROM admin WHERE username = '$username' AND level_admin = 'admin'");
$data = mysql_fetch_array($sql);
if ($username != $data['username']) {
  header("location:dataadmin");
}
else {
  $query = mysql_query("DELETE FROM `admin` WHERE username = '$username' AND level_admin = 'admin'");
  if($query){
    header("location:dataadmin");
  }
}
?>
