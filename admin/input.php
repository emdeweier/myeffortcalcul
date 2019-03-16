<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
elseif(!isset($_POST['submit'])){
  header("location:tambah");
}
else {
	$sql = mysql_query("SELECT COUNT(*) FROM proyek_lama");
	$result = mysql_fetch_array($sql);
  $nomor = $result['COUNT(*)'];
  $nama_proyek = $_POST['nama_proyek'];
  $effort_aktual = $_POST['effort_aktual'];
  $ucp = $_POST['ucp'];
  $kode = $nomor+1;
  $query1 = mysql_query("INSERT INTO `proyek_lama` (`kode_proyek`,`nama_proyek`,`effort_aktual`,`ucp`) VALUES ('$kode','$nama_proyek','$effort_aktual','$ucp')");
  if($query1){
    header("location:coba");
  }
}
?>
