<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	if(!isset($_SESSION['nim'])){
	  header("location:./");
	}
	else{
	$tgl = date("Y-m-d");
  $jam = date("H:i:s");
	$id_pengguna = $_SESSION['nim'];
	$query = mysql_query("UPDATE `pengguna` SET `last_login` = '$tgl $jam' WHERE nim = '$id_pengguna'");
	if($query){
	unset($_SESSION['nim']);
	session_destroy();
	header('location:./');
	}
	}
?>
