<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$query1 = mysql_query("SELECT * FROM uucw,temp_proyek WHERE uucw.id_temp = temp_proyek.id_temp AND uucw.id_temp = '$id'");
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
 function hitung_simpeluucw(nilai_simpel){
   x = 5*nilai_simpel;
   document.getElementById("hasil_simpel1").value = 1*nilai_simpel;
   document.getElementById("hasil_simpel").value = 5*nilai_simpel;
   hitung_total();
 }
 function hitung_mediumuucw(nilai_medium){
   document.getElementById("hasil_medium1").value = 1*nilai_medium;
   document.getElementById("hasil_medium").value = 10*nilai_medium;
   x = 10*nilai_medium;
   hitung_total();
 }
 function hitung_complexuucw(nilai_complex){
   document.getElementById("hasil_complex1").value = 1*nilai_complex;
   document.getElementById("hasil_complex").value = 15*nilai_complex;
   x = 15*nilai_complex;
   hitung_total();
  }
 function hitung_total(){
   var a = document.getElementById("hasil_simpel1").value;
   var b = document.getElementById("hasil_medium1").value;
   var c = document.getElementById("hasil_complex1").value;
   var d = parseInt(a)+parseInt(b)+parseInt(c);
   if(isNaN(parseInt(document.getElementById("hasil_simpel").value))) n1 = 0;
   else n1 = parseInt(document.getElementById("hasil_simpel").value);
   if(isNaN(parseInt(document.getElementById("hasil_medium").value))) n2 = 0;
   else n2 = parseInt(document.getElementById("hasil_medium").value);
   if(isNaN(parseInt(document.getElementById("hasil_complex").value)))  n3 = 0;
   else n3 = parseInt(document.getElementById("hasil_complex").value);
   document.getElementById("hasil_uucw").value = (n1 + n2 + n3);
   document.getElementById("total_trx").value = (d);
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
        Tambah Unadjusted Use Case Weighting
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Tambah Unadjusted Use Case Weighting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Unadjusted Use Case Weighting</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambahuucw_db" method="post">
                <div class="box-body">
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                    <label for="tipe_aktor">Tipe Use Case</label>
                    <p>Simple <br>(menggunakan 1 sampai 3 transaksi)</p>
                    <input type="hidden" name="jenis_uucw" class="form-control" id="jenis_uucw" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="bobot">Bobot</label>
                    <input type="text" name="bobot" class="form-control" value="5" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="nilai">Nilai</label>
                    <input type="text" name="nilai_simpel" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_simpeluucw" onkeyup="hitung_simpeluucw(this.value)" placeholder="Nilai">
                    <input type="hidden" name="hasil_simpel" class="form-control" id="hasil_simpel1" value="0" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <label for="hasil">Hasil</label>
                    <input type="text" name="hasil_simpel" class="form-control" id="hasil_simpel" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <p>Average<br>(menggunakan 4 sampai 7 transaksi)</p>
                    <input type="hidden" name="jenis_uucw" class="form-control" id="jenis_uucw" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="bobot" class="form-control" value="10" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="nilai_medium" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_mediumuucw" onkeyup="hitung_mediumuucw(this.value)" placeholder="Nilai">
                    <input type="hidden" name="hasil_medium" class="form-control" id="hasil_medium1" value="0" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_medium" class="form-control" id="hasil_medium" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-4">
                    <p>Complex<br>(menggunakan lebih dari 7 transaksi)</p>
                    <input type="hidden" name="jenis_uucw" class="form-control" id="jenis_uucw" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="bobot" class="form-control" value="15" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="nilai_complex" class="form-control" onkeypress='return wajib_angka(event)' id="nilai_complexuucw" onkeyup="hitung_complexuucw(this.value)" placeholder="Nilai">
                    <input type="hidden" name="hasil_complex" class="form-control" id="hasil_complex1" value="0" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_complex" class="form-control" id="hasil_complex" readonly>
                  </div>
                  </div>
                  <div class="col-xs-12">
                  <div class="form-group col-xs-5">
                    <p>Hasil</p>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="total_trx" class="form-control" id="total_trx" readonly>
                  </div>
                  <div class="form-group col-xs-1">
                    <input type="text" name="hasil_uucw" class="form-control" id="hasil_uucw" readonly>
                  </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                 <a type="button" id="btnprosesuucw" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Transaksi</a>
                </div>
                <div class="box-body">
                  <div class="col-xs-12">
                  <div class="form-group col-xs-1">
                    <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                    <label for="tipe_aktor">No</label>
                  </div>
                  <div class="form-group col-xs-3">
                    <label for="bobot">Nama Use Case</label>
                  </div>
                  <div class="form-group col-xs-2">
                    <label for="nilai">Jumlah Transaksi</label>
                  </div>
                  </div>
                  <div id="tambahan">

                  </div>
                </div>
                <div class="box-footer">
                 <button type="submit" name="submit" class="btn btn-primary">Simpan</a>
                </div>
                <!-- /.box-body -->
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
function addInput(no){
  input = '<div class="col-xs-12"><div class="form-group col-xs-1"><input class="form-control" readonly value="'+no+'" type="text"></div><div class="form-group col-xs-3"><input type="text" name="nameuc_'+i+'" class="form-control" placeholder="Nama Use Case"></div><div class="form-group col-xs-2"><input type="text" name="transaksi_'+i+'" class="form-control" onkeypress="return wajib_angka(event)" placeholder="Jumlah Transaksi"></div></div>';
 // input = '<tr><td><input type="hidden" name="jenis[]" value="'+jenis+'"><input class="col s3 offset-m5" readonly value="' + no  + '"  type="text" class="validate"></td><td><input readonly class="col s12" name="nameuc[]" value="'+ name +'"  type="text" class="validate"></td><td><input class="col s12 offset-m2" name="transaction[]"  type="text" class="validate"></td></tr>';
 return input;
}
$('#btnprosesuucw').click(function(){
 smpl = $('#hasil_simpel1').val();
 mdm = $('#hasil_medium1').val();
 cplx = $('#hasil_complex1').val();
 temp = parseInt(smpl)+parseInt(mdm)+parseInt(cplx);
 panjang = temp;
 if($('#hasil_simpel1').val()=='') panjang--;
 if($('#hasil_medium1').val()=='') panjang--;
 if($('#hasil_complex1').val()=='') panjang--;
 totalhtml = '';
 for(i=1;i<=panjang;i++){
   totalhtml = totalhtml + addInput((i));
 }
 $('#tambahan').html(totalhtml);
});
</script>
</body>
</html>
