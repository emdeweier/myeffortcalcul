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
	$sql = mysql_query("SELECT id_uji_normalitas_s FROM uji_normalitas_s ORDER BY id_uji_normalitas_s ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_uji_normalitas_s'];
  }
  $id_proyek = $_POST['id_proyek'];
  $n_sampel = $_POST['n_sampel'];
  $id_normalitas_s = $kode+1;

  $totalucp = $_POST['total_ucp'];
  $mean_ucp = $_POST['mean_ucp'];
  $b_ucp = $_POST['b_ucp'];
  $ss_ucp = $_POST['ss_ucp'];
  $bpss_ucp = $_POST['bpss_ucp'];
  $p1_ucp = $_POST['p1_ucp'];
  $nilaip1_ucp = $_POST['nilai_p1_ucp'];
  $p2_ucp = $_POST['p2_ucp'];
  $nilaip2_ucp = $_POST['nilai_p2_ucp'];
  $p_value_ucp = $_POST['p_value_ucp'];

  $totaleffort = $_POST['total_effort'];
  $mean_effort = $_POST['mean_effort'];
  $b_effort = $_POST['b_effort'];
  $ss_effort = $_POST['ss_effort'];
  $bpss_effort = $_POST['bpss_effort'];
  $p1_effort = $_POST['p1_effort'];
  $nilaip1_effort = $_POST['nilai_p1_effort'];
  $p2_effort = $_POST['p2_effort'];
  $nilaip2_effort = $_POST['nilai_p2_effort'];
  $p_value_effort = $_POST['p_value_effort'];

  $kesimpulan = $_POST['kesimpulan'];
  $sql1 = mysql_query("SELECT id_temp FROM uji_normalitas_s WHERE id_temp = '$id_proyek' ORDER BY id_temp ASC");
  $query1 = mysql_fetch_array($sql1);
  if($id_proyek != $query1['id_temp']){
    $query1 = mysql_query("INSERT INTO `uji_normalitas_s` (`id_uji_normalitas_s`,`id_temp`,`n_sampel`,`nilai_ucp`,`mean_ucp`,`ss_ucp`,`b_ucp`,`bpss_ucp`,`p1_ucp`,`nilai_p1_ucp`,`p2_ucp`,`nilai_p2_ucp`,
      `p_value_ucp`,`nilai_effort`,`mean_effort`,`ss_effort`,`b_effort`,`bpss_effort`,`p1_effort`,`nilai_p1_effort`,`p2_effort`,`nilai_p2_effort`,`p_value_effort`,`kesimpulan`) VALUES ('$id_normalitas_s','$id_proyek','$n_sampel','$totalucp','$mean_ucp','$ss_ucp','$b_ucp','$bpss_ucp','$p1_ucp','$nilaip1_ucp','$p2_ucp',
        '$nilaip2_ucp','$p_value_ucp','$totaleffort','$mean_effort','$ss_effort','$b_effort','$bpss_effort','$p1_effort','$nilaip1_effort','$p2_effort','$nilaip2_effort','$p_value_effort','$kesimpulan')");
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
