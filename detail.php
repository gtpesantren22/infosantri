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
$lm = $_GET['lmb'];
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
    <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA SANTRI PULANG</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="color: white; background-color: #20B2AA;">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas Formal</th>
                                            <th>Alasan</th>
                                            <th>Tanggal Pulang</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'config/koneksi.php';
                                        $no = 1;
                                        $sql = mysqli_query($koneksi2, "SELECT * FROM tb_santri JOIN pulang ON tb_santri.nis = pulang.nis WHERE pulang.ket = 0 AND t_formal = '$lm' ");
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $row['nama'] ?></t>
                                                <td><?php echo $row['k_formal'] . ' - ' . $row['t_formal'] ?></td>
                                                <!--<td><?php echo $row['k_madin'] . ' - ' . $row['r_madin'] ?></td>-->
                                                <td><?php echo $row['keperluan'] ?></t>
                                                <td><?php echo $row['tgl_pulang'] ?></td>



                                                <td style="text-align: center;">
                                                    <a href="<?= 'detail_santri_pulang.php?id=' . $row['id'] ?>" class="btn btn-success btn-icon-split btn-sm">
                                                        <span class="icon text-white-100">
                                                            <i class="fas fa-cog"></i>
                                                        </span>
                                                        <span class="text">Detail</span>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="color: white; background-color: lightsalmon;">
                                            <th>No</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Sakit</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'config/koneksi.php';
                                        $no = 1;
                                        $sql = mysqli_query($koneksi, "SELECT * FROM tb_santri JOIN sakit ON tb_santri.nis = sakit.nis WHERE status = 'Sakit' AND t_formal = '$lm' ");

                                        while ($row = mysqli_fetch_assoc($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $row['nis'] ?></td>
                                                <td><?php echo $row['nama'] ?></td>
                                                <td><?php echo $row['ds'] ?></td>

                                                <td style="text-align: center;">
                                                    <a href="<?= 'detail_santri_sakit.php?id=' . $row['id_sakit'] ?>" class="btn btn-success btn-icon-split btn-sm">
                                                        <span class="icon text-white-100">
                                                            <i class="fas fa-cog"></i>
                                                        </span>
                                                        <span class="text">Detail</span>
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

</body>

</html>