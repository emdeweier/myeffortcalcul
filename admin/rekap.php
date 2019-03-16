<?php
include '../koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:../masuk");
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
        Rekap Proyek
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Rekap Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Rekap Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Var I</th>
                  <th>Nama Proyek</th>
                  <th>Frekuensi</th>
                  <th>Kumulatif</th>
                  <th>S<small>n</small>(X)</th>
                  <th>Z-Score</th>
                  <th>F(X)</th>
                  <th>Difference</th>
                </tr>
                </thead>
                <tbody>
                <?php
                function cumnormdist($x)
                {
                  $b1 =  0.319381530;
                  $b2 = -0.356563782;
                  $b3 =  1.781477937;
                  $b4 = -1.821255978;
                  $b5 =  1.330274429;
                  $p  =  0.2316419;
                  $c  =  0.39894228;

                  if($x >= 0.0) {
                      $t = 1.0 / ( 1.0 + $p * $x );
                      return (1.0 - $c * exp( -$x * $x / 2.0 ) * $t *
                      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
                  }
                  else {
                      $t = 1.0 / ( 1.0 - $p * $x );
                      return ( $c * exp( -$x * $x / 2.0 ) * $t *
                      ( $t *( $t * ( $t * ( $t * $b5 + $b4 ) + $b3 ) + $b2 ) + $b1 ));
                    }
                }
                ?>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT ucp FROM proyek_lama ORDER BY ucp ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil[] = $data;
                  }
                  foreach ($hasil as $x) {
                    $ucp = $x['ucp'];
                    $sum += 1;
                    $sumucp += $ucp;
                    $mean = $sumucp/$sum;
                  }
                ?>
                <?php
                  $query = mysql_query("SELECT ucp FROM proyek_lama ORDER BY ucp ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil1[] = $data;
                  }
                  foreach ($hasil1 as $x1) {
                    $ucp = $x1['ucp'];
                    $std = pow(($ucp-$mean),2);
                    $sumstd += $std;
                  }
                  $s2 = $sumstd/($sum-1);
                  $s = sqrt($s2);
                ?>
                <?php
                  $max = 0;
                  $query = mysql_query("SELECT * FROM proyek_lama ORDER BY ucp ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil2[] = $data;
                  }
                  foreach ($hasil2 as $x2) {
                    $ucp = $x2['ucp'];
                    $nama_proyek = $x2['nama_proyek'];
                    $sn = ($no)/$sum;
                    $zscore = ($ucp-$mean)/$s;
                    $normdist = cumnormdist($zscore);
                    $diff = abs(cumnormdist($zscore)-$sn);
                    if($diff > $max){
                      $max = $diff;
                    }
                    else{
                      $max = $max;
                    }
                ?>
                <tr>
                  <td><?php echo $ucp;?></td>
                  <td><?php echo $nama_proyek;?></td>
                  <td><?php echo 1;?></td>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $sn;?></td>
                  <td><?php echo round($zscore,9);?></td>
                  <td><?php echo round($normdist,6);?></td>
                  <td><?php echo round($diff,9);?></td>
                </tr>
                <?php
                  }
                  $s2 = $sumstd/($sum-1);
                  $s = sqrt($s2);
                  $kstabel = 1.36/(sqrt($sum));
                  if($max<$kstabel){
                    $kesimpulan = "Normal";
                  }
                  else{
                    $kesimpulan = "Tidak Normal";
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="7">N Sampel</th>
                  <th colspan="1"><center><?php echo $sum; ?></center></th>
                </tr>
                <tr>
                  <th colspan="7">Mean</th>
                  <th colspan="1"><center><?php echo $mean; ?></center></th>
                </tr>
                <tr>
                  <th colspan="7">Simpangan Baku</th>
                  <th colspan="1"><center><?php echo round($s,3); ?></center></th>
                </tr>
                <tr>
                  <th colspan="7">D<small>n</small></th>
                  <th colspan="1"><center><?php echo round($max,3); ?></center></th>
                </tr>
                <tr>
                  <th colspan="7">KS Tabel</th>
                  <th colspan="1"><center><?php echo round($kstabel,3); ?></center></th>
                </tr>
                <tr>
                  <th colspan="7">Kesimpulan</th>
                  <th colspan="1"><center><?php echo $kesimpulan; ?></center></th>
                </tr>
                </tfoot>
              </table>

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
