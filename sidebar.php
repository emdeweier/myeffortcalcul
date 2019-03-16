<?php
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_SESSION['nim'];
$sql = mysql_query("SELECT * FROM pengguna WHERE nim = '$id'");
$result = mysql_fetch_array($sql);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $result['nim']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU NAVIGASI</li>
      <li><a href="tambah"><i class="fa fa-plus"></i> <span>Tambah Proyek</span></a></li>
      <li><a href="klasifikasi"><i class="fa fa-exchange"></i> <span>Klasifikasi FUCP</span></a></li>
      <li><a href="cara-penggunaan"><i class="fa fa-bullhorn"></i> <span>Cara Penggunaan</span></a></li>
      <li><a href="tentang"><i class="fa fa-info-circle"></i> <span>Tentang Kami</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
