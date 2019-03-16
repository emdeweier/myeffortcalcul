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
	$sql = mysql_query("SELECT id_tcf FROM tcf ORDER BY id_tcf ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_tcf'];
  }
  $id_tcf = $kode+1;
  $id_proyek = $_POST['id_proyek'];
  $tcf = $_POST['hasil_tcf'];
  $tcf = number_format($tcf,1);
  $rms = $_POST['hasil_rms'];
  $rms = number_format($rms,3);
  $t1 = $_POST['t1'];
  $t2 = $_POST['t2'];
  $t3 = $_POST['t3'];
  $t4 = $_POST['t4'];
  $t5 = $_POST['t5'];
  $t6 = $_POST['t6'];
  $t7 = $_POST['t7'];
  $t8 = $_POST['t8'];
  $t9 = $_POST['t9'];
  $t10 = $_POST['t10'];
  $t11 = $_POST['t11'];
  $t12 = $_POST['t12'];
  $t13 = $_POST['t13'];
  $query1 = mysql_query("UPDATE `temp_proyek` SET `tcf` = '$rms' WHERE `id_temp` = '$id_proyek'");
  $query2 = mysql_query("INSERT INTO `tcf` (`id_tcf`,`id_temp`,`t1`,`t2`,`t3`,`t4`,`t5`,`t6`,`t7`,`t8`,`t9`,`t10`,`t11`,`t12`,`t13`,`total`,`rumus`)
  VALUES ('$id_tcf','$id_proyek','$t1','$t2','$t3','$t4','$t5','$t6','$t7','$t8','$t9','$t10','$t11','$t12','$t13','$tcf','$rms')");
  if($query1){
    header("location:tambahef?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
