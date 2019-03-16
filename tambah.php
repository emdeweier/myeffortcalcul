<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_SESSION['nim'];
$query = mysql_query("SELECT * FROM pengguna WHERE nim = '$id'");
$data = mysql_fetch_array($query);
$pengguna = $data['nim'];
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="hold-transition skin-blue-light sidebar-mini fixed">
<div class="wrapper">

  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Proyek
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Tambah Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="tambah_db" method="post">
                <div class="box-body">
                  <div class="form-group col-xs-1">
                    <label for="id_proyek">ID</label>
                    <input type="text" name="id_proyek" class="form-control" value="<?php
                    $query = mysql_query("SELECT COUNT(*) FROM temp_proyek");
                    $data = mysql_fetch_array($query);
                    $id_proyek = $data['COUNT(*)']+1;
                    echo $id_proyek;
                    ?>" readonly>
                  </div>
                  <div class="form-group col-xs-3">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" name="nama_proyek" class="form-control" placeholder="Nama Proyek">
                  </div>
                  <div class="form-group col-xs-3">
                    <label for="pembuat">NIM Pembuat</label>
                    <input type="text" name="pembuat" class="form-control" value="<?php echo $pengguna;?>" readonly>
                  </div>
                  <div class="form-group col-xs-3">
                    <label for="waktu">Waktu Input</label>
                    <input type="text" name="waktu" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date("d-m-Y")." (".date("H:i:s").")";?>" readonly>
                  </div>
                  <div class="form-group col-xs-2">
                    <label for="effort">Hitung Effort Rate</label>
                    <select class="form-control select2" name="effort">
                      <option value="ya" selected>Ya</option>
                      <option value="tidak">Tidak</option>
                    </select>
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
