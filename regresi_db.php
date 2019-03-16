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
	$sql = mysql_query("SELECT id_uji_regresi FROM uji_regresi ORDER BY id_uji_regresi ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uji_regresi'];
  }
  $id_proyek = $_POST['id_proyek'];
  $id_regresi = $kode+1;
  $nilaif = $_POST['nilai_f'];
  $ucp1 = $_POST['ucp1'];
  $effort1 = $_POST['effort1'];
  $ucp2 = $_POST['ucp2'];
  $effort2 = $_POST['effort2'];
  $selisihucp = $_POST['selisihucp'];
  $selisiheffort = $_POST['selisiheffort'];
  $effort_rate = $_POST['effort_rate'];
  $sql1 = mysql_query("SELECT id_temp FROM uji_regresi WHERE id_temp = '$id_proyek' ORDER BY id_temp ASC");
  $query1 = mysql_fetch_array($sql1);
  if($id_proyek != $query1['id_temp']){
    $query1 = mysql_query("INSERT INTO `uji_regresi` (`id_uji_regresi`,`id_temp`,`nilai_f`,`ucp1`,`effort1`,`ucp2`,`effort2`,`selisiheffort`,`selisihucp`,`effort_rate`)
    VALUES ('$id_regresi','$id_proyek','$nilaif','$ucp1','$effort1','$ucp2','$effort2','$selisihucp','$selisiheffort','$effort_rate')");
    $query2 = mysql_query("UPDATE `temp_proyek`  SET `effort_rate` = '$effort_rate' WHERE `id_temp` = '$id_proyek'");
    if($query1 && $query2){
      header("location:tambahuaw?proyek=$id_proyek");
    }
    else{
      header("location:./");
    }
  }
  else{
    header("location:tambahuaw?proyek=$id_proyek");
  }
}
?>
