<?php
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

$tkos = ['', 'Ny. Jamilah/Kantin', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naily Zulfa', 'Ny. Lathifah', 'Ny. Ummi Kultsum'];
$id_sakit = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE nis = $id_sakit"));
$dom = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM lemari_data WHERE nis = $id_sakit"));

$nmwl = $dom['wali'];
$dtwali = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE nama = '$nmwl"));

$id_user = $_SESSION['id'];
$dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user "));
$level = $dt['level'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Info Santri PPDWk</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800"><b>Detail Santri</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <h4>Identitas Santri</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <td rowspan="13"><img src="<?= 'https://dpontren.ppdwk.com/images/santri/' . $data['foto'] ?>" width="150"></td>
                                            <td>NIS</td>
                                            <td><?= $data['nis'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td><?= $data['nisn'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td><?= $data['nik'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>NO KK</td>
                                            <td><?= $data['no_kk'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td><?= $data['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tetala</td>
                                            <td><?= $data['tempat'] . ', ' . $data['tanggal'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Jalan/Dusun</td>
                                            <td><?= $data['jln'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>RT</td>
                                            <td><?= $data['rt'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>RW</td>
                                            <td><?= $data['rw'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Desa/Kelurahan</td>
                                            <td><?= $data['desa'] . ' - ' . $data['kec'] . ' - ' . $data['kab'] . ' - ' . $data['prov'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jkl</td>
                                            <td><?= $data['jkl'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Anak Ke</td>
                                            <td><?= $data['anak_ke'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jml Saudara</td>
                                            <td><?= $data['jml_sdr'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <h4>Data Orang Tua</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                                <tr>
                                                    <td>NIK Ayah</td>
                                                    <td><?= $data['nik_a'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Ayah</td>
                                                    <td><?= $data['bapak'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tetala</td>
                                                    <td><?= $data['tempat_a'] . ', ', $data['tanggal_a'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pendidikan</td>
                                                    <td><?= $data['pend_a'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pekerjaan</td>
                                                    <td><?= $data['pkj_a'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td><?= $data['status_a'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                                <tr>
                                                    <td>NIK Ibu</td>
                                                    <td><?= $data['nik_i'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Ibu</td>
                                                    <td><?= $data['ibu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tetala</td>
                                                    <td><?= $data['tempat_i'] . ', ', $data['tanggal_i'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pendidikan</td>
                                                    <td><?= $data['pend_i'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pekerjaan</td>
                                                    <td><?= $data['pkj_i'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td><?= $data['status_i'] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <h4>Lain-lain</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <td>Komplek</td>
                                            <td><?= $dom['komplek'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kamar</td>
                                            <td><?= $dom['kamar'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Lemari</td>
                                            <td><?= $dom['lemari'] ?>, Loker : <?= $dom['loker'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Wali Asuh</td>
                                            <td><?= $dom['wali'] ?> (<?= $dtwali['t_formal'] ?>)</td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td><?= $data['hp'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Kos</td>
                                            <td><?= $tkos[$data['t_kos']] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Content Wrapper -->


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

</body>

</html>