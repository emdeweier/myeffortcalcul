<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$query1 = mysql_query("SELECT * FROM ef,temp_proyek WHERE ef.id_temp = temp_proyek.id_temp AND ef.id_temp = '$id'");
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
function hitung_e1(nilai_e1){
  document.getElementById("hasil_e1").value = 1.5*nilai_e1;
  hitung_total();
}
function hitung_e2(nilai_e2){
  document.getElementById("hasil_e2").value = 0.5*nilai_e2;
  hitung_total();
}
function hitung_e3(nilai_e3){
  document.getElementById("hasil_e3").value = 1*nilai_e3;
  hitung_total();
}
function hitung_e4(nilai_e4){
  document.getElementById("hasil_e4").value = 0.5*nilai_e4;
  hitung_total();
}
function hitung_e5(nilai_e5){
  document.getElementById("hasil_e5").value = 1*nilai_e5;
  hitung_total();
}
function hitung_e6(nilai_e6){
  document.getElementById("hasil_e6").value = 2*nilai_e6;
  hitung_total();
}
function hitung_e7(nilai_e7){
  document.getElementById("hasil_e7").value = (-1)*nilai_e7;
  hitung_total();
}
function hitung_e8(nilai_e8){
  document.getElementById("hasil_e8").value = (-1)*nilai_e8;
  hitung_total();
}
function hitung_total(){
  if(isNaN(parseInt(document.getElementById("hasil_e1").value))) n1 = 0;
  else n1 = parseFloat(document.getElementById("hasil_e1").value);
  if(isNaN(parseInt(document.getElementById("hasil_e2").value))) n2 = 0;
  else n2 = parseFloat(document.getElementById("hasil_e2").value);
  if(isNaN(parseInt(document.getElementById("hasil_e3").value))) n3 = 0;
  else n3 = parseFloat(document.getElementById("hasil_e3").value);
  if(isNaN(parseInt(document.getElementById("hasil_e4").value))) n4 = 0;
  else n4 = parseFloat(document.getElementById("hasil_e4").value);
  if(isNaN(parseInt(document.getElementById("hasil_e5").value))) n5 = 0;
  else n5 = parseFloat(document.getElementById("hasil_e5").value);
  if(isNaN(parseInt(document.getElementById("hasil_e6").value))) n6 = 0;
  else n6 = parseFloat(document.getElementById("hasil_e6").value);
  if(isNaN(parseInt(document.getElementById("hasil_e7").value))) n7 = 0;
  else n7 = parseFloat(document.getElementById("hasil_e7").value);
  if(isNaN(parseInt(document.getElementById("hasil_e8").value))) n8 = 0;
  else n8 = parseFloat(document.getElementById("hasil_e8").value);
  jumlah = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8;
  document.getElementById("hasil_ef").value = jumlah.toFixed(2);
  document.getElementById("hasil_rmse").value = (1.4-(0.03*jumlah)).toFixed(3);
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
        Tambah Environmental Factor
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Tambah Environmental Factor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Environmental Factor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambahef_db" method="post">
                <div class="box-body">
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                      <label for="no">No.</label>
                      <p>E1</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <label for="tf">Environmental Factor</label>
                      <p>Keakraban dengan sistem</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="bobot">Bobot</label>
                      <input type="text" name="bobot_e1" class="form-control" value="1.5" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <label for="nilai">Alasan</label>
                      <select class="form-control select21" id="nilai_e1" onchange="hitung_e1(this.value)">
                        <option value="" disabled selected="selected">Alasan</option>
                        <option value="0">Pertama kali</option>
                        <option value="1">Tim telah mengerjakan 1 proyek sebelumnya</option>
                        <option value="2">Tim telah mengerjakan 2 proyek sebelumnya</option>
                        <option value="3">Tim telah mengerjakan ≥ 3 proyek sebelumnya</option>
                        <option value="4">Tim telah mengerjakan lebih dari 10 proyek sebelumnya</option>
                        <option value="5">Tim telah mengerjakan lebih dari 20 proyek sebelumnya</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="hasil">Hasil</label>
                      <input type="text" name="e1" class="form-control" id="hasil_e1" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E2</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Pengalaman aplikasi</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e2" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e2" onchange="hitung_e2(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Pertama kali mengerjakan aplikasi jenis ini</option>
                        <option value="1">Tim telah bekerja pada satu aplikasi mandiri sebelumnya</option>
                        <option value="2">Tim telah bekerja pada beberapa aplikasi mandiri sebelumnya</option>
                        <option value="3">Tim telah bekerja pada beberapa aplikasi klien / server sebelumnya</option>
                        <option value="4">Tim telah bekerja pada aplikasi perusahaan sebelumnya</option>
                        <option value="5">Tim telah bekerja pada beberapa aplikasi perusahaan sebelumnya</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e2" class="form-control" id="hasil_e2" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E3</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Pengalaman pada pemrograman berorientasi objek</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e3" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e3" onchange="hitung_e3(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Tim tidak pernah menggunakan orientasi objek sebelumnya</option>
                        <option value="1">Tim memiliki pengalaman 1 tahun menggunakan orientasi objek</option>
                        <option value="2">Tim memiliki pengalaman 2 tahun menggunakan orientasi objek</option>
                        <option value="3">Tim memiliki pengalaman lebih dari 2 tahun menggunakan orientasi objek, termasuk konsep orientasi objek lanjutan</option>
                        <option value="4">Tim telah bekerja pada aplikasi berbasis web 3 tingkat penuh dengan konsep berorientasi objek canggih</option>
                        <option value="5">Tim telah bekerja pada aplikasi terintegrasi canggih dengan paket berorientasi objek lainnya</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e3" class="form-control" id="hasil_e3" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E4</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Memimpin kemampuan analisis</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e4" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e4" onchange="hitung_e4(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Analis utama tidak pernah menggunakan orientasi objek sebelumnya</option>
                        <option value="1">Analis utama telah bekerja dengan program berorientasi objek</option>
                        <option value="2">Analis utama memiliki pengalaman berorientasi objek dan pengetahuan tentang bahasa pemodelan terpadu</option>
                        <option value="3">Analis utama memiliki pengalaman berorientasi objek dan pengetahuan yang baik tentang bahasa pemodelan terpadu, pemodelan tangkas, dll</option>
                        <option value="4">Analis utama memiliki pengalaman dengan 3 tingkat aplikasi berbasis web</option>
                        <option value="5">Analis utama memiliki pengalaman dengan aplikasi perusahaan besar dan terintegrasi</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e4" class="form-control" id="hasil_e4" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E5</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Motivasi</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e5" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e5" onchange="hitung_e5(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Tingkat absensi tinggi (lebih dari 1 hari per orang per bulan)</option>
                        <option value="1">Ketidakhadiran sedang (anggota melewati pertemuan)</option>
                        <option value="2">Anggota datang terlambat untuk rapat, harus didorong untuk mulai bekerja</option>
                        <option value="3">Anggota kebanyakan tepat waktu, biasanya mulai bekerja sendiri, kadang-kadang mencari pekerjaan tambahan</option>
                        <option value="4">Anggota selalu tepat waktu, mulai bekerja sendiri, selalu mencari kerja ekstra, komitmen</option>
                        <option value="5">Ketidakhadiran tim rendah, berusaha mencapai tujuan yang bermakna, selalu berusaha meningkatkan, selalu berusaha saling membantu, dapat bekerja secara mandiri, menunjukkan komitmen</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e5" class="form-control" id="hasil_e5" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E6</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Stabilitas persyaratan</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e6" class="form-control" value="2" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e6" onchange="hitung_e6(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Ruang lingkup tidak didefinisikan dengan baik</option>
                        <option value="1"></option>
                        <option value="2"></option>
                        <option value="3"></option>
                        <option value="4"></option>
                        <option value="5"></option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e6" class="form-control" id="hasil_e6" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E7</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Staf paruh waktu</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e7" class="form-control" value="-1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e7" onchange="hitung_e7(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Staf atau konsultan paruh waktu nol</option>
                        <option value="1">Staf atau konsultan paruh waktu akan melakukan < 5% pekerjaan</option>
                        <option value="2">Staf atau konsultan paruh waktu akan melakukan < 10% pekerjaan</option>
                        <option value="3">Staf atau konsultan paruh waktu akan melakukan < 20% pekerjaan</option>
                        <option value="4">Staf atau konsultan paruh waktu akan melakukan < 50% pekerjaan</option>
                        <option value="5">Staf atau konsultan paruh waktu akan melakukan > 50% pekerjaan</option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e7" class="form-control" id="hasil_e7" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>E8</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <p>Kesulitan bahasa pemrograman</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot_e8" class="form-control" value="-1" readonly>
                    </div>
                    <div class="form-group col-xs-5">
                      <select class="form-control select21" id="nilai_e8" onchange="hitung_e8(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">Menggunakan bahasa pemrograman yang tidak terstruktur misalnya HTML</option>
                        <option value="1">Menggunakan bahasa pemrograman terstruktur misalnya Pascal</option>
                        <option value="2">Menggunakan bahasa pemrograman berorientasi objek misalnya C</option>
                        <option value="3">Menggunakan bahasa pemrograman berorientasi objek dengan kemampuan berorientasi objek penuh dan fitur-fitur canggih misalnya C ++</option>
                        <option value="4">Menggunakan bahasa pemrograman berorientasi objek didorong dengan kemampuan berorientasi objek penuh misalnya Java</option>
                        <option value="5">Menggunakan lingkungan pengembangan berorientasi objek terintegrasi misalnya </option>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="e8" class="form-control" id="hasil_e8" readonly>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <hr>
                    <div class="form-group col-xs-11">
                      <p>Hasil</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="hasil_ef" class="form-control" id="hasil_ef" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-11">
                      <p>Hasil Rumus (1.4-(hasil*0.03))</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="hasil_rmse" class="form-control" id="hasil_rmse" readonly>
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
  $('.select21').select2()
})
</script>
</body>
</html>
