<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$id_proyek = $data['id_temp'];
if($data === FALSE || $data == NULL){
  header("location:tambah");
}
$query1 = mysql_query("SELECT * FROM uji_regresi WHERE id_temp = '$id'");
$data1 = mysql_fetch_array($query1);
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
        Uji Korelasi Pearson
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Uji Korelasi Pearson</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Uji Korelasi Pearson</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-header">
              <h3 class="box-title">Rentang Perhitungan Korelasi Pearson</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Rentang</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $query = mysql_query("SELECT * FROM rentang");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil2[] = $data;
                  }
                  foreach ($hasil2 as $x2) {
                ?>
                <tr>
                  <td><?php echo $x2['rentang1']." - ".$x2['rentang2'];?></td>
                  <td><?php echo $x2['keterangan'];?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <div class="box-header">
              <h3 class="box-title">Tabel Perhitungan</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Effort Aktual (Y)</th>
                  <th>UCP (X)</th>
                  <th>Y^2</th>
                  <th>X^2</th>
                  <th>X*Y</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp='$id_proyek' ORDER BY effort_aktual ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil3[] = $data;
                  }
                  foreach ($hasil3 as $x3) {
                    $sum += 1;
                    $sumucp += $x3['ucp'];
                    $sumeffort += $x3['effort_aktual'];
                    $sumucp2 += $x3['ucp']*$x3['ucp'];
                    $sumeffort2 += $x3['effort_aktual']*$x3['effort_aktual'];
                    $sumexucp += $x3['ucp']*$x3['effort_aktual'];
                ?>
                <tr>
                  <td><?php echo $x3['effort_aktual'];?></td>
                  <td><?php echo $x3['ucp'];?></td>
                  <td><?php echo $x3['ucp']*$x3['ucp'];?></td>
                  <td><?php echo $x3['effort_aktual']*$x3['effort_aktual'];?></td>
                  <td><?php echo $x3['ucp']*$x3['effort_aktual'];?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo $sumeffort; ?></th>
                  <th><?php echo $sumucp; ?></th>
                  <th><?php echo $sumeffort2; ?></th>
                  <th><?php echo $sumucp2; ?></th>
                  <th><?php echo $sumexucp; ?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <?php
              $a = $sum*$sumexucp;
              $b = $sumucp*$sumeffort;
              $c = $sum*$sumucp2;
              $d = $sumucp*$sumucp;
              $e = $sum*$sumeffort2;
              $f = $sumeffort*$sumeffort;

              $ab = $a-$b;
              $cd = $c-$d;
              $ef = $e-$f;
              $g = $cd*$ef;
              $h = sqrt($g);
              $i = abs($ab/$h);
              $jkt = $sumeffort2-($f/$sum);
              $j = $sumeffort*$sumucp2;
              $k = $sumucp*$sumexucp;
              $a1 = (($j)-($k))/(($c)-($d));
              $b1 = (($a)-($b))/(($c)-($d));
              $jkxy = $sumexucp-(($sumucp*$sumeffort)/$sum);
              $jkr = $b1*$jkxy;
              $jktmjkr = $jkt-$jkr;
              $jkrpjkt = $jkr/$jkt;
              $query2 = mysql_query("SELECT * FROM rentang WHERE $i >= rentang1 AND $i <= rentang2");
              $data2 = mysql_fetch_array($query2);
            ?>
            <div class="box-header">
              <h3 class="box-title">Hasil Perhitungan Korelasi Pearson</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <th colspan="6">Multiple R</th>
                    <th colspan="1"><center><?php echo round($i,8)." <i class='fa fa-arrow-right'></i> ".round($i,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">R Square</th>
                    <th colspan="1"><center><?php echo round($jkrpjkt,9)." <i class='fa fa-arrow-right'></i> ".round($jkrpjkt,3); ?></center></th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-body">
              <div class="alert <?php if($i >= 0) echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Kesimpulan</h4>
                Hasil perhitungan korelasi <i>Pearson</i> didapat sebesar sebesar <b><?php  echo round($i,3); ?></b>. Hal ini menunjukkan bahwa <b><?php echo $data2['keterangan'];?></b>.
              </div>
              <?php if($i >= 0){ ?>
              <form role="form" action="korelasi_db" method="post">
                <input type="hidden" name="id_korelasi" class="form-control" value="<?php
                $query = mysql_query("SELECT COUNT(*) FROM uji_korelasi");
                $data = mysql_fetch_array($query);
                $id_korelasi = $data['COUNT(*)']+1;
                echo $id_korelasi;
                ?>" readonly>
                <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>" readonly>
                <input type="hidden" name="multiple_r" class="form-control" value="<?php echo round($i,3);?>" readonly>
                <input type="hidden" name="r_square" class="form-control" value="<?php echo round($jkrpjkt,3);?>" readonly>
                <input type="hidden" name="keterangan" class="form-control" value="<?php echo $data2['keterangan'];?>" readonly>
                <button type="submit" name="submit" class="btn btn-primary" <?php if($data1 != NULL) echo "disabled";?>>Uji Regresi Data</button>
              </form>
              <?php }
              else{
                echo '<a href="ubahdata?proyek='.$id_proyek.'" class="btn btn-primary">Ubah Data</a>';
              } ?>
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
