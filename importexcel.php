<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$query1 = mysql_query("SELECT * FROM dataset_proyek,temp_proyek WHERE dataset_proyek.id_temp = temp_proyek.id_temp AND dataset_proyek.id_temp = '$id'");
$data1 = mysql_fetch_array($query1);
$id_proyek = $data['id_temp'];
if($data === FALSE || $data1 != NULL){
  header("location:tambah");
}
else if($data['effort_rate'] != 0){
  header("location:tambah");
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
        Import Data History Proyek
        <small>proyek <?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Import Data History Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Import Data History Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-body">
                <a href="excel-ucp.xls" class="btn btn-default"><i class="fa fa-download"></i> Unduh Format</a>
              </div>
              <form role="form" action="importexcel_db" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <input type="hidden" name="id_temp" value="<?php echo $id_proyek; ?>" class="form-control">
                  <input type="file" name="file" accept=".xls">
                </div>
                <div class="box-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Lihat Data</button>
                </div>
              </form>
            </div>
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
