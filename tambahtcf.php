<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$query1 = mysql_query("SELECT * FROM tcf,temp_proyek WHERE tcf.id_temp = temp_proyek.id_temp AND tcf.id_temp = '$id'");
$data1 = mysql_fetch_array($query1);
$id_proyek = $data['id_temp'];
if($data === FALSE || $data1 != NULL){
  header("location:tambah");
}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="hold-transition skin-blue-light sidebar-mini fixed">
<script type="text/javascript">
var hasil = 0;
var hasil2 = 0;
var x;
function hitung_t1(nilai_t1){
  document.getElementById("hasil_t1").value = 2*nilai_t1;
  hitung_total();
}
function hitung_t2(nilai_t2){
  document.getElementById("hasil_t2").value = 1*nilai_t2;
  hitung_total();
}
function hitung_t3(nilai_t3){
  document.getElementById("hasil_t3").value = 1*nilai_t3;
  hitung_total();
}
function hitung_t4(nilai_t4){
  document.getElementById("hasil_t4").value = 1*nilai_t4;
  hitung_total();
}
function hitung_t5(nilai_t5){
  document.getElementById("hasil_t5").value = 1*nilai_t5;
  hitung_total();
}
function hitung_t6(nilai_t6){
  document.getElementById("hasil_t6").value = 0.5*nilai_t6;
  hitung_total();
}
function hitung_t7(nilai_t7){
  document.getElementById("hasil_t7").value = 0.5*nilai_t7;
  hitung_total();
}
function hitung_t8(nilai_t8){
  document.getElementById("hasil_t8").value = 2*nilai_t8;
  hitung_total();
}
function hitung_t9(nilai_t9){
  document.getElementById("hasil_t9").value = 1*nilai_t9;
  hitung_total();
}
function hitung_t10(nilai_t10){
  document.getElementById("hasil_t10").value = 1*nilai_t10;
  hitung_total();
}
function hitung_t11(nilai_t11){
  document.getElementById("hasil_t11").value = 1*nilai_t11;
  hitung_total();
}
function hitung_t12(nilai_t12){
  document.getElementById("hasil_t12").value = 1*nilai_t12;
  hitung_total();
}
function hitung_t13(nilai_t13){
  document.getElementById("hasil_t13").value = 1*nilai_t13;
  hitung_total();
}
function hitung_total(){
  if(isNaN(parseInt(document.getElementById("hasil_t1").value))) n1 = 0;
  else n1 = parseFloat(document.getElementById("hasil_t1").value);
  if(isNaN(parseInt(document.getElementById("hasil_t2").value))) n2 = 0;
  else n2 = parseFloat(document.getElementById("hasil_t2").value);
  if(isNaN(parseInt(document.getElementById("hasil_t3").value))) n3 = 0;
  else n3 = parseFloat(document.getElementById("hasil_t3").value);
  if(isNaN(parseInt(document.getElementById("hasil_t4").value))) n4 = 0;
  else n4 = parseFloat(document.getElementById("hasil_t4").value);
  if(isNaN(parseInt(document.getElementById("hasil_t5").value))) n5 = 0;
  else n5 = parseFloat(document.getElementById("hasil_t5").value);
  if(isNaN(parseInt(document.getElementById("hasil_t6").value))) n6 = 0;
  else n6 = parseFloat(document.getElementById("hasil_t6").value);
  if(isNaN(parseInt(document.getElementById("hasil_t7").value))) n7 = 0;
  else n7 = parseFloat(document.getElementById("hasil_t7").value);
  if(isNaN(parseInt(document.getElementById("hasil_t8").value))) n8 = 0;
  else n8 = parseFloat(document.getElementById("hasil_t8").value);
  if(isNaN(parseInt(document.getElementById("hasil_t9").value))) n9 = 0;
  else n9 = parseFloat(document.getElementById("hasil_t9").value);
  if(isNaN(parseInt(document.getElementById("hasil_t10").value))) n10 = 0;
  else n10 = parseFloat(document.getElementById("hasil_t10").value);
  if(isNaN(parseInt(document.getElementById("hasil_t11").value))) n11 = 0;
  else n11 = parseFloat(document.getElementById("hasil_t11").value);
  if(isNaN(parseInt(document.getElementById("hasil_t12").value))) n12 = 0;
  else n12 = parseFloat(document.getElementById("hasil_t12").value);
  if(isNaN(parseInt(document.getElementById("hasil_t13").value))) n13 = 0;
  else n13 = parseFloat(document.getElementById("hasil_t13").value);
  jumlah = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10 + n11 + n12 + n13;
  document.getElementById("hasil_tcf").value = jumlah.toFixed(1);
  document.getElementById("hasil_rms").value = (0.6 + (jumlah*0.01)).toFixed(3);
}
   </script>
<div class="wrapper">

  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Technical Complexity Factor
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Tambah Technical Complexity Factor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Technical Complexity Factor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambahtcf_db" method="post">
                <div class="box-body">
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                      <label for="no">No.</label>
                      <p>T1</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <label for="tf">Technical Factor</label>
                      <p>Sistem terdistribusi</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="bobot">Bobot</label>
                      <input type="text" name="bobot_t1" class="form-control" value="2" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <label for="nilai">Alasan</label>
                      <select class="form-control select2" id="nilai_t1" onchange="hitung_t1(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada transfer data</option>
                        <option value="1">Menyiapkan data untuk komponen lain</option>
                        <option value="2">Data disiapkan dan kemudian ditransfer</option>
                        <option value="3">Jika transfer data online satu arah</option>
                        <option value="4">Jika transfer data online di kedua arah</option>
                        <option value="5">Jika pemrosesan dinamis</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="hasil">Hasil</label>
                      <input type="text" name="t1" class="form-control" id="hasil_t1" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T2</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Waktu respons atau hasil sasaran kinerja</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t2" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t2" onchange="hitung_t2(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada persyaratan</option>
                        <option value="1">Tidak ada perhatian khusus terhadap waktu respons atau hasil</option>
                        <option value="2">Jika waktu respons dan hasil kritis pada waktu puncak</option>
                        <option value="3">Jika waktu respons dan hasil penting selama jam kerja</option>
                        <option value="4">Jika persyaratan kinerja pengguna ketat dan memerlukan analisis kinerja dalam fase desain</option>
                        <option value="5">Jika alat analisis kinerja diperlukan dalam fase desain, pengembangan, dan implementasi</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t2" class="form-control" id="hasil_t2" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T3</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Efisiensi online pengguna akhir</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t3" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t3" onchange="hitung_t3(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada</option>
                        <option value="1">Jika ada 1 sampai 3</option>
                        <option value="2">Jika ada 4 sampai 5</option>
                        <option value="3">Jika ada 6 atau lebih tanpa kebutuhan pengguna spesifik</option>
                        <option value="4">Jika 6 atau lebih dengan persyaratan pengguna spesifik yang dinyatakan, faktor manusia harus dimasukkan</option>
                        <option value="5">Jika 6 atau lebih dengan persyaratan pengguna spesifik yang dinyatakan menuntut alat dan proses spesifik digunakan untuk menunjukkan persyaratan yang dicapai</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t3" class="form-control" id="hasil_t3" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T4</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Pemrosesan internal yang kompleks</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t4" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t4" onchange="hitung_t4(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada</option>
                        <option value="1">Ada 1</option>
                        <option value="2">Ada 2</option>
                        <option value="3">Ada 3</option>
                        <option value="4">Ada 4</option>
                        <option value="5">Ada 5</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t4" class="form-control" id="hasil_t4" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T5</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Kode dapat digunakan kembali</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t5" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t5" onchange="hitung_t5(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada kode yang digunakan kembali</option>
                        <option value="1">Kode yang dapat digunakan kembali digunakan dalam aplikasi</option>
                        <option value="2">Kurang dari 10% aplikasi mempertimbangkan lebih dari 1 kebutuhan aplikasi</option>
                        <option value="3">10% atau lebih aplikasi mempertimbangkan lebih dari 1 kebutuhan aplikasi</option>
                        <option value="4">Aplikasi yang dikembangkan secara khusus untuk memudahkan penggunaan kembali. Dapat disesuaikan di tingkat sumber</option>
                        <option value="5">Aplikasi yang dirancang khusus untuk memudahkan penggunaan kembali. Dapat disesuaikan pada level sumber dengan parameter</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t5" class="form-control" id="hasil_t5" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T6</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Mudah dipasang</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t6" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t6" onchange="hitung_t6(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada pertimbangan khusus yang dinyatakan oleh pengguna. Tidak diperlukan pengaturan khusus.</option>
                        <option value="1">Tidak ada pertimbangan khusus yang dinyatakan oleh pengguna. Diperlukan pengaturan khusus.</option>
                        <option value="2">Persyaratan konversi dan instalasi dinyatakan oleh pengguna. Dampak tidak dianggap penting.</option>
                        <option value="3">Persyaratan konversi dan instalasi dinyatakan oleh pengguna. Dampak dianggap penting.</option>
                        <option value="4">Sebagai tambahan nomor 2, konversi otomatis dan alat instalasi disediakan dan diuji</option>
                        <option value="5">Sebagai tambahan nomor 3, konversi otomatis dan alat instalasi disediakan dan diuji</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t6" class="form-control" id="hasil_t6" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T7</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Kemudahan penggunaan</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t7" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t7" onchange="hitung_t7(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Tidak ada pertimbangan khusus yang dinyatakan selain cadangan normal</option>
                        <option value="1">Proses start up, backup, dan pemulihan yang efektif disediakan, tetapi diperlukan intervensi operator</option>
                        <option value="2">Proses start up, backup, dan pemulihan yang efektif disediakan, tetapi tidak diperlukan intervensi operator</option>
                        <option value="3">Aplikasi meminimalkan kebutuhan untuk penanganan media</option>
                        <option value="4">Aplikasi meminimalkan kebutuhan untuk penanganan kertas</option>
                        <option value="5">Aplikasi dirancang untuk operasi tanpa pengawasan. Pemulihan kesalahan otomatis.</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t7" class="form-control" id="hasil_t7" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>T8</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Portabilitas</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_t8" class="form-control" value="2" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select2" id="nilai_t8" onchange="hitung_t8(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Hanya 1 situs</option>
                        <option value="1">Aplikasi yang dirancang untuk beroperasi hanya di bawah perangkat keras dan perangkat lunak yang identik</option>
                        <option value="2">Aplikasi yang dirancang untuk beroperasi hanya di bawah perangkat keras dan perangkat lunak yang serupa</option>
                        <option value="3">Aplikasi yang dirancang untuk beroperasi hanya di lingkungan perangkat keras dan perangkat lunak yang berbeda</option>
                        <option value="4">Dokumentasi dan rencana dukungan disediakan dan diuji untuk nomor 1 atau nomor 2</option>
                        <option value="5">Dokumentasi dan rencana dukungan disediakan dan diuji untuk nomor 3</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="t8" class="form-control" id="hasil_t8" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                   <div class="form-group col-xs-1">
                     <p>T9</p>
                   </div>
                   <div class="form-group col-xs-4">
                     <p>Kemudahan perubahan</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot_t9" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-5">
                     <select class="form-control select2" id="nilai_t9" onchange="hitung_t9(this.value)">
                       <option value="" disabled selected="selected">Alasan</option>
                       <option value="0">Fasilitas permintaan / laporan yang fleksibel untuk menangani permintaan sederhana</option>
                       <option value="1">Fasilitas permintaan / laporan yang fleksibel untuk menangani permintaan yang kompleks</option>
                       <option value="2">Fasilitas permintaan / laporan yang fleksibel untuk menangani permintaan yang sangat kompleks</option>
                       <option value="3">Kontrol data disimpan dalam tabel dan dipelihara online. Perubahan mulai berlaku hari berikutnya</option>
                       <option value="4">Perubahan segera berlaku (waktu nyata)</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t9" class="form-control" id="hasil_t9" readonly>
                   </div>
                  </div>
                  <div class="col-xs-12">
                   <div class="form-group col-xs-1">
                     <p>T10</p>
                   </div>
                   <div class="form-group col-xs-4">
                     <p>Konkurensi</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot_t10" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-5">
                     <select class="form-control select2" id="nilai_t10" onchange="hitung_t10(this.value)">
                       <option value="" disabled selected="selected">Alasan</option>
                       <option value="0">Hanya 1 pengguna pada satu waktu</option>
                       <option value="1">Aplikasi yang dirancang untuk beroperasi dengan kurang dari 5 pengguna secara bersamaan</option>
                       <option value="2">Aplikasi yang dirancang untuk beroperasi dengan kurang dari 50 pengguna secara bersamaan</option>
                       <option value="3">Aplikasi yang dirancang untuk beroperasi dengan kurang dari 100 pengguna secara bersamaan</option>
                       <option value="4">Aplikasi yang dirancang untuk beroperasi dengan kurang dari 1000 pengguna secara bersamaan</option>
                       <option value="5">Aplikasi yang dirancang untuk beroperasi dengan lebih dari 1000 pengguna secara bersamaan</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t10" class="form-control" id="hasil_t10" readonly>
                   </div>
                  </div>
                  <div class="col-xs-12">
                   <div class="form-group col-xs-1">
                     <p>T11</p>
                   </div>
                   <div class="form-group col-xs-4">
                     <p>Termasuk tujuan keamanan khusus</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot_t11" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-5">
                     <select class="form-control select2" id="nilai_t11" onchange="hitung_t11(this.value)">
                       <option value="" disabled selected="selected">Alasan</option>
                       <option value="0">Tidak ada pertimbangan khusus yang dinyatakan oleh pengguna. Tidak diperlukan keamanan khusus.</option>
                       <option value="1">Tidak ada pertimbangan khusus yang dinyatakan oleh pengguna. Diperlukan keamanan khusus.</option>
                       <option value="2">Persyaratan keamanan dinyatakan oleh pengguna. Dampak tidak dianggap penting.</option>
                       <option value="3">Persyaratan keamanan dinyatakan oleh pengguna. Dampak dianggap penting.</option>
                       <option value="4">Sebagai tambahan nomor 2, alat keamanan otomatis disediakan dan diuji.</option>
                       <option value="5">Sebagai tambahan nomor 3, alat keamanan otomatis disediakan dan diuji.</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t11" class="form-control" id="hasil_t11" readonly>
                   </div>
                  </div>
                  <div class="col-xs-12">
                   <div class="form-group col-xs-1">
                     <p>T12</p>
                   </div>
                   <div class="form-group col-xs-4">
                     <p>Akses langsung ke pihak ketiga</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot_t12" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-5">
                     <select class="form-control select2" id="nilai_t12" onchange="hitung_t12(this.value)">
                       <option value="" disabled selected="selected">Alasan</option>
                       <option value="0">Kumpulan murni atau PC yang berdiri sendiri</option>
                       <option value="1">Kumpulan dengan entri atau pencetakan data jarak jauh</option>
                       <option value="2">Kumpulan dengan entri data jarak jauh dan pencetakan jarak jauh</option>
                       <option value="3">Tautan ujung depan pihak ketiga ke kumpulan</option>
                       <option value="4">Lebih dari ujung depan dengan satu jenis pihak ketiga</option>
                       <option value="5">Lebih dari 1 jenis protokol pihak ketiga</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t12" class="form-control" id="hasil_t12" readonly>
                   </div>
                  </div>
                  <div class="col-xs-12">
                   <div class="form-group col-xs-1">
                     <p>T13</p>
                   </div>
                   <div class="form-group col-xs-4">
                     <p>Diperlukan pelatihan pengguna khusus</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot_t13" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-5">
                     <select class="form-control select2" id="nilai_t13" onchange="hitung_t13(this.value)">
                       <option value="" disabled selected="selected">Alasan</option>
                       <option value="0">Tidak diperlukan pelatihan pengguna</option>
                       <option value="1">Diperlukan kursus satu hari untuk pengguna umum</option>
                       <option value="2">Diperlukan kursus dua hari untuk pengguna umum</option>
                       <option value="3">Diperlukan kursus satu minggu untuk pengguna umum</option>
                       <option value="4">Diperlukan kursus dua minggu untuk pengguna umum</option>
                       <option value="5">Kursus luas diperlukan untuk pengguna umum</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t13" class="form-control" id="hasil_t13" readonly>
                   </div>
                  </div>

                  <div class="col-xs-12">
                    <hr>
                    <div class="form-group col-xs-11">
                      <p>Hasil</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="hasil_tcf" class="form-control" id="hasil_tcf" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-11">
                      <p>Hasil Rumus (0.6+(hasil*0.01))</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="hasil_rms" class="form-control" id="hasil_rms" readonly>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php'; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include 'script.php'; ?>
<script type="text/javascript">
$(function () {
  $('.select2').select2()
})
</script>
</body>
</html>
