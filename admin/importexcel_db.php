<?php
include '../koneksi.php';
require '../excel_reader/excel_reader.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
else if(!isset($_POST['submit'])){
  header("location:tambah");
}
else {
  move_uploaded_file($_FILES['file']['tmp_name'], 'p-value.xls');
  $data = new Spreadsheet_Excel_Reader('p-value.xls',false);
  $baris = $data->rowcount($sheet_index=0);
  for ($i=2; $i<=$baris; $i++){
  	$sql = mysql_query("SELECT id_p_value FROM tabel_p_value ORDER BY id_p_value ASC");
  	while($result = mysql_fetch_array($sql)){
      $kode = $result['id_p_value'];
    }
    $id_p_value = $kode+1;
    $p = $data->val($i, 1);
    $nilaip = $data->val($i, 2);
    $n_sampel = $data->val($i, 3);
    $query = mysql_query("INSERT INTO `tabel_p_value` (`id_p_value`,`p`,`nilai_p`,`n_sampel`) VALUES ('$id_p_value','$p','$nilaip','$n_sampel')");
  }
  if($query){
    header("location:datasuperadmin");
  }
  else{
    header("location:./");
  }
}
?>
