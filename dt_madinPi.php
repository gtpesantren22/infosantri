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

if ($level === 'madin') {
    $sql = mysqli_query($koneksi3, "SELECT * FROM kl_madin ORDER BY nm_kelas");
} else {
    $sql = mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga = '$level' ORDER BY nm_kelas ");
}

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
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA KELAS MADIN PUTRI</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kelas</th>
                                                    <th>Tapel</th>
                                                    <th>Jumlah</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'config/koneksi.php';
                                                $no = 1;

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    $kls = explode('-', $row['nm_kelas']);
                                                    $k_madin = htmlspecialchars(mysqli_real_escape_string($koneksi3, $kls[0]));
                                                    $r_madin = $kls[1];

                                                    $jml = mysqli_num_rows(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_madin = '$k_madin' AND r_madin = '$r_madin' AND jkl = 'Perempuan' AND aktif = 'Y' "));
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nm_kelas'] ?></td>
                                                        <td><?php echo $row['tahun'] ?></td>
                                                        <td><?php echo $jml ?> santri</td>

                                                        <td style="text-align: center;">
                                                            <a href="<?= 'cek_madin.php?kls=' . $row['nm_kelas'] . '&jkl=Perempuan' ?>" class="btn btn-primary btn-icon-split btn-sm">
                                                                <span class="icon text-white-100">
                                                                    <i class="fas fa-search"></i>
                                                                </span>
                                                                <span class="text">Cek Santri</span>
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


                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->


                <!-- Bootstrap core JavaScript-->
                <script src="vendors/jquery/jquery.min.js"></script>
                <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendors/datatables/jquery.dataTables.min.js"></script>
                <script src="vendors/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php

if (isset($_POST['save'])) {
    $kelas = mysqli_real_escape_string($koneksi3, $_POST['kelas']);
    $rombel = $_POST['rombel'];
    $tahun = $_POST['tahun'];
    $nmOk = $kelas . '-' . $rombel;

    $inn = mysqli_query($koneksi3, "INSERT INTO kl_madin VALUES ('', '$nmOk', '$tahun') ");

    if ($inn) {
        echo "
        <script>
            window.location = 'dt_kelasMd.php';
        </script>
    ";
    }
}
?>