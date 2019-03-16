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
              <form role="form" action="input.php" method="post">
                <div class="box-body">
                  <div class="form-group col-xs-4">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" name="nama_proyek" class="form-control" placeholder="Nama Proyek">
                  </div>
                  <div class="form-group col-xs-4">
                    <label for="effort_aktual">Effort Aktual</label>
                    <input type="text" name="effort_aktual" class="form-control" placeholder="Effort Aktual">
                  </div>
                  <div class="form-group col-xs-4">
                    <label for="ucp">UCP</label>
                    <input type="text" name="ucp" class="form-control" placeholder="Use Case Point">
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
