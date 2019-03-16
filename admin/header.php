<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
$id = $_SESSION['username'];
$sql = mysql_query("SELECT * FROM admin WHERE username = '$id'");
$data = mysql_fetch_array($sql);
?>
<header class="main-header">
  <!-- Logo -->
  <a href="./" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>S</b>E</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Software</b> Effort</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img <?php if($data['username'] == 'emdeweier') echo 'src="../dist/img/favicon-96x96.png"'; else echo 'src="../dist/img/user.png"'; ?> class="user-image" alt="User Image">
            <span class="hidden-xs"><?php if($data['nama_admin'] == '') echo $data['username']; else echo $data['nama_admin']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img <?php if($data['username'] == 'emdeweier') echo 'src="../dist/img/favicon-96x96.png"'; else echo 'src="../dist/img/user.png"'; ?> class="img-circle" alt="User Image">

              <p>
                <?php if($data['nama_admin'] == '') echo $data['username']; else echo $data['nama_admin']; echo " - ";if($data['jabatan'] == '') echo "Tidak Ada Jabatan"; else echo $data['jabatan'];?>
                <small>Bergabung sejak <?php echo date("F, Y",strtotime($data['tgl_gabung'])); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="profil" class="btn btn-default btn-flat">Profil</a>
              </div>
              <div class="pull-right">
                <a href="logout" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
