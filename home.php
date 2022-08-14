<?php
include 'config/koneksi.php';
$santri_sakit  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM sakit WHERE status = 'Sakit' "));
$santri_pulang = mysqli_fetch_assoc(mysqli_query($koneksi2, "SELECT COUNT(*) AS jml FROM pulang WHERE ket = 0 "));

$mts_sakit  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM sakit a JOIN tb_santri b ON a.nis=b.nis WHERE a.status = 'Sakit' AND b.t_formal = 'MTs' "));
$mts_pulang = mysqli_fetch_assoc(mysqli_query($koneksi2, "SELECT COUNT(*) AS jml FROM pulang a JOIN tb_santri b ON a.nis=b.nis WHERE a.ket = 0 AND b.t_formal = 'MTs' "));

$smp_sakit  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM sakit a JOIN tb_santri b ON a.nis=b.nis WHERE a.status = 'Sakit' AND b.t_formal = 'SMP' "));
$smp_pulang = mysqli_fetch_assoc(mysqli_query($koneksi2, "SELECT COUNT(*) AS jml FROM pulang a JOIN tb_santri b ON a.nis=b.nis WHERE a.ket = 0 AND b.t_formal = 'SMP' "));

$ma_sakit  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM sakit a JOIN tb_santri b ON a.nis=b.nis WHERE a.status = 'Sakit' AND b.t_formal = 'MA' "));
$ma_pulang = mysqli_fetch_assoc(mysqli_query($koneksi2, "SELECT COUNT(*) AS jml FROM pulang a JOIN tb_santri b ON a.nis=b.nis WHERE a.ket = 0 AND b.t_formal = 'MA' "));

$smk_sakit  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM sakit a JOIN tb_santri b ON a.nis=b.nis WHERE a.status = 'Sakit' AND b.t_formal = 'SMK' "));
$smk_pulang = mysqli_fetch_assoc(mysqli_query($koneksi2, "SELECT COUNT(*) AS jml FROM pulang a JOIN tb_santri b ON a.nis=b.nis WHERE a.ket = 0 AND b.t_formal = 'SMk' "));

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard <?= $dt['nama']; ?> (<?= $dt['level']; ?>)</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Santri Sakit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $santri_sakit['jml'] ?> Santri</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Santri Pulang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $santri_pulang['jml'] ?> Santri</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data MTs</h6>
                </div>
                <div class="card-body">
                    <strong>Santri Pulang : <?= $mts_pulang['jml']; ?></strong><br>
                    <strong>Santri Sakit : <?= $mts_sakit['jml']; ?></strong><br><br>
                    <?php
                    if ($level === 'MTs') {
                    ?>
                        <a href="detail.php?lmb=MTs"><button class="btn btn-success btn-block">Cek Detail</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data SMP</h6>
                </div>
                <div class="card-body">
                    <strong>Santri Pulang : <?= $smp_pulang['jml']; ?></strong><br>
                    <strong>Santri Sakit : <?= $smp_sakit['jml']; ?></strong><br><br>
                    <?php
                    if ($level === 'SMP') {
                    ?>
                        <a href="detail.php?lmb=SMP"><button class="btn btn-success btn-block">Cek Detail</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data MA</h6>
                </div>
                <div class="card-body">
                    <strong>Santri Pulang : <?= $ma_pulang['jml']; ?></strong><br>
                    <strong>Santri Sakit : <?= $ma_sakit['jml']; ?></strong><br><br>
                    <?php
                    if ($level === 'MA') {
                    ?>
                        <a href="detail.php?lmb=MA"><button class="btn btn-success btn-block">Cek Detail</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data SMK</h6>
                </div>
                <div class="card-body">
                    <strong>Santri Pulang : <?= $smk_pulang['jml']; ?></strong><br>
                    <strong>Santri Sakit : <?= $smk_sakit['jml']; ?></strong><br><br>
                    <?php
                    if ($level === 'SMK') {
                    ?>
                        <a href="detail.php?lmb=SMK"><button class="btn btn-success btn-block">Cek Detail</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->



</div>