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
                    <h1 class="h3 mb-2 text-gray-800"><b>SETTINGS</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="">Nama User</label>
                                            <input type="text" name="nama" id="" class="form-control" value="<?= $dt['nama'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" name="username" id="" class="form-control" value="<?= $dt['username'] ?>">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="password" name="password" id="" class="form-control" placeholder="Masukan Password baru">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password2" id="" class="form-control" placeholder="Ulangi Password baru">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                                        </div>
                                    </form>
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
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php 

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $pass = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
    
    if ($pass === '') {
        $sql = mysqli_query($conn, "UPDATE user SET nama = '$nama', username = '$username' WHERE id_user = $id_user ");
        if ($sql) {
            echo "
                <script>
                    window.location = 'setting.php'
                </script>
            ";
        }
    } elseif ($pass != '') {
        $pass2 = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password2']));

        if ($pass != $pass2) {
            echo "
                <script>
                    alert('Maaf Password yang anda masukan tidak sanma');
                    window.location = 'setting.php'
                </script>
            ";
        }else{
            $sql = mysqli_query($conn, "UPDATE user SET nama = '$nama', username = '$username', password = '$pass' WHERE id_user = $id_user ");
            if ($sql) {
                echo "
                <script>
                    alert('Akun sudah diperbarui');
                    window.location = 'setting.php'
                </script>
            ";
            }
        }
    }
}

?>