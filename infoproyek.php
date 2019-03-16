<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$id_proyek = $data['id_temp'];
if($data === FALSE || $data == NULL){
  header("location:tambah");
}
$query1 = mysql_query("SELECT * FROM uji_normalitas WHERE id_temp = '$id'");
$data1 = mysql_fetch_array($query1);
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
        Info Proyek
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Informasi Dataset Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Info Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Id Proyek</th>
                  <th>Kategori Proyek</th>
                  <th>Effort Aktual</th>
                  <th>UCP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek'");
                  while ($data = mysql_fetch_array($query)) {
                  $hasil3[] = $data;
                  }
                  foreach ($hasil3 as $x) {
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x['id_temp'];?></td>
                  <td><?php echo $x['kategori_proyek'];?></td>
                  <td><?php echo $x['effort_aktual'];?></td>
                  <td><?php echo $x['ucp'];?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
              <?php if($no-1 <= 50 && $no-1 >= 3){ ?>
              <a href="normalitas-s?proyek=<?php echo $id_proyek; ?>"><button class="btn btn-primary" name="norms" <?php if($data1 != NULL) echo "disabled";?>>Uji Normalitas Data</button></a>
            <?php }else if($no-1 > 50){ ?>
              <a href="normalitas-k?proyek=<?php echo $id_proyek; ?>"><button class="btn btn-primary" name="normk" <?php if($data1 != NULL) echo "disabled";?>>Uji Normalitas Data</button></a>
              <?php }else { ?>
              <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Warning</h4>
                N-Sampel kurang dari 3 data, data harus diubah agar dapat diproses.
              </div>
              <a href="ubahdata?proyek=<?php echo $id_proyek; ?>"><button class="btn btn-primary" name="ubah" <?php if($data1 != NULL) echo "disabled";?>>Ubah Data</button></a>
              <?php } ?>
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
