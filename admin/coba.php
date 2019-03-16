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
        Beranda
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Rekap Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Proyek</th>
                  <th>Effort Aktual</th>
                  <th>UCP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM proyek_lama");
                  while ($data = mysql_fetch_array($query)) {
                  $hasil[] = $data;
                  }
                  foreach ($hasil as $x) {
                    $nama_proyek = $x['nama_proyek'];
                    $effort_aktual = $x['effort_aktual'];
                    $ucp = $x['ucp'];
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $nama_proyek;?></td>
                  <td><?php echo $effort_aktual;?></td>
                  <td><?php echo round($ucp,2);?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="3">Effort Rate</th>
                  <th colspan="1"><center><?php echo $ermh; ?></center></th>
                </tr>
                </tfoot>
              </table>

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
