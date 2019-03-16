<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
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
        Klasifikasi Penilaian
        <small>Fuzzy Use Case Point</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"><a href="">Klasifikasi Penilaian FUCP</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Klasifikasi Penilaian</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-xs-6">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Jumlah Transaksi</th>
                  <th>Nilai Metode UCP</th>
                  <th>Nilai Metode FUCP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query2 = mysql_query("SELECT * FROM klasifikasi_fucp");
                  while ($data2 = mysql_fetch_array($query2)) {
                  $hasil2[] = $data2;
                  }
                  foreach ($hasil2 as $x2) {
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x2['jml_transaksi'];?> Transaksi</td>
                  <td><?php echo $x2['nilai_metodeucp'];?></td>
                  <td><?php echo $x2['nilai_metodefucp'];?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
              </div>
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
