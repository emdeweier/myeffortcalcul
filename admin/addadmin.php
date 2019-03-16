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
        Tambah Admin
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Tambah Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tambah Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" action="addadmin_db" method="post">
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama_admin" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama_admin" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>

                  <div class="col-sm-5">
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jabatan" class="col-sm-2 control-label">Level Admin</label>

                  <div class="col-sm-5">
                    <select class="form-control select2" name="level_admin">
                      <option value="admin" selected>Standard Admin</option>
                      <?php if($data['username'] == 'emdeweier'){ ?>
                      <option value="super">Super Admin</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pw" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  </div>
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
