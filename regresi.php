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
$query1 = mysql_query("SELECT * FROM regresi WHERE id_temp = '$id'");
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
        Regresi
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Analisis Regresi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Analisis Regresi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Effort Aktual (Y)</th>
                  <th>UCP (X)</th>
                  <th>Nama Proyek</th>
                  <th>Effort Aktual * UCP</th>
                  <th>(Effort Aktual)^2</th>
                  <th>(UCP)^2</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp='$id_proyek' ORDER BY effort_aktual ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil[] = $data;
                  }
                  foreach ($hasil as $x) {
                    $sum += 1;
                    $ucp = $x['ucp'];
                    $sumucp += $ucp;
                    $sumucpucp += $ucp*$ucp;
                    $effort_aktual = $x['effort_aktual'];
                    $sumeffort += $effort_aktual;
                    $exucp = $effort_aktual*$ucp;
                    $sumexucp += $exucp;
                    $ucp2 = $x['ucp']*$x['ucp'];
                    $sumucp2 += $ucp2;
                    $sumucpucp2 += $ucp2*$ucp2;
                    $effort_aktual2 = $x['effort_aktual']*$x['effort_aktual'];
                    $sumeffort2 += $effort_aktual2;
                    $nama_proyek = $x['nama_proyek'];
                ?>
                <tr>
                  <td><?php echo $effort_aktual;?></td>
                  <td><?php echo $ucp;?></td>
                  <td><?php echo $nama_proyek;?></td>
                  <td><?php echo $exucp;?></td>
                  <td><?php echo $effort_aktual2;?></td>
                  <td><?php echo $ucp2;?></td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th><?php echo $sumeffort; ?></th>
                  <th><?php echo $sumucp; ?></th>
                  <th><center>-</center></th>
                  <th><?php echo $sumexucp; ?></th>
                  <th><?php echo $sumeffort2; ?></th>
                  <th><?php echo $sumucp2; ?></th>
                </tr>
                </tfoot>
              </table>
              <br>
              <table class="table table-bordered table-striped">
                <?php
                  $a = ($sumeffort*$sumucpucp)-($sumucp*$sumexucp);
                  $b = ($sum*$sumucpucp)-($sumucp*$sumucp);
                  $c = $a/$b;

                  $a1 = ($sum*$sumexucp)-($sumucp*$sumeffort);
                  $b1 = ($sum*$sumucpucp)-($sumucp*$sumucp);
                  $c1 = $a1/$b1;

                  $a2 = ($sumeffort2)-(($sumeffort*$sumeffort)/$sum);
                  $b2 = ($sumexucp)-(($sumucp*$sumeffort)/$sum);
                  $c2 = $c1*$b2;
                  $d2 = $a2-$c2;

                  $sum1 = $sum-1;
                  $sum2 = $sum1-1;
                  $sum3 = $sum-$sum1;
                  $d = $c2/$sum3;
                  $d1 = $d2/$sum2;
                  $fo = $d/$d1;

                  $x1 = $ucp;
                  $x2 = $sumucp;
                  $y1 = $c+($c1*$ucp);
                  $y2 = $c+($c1*$sumucp);
                ?>
                <tr>
                  <th colspan="5">Koefisien</th>
                  <th colspan="1"><center><?php echo round($c,5); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Koefisien UCP</th>
                  <th colspan="1"><center><?php echo round($c1,8); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Regresi</th>
                  <th colspan="1"><center><?php echo round($c2,1); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Residual</th>
                  <th colspan="1"><center><?php echo round($d2,1); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Regresi + Residual</th>
                  <th colspan="1"><center><?php echo round($a2,0); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">MS<small>1</small></th>
                  <th colspan="1"><center><?php echo round($d,1); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">MS<small>2</small></th>
                  <th colspan="1"><center><?php echo round($d1,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">F<small>o</small></th>
                  <th colspan="1"><center><?php echo round($fo,5); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">X<small>1</small></th>
                  <th colspan="1"><center><?php echo round($x1,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Y<small>1</small></th>
                  <th colspan="1"><center><?php echo round($y1,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">X<small>2</small></th>
                  <th colspan="1"><center><?php echo round($x2,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Y<small>2</small></th>
                  <th colspan="1"><center><?php echo round($y2,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Y<small>2</small> - Y<small>1</small></th>
                  <th colspan="1"><center><?php echo round($y2-$y1,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">X<small>2</small> - X<small>1</small></th>
                  <th colspan="1"><center><?php echo round($x2-$x1,2); ?></center></th>
                </tr>
                <tr>
                  <th colspan="5">Effort Rate = (Y<small>2</small> - Y<small>1</small>)/(X<small>2</small> - X<small>1</small>)</th>
                  <th colspan="1"><center><?php echo round(($y2-$y1)/($x2-$x1),2); ?></center></th>
                </tr>
              </table>
            </div>
            <div class="box-body">
              <div class="alert <?php if(round(($y2-$y1)/($x2-$x1),2) <= 20) echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Kesimpulan</h4>
                Hasil perhitungan regresi didapat nilai F sebesar <b><?php echo round($fo,5); ?></b>. Nilai Y1 dan Y2 didapatkan dari rumus <b><?php echo round($c,2); ?> + <?php echo round($c1,2); ?>X</b>. Sedangkan untuk nilai X yang merupakan X1 dan X2 diambil dari nilai UCP terakhir dan total nilai UCP. Kemudian, dengan perhitungan seperti di atas dihasilkan Effort Rate sebesar <b><?php echo round(($y2-$y1)/($x2-$x1),2); ?></b>.
              </div>
              <?php if($i >= 0){ ?>
              <form role="form" action="regresi_db" method="post">
                <input type="hidden" name="id_regresi" class="form-control" value="<?php
                $query = mysql_query("SELECT COUNT(*) FROM uji_regresi");
                $data = mysql_fetch_array($query);
                $id_regresi = $data['COUNT(*)']+1;
                echo $id_regresi;
                ?>" readonly>
                <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>" readonly>
                <input type="hidden" name="nilai_f" class="form-control" value="<?php echo round($fo,5);?>" readonly>
                <input type="hidden" name="ucp1" class="form-control" value="<?php echo round($x1,2);?>" readonly>
                <input type="hidden" name="effort1" class="form-control" value="<?php echo round($y1,2);?>" readonly>
                <input type="hidden" name="ucp2" class="form-control" value="<?php echo round($x2,2);?>" readonly>
                <input type="hidden" name="effort2" class="form-control" value="<?php echo round($y2,2);?>" readonly>
                <input type="hidden" name="selisihucp" class="form-control" value="<?php echo round($x2-$x1,2);?>" readonly>
                <input type="hidden" name="selisiheffort" class="form-control" value="<?php echo round($y2-$y1,2);?>" readonly>
                <input type="hidden" name="effort_rate" class="form-control" value="<?php echo round(($y2-$y1)/($x2-$x1),2);?>" readonly>
                <button type="submit" name="submit" class="btn btn-primary" <?php if($data1 != NULL) echo "disabled";?>>Proses UCP</button>
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
