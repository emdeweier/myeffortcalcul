<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id'");
$data = mysql_fetch_array($query);
$id_proyek = $data['id_temp'];
if($data === FALSE){
  header("location:tambah");
}
$query2 = mysql_query("SELECT * FROM gaji,durasi WHERE gaji.id_temp = '$id' AND durasi.id_temp = '$id'");
$data2 = mysql_fetch_array($query2);
$query1 = mysql_query("SELECT * FROM uucw,gaji,temp_proyek WHERE uucw.id_temp = temp_proyek.id_temp AND gaji.id_temp = temp_proyek.id_temp AND gaji.id_temp = '$id'");
$data1 = mysql_fetch_array($query1);
$id_proyek = $data['id_temp'];
$id_uucw = $data1['id_uucw'];
$tcf = $data['tcf'];
$ef = $data['ef'];
$er = $data['effort_rate'];
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
        Proyek
        <small>#<?php echo $id_proyek; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> Beranda</li>
        <li>Tambah Proyek</li>
        <li class="active">Hasil Akhir</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-warning" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info-circle"></i> Info :</h4>
        <p>Mohon maaf, untuk sementara fitur cetak dan konversi ke file pdf belum tersedia.</p>
        <small>- Adminnya <cite title="Software Effort">Software Effort</cite></small>
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Software Effort
            <small class="pull-right">Tanggal: <?php echo date('d-m-Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Proyek #<?php echo $id_proyek; ?></b><br>
          <b>Tanggal:</b> <?php echo date('d-m-Y'); ?><br>
          <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Ringkasan Proyek</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>Nama Proyek</th>
              <th>UAW</th>
              <th>UUCW</th>
              <th>UUCP</th>
              <th>TCF</th>
              <th>EF</th>
              <th>UCP</th>
              <th>ER</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query2 = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$id_proyek'");
              while ($data2 = mysql_fetch_array($query2)) {
              $hasil2[] = $data2;
              }
              foreach ($hasil2 as $x2) {
              $i += $x2['transaksi'];
              $ucp = $x2['ucp'];
            ?>
            <tr>
              <td><?php echo $x2['nama_proyek'];?></td>
              <td><?php echo $x2['uaw'];?></td>
              <td><?php echo $x2['uucw'];?></td>
              <td><?php echo $x2['uucp'];?></td>
              <td><?php echo $x2['tcf'];?></td>
              <td><?php echo $x2['ef'];?></td>
              <td><?php echo number_format($x2['ucp'],1,'.','');?></td>
              <td><?php echo $x2['effort_rate'];?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
          </table>

          <table class="table table-bordered">
            <thead>
            <tr>
              <?php for($i=1;$i<=13;$i++){ ?>
              <th>T<?php echo $i; ?></th>
              <?php } ?>
              <th>Total</th>
              <th>Total Rumus<br>
              <small>(0.6+(0.01*total))</small></th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query2 = mysql_query("SELECT * FROM tcf WHERE id_temp = '$id_proyek'");
              while ($data2 = mysql_fetch_array($query2)) {
              $hasil8[] = $data2;
              }
              foreach ($hasil8 as $x2) {
            ?>
            <tr>
              <?php for($i=1;$i<=13;$i++){ ?>
              <td><?php echo number_format($x2['t'.$i],2,".","");?></td>
              <?php } ?>
              <td><?php echo $x2['total'];?></td>
              <td><?php echo $x2['rumus'];?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
          </table>

          <table class="table table-bordered">
            <thead>
            <tr>
              <?php for($i=1;$i<=8;$i++){ ?>
              <th>E<?php echo $i; ?></th>
              <?php } ?>
              <th>Total</th>
              <th>Total Rumus<br>
              <small>(1.4-(0.03*total))</small></th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query2 = mysql_query("SELECT * FROM ef WHERE id_temp = '$id_proyek'");
              while ($data2 = mysql_fetch_array($query2)) {
              $hasil9[] = $data2;
              }
              foreach ($hasil9 as $x2) {
            ?>
            <tr>
              <?php for($i=1;$i<=8;$i++){ ?>
              <td><?php echo number_format($x2['e'.$i],2,".","");?></td>
              <?php } ?>
              <td><?php echo $x2['total'];?></td>
              <td><?php echo $x2['rumus'];?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-6 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Klasifikasi Use Case Point</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th style="width:10%">No.</th>
              <th style="width:55%">Nama Use Case</th>
              <th style="width:25%">Jumlah Transaksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query = mysql_query("SELECT * FROM sub_uucw,uucw WHERE uucw.id_uucw = sub_uucw.id_uucw AND sub_uucw.id_uucw = '$id_uucw'");
              while ($data = mysql_fetch_array($query)) {
              $hasil3[] = $data;
              }
              foreach ($hasil3 as $x) {
              $i15 += $x['transaksi'];
            ?>
            <tr>
              <td><?php echo $x['id_sub_uucw'];?></td>
              <td><?php echo $x['use_case'];?></td>
              <td><?php echo $x['transaksi'];?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="2">Total Transaksi</th>
              <th colspan="1"><center><?php echo $i15; ?></center></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-xs-6 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Klasifikasi Fuzzy Use Case Point</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th style="width:10%">No.</th>
              <th style="width:45%">Nama Use Case</th>
              <th style="width:35%">Jumlah Transaksi <i class="fa fa-long-arrow-right"></i> F-UCP</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query6 = mysql_query("SELECT * FROM uaw WHERE id_temp = '$id_proyek'");
              $data6 = mysql_fetch_array($query6);
              $query4 = mysql_query("SELECT * FROM sub_uucw,klasifikasi_fucp WHERE sub_uucw.transaksi = klasifikasi_fucp.jml_transaksi AND sub_uucw.id_uucw = '$id_uucw'");
              while ($data4 = mysql_fetch_array($query4)) {
              $hasil5[] = $data4;
              }
              foreach ($hasil5 as $x3) {
              $i7 += $x3['transaksi'];
              $i14 += $x3['nilai_metodefucp'];
            ?>
            <tr>
              <td><?php echo $x3['id_sub_uucw'];?></td>
              <td><?php echo $x3['use_case'];?></td>
              <td><?php echo $x3['transaksi']." <i class='fa fa-long-arrow-right'></i> ".$x3['nilai_metodefucp'];?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="2">Total Transaksi</th>
              <th colspan="1"><center><?php echo $i14; ?></center></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Penggajian Anggota Use Case Point</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>No.</th>
              <th>Jabatan</th>
              <th>Qty</th>
              <th>Jam Kerja/Hari</th>
              <th>Jam Kerja/Minggu</th>
              <th>Total Jam Kerja/Minggu</th>
              <th>Gaji/Jam</th>
              <th>Total Gaji</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query1 = mysql_query("SELECT * FROM jabatan WHERE id_temp = '$id_proyek' AND jabatan != ''");
              while ($data1 = mysql_fetch_array($query1)) {
              $hasil4[] = $data1;
              }
              foreach ($hasil4 as $x1) {
                $i1 += $x1['qty'];
                $i2 += $x1['total_jam'];
                $i3 += $x1['gaji_perjam'];
                $i4 += $x1['gaji'];
                $i5 += $x1['jam_hari'];
                $i6 += $x1['jam_minggu'];
            ?>
            <tr>
              <td><?php echo $no++;?></td>
              <td><?php echo $x1['jabatan'];?></td>
              <td><?php echo $x1['qty'];?></td>
              <td><?php echo $x1['jam_hari'];?></td>
              <td><?php echo $x1['jam_minggu'];?></td>
              <td><?php echo $x1['total_jam'];?></td>
              <td><?php echo "Rp. ".number_format($x1['gaji_perjam'],0,",",".");?></td>
              <td><?php echo "Rp. ".number_format($x1['gaji'],0,",",".");?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="2">Total</th>
              <th colspan="1"><center><?php echo $i1; ?></center></th>
              <th colspan="1"><center><?php echo $i5; ?></center></th>
              <th colspan="1"><center><?php echo $i6; ?></center></th>
              <th colspan="1"><center><?php echo $i2; ?></center></th>
              <th colspan="1"><center><?php echo "Rp. ".number_format($i3,0,",","."); ?></center></th>
              <th colspan="1"><center><?php echo "Rp. ".number_format($i4,0,",","."); ?></center></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-xs-12 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Perubahan Setelah Menggunakan Fuzzy Use Case Point</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>UAW</th>
              <th>UUCW</th>
              <th>UUCP</th>
              <th>TCF</th>
              <th>EF</th>
              <th>UCP</th>
              <th>ER</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $uaw = $data6['total'];
            $fuucp = $i14+$uaw;
            $fucp = $fuucp*$tcf*$ef;
            $jam = $fucp*$er;
            $minggu = $jam/$i2;
            ?>
            <tr>
              <td><?php echo $uaw;?></td>
              <td><?php echo $i14;?></td>
              <td><?php echo $fuucp;?></td>
              <td><?php echo $tcf;?></td>
              <td><?php echo $ef;?></td>
              <td><?php echo number_format($fucp,1,'.','');?></td>
              <td><?php echo $er; ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <div class="col-xs-12 table-responsive">
          <div class="box-header">
            <h3 class="box-title">Penggajian Anggota Fuzzy Use Case Point</h3>
          </div>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>No.</th>
              <th>Jabatan</th>
              <th>Qty</th>
              <th>Jam Kerja/Hari</th>
              <th>Jam Kerja/Minggu</th>
              <th>Total Jam Kerja/Minggu</th>
              <th>Gaji/Jam</th>
              <th>Total Gaji</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $no = 1;
              $query5 = mysql_query("SELECT * FROM jabatan WHERE id_temp = '$id_proyek' AND jabatan != ''");
              while ($data5 = mysql_fetch_array($query5)) {
              $hasil6[] = $data5;
              }
              foreach ($hasil6 as $x4) {
                $i8 += $x4['qty'];
                $i9 += $x4['total_jam'];
                $i10 += $x4['gaji_perjam'];
                $i11 += $x4['gaji'];
                $i12 += $x4['jam_hari'];
                $i13 += $x4['jam_minggu'];
                $gaji = $minggu*$x4['total_jam']*$x4['gaji_perjam'];
                $totalgaji += $gaji;
            ?>
            <tr>
              <td><?php echo $no++;?></td>
              <td><?php echo $x4['jabatan'];?></td>
              <td><?php echo $x4['qty'];?></td>
              <td><?php echo $x4['jam_hari'];?></td>
              <td><?php echo $x4['jam_minggu'];?></td>
              <td><?php echo $x4['total_jam'];?></td>
              <td><?php echo "Rp. ".number_format($x4['gaji_perjam'],0,",",".");?></td>
              <td><?php echo "Rp. ".number_format($gaji,0,",",".");?></td>
            </tr>
            <?php
              }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="2">Total</th>
              <th colspan="1"><center><?php echo $i8; ?></center></th>
              <th colspan="1"><center><?php echo $i12; ?></center></th>
              <th colspan="1"><center><?php echo $i13; ?></center></th>
              <th colspan="1"><center><?php echo $i9; ?></center></th>
              <th colspan="1"><center><?php echo "Rp. ".number_format($i10,0,",","."); ?></center></th>
              <th colspan="1"><center><?php echo "Rp. ".number_format($totalgaji,0,",","."); ?></center></th>
            </tr>
            </tfoot>
          </table>
        </div>

        <!-- /.col -->
      </div>
      <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-info-circle"></i> Perubahan</h4>
        <?php $stat = (($fucp-$ucp)/$ucp)*100;$stat1 = (($totalgaji-$i4)/$i4)*100; ?>
        Setelah menggunakan metode Fuzzy dapat dilihat bahwa FUCP <b><?php if($fucp < $ucp) echo "menurun"; else echo "meningkat"; ?></b> sebesar ± <b><?php echo number_format(abs($stat),0,",",".")."%"; ?></b> dari UCP sebelum digunakan metode Fuzzy. Dan untuk penggajian anggota saat menggunakan metode Fuzzy menjadi lebih
        <b><?php if($totalgaji < $i4) echo "rendah"; else echo "tinggi"; ?></b> daripada sebelum menggunakan metode Fuzzy.
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#"><button class="btn btn-default" disabled><i class="fa fa-print"></i> Cetak</button></a>
          <a href="./"><button class="btn btn-success pull-right"><i class="fa fa-home"></i> Beranda</button></a>
          <a href="./"><button class="btn btn-primary pull-right" disabled style="margin-right:5px"><i class="fa fa-file-pdf-o"></i> Konversi ke PDF</button></a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
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
