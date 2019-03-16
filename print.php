<?php
include 'koneksi.php';
$id = $_GET['proyek'];
$query = mysql_query("SELECT * FROM proyek WHERE id_proyek = '$id'");
$data = mysql_fetch_array($query);
$id_proyek = $data['id_proyek'];
if($data === FALSE){
  header("location:tambah");
}
$query2 = mysql_query("SELECT * FROM gaji,durasi WHERE gaji.id_proyek = '$id' AND durasi.id_proyek = '$id'");
$data2 = mysql_fetch_array($query2);
$query1 = mysql_query("SELECT * FROM uucw,gaji,proyek WHERE uucw.id_proyek = proyek.id_proyek AND gaji.id_proyek = proyek.id_proyek AND gaji.id_proyek = '$id'");
$data1 = mysql_fetch_array($query1);
$id_proyek = $data['id_proyek'];
$id_uucw = $data1['id_uucw'];
$tcf = $data['tcf'];
$ef = $data['ef'];
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'head.php'; ?>
<body onload="window.print();">
<div class="wrapper">
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
            $query2 = mysql_query("SELECT * FROM proyek WHERE id_proyek = '$id_proyek'");
            while ($data2 = mysql_fetch_array($query2)) {
            $hasil2[] = $data2;
            }
            foreach ($hasil2 as $x2) {
            $i += $x2['transaksi'];
          ?>
          <tr>
            <td><?php echo $x2['nama_proyek'];?></td>
            <td><?php echo $x2['uaw'];?></td>
            <td><?php echo $x2['uucw'];?></td>
            <td><?php echo $x2['uucp'];?></td>
            <td><?php echo $x2['tcf'];?></td>
            <td><?php echo $x2['ef'];?></td>
            <td><?php echo $x2['ucp'];?></td>
            <?php $query3 = mysql_query("SELECT * FROM setting_value"); $data3 = mysql_fetch_array($query3); ?>
            <td><?php echo $data3['effort_rate'];?></td>
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
            $query2 = mysql_query("SELECT * FROM tcf WHERE id_proyek = '$id_proyek'");
            while ($data2 = mysql_fetch_array($query2)) {
            $hasil8[] = $data2;
            }
            foreach ($hasil8 as $x2) {
          ?>
          <tr>
            <?php for($i=1;$i<=7;$i++){ ?>
            <td><?php echo number_format($x2['t'.$i],2,".","");?></td>
            <?php } ?>
            <?php $query3 = mysql_query("SELECT * FROM setting_value"); $data3 = mysql_fetch_array($query3); ?>
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
            $query2 = mysql_query("SELECT * FROM ef WHERE id_proyek = '$id_proyek'");
            while ($data2 = mysql_fetch_array($query2)) {
            $hasil9[] = $data2;
            }
            foreach ($hasil9 as $x2) {
          ?>
          <tr>
            <?php for($i=1;$i<=8;$i++){ ?>
            <td><?php echo number_format($x2['e'.$i],2,".","");?></td>
            <?php } ?>
            <?php $query3 = mysql_query("SELECT * FROM setting_value"); $data3 = mysql_fetch_array($query3); ?>
            <td><?php echo $data3['effort_rate'];?></td>
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
      <div class="box-header">
        <h3>Klasifikasi Use Case Point</h3>
      </div>
      <div class="col-xs-12 table-responsive">
        <div class="box-header">
          <h3 class="box-title">Jenis Use Case</h3>
        </div>
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>No.</th>
            <th>Nama Use Case</th>
            <th>Jumlah Transaksi</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $no = 1;
            $query = mysql_query("SELECT * FROM sub_uucw WHERE id_uucw = '$id_uucw'");
            while ($data = mysql_fetch_array($query)) {
            $hasil3[] = $data;
            }
            foreach ($hasil3 as $x) {
            $i += $x['transaksi'];
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
            <th colspan="1"><center><?php echo $i; ?></center></th>
          </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-xs-12 table-responsive">
        <div class="box-header">
          <h3 class="box-title">Penggajian Anggota</h3>
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
            $query1 = mysql_query("SELECT * FROM jabatan WHERE id_proyek = '$id_proyek'");
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
      <!-- /.col -->
    </div>
    <div class="row">
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
            $query6 = mysql_query("SELECT * FROM uaw WHERE id_proyek = '$id_proyek'");
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
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
