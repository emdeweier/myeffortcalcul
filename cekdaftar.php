<?php
	require "koneksi.php";
	$nim1 = $_POST['nim_pengguna'];
	$pass1 = md5($_POST['password']);
	$query1 = mysql_query("SELECT * FROM pengguna WHERE nim = '$nim1'");
	$data1 = mysql_fetch_array($query1);
  $tgl = date("Y-m-d");
	if ($nim1 != $data1['nim']) {
	  $query2 = mysql_query("INSERT INTO `pengguna` (`nim`,`password`,`tgl_join`) VALUES ('$nim1','$pass1','$tgl')");
		header("location:masuk");
	}
	else{
		header("location:masuk");
	}
?>
