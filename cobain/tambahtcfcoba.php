<?php
include 'koneksi.php';
// session_start();
// if(!isset($_SESSION['id_proyek'])){
//   header("location:tambah");
// }
// $id_proyek = $_SESSION['id_proyek'];
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
          // x =  1*nilai_t13;
          // hasil2= (0.6+(hasil/100));
          // document.getElementById('hasil_tcf').value = hasil2;
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
  document.getElementById("hasil_tcf").value = jumlah;
  document.getElementById("hasil_rms").value = (0.6 + (jumlah*0.01));
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
        <li><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="#">Tambah Proyek</a></li>
        <li class="active"><a href="#">Tambah Technical Complexity Factor</a></li>
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
              <form role="form" action="tambahuaw_db.php" method="post">
                <div class="box-body">
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                      <label for="tipe_aktor">No.</label>
                      <p>T1</p>
                    </div>
                    <div class="form-group col-xs-4">
                      <label for="tf">Technical Factor</label>
                      <p>Distributed System</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="bobot">Bobot</label>
                      <input type="text" name="bobot" class="form-control" value="2" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <label>Nilai</label>
                      <select class="form-control select2" id="nilai_t1" onchange="hitung_t1(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Response time or throughput performance objectives</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t2" onchange="hitung_t2(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>End-user online efficiency</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t3" onchange="hitung_t3(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Complex internal processing</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t4" onchange="hitung_t4(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Reusability of code</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="1" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t5" onchange="hitung_t5(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Easy to install</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t6" onchange="hitung_t6(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Ease of use</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="0.5" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t7" onchange="hitung_t7(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                      <p>Portability</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="bobot" class="form-control" value="2" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <select class="form-control select2" id="nilai_t8" onchange="hitung_t8(this.value)">
                        <option value="" disabled selected="selected">Nilai</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
                     <p>Ease of change</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-2">
                     <select class="form-control select2" id="nilai_t9" onchange="hitung_t9(this.value)">
                       <option value="" disabled selected="selected">Nilai</option>
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
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
                     <p>Concurrency</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-2">
                     <select class="form-control select2" id="nilai_t10" onchange="hitung_t10(this.value)">
                       <option value="" disabled selected="selected">Nilai</option>
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
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
                     <p>Special security objectives included</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-2">
                     <select class="form-control select2" id="nilai_t11" onchange="hitung_t11(this.value)">
                       <option value="" disabled selected="selected">Nilai</option>
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
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
                     <p>Direct access for third parties</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-2">
                     <select class="form-control select2" id="nilai_t12" onchange="hitung_t12(this.value)">
                       <option value="" disabled selected="selected">Nilai</option>
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
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
                     <p>Special user training required</p>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="bobot" class="form-control" value="1" readonly>
                   </div>
                   <div class="form-group col-xs-2">
                     <select class="form-control select2" id="nilai_t13" onchange="hitung_t13(this.value)">
                       <option value="" disabled selected="selected">Nilai</option>
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
                     </select>
                   </div>
                   <div class="form-group col-xs-1">
                     <input type="text" name="t13" class="form-control" id="hasil_t13" readonly>
                   </div>
                  </div>

                  <div class="col-xs-12">
                    <hr>
                    <div class="form-group col-xs-8">
                      <p>Hasil</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="hasil_tcf" class="form-control" id="hasil_tcf" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-8">
                      <p>Hasil Rumus (0.6 + (hasil/100))</p>
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
