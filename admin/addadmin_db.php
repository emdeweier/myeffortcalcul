<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
elseif(!isset($_POST['submit'])){
  header("location:addadmin");
}
$id = $_SESSION['username'];
$sql = mysql_query("SELECT * FROM admin WHERE username = '$id'");
$data = mysql_fetch_array($sql);
$level = $data['level_admin'];
if($level != 'super'){
  header("location:./");
}
else {
  $username = trim($_POST['username']);
  $sql = mysql_query("SELECT * FROM admin WHERE username = '$username'");
  $data = mysql_fetch_array($sql);
  if($username != $data['username'] && $username != ''){
    $nama_admin = trim($_POST['nama_admin']);
    $jabatan = trim($_POST['jabatan']);
    $pw = trim($_POST['password']);
    $level = $_POST['level_admin'];
    $tgl = date("Y-m-d");
    if($pw != ''){
      $pw = md5($pw);
      $query2 = mysql_query("INSERT INTO `admin` (`username`,`nama_admin`,`jabatan`,`password`,`level_admin`,`tgl_gabung`) VALUES ('$username','$nama_admin','$jabatan','$pw','$level','$tgl')");
      if($query2 && $level == 'admin'){
        header("location:dataadmin");
      }
      else if($query2 && $level == 'super'){
        header("location:datasuperadmin");
      }
      else{
        header("location:./");
      }
    }
    else{
      header("location:./");
    }
  }
  else{
    header("location:addadmin");
  }
}
?>
