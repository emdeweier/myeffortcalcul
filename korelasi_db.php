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
	$sql = mysql_query("SELECT id_uji_korelasi FROM uji_korelasi ORDER BY id_uji_korelasi ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uji_korelasi'];
  }
  $id_proyek = $_POST['id_proyek'];
  $multipler = $_POST['multiple_r'];
  $id_korelasi = $kode+1;
  $rsquare = $_POST['r_square'];
  $keterangan = $_POST['keterangan'];
  $sql1 = mysql_query("SELECT id_temp FROM uji_korelasi WHERE id_temp = '$id_proyek' ORDER BY id_temp ASC");
  $query1 = mysql_fetch_array($sql1);
  if($id_proyek != $query1['id_temp']){
    $query1 = mysql_query("INSERT INTO `uji_korelasi` (`id_uji_korelasi`,`id_temp`,`multiple_r`,`r_square`,`keterangan`) VALUES ('$id_korelasi','$id_proyek','$multipler','$rsquare','$keterangan')");
    if($query1){
      header("location:regresi?proyek=$id_proyek");
    }
    else{
      header("location:./");
    }
  }
  else{
    header("location:regresi?proyek=$id_proyek");
  }
}
?>
