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
        Rekap Proyek Pengguna
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Rekap Proyek Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Rekap Proyek Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Proyek</th>
                  <th>UAW</th>
                  <th>UUCW</th>
                  <th>UUCP</th>
                  <th>TCF</th>
                  <th>EF</th>
                  <th>UCP</th>
                  <th>Nama Pembuat</th>
                  <th>Tanggal Input</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM proyek");
                  while ($data = mysql_fetch_array($query)) {
                  $hasil3[] = $data;
                  }
                  foreach ($hasil3 as $x) {
                ?>
                <tr>
                  <td><?php echo $x['id_proyek'];?></td>
                  <td><a href="proyek?proyek=<?php echo $x['id_proyek'];?>"><?php echo $x['nama_proyek'];?></a></td>
                  <td><?php echo $x['uaw'];?></td>
                  <td><?php echo $x['uucw'];?></td>
                  <td><?php echo $x['uucp'];?></td>
                  <td><?php echo $x['tcf'];?></td>
                  <td><?php echo $x['ef'];?></td>
                  <td><?php echo $x['ucp'];?></td>
                  <td><?php echo $x['nama_pembuat'];?></td>
                  <td><?php echo date("d-m-Y (H:i:s)",strtotime($x['create_date']));?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="9">Effort Rate (Man / Hours)</th>
                  <?php
                    $query = mysql_query("SELECT * FROM setting_value");
                    $data = mysql_fetch_array($query);
                    $er = $data['effort_rate'];
                  ?>
                  <th colspan="2"><center><?php echo $er; ?></center></th>
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
