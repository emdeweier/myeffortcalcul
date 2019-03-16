<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
$id = $_SESSION['username'];
$sql = mysql_query("SELECT * FROM admin WHERE username = '$id'");
$data = mysql_fetch_array($sql);
$level = $data['level_admin'];
$username = $data['username'];
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img <?php if($data['username'] == 'emdeweier') echo 'src="../dist/img/favicon-96x96.png"'; else echo 'src="../dist/img/user.png"'; ?> class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php if($data['nama_admin'] == '') echo $data['username']; else echo $data['nama_admin']; ?></p>
        <i class="fa fa-circle text-success" title="terakhir online"></i> <?php echo date("d-m-y, H:i:s",strtotime($data['last_login'])); ?>
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
      <li class="treeview">
        <a href="#">
          <i class="fa fa-flask"></i> <span>Proyek</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="tambah"><i class="fa fa-plus"></i> <span>Tambah Proyek</span></a></li>
          <li><a href="proyek"><i class="fa fa-archive"></i> Data Proyek</a></li>
          <li><a href="rekap"><i class="fa fa-archive"></i> Rekap Proyek</a></li>
          <li><a href="regresi"><i class="fa fa-archive"></i> Regresi</a></li>
        </ul>
      </li>
      <?php
        if($level == 'super'){
      ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i> <span>Admin</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="addadmin"><i class="fa fa-user-plus"></i> <span>Tambah Admin</span></a></li>
          <li><a href="dataadmin"><i class="fa fa-user"></i> Data Admin</a></li>
          <?php if ($username == 'emdeweier'){ ?>
          <li><a href="datasuperadmin"><i class="fa fa-user-secret"></i> Data Super Admin</a></li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
      <li><a href="klasifikasi"><i class="fa fa-exchange"></i> <span>Klasifikasi FUCP</span></a></li>
      <li><a href="cara-penggunaan"><i class="fa fa-bullhorn"></i> <span>Cara Penggunaan</span></a></li>
      <li><a href="tentang"><i class="fa fa-info-circle"></i> <span>Tentang Kami</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
