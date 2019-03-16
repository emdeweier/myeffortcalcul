<?php include 'koneksi.php'; ?>
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
        Beranda
        <small>software effort</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
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
                  <th>No.</th>
                  <th>Nama Proyek</th>
                  <th>Real Cost</th>
                  <th>Real Waktu</th>
                  <th>TCF</th>
                  <th>EF</th>
                  <th>UAW</th>
                  <th>UUCW</th>
                  <th>UUCP</th>
                  <th>UCP</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysql_query("SELECT * FROM proyek,ef,tcf,uaw,uucw WHERE proyek.id_proyek = ef.id_proyek AND proyek.id_proyek = tcf.id_proyek AND proyek.id_proyek = uaw.id_proyek AND proyek.id_proyek = uucw.id_proyek");
                  while ($data = mysql_fetch_array($query)) {
                  $hasil3[] = $data;
                  }
                  foreach ($hasil3 as $x) {
                    $tcf = floatval($x['rumus']);
                    $ef = floatval($x['rumus_ef']);
                    $uaw = $x['total'];
                    $uucw = $x['hasil'];
                    $uucp = $uaw+$uucw;
                    $ucp = $uucp*$tcf*$ef;
                    $cost = floatval($x['real_penghasilan']);
                    $cost1 = floatval($x['real_penghasilan'])/1000;
                    $sumcost += $cost1;
                    $sumrc += round($ucp,2);
                    $sumrw += floatval($x['real_waktu']);
                    $sumrc2 += (round($ucp,2)*round($ucp,2));
                    $sumrw2 += (floatval($x['real_waktu'])*floatval($x['real_waktu']));
                    $rcost += round((round(floatval($cost1),2)*round(floatval($ucp),2)),2);
                    $hoef = $ucp*7;
                    $aeucp += (round($ucp,2)*floatval($x['real_waktu']));
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $x['nama_proyek'];?></td>
                  <td><?php echo "Rp. ".number_format($cost,0,",",".");?></td>
                  <td><?php echo $x['real_waktu'];?></td>
                  <td><?php echo $tcf;?></td>
                  <td><?php echo $ef;?></td>
                  <td><?php echo $uaw;?></td>
                  <td><?php echo $uucw;?></td>
                  <td><?php echo round($uucp,2);?></td>
                  <td><?php echo round($ucp,2);?></td>
                </tr>
                <?php
                  $sumtotalData +=1 ;
                  }
                ?>
                <?php
                  $a = $sumtotalData * $aeucp;
                  $b = $sumrc * $sumrw;
                  $c = $sumtotalData * round($sumrc2,2);
                  $d = round($sumrc * $sumrc,2);

                  $a2 = $sumtotalData * $rcost;
                  $b2 = $sumrc * $sumcost;
                  $c2 = $sumtotalData * round($sumrc2,2);
                  $d2 = round($sumrc * $sumrc,2);
                  if (($c-$d) == 0) {
                    $e = 1;
                  }else{
                    $e = $c-$d;
                  }
                  if (($c2-$d2) == 0) {
                    $e2 = 1;
                  }else{
                    $e2 = $c2-$d2;
                  }
                  $ermh = round(abs(($a-$b)/($e)),3);
                  $ercmh = round(abs(($a2-$b2)/($e2)),3);
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th colspan="8">Effort Rate (Man / Hours)</th>
                  <th colspan="2"><center><?php echo "20"; ?></center></th>
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
