<?php
include 'koneksi.php';
require 'excel_reader/excel_reader.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
else if(!isset($_POST['submit'])){
  header("location:tambah");
}
else {
  $id_proyek = $_POST['id_temp'];
  move_uploaded_file($_FILES['file']['tmp_name'], 'file/excel-ucp-'.$id_proyek.'.xls');
  $data = new Spreadsheet_Excel_Reader('file/excel-ucp-'.$id_proyek.'.xls',false);
  $baris = $data->rowcount($sheet_index=0);
  for ($i=2; $i<=$baris; $i++){
  	$sql = mysql_query("SELECT id_dataset FROM dataset_proyek ORDER BY id_dataset ASC");
  	while($result = mysql_fetch_array($sql)){
      $kode = $result['id_dataset'];
    }
    $id_dataset = $kode+1;
    $kategori = $data->val($i, 1);
    $effort_aktual = $data->val($i, 2);
    $ucp_effort = $data->val($i, 3);
    $query = mysql_query("INSERT INTO `dataset_proyek` (`id_dataset`,`id_temp`,`kategori_proyek`,`effort_aktual`,`ucp`) VALUES ('$id_dataset','$id_proyek','$kategori','$effort_aktual','$ucp_effort')");
  }
  if($query){
    header("location:infoproyek?proyek=$id_proyek");
  }
  else{
    header("location:./");
  }
}
?>
