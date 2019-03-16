<?php
	require "koneksi.php";
	$nim1 = $_POST['nim_pengguna'];
	$pass1 = md5($_POST['password']);
	$query1 = mysql_query("SELECT * FROM pengguna WHERE nim = '$nim1' AND password = '$pass1'");
	$data1 = mysql_fetch_array($query1);
	if ($nim1 == $data1['nim']) {
		$_SESSION['nim'] = $data1['nim'];
		header("location:./");
	}
	else{
		header("location:masuk");
	}
?>
