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
  $id_pengguna = $_SESSION['nim'];
	$sql = mysql_query("SELECT id_temp FROM temp_proyek ORDER BY id_temp ASC");
	while($result = mysql_fetch_array($sql)){
    $kode = $result['id_temp'];
  }
  $nama_proyek = $_POST['nama_proyek'];
  $nama_pembuat = $_POST['pembuat'];
  $tgl = date("Y-m-d");
  $jam = date("H:i:s");
  $id_proyek = $kode+1;
  $effort = $_POST['effort'];
  if($effort == 'tidak'){
    $query1 = mysql_query("INSERT INTO `temp_proyek` (`id_temp`,`nama_proyek`,`nim`,`effort_rate`,`create_date`) VALUES ('$id_proyek','$nama_proyek','$id_pengguna','20','$tgl $jam')");
    if($query1){
      header("location:tambahuaw?proyek=$id_proyek");
    }
    else{
      header("location:./");
    }
  }
  else{
    $query1 = mysql_query("INSERT INTO `temp_proyek` (`id_temp`,`nama_proyek`,`nim`,`effort_rate`,`create_date`) VALUES ('$id_proyek','$nama_proyek','$id_pengguna','0','$tgl $jam')");
    if($query1){
      header("location:importexcel?proyek=$id_proyek");
    }
    else{
      header("location:./");
    }
  }
}
?>
