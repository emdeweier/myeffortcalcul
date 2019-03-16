<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
elseif(!isset($_GET['username'])){
  header("location:dataadmin");
}
elseif(!isset($_POST['submit'])){
  header("location:dataadmin");
}
else if($_SESSION['username'] != 'emdeweier'){
  header("location:dataadmin");
}
else {
  $username = $_POST['username'];
	$sql = mysql_query("SELECT * FROM admin WHERE username = '$username'");
	$data = mysql_fetch_array($sql);
  $nama_admin = trim($_POST['nama_admin']);
  $jabatan = $_POST['jabatan'];
  if($nama_admin == ''){
    $nama_admin = $data['nama_admin'];
  }
  else{
    $nama_admin = $nama_admin;
  }
  if($jabatan == ''){
    $jabatan = $data['jabatan'];
  }
  else{
    $nama_admin = $nama_admin;
  }
  $query = mysql_query("UPDATE `admin` SET `nama_admin` = '$nama_admin', `jabatan` = '$jabatan' WHERE username = '$username'");
  $pw = $data['password'];
  $pwlama = trim($_POST['pwlama']);
  $pwbaru = trim($_POST['pwbaru']);
  if($pwbaru != ''){
    $pwlama = md5($pwlama);
    $pwbaru = md5($pwbaru);
    if($pwlama == $pw){
      $query = mysql_query("UPDATE `admin` SET `password` = '$pwbaru' WHERE `username` = '$username'");
    }
    else{
      header("location:./");
    }
  }
  if($query){
    header("location:datasuperadmin");
  }
}
?>
