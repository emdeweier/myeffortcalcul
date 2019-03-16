<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$query1 = mysql_query("SELECT * FROM uaw,temp_proyek WHERE uaw.id_temp = temp_proyek.id_temp AND uaw.id_temp = '$id'");
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
 function wajib_angka(event){
   var charCode = (event.which) ? event.which : event.keyCode
   if (charCode != 8 && (charCode < 48 || charCode > 57))
   return false;
 }
 var hasil = 0;
 var x;
 function hitung_simpel(nilai_simpel){
   x = 1*nilai_simpel;
   document.getElementById("hasil_simpel").value = 1*nilai_simpel;
   hitung_total();
 }
 function hitung_medium(nilai_medium){
   document.getElementById("hasil_medium").value = 2*nilai_medium;
   x = 2*nilai_medium;
   hitung_total();
 }
 function hitung_complex(nilai_complex){
   document.getElementById("hasil_complex").value = 3*nilai_complex;
   x = 3*nilai_complex;
   hitung_total();
  }
 function hitung_total(){
   if(isNaN(parseInt(document.getElementById("hasil_simpel").value))) n1 = 0;
   else n1 = parseInt(document.getElementById("hasil_simpel").value);
   if(isNaN(parseInt(document.getElementById("hasil_medium").value))) n2 = 0;
   else n2 = parseInt(document.getElementById("hasil_medium").value);
   if(isNaN(parseInt(document.getElementById("hasil_complex").value)))  n3 = 0;
   else n3 = parseInt(document.getElementById("hasil_complex").value);
   document.getElementById("hasil_uaw").value = (n1 + n2 + n3);
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
        Tambah Unadjusted Actor Weighting
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Tambah Unadjusted Actor Weighting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Unadjusted Actor Weighting</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambahuaw_db" method="post">
                <div class="box-body">
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <label for="tipe_aktor">Tipe Aktor</label>
                    <p>Simple <br>(interaksi melalui API, ex: Command Prompt)</p>
                    <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="bobot">Bobot</label>
                    <input type="text" name="bobot" class="form-control" value="1" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="nilai">Nilai</label>
                    <input type="text" name="nilai_simpel" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_simpel" onkeyup="hitung_simpel(this.value)" placeholder="Nilai">
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil_simpel" class="form-control" id="hasil_simpel" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <p>Average<br>(interaksi melalui protokol, ex: TCF/IP)</p>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="bobot" class="form-control" value="2" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="nilai_medium" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_medium" onkeyup="hitung_medium(this.value)" placeholder="Nilai">
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_medium" class="form-control" id="hasil_medium" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <p>Complex<br>(interaksi melalui GUI atau web page)</p>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="bobot" class="form-control" value="3" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="nilai_complex" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_complex" onkeyup="hitung_complex(this.value)" placeholder="Nilai">
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_complex" class="form-control" id="hasil_complex" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-6">
                    <p>Hasil</p>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_uaw" class="form-control" id="hasil_uaw" readonly>
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
</body>
</html>
