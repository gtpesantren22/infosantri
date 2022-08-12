<?php

use function PHPSTORM_META\map;

session_start();
include 'config/koneksi.php';
if (!isset($_SESSION['truecaller'])) {
    echo "
                <script>
                alert('Maaf, Login dulu');
                window.location = 'login.php';
                </script>
                ";
    exit;
}

$id_user = $_SESSION['id'];
$dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user "));
$level = $dt['level'];

if ($level == 'admin') {
    $sql = mysqli_query($koneksi3, "SELECT * FROM absen ");
} else {
    $sql = mysqli_query($conn, "SELECT a.* FROM absen a JOIN tb_santri b ON a.nis=b.nis WHERE b.t_formal = '$level' AND b.aktif = 'Y' GROUP BY a.tanggal ORDER BY a.tanggal DESC LIMIT 1");
    $sql2 = mysqli_query($conn, "SELECT a.* FROM absen a JOIN tb_santri b ON a.nis=b.nis WHERE b.t_formal = '$level' AND b.aktif = 'Y' GROUP BY a.tanggal ORDER BY a.tanggal DESC ");
}
$mgr = mysqli_fetch_assoc($sql);

$bn = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "menu.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "header.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA KELAS FORMAL LEMBAGA - <?= $level; ?></b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <button class="btn btn-sm btn-success btn-block" type="button" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-circle"></i> Buat Absen Baru</button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><b>Absensi Terakhir : <?= $bn[$mgr['bulan']] . ', Minggu ke-' . $mgr['minggu']; ?></b></p>
                                            <?php
                                            $now = date('Y-m-d');
                                            $dtkls = mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga= '$level' ");
                                            while ($ar = mysqli_fetch_array($dtkls)) {
                                                $klsx = $ar['nm_kelas'];
                                            ?>
                                                <a href="<?= 'cek_absen.php?kls=' . $klsx . '&tgl=' . $mgr['tanggal']  ?>" class="btn btn-primary btn-sm mb-1" target="_blank"><?= $klsx; ?></a>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        if (isset($_POST['cekdt'])) {
                                            $tanggalKo = $_POST['tanggal'];
                                            $dtks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM absen WHERE tanggal = '$tanggalKo' AND lembaga = '$level' "));
                                        ?>
                                            &nbsp;
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="px-3 py-3 bg-gradient-light text-dark ">
                                                    <p><b>Lihat Absensi Bulan <?= $bn[$dtks['bulan']] . ', Minggu ke-' . $dtks['minggu']; ?></b></p>
                                                    <?php

                                                    $dtkls = mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga= '$level' ");

                                                    while ($ar = mysqli_fetch_array($dtkls)) {
                                                        $klsx = $ar['nm_kelas'];
                                                    ?>
                                                        <a href="<?= 'cek_absen.php?kls=' . $klsx . '&tgl=' . $tanggalKo  ?>" class="btn btn-danger btn-sm mb-1" target="_blank"><?= $klsx; ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    Data Absensi Santri
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Ket Absen</th>
                                                            <th style="text-align: center;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include 'config/koneksi.php';
                                                        $no = 1;

                                                        while ($row = mysqli_fetch_assoc($sql2)) {
                                                            // $kls = $row['k_formal'];
                                                        ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td>
                                                                    <span class="badge badge-info">Minggu ke-<?= $row['minggu'] ?></span>
                                                                    <span class="badge badge-dark"><?= $bn[$row['bulan']] ?></span>
                                                                    <span class="badge badge-primary"><?= $row['ta'] ?></span>
                                                                </td>

                                                                <td style="text-align: center;">
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="tanggal" value="<?= $row['tanggal']; ?>">
                                                                        <button class="btn btn-success btn-sm" type="submit" name="cekdt">Detail</button>
                                                                        <a href="<?= 'del.php?kd=abs&id=' . $row['id_absen'] ?>" class="btn btn-danger btn-icon-split btn-sm" onclick="return confirm('Yakin akan dihapus ?')">
                                                                            <span class="icon text-white-100">
                                                                                <i class="fas fa-trash"></i>
                                                                            </span>
                                                                        </a>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Content Wrapper -->

                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat Absensi Baru</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="act" value="add">
                                    <select name="mg" id="" class="form-control" required>
                                        <option value=""> -- pilih minggu-- </option>
                                        <option value="1">Minggu Ke-1</option>
                                        <option value="2">Minggu Ke-2</option>
                                        <option value="3">Minggu Ke-3</option>
                                        <option value="4">Minggu Ke-4</option>
                                        <option value="5">Minggu Ke-5</option>
                                    </select>
                                    <br>
                                    <select name="bln" id="" class="form-control" required>
                                        <option value=""> -- pilih bulan-- </option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $bn[$i] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <select name="ta" id="" class="form-control" required>
                                        <option value=""> -- pilih TA-- </option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tahun");
                                        while ($tt = mysqli_fetch_assoc($th)) { ?>
                                            <option value="<?= $tt['nama'] ?>"><?= $tt['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <input type="text" name="tgl" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit" name="buat">Buat Absen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->


                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php

if (isset($_POST['buat'])) {
    $mg = $_POST['mg'];
    $bln = $_POST['bln'];
    $ta = $_POST['ta'];
    $tgl = $_POST['tgl'];

    $cek = mysqli_query($conn, "SELECT * FROM absen WHERE bulan = $bln AND minggu = $mg AND ta = '$ta' AND lembaga = '$level' ");
    $cek2 = mysqli_query($conn, "SELECT * FROM absen WHERE tanggal = '$tgl' AND lembaga = '$level' ");
    if (mysqli_num_rows($cek2) > 0) {
        echo "
        <script>
        alert('Ada absen yang sudah dibuat pada tanggal ini. Silahkan buat ditanggal lain');
        window.location = 'absen_formal.php';
        </script>
        ";
    } else if (mysqli_num_rows($cek) > 0) {
        echo "
        <script>
        alert('Absen Minggu ini sudah buat');
        window.location = 'absen_formal.php';
        </script>
        ";
    } else {
        $dt = mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_formal = '$level' ");
        while ($in = mysqli_fetch_assoc($dt)) {
            $nis = $in['nis'];
            $input =  mysqli_query($conn, "INSERT INTO absen VALUES('', '$level', '$nis', '$bln', '$mg', '$tgl', '0', '0', '0', '-', '$ta')");
        }
        echo "
            <script>
            window.location = 'absen_formal.php';
            </script>
        ";
    }
}
?>