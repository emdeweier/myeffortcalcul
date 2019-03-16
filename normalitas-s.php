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
if($jmldata > 50){
  header("location:normalitas-k?proyek=$id_proyek");
}
$query10 = mysql_query("SELECT * FROM uji_korelasi WHERE id_temp = '$id_proyek'");
$data10 = mysql_fetch_array($query10);
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
        Uji Normalitas Shapiro Wilk
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li>Tambah Proyek</li>
        <li class="active">Uji Normalitas Shapiro Wilk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#ucp" data-toggle="tab">UCP</a></li>
                <li><a href="#effort" data-toggle="tab">Effort</a></li>
                <li><a href="#kesimpulan" data-toggle="tab">Kesimpulan</a></li>
              </ul>
            <!-- /.box-header -->
            <div class="tab-content">
            <div class="active tab-pane" id="ucp">
            <div class="box-header">
              <h3 class="box-title">Hasil berdasarkan urutan UCP</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nilai UCP</th>
                  <th>(Nilai UCP - Mean)²</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $max = 0;
                  $no = 1;
                  $query1 = mysql_query("SELECT COUNT(*),SUM(ucp) FROM dataset_proyek WHERE id_temp = '$id_proyek'");
                  $data1 = mysql_fetch_array($query1);
                  $n = $data1['COUNT(*)'];
                  $totalucp = $data1['SUM(ucp)'];
                  $mean = $totalucp/$n;
                  $bagidua = $totalucp/2;
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil2[] = $data;
                  }
                  foreach ($hasil2 as $x2) {
                  $ucpmean = round(($x2['ucp']-$mean)*($x2['ucp']-$mean),3);
                  $totalucpmean += $ucpmean;
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x2['ucp'];?></td>
                  <td><?php echo $ucpmean;?></td>
                <?php
                  }
                ?>
                </tr>
                </tbody>
                <tfoot>
                  <th>No.</th>
                  <th>Nilai UCP</th>
                  <th>(Nilai UCP - Mean)²</th>
                </tfoot>
              </table>
              <br>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>A</th>
                  <th>Nilai A</th>
                  <th>UCP Difference</th>
                  <th>Nilai A * UCP Difference</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query1 = mysql_query("SELECT * FROM tabel_saphiro WHERE n_sampel = '$n'");
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp ASC");
                  $query2 = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY ucp DESC");
                  while ($data1 = mysql_fetch_array($query1)) {
                    $hasil3[] = $data1;
                  }
                  foreach ($hasil3 as $x3) {
                  $data = mysql_fetch_array($query);
                  $data2 = mysql_fetch_array($query2);
                  $ucp = $data['ucp'];
                  $ucpd = $data2['ucp'];
                  $kurang = $ucpd - $ucp;
                  $nilaia = $kurang*$x3['nilai_a'];
                  $sumnilaia += $nilaia;
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x3['a'];?></td>
                  <td><?php echo round($x3['nilai_a'],4);?></td>
                  <td><?php echo $kurang;?></td>
                  <td><?php echo $nilaia;?></td>
                <?php
                  }
                ?>
                </tr>
                </tbody>
                <tfoot>
                  <th>N Sampel</th>
                  <th>A</th>
                  <th>Nilai A</th>
                  <th>UCP Difference</th>
                  <th>Nilai A * UCP Difference</th>
                </tfoot>
              </table>
              <br>
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                    <th colspan="6">N Sampel</th>
                    <th colspan="1"><center><?php echo $n; ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">ΣNilai UCP</th>
                    <th colspan="1"><center><?php echo round($totalucp,1); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Mean (ΣNilai UCP/N Sampel)</th>
                    <th colspan="1"><center><?php echo round($mean,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Σ(Nilai UCP - Mean)² <i class="fa fa-arrow-right"></i> SS</th>
                    <th colspan="1"><center><?php echo round($totalucpmean,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">ΣNilai A * UCP Difference <i class="fa fa-arrow-right"></i> b</th>
                    <th colspan="1"><center><?php echo round($sumnilaia,4); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">b²/SS</th>
                    <?php $bpss = ($sumnilaia*$sumnilaia)/$totalucpmean; ?>
                    <th colspan="1"><center><?php echo round($bpss,3); ?></center></th>
                  </tr>
                  <?php
                    $query3 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n'");
                    while ($data3 = mysql_fetch_array($query3)) {
                      $hasil4[] = $data3;
                    }
                    foreach ($hasil4 as $x4) {
                      $nilaip = $x4['nilai_p'];
                      $query4 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n' AND $bpss <= nilai_p");
                      $data4 = mysql_fetch_array($query4);
                      $query5 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n' AND $bpss >= nilai_p ORDER BY nilai_p DESC");
                      $data5 = mysql_fetch_array($query5);
                    }
                    $p1_ucp = $data5['p'];
                    $p2_ucp = $data4['p'];
                    $nilaip1_ucp = $data5['nilai_p'];
                    $nilaip2_ucp = $data4['nilai_p'];
                    $pvalue = $p1_ucp-(($p1_ucp-$p2_ucp)*($bpss-$nilaip1_ucp)/($nilaip2_ucp-$nilaip1_ucp));
                    if($pvalue>0.05){
                      $kesimpulan = "Normal";
                    }
                    else{
                      $kesimpulan = "Tidak Normal";
                    }
                  ?>
                  <tr>
                    <th colspan="6">p = <?php echo $p1_ucp; ?></th>
                    <th colspan="1"><center><?php echo round($nilaip1_ucp,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">p = <?php echo $p2_ucp; ?></th>
                    <th colspan="1"><center><?php echo round($nilaip2_ucp,3); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">p-value</th>
                    <th colspan="1"><center><?php echo round($pvalue,6); ?></center></th>
                  </tr>
                  <tr>
                    <th colspan="6">Kesimpulan</th>
                    <th colspan="1"><center><?php echo $kesimpulan; ?></center></th>
                  </tr>
                </tbody>
              </table>
              <br>
              <div class="alert <?php if($kesimpulan == 'Normal') echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Informasi</h4>
              Pengujian normalitas Shapiro Wilk berdasarkan urutan Effort Aktual menghasilkan nilai p-value = <?php echo round($pvalue,6) ?> dan nilai tersebut <?php if($pvalue > 0.05) echo "lebih besar dari"; else echo "lebih kecil dari" ?> 0.05. Jadi data tersebut <?php if($kesimpulan == 'Normal') echo '<b>dapat digunakan</b> untuk dicari korelasi datanya'; else  echo '<b>harus diubah</b>. Pengubahan data dapat dilakukan dengan cara menambah data atau menghapus data yang ekstrem'?>.
              </div>
            </div>
            </div>
            <div class="tab-pane" id="effort">
              <div class="box-header">
              <h3 class="box-title">Hasil berdasarkan urutan Effort Aktual</h3>
            </div>
              <div class="box-body">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nilai Effort</th>
                      <th>(Nilai Effort - Mean)²</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                  $max = 0;
                  $no = 1;
                  $query1 = mysql_query("SELECT COUNT(*),SUM(effort_aktual) FROM dataset_proyek WHERE id_temp = '$id_proyek'");
                  $data1 = mysql_fetch_array($query1);
                  $n = $data1['COUNT(*)'];
                  $totaleffort = $data1['SUM(effort_aktual)'];
                  $mean_effort = $totaleffort/$n;
                  $bagidua = $totalucp/2;
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY effort_aktual ASC");
                  while ($data = mysql_fetch_array($query)) {
                    $hasil5[] = $data;
                  }
                  foreach ($hasil5 as $x5) {
                  $effortmean = round(($x5['effort_aktual']-$mean_effort)*($x5['effort_aktual']-$mean_effort),3);
                  $totaleffortmean += $effortmean;
                ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $x5['effort_aktual'];?></td>
                      <td><?php echo $effortmean;?></td>
                <?php
                  }
                ?>
                    </tr>
                  </tbody>
                  <tfoot>
                    <th>No.</th>
                    <th>Nilai Effort</th>
                    <th>(Nilai Effort - Mean)²</th>
                  </tfoot>
                </table>
                <br>
                <table id="example4" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>A</th>
                      <th>Nilai A</th>
                      <th>Effort Difference</th>
                      <th>Nilai A * Effort Difference</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                  $no = 1;
                  $query1 = mysql_query("SELECT * FROM tabel_saphiro WHERE n_sampel = '$n'");
                  $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY effort_aktual ASC");
                  $query2 = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek' ORDER BY effort_aktual DESC");
                  while ($data1 = mysql_fetch_array($query1)) {
                    $hasil6[] = $data1;
                  }
                  foreach ($hasil6 as $x6) {
                  $data = mysql_fetch_array($query);
                  $data2 = mysql_fetch_array($query2);
                  $effort = $data['effort_aktual'];
                  $effortd = $data2['effort_aktual'];
                  $kurang1 = $effortd - $effort;
                  $nilaia1 = $kurang1*$x6['nilai_a'];
                  $sumnilaia1 += $nilaia1;
                ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $x6['a'];?></td>
                      <td><?php echo round($x6['nilai_a'],4);?></td>
                      <td><?php echo $kurang1;?></td>
                      <td><?php echo $nilaia1;?></td>
                <?php
                  }
                ?>
                    </tr>
                  </tbody>
                  <tfoot>
                    <th>N Sampel</th>
                    <th>A</th>
                    <th>Nilai A</th>
                    <th>Effort Difference</th>
                    <th>Nilai A * Effort Difference</th>
                  </tfoot>
                </table>
                <br>
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th colspan="6">N Sampel</th>
                      <th colspan="1"><center><?php echo $n; ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">ΣNilai Effort</th>
                      <th colspan="1"><center><?php echo round($totaleffort,1); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">Mean (ΣNilai Effort/N Sampel)</th>
                      <th colspan="1"><center><?php echo round($mean_effort,3); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">Σ(Nilai Effort - Mean)² <i class="fa fa-arrow-right"></i> SS</th>
                      <th colspan="1"><center><?php echo round($totaleffortmean,3); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">ΣNilai A * Effort Difference <i class="fa fa-arrow-right"></i> b</th>
                      <th colspan="1"><center><?php echo round($sumnilaia1,4); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">b²/SS</th>
                    <?php $bpss1 = ($sumnilaia1*$sumnilaia1)/$totaleffortmean; ?>
                      <th colspan="1"><center><?php echo round($bpss1,3); ?></center></th>
                    </tr>
                  <?php
                    $query3 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n'");
                    while ($data3 = mysql_fetch_array($query3)) {
                      $hasil7[] = $data3;
                    }
                    foreach ($hasil7 as $x7) {
                      $nilaip1 = $x7['nilai_p'];
                      $query4 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n' AND $bpss1 <= nilai_p");
                      $data4 = mysql_fetch_array($query4);
                      $query5 = mysql_query("SELECT * FROM tabel_p_value WHERE n_sampel = '$n' AND $bpss1 >= nilai_p ORDER BY nilai_p DESC");
                      $data5 = mysql_fetch_array($query5);
                    }
                    $p1 = $data5['p'];
                    $p2 = $data4['p'];
                    $nilaip1 = $data5['nilai_p'];
                    $nilaip2 = $data4['nilai_p'];
                    $pvalue1 = $p1-(($p1-$p2)*($bpss1-$nilaip1)/($nilaip2-$nilaip1));
                    if($pvalue1>0.05){
                      $kesimpulan1 = "Normal";
                    }
                    else{
                      $kesimpulan1 = "Tidak Normal";
                    }
                  ?>
                    <tr>
                      <th colspan="6">p = <?php echo $p1; ?></th>
                      <th colspan="1"><center><?php echo round($nilaip1,3); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">p = <?php echo $p2; ?></th>
                      <th colspan="1"><center><?php echo round($nilaip2,3); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">p-value</th>
                      <th colspan="1"><center><?php echo round($pvalue1,6); ?></center></th>
                    </tr>
                    <tr>
                      <th colspan="6">Kesimpulan</th>
                      <th colspan="1"><center><?php echo $kesimpulan; ?></center></th>
                    </tr>
                  </tbody>
                </table>
                <br>
                <div class="alert <?php if($kesimpulan1 == 'Normal') echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                  <h4><i class="icon fa fa-info-circle"></i> Informasi</h4>
                Pengujian normalitas Shapiro Wilk berdasarkan urutan Effort Aktual menghasilkan nilai p-value = <?php echo round($pvalue1,6) ?> dan nilai tersebut <?php if($pvalue1 > 0.05) echo "lebih besar dari"; else echo "lebih kecil dari" ?> 0.05. Jadi data tersebut <?php if($kesimpulan == 'Normal') echo '<b>dapat digunakan</b> untuk dicari korelasi datanya'; else  echo '<b>harus diubah</b>. Pengubahan data dapat dilakukan dengan cara menambah data atau menghapus data yang ekstrem'?>.
                </div>
              </div>
            </div>
            <div class="tab-pane" id="kesimpulan">
              <div class="box-body">
              <div class="alert <?php if($kesimpulan == 'Normal' && $kesimpulan1 == 'Normal') echo "alert-success"; else echo "alert-danger"?> alert-dismissible">
                <h4><i class="icon fa fa-info-circle"></i> Informasi</h4>
              Pengujian normalitas Shapiro Wilk berdasarkan urutan UCP dan Effort Aktual menghasilkan nilai p-value = <?php echo round($pvalue,6) ?> dan <?php echo round($pvalue1,6) ?>. Nilai <?php if($pvalue1 > 0.05 && $pvalue > 0.05) echo "p-value lebih besar dari"; elseif($pvalue > 0.05 && $pvalue1 < 0.05) echo "p-value ucp lebih besar dari 0.05, tetapi nilai p-value effort aktual lebih kecil dari 0.05";
              elseif($pvalue < 0.05 && $pvalue1 > 0.05) echo "p-value effort aktual lebih besar dari 0.05, tetapi nilai p-value effort ucp lebih kecil dari 0.05"; else echo "p-value lebih kecil dari" ?> 0.05. Jadi data tersebut <?php if($kesimpulan == 'Normal' && $kesimpulan1 == 'Normal') echo '<b>dapat digunakan</b> untuk dicari korelasi datanya'; else  echo '<b>harus diubah</b>. Pengubahan data dapat dilakukan dengan cara menambah data atau menghapus data yang ekstrem'?>.
              </div>
              <?php if($kesimpulan == 'Normal' && $kesimpulan1 == 'Normal'){ ?>
                <form role="form" action="normalitas-s_db" method="post">
                  <input type="hidden" name="id_normalitas_s" class="form-control" value="<?php
                $query = mysql_query("SELECT COUNT(*) FROM uji_normalitas_s");
                $data = mysql_fetch_array($query);
                $id_normalitas_s = $data['COUNT(*)']+1;
                echo $id_normalitas_s;
                ?>" readonly>
                  <input type="hidden" name="id_proyek" class="form-control" value="<?php echo $id_proyek;?>" readonly>
                  <input type="hidden" name="n_sampel" class="form-control" value="<?php echo $n;?>" readonly>
                  <input type="hidden" name="total_ucp" class="form-control" value="<?php echo round($totalucp,3);?>" readonly>
                  <input type="hidden" name="mean_ucp" class="form-control" value="<?php echo round($mean,3);?>" readonly>
                  <input type="hidden" name="b_ucp" class="form-control" value="<?php echo round($sumnilaia,3);?>" readonly>
                  <input type="hidden" name="ss_ucp" class="form-control" value="<?php echo round($totalucpmean,3);?>" readonly>
                  <input type="hidden" name="bpss_ucp" class="form-control" value="<?php echo round($bpss,3);?>" readonly>
                  <input type="hidden" name="p1_ucp" class="form-control" value="<?php echo round($p1_ucp,3);?>" readonly>
                  <input type="hidden" name="nilai_p1_ucp" class="form-control" value="<?php echo round($nilaip1_ucp,3);?>" readonly>
                  <input type="hidden" name="p2_ucp" class="form-control" value="<?php echo round($p2_ucp,3);?>" readonly>
                  <input type="hidden" name="nilai_p2_ucp" class="form-control" value="<?php echo round($nilaip2_ucp,3);?>" readonly>
                  <input type="hidden" name="p_value_ucp" class="form-control" value="<?php echo round($pvalue,6);?>" readonly>

                  <input type="hidden" name="total_effort" class="form-control" value="<?php echo round($totaleffort,3);?>" readonly>
                  <input type="hidden" name="mean_effort" class="form-control" value="<?php echo round($mean_effort,3);?>" readonly>
                  <input type="hidden" name="b_effort" class="form-control" value="<?php echo round($sumnilaia1,3);?>" readonly>
                  <input type="hidden" name="ss_effort" class="form-control" value="<?php echo round($totaleffortmean,3);?>" readonly>
                  <input type="hidden" name="bpss_effort" class="form-control" value="<?php echo round($bpss1,3);?>" readonly>
                  <input type="hidden" name="p1_effort" class="form-control" value="<?php echo round($p1,2);?>" readonly>
                  <input type="hidden" name="nilai_p1_effort" class="form-control" value="<?php echo round($nilaip2,2);?>" readonly>
                  <input type="hidden" name="p2_effort" class="form-control" value="<?php echo round($p1,2);?>" readonly>
                  <input type="hidden" name="nilai_p2_effort" class="form-control" value="<?php echo round($nilaip2,2);?>" readonly>
                  <input type="hidden" name="p_value_effort" class="form-control" value="<?php echo round($pvalue1,6);?>" readonly>
                  <input type="hidden" name="kesimpulan" class="form-control" value="Normal" readonly>
                  <button type="submit" name="submit" class="btn btn-primary" <?php if($data10 != NULL) echo "disabled";?>>Uji Korelasi Data</button>
                  <?php if($kesimpulan != 'Normal' || $kesimpulan1 != 'Normal'){ ?>
                  <a href="ubahdata?proyek=<?php echo $id_proyek; ?>" class="btn btn-primary">Ubah Data</a>
                  <?php } ?>
                </form>
                <?php } ?>
              </div>
            </div>
            <!-- /.box-body -->
            </div>
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
