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
  function wajib_angka(event){
    var charCode = (event.which) ? event.which : event.keyCode
    if (charCode != 8 && (charCode < 48 || charCode > 57))
    return false;
  }
  var hasil = 0;
  var hasil2 = 0;
  var x;
  function hitung_jam1(){
    var minggu = document.getElementById("minggu_hari1").value;
    var jam = document.getElementById("jam_hari1").value;
    var qty = document.getElementById("qty1").value;
    var jam_minggu = document.getElementById("jam_minggu1").value = minggu*jam;
    document.getElementById("totaljam_minggu1").value = jam_minggu*qty;
    hitung_qty();
    hitung_jamhari();
    hitung_jamminggu();
    hitung_totaljamminggu();
    hitung_gaji();
  }
  function hitung_jam2(){
    var minggu = document.getElementById("minggu_hari2").value;
    var jam = document.getElementById("jam_hari2").value;
    var qty = document.getElementById("qty2").value;
    var jam_minggu = document.getElementById("jam_minggu2").value = minggu*jam;
    document.getElementById("totaljam_minggu2").value = jam_minggu*qty;
    hitung_qty();
    hitung_jamhari();
    hitung_jamminggu();
    hitung_totaljamminggu();
    hitung_gaji();
  }
  function hitung_jam3(){
    var minggu = document.getElementById("minggu_hari3").value;
    var jam = document.getElementById("jam_hari3").value;
    var qty = document.getElementById("qty3").value;
    var jam_minggu = document.getElementById("jam_minggu3").value = minggu*jam;
    document.getElementById("totaljam_minggu3").value = jam_minggu*qty;
    hitung_qty();
    hitung_jamhari();
    hitung_jamminggu();
    hitung_totaljamminggu();
    hitung_gaji();
  }
  function hitung_qty(){
    if(isNaN(parseInt(document.getElementById("qty1").value))) q1 = '';
    else q1 = parseFloat(document.getElementById("qty1").value);
    if(isNaN(parseInt(document.getElementById("qty2").value))) q2 = '';
    else q2 = parseFloat(document.getElementById("qty2").value);
    if(isNaN(parseInt(document.getElementById("qty3").value))) q3 = '';
    else q3 = parseFloat(document.getElementById("qty3").value);
    qty = q1+q2+q3;
    document.getElementById("total_qty").value = qty;
  }
  function hitung_jamhari(){
    if(isNaN(parseInt(document.getElementById("jam_hari1").value))) h1 = '';
    else h1 = parseFloat(document.getElementById("jam_hari1").value);
    if(isNaN(parseInt(document.getElementById("jam_hari2").value))) h2 = '';
    else h2 = parseFloat(document.getElementById("jam_hari2").value);
    if(isNaN(parseInt(document.getElementById("jam_hari3").value))) h3 = '';
    else h3 = parseFloat(document.getElementById("jam_hari3").value);
    hari = h1+h2+h3;
    document.getElementById("total_jam_hari").value = hari;
  }
  function hitung_jamminggu(){
    if(isNaN(parseInt(document.getElementById("jam_minggu1").value))) m1 = '';
    else m1 = parseFloat(document.getElementById("jam_minggu1").value);
    if(isNaN(parseInt(document.getElementById("jam_minggu2").value))) m2 = '';
    else m2 = parseFloat(document.getElementById("jam_minggu2").value);
    if(isNaN(parseInt(document.getElementById("jam_minggu3").value))) m3 = '';
    else m3 = parseFloat(document.getElementById("jam_minggu3").value);
    minggu = m1+m2+m3;
    document.getElementById("total_jam_minggu1").value = minggu;
  }
  function hitung_totaljamminggu(){
    if(isNaN(parseInt(document.getElementById("totaljam_minggu1").value))) tm1 = '';
    else tm1 = parseFloat(document.getElementById("totaljam_minggu1").value);
    if(isNaN(parseInt(document.getElementById("totaljam_minggu2").value))) tm2 = '';
    else tm2 = parseFloat(document.getElementById("totaljam_minggu2").value);
    if(isNaN(parseInt(document.getElementById("totaljam_minggu3").value))) tm3 = '';
    else tm3 = parseFloat(document.getElementById("totaljam_minggu3").value);
    totalminggu = tm1+tm2+tm3;
    document.getElementById("total_jam_minggu2").value = totalminggu;
  }
  function hitung_gaji(){
    if(isNaN(parseInt(document.getElementById("gaji_jam1").value))) g1 = '';
    else g1 = parseFloat(document.getElementById("gaji_jam1").value);
    if(isNaN(parseInt(document.getElementById("gaji_jam2").value))) g2 = '';
    else g2 = parseFloat(document.getElementById("gaji_jam2").value);
    if(isNaN(parseInt(document.getElementById("gaji_jam3").value))) g3 = '';
    else g3 = parseFloat(document.getElementById("gaji_jam3").value);
    gaji = g1+g2+g3;
    document.getElementById("total_gaji1").value = gaji;
    hitung_totalgaji();
  }
  function hitung_totalgaji(){
    var perjam = document.getElementById("total_er_perjam").value;
    var gaji = document.getElementById("total_jam_minggu2").value;
    totalgaji = perjam/gaji;
    var perminggu = document.getElementById("total_er_perminggu").value = totalgaji.toFixed(1);
    if(isNaN(parseInt(document.getElementById("gaji_jam1").value))) g1 = '';
    else g1 = parseFloat(document.getElementById("gaji_jam1").value);
    if(isNaN(parseInt(document.getElementById("gaji_jam2").value))) g2 = '';
    else g2 = parseFloat(document.getElementById("gaji_jam2").value);
    if(isNaN(parseInt(document.getElementById("gaji_jam3").value))) g3 = '';
    else g3 = parseFloat(document.getElementById("gaji_jam3").value);

    if(isNaN(parseInt(document.getElementById("qty1").value))) qt1 = '';
    else qt1 = parseFloat(document.getElementById("qty1").value);
    if(isNaN(parseInt(document.getElementById("qty2").value))) qt2 = '';
    else qt2 = parseFloat(document.getElementById("qty2").value);
    if(isNaN(parseInt(document.getElementById("qty3").value))) qt3 = '';
    else qt3 = parseFloat(document.getElementById("qty3").value);

    if(isNaN(parseInt(document.getElementById("totaljam_minggu1").value))) tm1 = '';
    else tm1 = parseFloat(document.getElementById("totaljam_minggu1").value);
    if(isNaN(parseInt(document.getElementById("totaljam_minggu2").value))) tm2 = '';
    else tm2 = parseFloat(document.getElementById("totaljam_minggu2").value);
    if(isNaN(parseInt(document.getElementById("totaljam_minggu3").value))) tm3 = '';
    else tm3 = parseFloat(document.getElementById("totaljam_minggu3").value);
    gajiku1 = totalgaji*g1*tm1;
    gajiku2 = totalgaji*g2*tm2;
    gajiku3 = totalgaji*g3*tm3;
    document.getElementById("total_gaji_jam1").value = gajiku1.toFixed(0);
    document.getElementById("total_gaji_orang1").value = (gajiku1/qt1).toFixed(0);
    document.getElementById("total_gaji_jam2").value = gajiku2.toFixed(0);
    document.getElementById("total_gaji_orang2").value = (gajiku2/qt2).toFixed(0);
    document.getElementById("total_gaji_jam3").value = gajiku2.toFixed(0);
    document.getElementById("total_gaji_orang3").value = (gajiku3/qt3).toFixed(0);
    document.getElementById("total_gaji2").value = (gajiku1+gajiku2+gajiku3).toFixed(0);
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
        Tambah Perhitungan Gaji
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="#">Tambah Proyek</a></li>
        <li class="active"><a href="#">Tambah Perhitungan Gaji</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Perhitungan Gaji</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambahef_db.php" method="post">
                <div class="box-body">
                  <?php
                    $sql = mysql_query("SELECT perjam FROM durasi");
                    $result = mysql_fetch_array($sql);
                    $jam = $result['perjam'];
                  ?>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>">
                      <label for="no">No.</label>
                      <p>1</p>
                    </div>
                    <div class="form-group col-xs-2">
                      <label for="tf">Jabatan</label>
                      <input type="text" name="jabatan1" class="form-control" placeholder="Jabatan 1">
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="bobot">Qty</label>
                      <select class="form-control select22" id="qty1" name="qty1" onchange="hitung_jam1()">
                        <option value="0" disabled selected>0</option>
                        <?php for($i=1;$i<=10;$i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="nilai">Jml. Hari</label>
                      <select class="form-control select22" id="minggu_hari1" name="minggu_hari1" onchange="hitung_jam1()">
                        <option value="0" disabled selected>0</option>
                        <?php for($i=1;$i<=7;$i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="nilai">Jam/Hari</label>
                      <select class="form-control select22" id="jam_hari1" name="jam_hari1" onchange="hitung_jam1()">
                        <option value="0" disabled selected>0</option>
                        <?php for($i=1;$i<=24;$i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="nilai">Jam/Minggu</label>
                      <input type="text" name="jam_minggu1" class="form-control" id="jam_minggu1" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="nilai">Total</label>
                      <input type="text" name="totaljam_minggu1" class="form-control" id="totaljam_minggu1" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <label for="nilai">Gaji/Jam</label>
                      <input type="text" name="gaji_jam1" class="form-control" id="gaji_jam1" onkeypress='return wajib_angka(event)' placeholder="Gaji/Jam" onkeyup="hitung_jam1()">
                    </div>
                    <div class="form-group col-xs-2">
                      <label for="nilai">Total Gaji</label>
                      <input type="text" name="total_gaji_jam1" class="form-control" id="total_gaji_jam1" readonly>
                      <br>
                      <input type="text" name="total_gaji_orang1" class="form-control" id="total_gaji_orang1" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>2</p>
                    </div>
                    <div class="form-group col-xs-2">
                      <input type="text" name="jabatan2" class="form-control" placeholder="Jabatan 2">
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="qty2" name="qty2" onchange="hitung_jam2()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=10;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="minggu_hari2" name="minggu_hari2" onchange="hitung_jam2()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=7;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="jam_hari2" name="jam_hari2" onchange="hitung_jam2()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=24;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="jam_minggu2" class="form-control" id="jam_minggu2" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="totaljam_minggu2" class="form-control" id="totaljam_minggu2" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="gaji_jam2" class="form-control" id="gaji_jam2" onkeypress='return wajib_angka(event)' placeholder="Gaji/Jam" onkeyup="hitung_jam2()">
                    </div>
                    <div class="form-group col-xs-2">
                      <input type="text" name="total_gaji_jam2" class="form-control" id="total_gaji_jam2" readonly>
                      <br>
                      <input type="text" name="total_gaji_orang2" class="form-control" id="total_gaji_orang2" readonly>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group col-xs-1">
                      <p>3</p>
                    </div>
                    <div class="form-group col-xs-2">
                      <input type="text" name="jabatan3" class="form-control" placeholder="Jabatan 3">
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="qty3" name="qty3" onchange="hitung_jam3()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=10;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="minggu_hari3" name="minggu_hari3" onchange="hitung_jam3()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=7;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                    <select class="form-control select22" id="jam_hari3" name="jam_hari3" onchange="hitung_jam3()">
                      <option value="0" disabled selected>0</option>
                      <?php for($i=1;$i<=24;$i++){ ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="jam_minggu3" class="form-control" id="jam_minggu3" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="totaljam_minggu3" class="form-control" id="totaljam_minggu3" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="gaji_jam3" class="form-control" id="gaji_jam3" onkeypress='return wajib_angka(event)' placeholder="Gaji/Jam" onkeyup="hitung_jam3()">
                    </div>
                    <div class="form-group col-xs-2">
                      <input type="text" name="total_gaji_jam3" class="form-control" id="total_gaji_jam3" readonly>
                      <br>
                      <input type="text" name="total_gaji_orang3" class="form-control" id="total_gaji_orang3" readonly>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <hr>
                    <div class="form-group col-xs-3">
                      <p>Total</p>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="total_qty" class="form-control" id="total_qty" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="total_jam_hari" class="form-control" id="total_jam_hari" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="total_jam_minggu1" class="form-control" id="total_jam_minggu1" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="total_jam_minggu2" class="form-control" id="total_jam_minggu2" readonly>
                      <input type="hidden" name="total_er_perminggu" class="form-control" id="total_er_perminggu" readonly>
                    </div>
                    <div class="form-group col-xs-1">
                      <input type="text" name="total_gaji1" class="form-control" id="total_gaji1" readonly>
                      <input type="hidden" name="total_er_perjam" class="form-control" id="total_er_perjam" value="<?php echo number_format($jam,0,",",""); ?>" readonly>
                    </div>
                    <div class="form-group col-xs-2">
                      <input type="text" name="total_gaji2" class="form-control" id="total_gaji2" readonly>
                    </div>
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
  $('.select22').select2()
})
</script>
</body>
</html>
