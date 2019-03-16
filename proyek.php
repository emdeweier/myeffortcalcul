<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['nim'])){
  header("location:masuk");
}
$id = $_SESSION['nim'];
$query = mysql_query("SELECT * FROM pengguna WHERE nim = '$id'");
$data = mysql_fetch_array($query);
$pengguna = $data['nim'];
$idp = $_GET['proyek'];
$query = mysql_query("SELECT * FROM temp_proyek WHERE id_temp = '$idp'");
$data = mysql_fetch_array($query);
if(!isset($id)){
  header("location:./");
}
else if($idp == ''){
  header("location:./");
}
else if($idp != $data['id_temp']){
  header("location:./");
}
$query2 = mysql_query("SELECT * FROM gaji,durasi WHERE gaji.id_temp = '$idp' AND durasi.id_temp = '$idp'");
$data2 = mysql_fetch_array($query2);
$query1 = mysql_query("SELECT * FROM uucw,gaji,temp_proyek WHERE uucw.id_temp = temp_proyek.id_temp AND gaji.id_temp = temp_proyek.id_temp AND gaji.id_temp = '$idp'");
$data1 = mysql_fetch_array($query1);
$id_proyek = $data['id_temp'];
$query3 = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek'");
$data3 = mysql_fetch_array($query3);
$id_uucw = $data1['id_uucw'];
$er = $data['effort_rate'];
$tcf = $data['tcf'];
$ef = $data['ef'];
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Informasi Proyek
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Informasi Proyek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
              <li><a href="#usecase" data-toggle="tab">Hasil Use Case Point</a></li>
              <li><a href="#fusecase" data-toggle="tab">Hasil Fuzzy Use Case Point</a></li>
              <?php if($data3 != NULL){ ?>
              <li><a href="#dataset" data-toggle="tab">Dataset Proyek</a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="deskripsi">
                <div class="box-body box-profile">
                  <h3 class="profile-username"><?php echo $data['nama_proyek']; ?></h3>
                  <p class="text-muted">dibuat oleh : <?php echo $pengguna; ?></p>
                  <p class="text-muted"><?php echo date('d-m-Y (H:i:s)',strtotime($data['create_date'])); ?></p>
                </div>
                <table id="proyek" class="table table-bordered">
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
                  ?>
                  <tr>
                    <td><?php echo $x2['nama_proyek'];?></td>
                    <td><?php echo $x2['uaw'];?></td>
                    <td><?php echo $x2['uucw'];?></td>
                    <td><?php echo $x2['uucp'];?></td>
                    <td><?php echo $x2['tcf'];?></td>
                    <td><?php echo $x2['ef'];?></td>
                    <td><?php echo $x2['ucp'];?></td>
                    <td><?php echo $x2['effort_rate'];?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>

                <table id="tcf" class="table table-bordered">
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

                <table id="ef" class="table table-bordered">
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="usecase">
                <div class="box-body box-profile">
                  <h3 class="profile-username">Klasifikasi Use Case Point</h3>
                </div>
                <table id="uucw" class="table table-bordered table-striped">
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
                    $i = 0;
                    $query = mysql_query("SELECT * FROM uucw,sub_uucw WHERE sub_uucw.id_uucw = uucw.id_uucw AND uucw.id_uucw = '$id_uucw'");
                    while ($data = mysql_fetch_array($query)) {
                    $hasil3[] = $data;
                    }
                    foreach ($hasil3 as $x5) {
                    $i += $x5['transaksi'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $x5['use_case'];?></td>
                    <td><?php echo $x5['transaksi'];?></td>
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
                <div class="box-body box-profile">
                  <h3 class="profile-username">Penggajian Anggota</h3>
                </div>
                <table id="anggota" class="table table-bordered table-striped">
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="fusecase">
                <div class="box-body box-profile">
                  <h3 class="profile-username">Klasifikasi Fuzzy Use Case Point</h3>
                </div>
                <table id="fuucw" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Use Case</th>
                    <th>Jumlah Transaksi</th>
                    <th>Nilai F-UCP</th>
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
                    <td><?php echo $no++;?></td>
                    <td><?php echo $x3['use_case'];?></td>
                    <td><?php echo $x3['transaksi'];?></td>
                    <td><?php echo $x3['nilai_metodefucp'];?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th colspan="2">Total Transaksi</th>
                    <th colspan="1"><center><?php echo $i; ?></center></th>
                    <th colspan="1"><center><?php echo $i14; ?></center></th>
                  </tr>
                  </tfoot>
                </table>

                <div class="box-body box-profile">
                  <h3 class="profile-username">Perubahan Setelah Menggunakan Fuzzy Use Case Point</h3>
                </div>
                <table id="nfuucw" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>UAW</th>
                    <th>UUCW</th>
                    <th>UUCP</th>
                    <th>TCF</th>
                    <th>EF</th>
                    <th>UCP</th>
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
                    <td><?php echo number_format($fucp,1,',','');?></td>
                  </tr>
                  </tbody>
                </table>

                <div class="box-body box-profile">
                  <h3 class="profile-username">Penggajian Anggota</h3>
                </div>
                <table id="fanggota" class="table table-bordered table-striped">
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="dataset">
                <div class="box-body box-profile">
                  <h3 class="profile-username">Dataset Proyek</h3>
                </div>
                <table id="dataproyek" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kategori Proyek</th>
                    <th>Effort Aktual</th>
                    <th>UCP</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    $i = 0;
                    $query = mysql_query("SELECT * FROM dataset_proyek WHERE id_temp = '$id_proyek'");
                    while ($data = mysql_fetch_array($query)) {
                    $hasil7[] = $data;
                    }
                    foreach ($hasil7 as $x5) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $x5['kategori_proyek'];?></td>
                    <td><?php echo $x5['effort_aktual'];?></td>
                    <td><?php echo $x5['ucp'];?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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
