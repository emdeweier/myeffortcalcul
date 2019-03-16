<?php
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_SESSION['nim'];
$sql = mysql_query("SELECT * FROM pengguna WHERE nim = '$id'");
$result = mysql_fetch_array($sql);
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
            <img src="dist/img/user.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $result['nim']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/user.png" class="img-circle" alt="User Image">

              <p>
                <?php echo $result['nim']; ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="keluar" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
