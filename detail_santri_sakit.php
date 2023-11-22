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
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM sakit WHERE id_sakit = $id"));

$id_sakit = $data['nis'];
$data2 = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_santri WHERE nis = $id_sakit"));

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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA SANTRI SAKIT</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                                <label>Nama Santri :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data2['nama'] ?>" disabled>
                                <label>DS :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['ds'] ?>" disabled>
                                <label>DO :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['do'] ?>" disabled>
                                <label>Tanggal Sakit :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['tgl_sakit'] ?>" disabled>
                                <label>Tanggal Sembuh :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['tgl_sakit'] ?>" disabled>
                                <label>Status :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['status'] ?>" disabled>
                                <label>Kategori :</label><br>
                                <input type="text" class="form-control" value="<?php echo $data['kategori'] ?>" disabled>
                                <br>
                                <a href="santri_sakit.php" class="btn btn-danger btn-icon-split btn-sm">
                                    <span class="icon text-white-100">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>
                                    <span class="text">Kembali</span>
                                </a>
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