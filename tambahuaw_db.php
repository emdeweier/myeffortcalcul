<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
else if(!isset($_POST['submit'])){
  header("location:tambah");
}
else {
	$sql = mysql_query("SELECT id_uaw FROM uaw ORDER BY id_uaw ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uaw'];
  }
  $id_proyek = $_POST['id_proyek'];
  $id_uaw = $kode+1;
  $simpel = $_POST['hasil_simpel'];
  $medium = $_POST['hasil_medium'];
  $complex = $_POST['hasil_complex'];
  $uaw = $_POST['hasil_uaw'];
  $query1 = mysql_query("UPDATE `temp_proyek`  SET `uaw` = '$uaw' WHERE `id_temp` = '$id_proyek'");
  $query2 = mysql_query("INSERT INTO `uaw` (`id_uaw`,`id_temp`,`simple`,`medium`,`complex`,`total`) VALUES ('$id_uaw','$id_proyek','$simpel','$medium','$complex','$uaw')");
  if($query1 && $query2){
    header("location:tambahuucw?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
