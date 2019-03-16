<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
else {
  $id = $_GET['proyek'];
  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id'");
  $data = mysql_fetch_array($query);
  $query1 = mysql_query("SELECT * FROM uji_normalitas_k WHERE id_temp = '$id'");
  $data1 = mysql_fetch_array($query1);
  $query2 = mysql_query("SELECT * FROM uji_normalitas_s WHERE id_temp = '$id'");
  $data2 = mysql_fetch_array($query2);
  $id_proyek = $data['id_temp'];
  if($data === FALSE || $data == NULL){
    header("location:tambah");
  }
  else{
    if($data1 != NULL){
      $query3 = mysql_query("DELETE FROM `uji_normalitas_k` WHERE id_temp = '$id_proyek'");
    }
    elseif($data2 != NULL){
      $query4 = mysql_query("DELETE FROM `uji_normalitas_s` WHERE id_temp = '$id_proyek'");
    }
    else{
      $query5 = mysql_query("DELETE FROM `dataset_proyek` WHERE id_temp = '$id_proyek'");
      if($query5 || $query4 || $query3){
        header("location:importexcel?proyek=$id_proyek");
      }
    }
  }
}
?>
