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
	$sql = mysql_query("SELECT id_ef FROM ef ORDER BY id_ef ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_ef'];
  }
  $sql1 = mysql_query("SELECT id_durasi FROM durasi ORDER BY id_durasi ASC");
	while($result1 = mysql_fetch_array($sql1)){
    $kode1 = $result1['id_durasi'];
  }
  $id_ef = $kode+1;
  $id_durasi = $kode1+1;
  $id_proyek = $_POST['id_proyek'];
  $ef = $_POST['hasil_ef'];
  $ef = number_format($ef,1);
  $rmse = $_POST['hasil_rmse'];
  $rmse = number_format($rmse,3);
  $query1 = mysql_query("SELECT uucp,tcf,effort_rate FROM `temp_proyek`  WHERE `id_temp` = '$id_proyek'");
  $result = mysql_fetch_array($query1);
  $uucp = $result['uucp'];
  $tcf = $result['tcf'];
  $er = $result['effort_rate'];
  $ucp = $uucp*$tcf*$rmse;
  $ucp = number_format($ucp,3);
  $jam = $er*$ucp;
  $e1 = $_POST['e1'];
  $e2 = $_POST['e2'];
  $e3 = $_POST['e3'];
  $e4 = $_POST['e4'];
  $e5 = $_POST['e5'];
  $e6 = $_POST['e6'];
  $e7 = $_POST['e7'];
  $e8 = $_POST['e8'];
  $query1 = mysql_query("UPDATE `temp_proyek`  SET `ef` = '$rmse', `ucp` = '$ucp' WHERE `id_temp` = '$id_proyek'");
  $query2 = mysql_query("INSERT INTO `ef` (`id_ef`,`id_temp`,`e1`,`e2`,`e3`,`e4`,`e5`,`e6`,`e7`,`e8`,`total`,`rumus`)
  VALUES ('$id_ef','$id_proyek','$e1','$e2','$e3','$e4','$e5','$e6','$e7','$e8','$ef','$rmse')");
  $query3 = mysql_query("INSERT INTO `durasi` (`id_durasi`,`id_temp`,`perjam`) VALUES ('$id_durasi','$id_proyek','$jam')");
  if($query1){
    header("location:hitunggaji?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
