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

if ($level == 'admin') {
    $sql = mysqli_query($koneksi3, "SELECT * FROM kl_formal ");
} else {
    $sql = mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga = '$level'");
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Tapel</th>
                                                    <th>Jml Santri</th>
                                                    <th style="text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'config/koneksi.php';
                                                $no = 1;

                                                while ($row = mysqli_fetch_assoc($sql)) {
                                                    $kls = explode('-', $row['nm_kelas']);
                                                    $k_formal = htmlspecialchars(mysqli_real_escape_string($koneksi3, $kls[0]));
                                                    $jurusan = $kls[1];
                                                    $r_formal = $kls[2];
                                                    $t_formal = $kls[3];

                                                    $jml = mysqli_num_rows(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' AND aktif = 'Y' "));

                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nm_kelas'] ?></td>
                                                        <td><?php echo $row['tahun'] ?></td>
                                                        <td><?php echo $jml ?> santri</td>
                                                        <td style="text-align: center;">
                                                            <a href="<?= 'cek_formal.php?kls=' . $row['nm_kelas'] ?>" class="btn btn-primary btn-icon-split btn-sm">
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
                                <div class="col-md-4">
                                    <h4>Tambah Kelas Baru</h4>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="lembaga" class="form-control" required value="<?= $level; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <select name="kelas" id="" class="form-control" required>
                                                <option value=""> -pilih kelas- </option>
                                                <?php
                                                $skls = mysqli_query($koneksi3, "SELECT * FROM kelas");
                                                while ($kl = mysqli_fetch_assoc($skls)) {
                                                ?>
                                                    <option value="<?= $kl['nama']; ?>"><?= $kl['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="rombel" id="" class="form-control" required>
                                                <option value=""> -pilih rombel- </option>
                                                <?php
                                                $skls = mysqli_query($koneksi3, "SELECT * FROM rombel");
                                                while ($kl = mysqli_fetch_assoc($skls)) {
                                                ?>
                                                    <option value="<?= $kl['nama']; ?>"><?= $kl['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="jurusan" id="" class="form-control" required>
                                                <option value=""> -pilih jurusan- </option>
                                                <?php
                                                $skls = mysqli_query($koneksi3, "SELECT * FROM jurusan");
                                                while ($kl = mysqli_fetch_assoc($skls)) {
                                                ?>
                                                    <option value="<?= $kl['nama']; ?>"><?= $kl['kode'] . ' - ' . $kl['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="tahun" id="" class="form-control" required>
                                                <option value=""> -pilih tahun pelajaran- </option>
                                                <?php
                                                $skls = mysqli_query($koneksi3, "SELECT * FROM tahun");
                                                while ($r = mysqli_fetch_assoc($skls)) { ?>
                                                    <option value="<?= $r['nama']; ?>"><?= $r['nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-success btn-sm" type="submit" name="save"><i class="fa fa-check"></i> Simpan</button>
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

                <!-- Page level plugins -->
                <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php

if (isset($_POST['save'])) {
    $lembaga = mysqli_real_escape_string($koneksi3, $_POST['lembaga']);
    $kelas = mysqli_real_escape_string($koneksi3, $_POST['kelas']);
    $rombel = $_POST['rombel'];
    $jurusan = mysqli_real_escape_string($koneksi3, $_POST['jurusan']);
    $tahun = $_POST['tahun'];
    $nmOk = $kelas . '-' . $jurusan . '-' . $rombel . '-' . $lembaga;

    $cck = mysqli_num_rows(mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE nm_kelas = '$nmOk' AND tahun = '$tahun' AND lembaga = '$lembaga' "));
    if ($cck > 0) {
        echo "
        <script>
            alert('Maaf. Kelas ini sudah ada');
            window.location = 'dt_kelas.php';
        </script>
        ";
    } else {

        $inn = mysqli_query($koneksi3, "INSERT INTO kl_formal VALUES ('', '$nmOk', '$lembaga', '$tahun') ");
        if ($inn) {
            echo "
            <script>
                window.location = 'dt_kelas.php';
            </script>
            ";
        }
    }
}
?>