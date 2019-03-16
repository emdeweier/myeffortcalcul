<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
}
?>
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; 2018 <a href="./">Software Effort</a>.</strong> All rights
  reserved. <strong>Designed by <a href="https://adminlte.io">Almsaeed Studio</a>.</strong>
</footer>
