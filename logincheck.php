<?php
	require "koneksi.php";
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	$query = mysql_query("SELECT * FROM admin WHERE username = '$user'");
	$data = mysql_fetch_array($query);
	if ($pass == $data['password']) {
		$_SESSION['username'] = $data['username'];
		header("location:admin/");
	}
  else{
		header("location:login");
	}
?>
