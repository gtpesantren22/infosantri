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
$id_user = $_SESSION['id'];
$dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user "));
$level = $dt['level'];

$kls = explode('-', $_GET['kls']);
$k_formal = $kls[0];
$jurusan = $kls[1];
$r_formal = $kls[2];
$t_formal = $kls[3];

$sql = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' AND aktif = 'Y' ");


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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA SISWA KELAS FORMAL : <?= $_GET['kls']; ?></b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Santri</button>
                            <a href="dt_kelas.php" class="btn btn-warning btn-sm float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Kelas</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'config/koneksi.php';
                                                $no = 1;

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['nama'] ?></td>
                                                        <td><?= $row['desa'] . '-' . $row['kec'] . '-' . $row['kab'] ?></td>
                                                        <td><?= $row['k_formal'] . '-' . $row['jurusan'] . '-' . $row['r_formal'] . '-' . $row['t_formal'] ?></td>

                                                        <td style="text-align: center;">
                                                            <a href="<?= 'del.php?kd=hps_for&id=' . $row['nis'] ?>" class="btn btn-danger btn-icon-split btn-sm">
                                                                <span class="icon text-white-100">
                                                                    <i class="fas fa-times"></i>
                                                                </span>
                                                                <span class="text">Hapus</span>
                                                            </a>

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
                <!-- End of Content Wrapper -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Santri</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="example" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $santri = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '' || r_formal = '' || jurusan = '' || t_formal = '' AND aktif = 'Y' ");
                                            while ($r3 = mysqli_fetch_assoc($santri)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $r3['nama'] ?></td>
                                                    <td><?= $r3['desa'] . '-' . $r3['kec'] . '-' . $r3['kab'] ?></td>

                                                    <td style="text-align: center;">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="nis" value="<?= $r3['nis']; ?>">
                                                            <input type="hidden" name="jkl" value="<?= $r3['jkl']; ?>">
                                                            <button type="submit" name="save" class="btn btn-success btn-icon-split btn-sm">
                                                                <span class="icon text-white-100">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                                <span class="text">Pilih</span>
                                                            </button>
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

                <script>
                    $(document).ready(function() {
                        $('#example').DataTable();
                    });
                </script>

</body>

</html>

<?php

if (isset($_POST['save'])) {
    $nis = $_POST['nis'];
    // $k_formal = $_POST['k_formal'];
    // $r_formal = $_POST['r_formal'];
    $jkl = $_POST['jkl'];

    // $back = $jkl == 'Laki-laki' ? 'dt_formalPa.php' : 'dt_formalPi.php';
    $link = 'cek_formal.php?kls=' . $_GET['kls'];

    $sql = mysqli_query($koneksi3, "UPDATE tb_santri SET k_formal = '$k_formal', r_formal = '$r_formal', jurusan = '$jurusan', t_formal = '$t_formal' WHERE nis = '$nis' ");

    if ($sql) {
        echo "
        <script>
            window.location = '" . $link . "';
        </script>
    ";
    }
}

?>