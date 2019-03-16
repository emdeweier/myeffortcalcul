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
$jmldata = $data['COUNT(*)'];
if($jmldata <= 50){
  header("location:normalitas-s?proyek=$id_proyek");
}
$query1 = mysql_query("SELECT * FROM uji_korelasi WHERE id_temp = '$id'");
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
        Uji Normalitas Kolmogorov
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Uji Normalitas Kolmogorov</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Uji Normalitas Kolmogorov</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>UCP</th>
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
                  $query = mysql_query("SELECT ucp FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp ASC");
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
                  $query = mysql_query("SELECT ucp FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp ASC");
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
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil2[] = $data;
                  }
                  foreach ($hasil2 as $x2) {
                    $ucp = $x2['ucp'];
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
              </table>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <th colspan="6">N Sampel</th>
                    <th colspan="1"><center><?php echo $sum; ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Mean</th>
                    <th colspan="1"><center><?php echo round($mean,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Simpangan Baku</th>
                    <th colspan="1"><center><?php echo round($s,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">D<small>n</small></th>
                    <th colspan="1"><center><?php echo round($max,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">KS Tabel</th>
                    <th colspan="1"><center><?php echo round($kstabel,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Kesimpulan</th>
                    <th colspan="1"><center><?php echo $kesimpulan; ?></center></th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-body">
              <div class="alert <?php if($kesimpulan == 'Normal') echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Informasi</h4>
                Hasil pengujian didapatkan bahwa nilai Kolmogorov Smirnov hitung (D<small>n</small>) sebesar <b><?php  echo round($max,3); ?></b> dan KS Tabel sebesar <b><?php  echo round($kstabel,3); ?></b>. Pada derajat kepercayaan 95% maka KS hitung sebesar <?php echo round($max,3); if(round($max,3)<round($kstabel,3)) echo " <b>lebih kecil dari</b> "; else echo " <b>lebih besar dari</b> "; echo round($kstabel,3); ?>.
                Sehingga dapat disimpulkan bahwa variabel tersebut bersifat <b><?php echo $kesimpulan;?></b>. Jadi data tersebut <?php if($kesimpulan == 'Normal') echo '<b>dapat digunakan</b> untuk dicari korelasi datanya'; else  echo '<b>harus diubah</b>. Pengubahan data dapat dilakukan dengan cara menambah data atau menghapus data yang ekstrem'?>.
              </div>
              <?php if($kesimpulan == 'Normal'){ ?>
              <form role="form" action="normalitas-k_db" method="post">
                <input type="hidden" name="id_normalitas" class="form-control" value="<?php
                $query = mysql_query("SELECT COUNT(*) FROM uji_normalitas");
                $data = mysql_fetch_array($query);
                $id_normalitas = $data['COUNT(*)']+1;
                echo $id_normalitas;
                ?>" readonly>
                <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>" readonly>
                <input type="hidden" name="n_sampel" class="form-control" value="<?php echo $sum;?>" readonly>
                <input type="hidden" name="mean" class="form-control" value="<?php echo round($mean,3);?>" readonly>
                <input type="hidden" name="simpangan_baku" class="form-control" value="<?php echo round($s,3);?>" readonly>
                <input type="hidden" name="dn" class="form-control" value="<?php echo round($max,3);?>" readonly>
                <input type="hidden" name="kstabel" class="form-control" value="<?php echo round($kstabel,3);?>" readonly>
                <input type="hidden" name="kesimpulan" class="form-control" value="<?php echo $kesimpulan;?>" readonly>
                <button type="submit" name="submit" class="btn btn-primary" <?php if($data1 != NULL) echo "disabled";?>>Uji Korelasi Data</button>
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
