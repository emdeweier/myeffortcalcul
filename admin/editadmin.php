<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
$id = $_GET['username'];
$query1 = mysql_query("SELECT * FROM admin WHERE username = '$id'");
$data1 = mysql_fetch_array($query1);
$username = $data1['username'];
if($data1 === FALSE){
  header("location:dataadmin");
}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Edit Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../dist/img/user.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php if($data1['nama_admin'] == '') echo $data1['username']; else echo $data1['nama_admin']; ?></h3>

              <p class="text-muted text-center"><?php echo $data1['jabatan']; ?></p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-body">
                <form class="form-horizontal" action="editadmin_db?username=<?php echo $data1['username']; ?>" method="post">
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" value="<?php echo $data1['username']; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_admin" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_admin" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>

                    <div class="col-sm-10">
                      <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pwlama" class="col-sm-2 control-label">Password Lama</label>

                    <div class="col-sm-10">
                      <input type="password" name="pwlama" class="form-control" placeholder="Password Lama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pwbaru" class="col-sm-2 control-label">Password Baru</label>

                    <div class="col-sm-10">
                      <input type="password" name="pwbaru" class="form-control" placeholder="Password Baru">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
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
