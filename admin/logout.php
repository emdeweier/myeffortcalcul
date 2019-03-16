<?php
	include '../koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	if(!isset($_SESSION['username'])){
	  header("location:../masuk");
	}
	else{
	$tgl = date("Y-m-d");
  $jam = date("H:i:s");
	$username = $_SESSION['username'];
	$query = mysql_query("UPDATE `admin` SET `last_login` = '$tgl $jam' WHERE username = '$username'");
	if($query){
	unset($_SESSION['username']);
	session_destroy();
	header('location:../');
	}
	}
?>
