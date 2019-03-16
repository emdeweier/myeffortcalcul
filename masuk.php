<?php
session_start();
if(isset($_SESSION['nim'])){
  header("location:./");
}
?>
<!DOCTYPE html>
<html>
<?php require 'head.php'; ?>
<body class="hold-transition login-page" style="height:auto">
<div class="login-box">
  <div class="login-logo">
    <b>Software</b> Effort
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masukkan Akun Anda</p>

    <form action="ceklogin" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nim_pengguna" placeholder="Nomor Induk Mahasiswa">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
      Belum punya akun? Daftar <a href="daftar">disini</a>
    </form>

  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2018 <strong><a href="./" class="text-black">Software Effort</a></strong>.<br>All rights
    reserved.<br>Template by <strong><a href="https://adminlte.io" class="text-black">Almsaeed Studio</a></strong>.
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
