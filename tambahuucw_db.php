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
  $id_proyek = $_POST['id_proyek'];
  $simpel = $_POST['hasil_simpel'];
  $medium = $_POST['hasil_medium'];
  $complex = $_POST['hasil_complex'];
  $sql = mysql_query("SELECT id_uucw FROM uucw ORDER BY id_uucw ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uucw'];
  }
  $id_uucw = $kode+1;
  $query1 = mysql_query("SELECT uaw FROM `temp_proyek`  WHERE `id_temp` = '$id_proyek'");
  $result = mysql_fetch_array($query1);
  $uaw = $result['uaw'];
  $uucw = $_POST['hasil_uucw'];
  $uucp = $uaw+$uucw;
  $query1 = mysql_query("UPDATE `temp_proyek`  SET `uucw` = '$uucw', `uucp` = '$uucp' WHERE `id_temp` = '$id_proyek'");
  $query2 = mysql_query("INSERT INTO `uucw` (`id_uucw`,`id_temp`,`simple`,`medium`,`complex`,`total`) VALUES ('$id_uucw','$id_proyek','$simpel','$medium','$complex','$uucw')");
  $total = $_POST['total_trx'];
  for($i=1;$i<=$total;$i++){
    $nameuc = $_POST['nameuc_'.$i];
    $trxuc = $_POST['transaksi_'.$i];
    $query1 = mysql_query("INSERT INTO `sub_uucw` (`id_uucw`,`use_case`,`transaksi`) VALUES ('$id_uucw','$nameuc','$trxuc')");
  }
  if($query1 && $query2){
    header("location:tambahtcf?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
