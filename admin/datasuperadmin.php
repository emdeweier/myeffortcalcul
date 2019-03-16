<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
$id = $_SESSION['username'];
$sql = mysql_query("SELECT * FROM admin WHERE username = '$id'");
$data = mysql_fetch_array($sql);
$level = $data['level_admin'];
if($level == 'admin'){
  header("location:./");
}
if($data['username'] != 'emdeweier'){
  header("location:dataadmin");
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
        Data Super Admin
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active"><a href="">Data Super Admin</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Super Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-xs-7">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Username</th>
                  <th>Nama Admin</th>
                  <th>Jabatan</th>
                  <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query2 = mysql_query("SELECT * FROM admin WHERE level_admin = 'super' AND username != 'emdeweier' ORDER BY username ASC");
                  while ($data2 = mysql_fetch_array($query2)) {
                  $hasil2[] = $data2;
                  }
                  foreach ($hasil2 as $x2) {
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x2['username'];?></td>
                  <td><?php echo $x2['nama_admin'];?></td>
                  <td><?php echo $x2['jabatan'];?></td>
                  <td><center><a href="editsuperadmin?username=<?php echo $x2['username'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a></center></td>
                  <td><center><button type="button" data-id="<?php echo $x2['username']; ?>" data-value="<?php echo $x2['nama_admin']; ?>" class="btn btn-danger trash" data-toggle="modal" data-target="#modal-default"><i class="fa fa-trash"></i></button></center></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
              </div>
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Konfirmasi Hapus</h4>
                    </div>
                    <div class="modal-body">
                      <p><i class="fa fa-warning"></i> Data terhapus tidak dapat dikembalikan.</p>
                      <p id="modal-body"></p>
                    </div>
                    <div class="modal-footer">
                      <a href="#" class="btn btn-danger pull-left" id="modal-delete">Ya</a>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    </div>
                  </div>
                </div>
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
<script>
$('.trash').click(function(){
    var id=$(this).data('id');
    var nama=$(this).data('value');
    $('#modal-body').html('<p>Apakah Anda yakin ingin menghapus data admin '+nama+' ?</p>');
    $('#modal-delete').attr('href','hapussuperadmin.php?username='+id);
})
</script>
</body>
</html>
