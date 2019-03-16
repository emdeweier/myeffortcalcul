<?php
include '../koneksi.php';
$_GET['id_proyek'];
$id_proyek = $_GET['id_proyek'];
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
        Edit Proyek <?php echo $id_proyek; ?>
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
          <li class="active">Edit Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Edit Proyek <?php echo $id_proyek;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Proyek</th>
                  <th>Nama Proyek</th>
                  <th>Real Cost</th>
                  <th>Real Waktu</th>
                  <th>TCF</th>
                  <th>EF</th>
                  <th>UAW</th>
                  <th>UUCW</th>
                  <th>UUCP</th>
                  <th>UCP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM proyek,ef,tcf,uaw,uucw WHERE proyek.id_proyek = ef.id_proyek AND proyek.id_proyek = tcf.id_proyek AND proyek.id_proyek = uaw.id_proyek AND proyek.id_proyek = uucw.id_proyek");
                  while ($data = mysql_fetch_array($query)) {
                  $hasil3[] = $data;
                  }
                  foreach ($hasil3 as $x) {
                ?>
                <tr>
                  <td><?php echo $x['id_proyek'];?></td>
                  <td><?php echo $x['nama_proyek'];?></td>
                  <td><?php echo "Rp. ".number_format($x['real_penghasilan'],0,",",".");?></td>
                  <td><?php echo $x['real_waktu'];?></td>
                  <?php
                    $tcf = $x['rumus'];
                    $ef = $x['rumus_ef'];
                    $uaw = $x['total'];
                    $uucw = $x['hasil'];
                    $uucp = $uaw+$uucw;
                    $ucp = $uucp*$tcf*$ef;
                  ?>
                  <td><?php echo $tcf;?></td>
                  <td><?php echo $ef;?></td>
                  <td><?php echo $uaw;?></td>
                  <td><?php echo $uucw;?></td>
                  <td><?php echo round($uucp,2);?></td>
                  <td><?php echo round($ucp,2);?></td>
                </tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Proyek</th>
                  <th>Nama Proyek</th>
                  <th>Real Cost</th>
                  <th>Real Waktu</th>
                  <th>TCF</th>
                  <th>EF</th>
                  <th>UAW</th>
                  <th>UUCW</th>
                  <th>UUCP</th>
                  <th>UCP</th>
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
