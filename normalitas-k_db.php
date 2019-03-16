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
	$sql = mysql_query("SELECT id_uji_normalitas FROM uji_normalitas ORDER BY id_uji_normalitas ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uji_normalitas'];
  }
  $id_proyek = $_POST['id_proyek'];
  $n_sampel = $_POST['n_sampel'];
  $id_normalitas = $kode+1;
  $mean = $_POST['mean'];
  $simpangan_baku = $_POST['simpangan_baku'];
  $dn = $_POST['dn'];
  $kstabel = $_POST['kstabel'];
  $kesimpulan = $_POST['kesimpulan'];
  $sql1 = mysql_query("SELECT id_temp FROM uji_normalitas WHERE id_temp = '$id_proyek' ORDER BY id_temp ASC");
  $query1 = mysql_fetch_array($sql1);
  if($id_proyek != $query1['id_temp']){
    $query1 = mysql_query("INSERT INTO `uji_normalitas` (`id_uji_normalitas`,`id_temp`,`n_sampel`,`mean`,`simpangan_baku`,`dn`,`ks_tabel`,`kesimpulan`) VALUES ('$id_normalitas','$id_proyek','$n_sampel','$mean','$simpangan_baku','$dn','$kstabel','$kesimpulan')");
    if($query1){
      header("location:korelasi?proyek=$id_proyek");
    }
    else{
      header("location:./");
    }
  }
  else{
    header("location:korelasi?proyek=$id_proyek");
  }
}
?>
