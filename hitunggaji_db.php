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
  $id_durasi = $_POST['id_durasi'];
  $sql = mysql_query("SELECT id_gaji FROM gaji ORDER BY id_gaji ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_gaji'];
  }
  $id_gaji = $kode+1;
  for($i=1;$i<=3;$i++){
    $j = $_POST['jabatan'.$i];
    $q = $_POST['qty'.$i];
    $mh = $_POST['minggu_hari'.$i];
    $jh = $_POST['jam_hari'.$i];
    $jm = $_POST['jam_minggu'.$i];
    $tjm = $_POST['totaljam_minggu'.$i];
    $gj = $_POST['gaji_jam'.$i];
    $tgj = $_POST['total_gaji_jam'.$i];
    $tgo = $_POST['total_gaji_orang'.$i];
    $query4 = mysql_query("INSERT INTO `jabatan` (`id_temp`,`id_gaji`,`jabatan`,`qty`,`jml_hari`,`jam_hari`,`jam_minggu`,`total_jam`,`gaji_perjam`,`gaji`,`gaji_perorang`)
    VALUES ('$id_proyek','$id_gaji','$j','$q','$mh','$jh','$jm','$tjm','$gj','$tgj','$tgo')");
  }
  $tq = $_POST['total_qty'];
  $tjh = $_POST['total_jam_hari'];
  $tjm1 = $_POST['total_jam_minggu1'];
  $tjm2 = $_POST['total_jam_minggu2'];
  $tem = $_POST['total_er_perminggu'];
  $teb = $tem*4;
  $tg1 = $_POST['total_gaji1'];
  $tg2 = $_POST['total_gaji2'];
  $tej = $_POST['total_er_perjam'];
  $query2 = mysql_query("UPDATE `durasi` SET `perbulan` = '$teb', `perminggu` = '$tem' WHERE `id_durasi` = '$id_durasi'");
  $query3 = mysql_query("INSERT INTO `gaji` (`id_gaji`,`id_temp`,`total_qty`,`total_jam_hari`,`total_jam_minggu`,`total_total_jam`,`total_gaji_perjam`,`total_gaji`) VALUES ('$id_gaji','$id_proyek','$tq','$tjh','$tjm1','$tjm2','$tg1','$tg2')");
  if($query3){
    header("location:hasilakhir?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
