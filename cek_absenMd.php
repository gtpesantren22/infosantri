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
    $sql = mysqli_query($koneksi3, "SELECT * FROM absen ");
} else {
    $sql = mysqli_query($conn, "SELECT a.* FROM absen a JOIN tb_santri b ON a.nis=b.nis WHERE b.aktif = 'Y' GROUP BY a.tanggal");
}

$kls = explode('-', $_GET['kls']);
$tgl = $_GET['tgl'];
$k_madin = $kls[0];
$r_madin = $kls[1];
$jkl = $_GET['jkl'];

$qr = mysqli_query($conn, "SELECT a.*, b.nama FROM absen_md a JOIN tb_santri b ON a.nis=b.nis WHERE a.tanggal = '$tgl' AND b.k_madin = '$k_madin' AND b.r_madin = '$r_madin' AND a.jkl = '$jkl' AND b.aktif = 'Y' ORDER BY b.nama ASC ");
$qr2 = mysqli_query($conn, "SELECT a.*, b.nama FROM absen_md a JOIN tb_santri b ON a.nis=b.nis WHERE a.tanggal = '$tgl' AND b.k_madin = '$k_madin' AND b.r_madin = '$r_madin' AND a.jkl = '$jkl' AND b.aktif = 'Y' ORDER BY b.nama ASC ");

$dtsa = mysqli_fetch_assoc($qr2);
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

    <title>Info Santri PPDWk</title>

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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA ABSENSI MADIN</b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- kls=2-B&tgl=2022-11-04&jkl=Laki-laki -->
                            <a href="exp_absen.php?kls=<?= $_GET['kls'] . '&tgl=' . $tgl . '&jkl=' . $jkl ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-download"></i> Download File Template</a>
                            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-upload"></i> Upload File</button>

                            <b>Cek Absensi Bulan <span class="badge badge-primary"><?= $bn[$dtsa['bulan']]; ?></span> <span class="badge badge-success">Minggu ke-<?= $dtsa['minggu']; ?></span></b>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Nama</th>
                                                    <th rowspan="2">Kelas</th>
                                                    <th colspan="4">Keterangan </th>
                                                    <th rowspan="2">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th>Izin</th>
                                                    <th>Sakit</th>
                                                    <th>Alpha</th>
                                                    <th>Ket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($r = mysqli_fetch_assoc($qr)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $r['nama'] ?></td>
                                                        <td><?= $_GET['kls'] ?></td>
                                                        <td><?= $r['izin'] ?></td>
                                                        <td><?= $r['sakit'] ?></td>
                                                        <td><?= $r['alpha'] ?></td>
                                                        <td><?= $r['ket'] ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal<?= $r['id_absen'] ?>">
                                                                <i class="fa fa-edit"> </i>
                                                            </button>

                                                            <!-- Modal Edit Data-->
                                                            <div class="modal fade" id="exampleModal<?= $r['id_absen'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Rekap Absen Siswa</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="" method="post">
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="act" value="edit">
                                                                                <input type="hidden" name="id_absen" value="<?= $r['id_absen'] ?>">
                                                                                <!-- <input type="hidden" name="jp" value="<?= $r['jam'] ?>"> -->
                                                                                <table class="table ">
                                                                                    <tr>
                                                                                        <th>Nama</th>
                                                                                        <th><?= $r['nama'] ?></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Kelas</th>
                                                                                        <th><?= $_GET['kls'] ?></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tgl Absen</th>
                                                                                        <th><?= $tgl; ?></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Sakit</th>
                                                                                        <th><input type="number" class="form-control" name="sakit" value="<?= $r['sakit'] ?>" required></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Izin</th>
                                                                                        <th><input type="number" class="form-control" name="izin" value="<?= $r['izin'] ?>" required></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Alpha</th>
                                                                                        <th><input type="number" class="form-control" name="alpha" value="<?= $r['alpha'] ?>" required></th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Ket</th>
                                                                                        <th>
                                                                                            <textarea name="ket" class="form-control" cols="15" rows="2" required><?= $r['ket'] ?></textarea>
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" name="update" class="btn btn-success">Update</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Akhir Modal -->

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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload File Absen yang sudah lengkap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <b><i>* Diharap untuk tidak mengubah format template hasil download yang akan diupload disini</i></b>
                    <div class="form-group">
                        <input type="hidden" name="kls" value="<?= $_GET['kls'] ?>">
                        <label for="">Pilih file</label>
                        <input type="file" name="file" id="" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['update'])) {
    $id_absen = mysqli_real_escape_string($conn, $_POST['id_absen']);
    $A = mysqli_real_escape_string($conn, $_POST['alpha']);
    $I = mysqli_real_escape_string($conn, $_POST['izin']);
    $S = mysqli_real_escape_string($conn, $_POST['sakit']);
    $ket = mysqli_real_escape_string($conn, $_POST['ket']);
    // $jp = mysqli_real_escape_string($conn, $_POST['jp']);

    $link = 'cek_absenMd.php?kls=' . $_GET['kls'] . '&tgl=' . $tgl . '&jkl=' . $jkl;

    // if (($A + $S + $H + $I)) {
    //     echo "
    //     <script>
    //         alert('Maaf. Akumulasi jml absen lebih');
    //         window.location = '" . $link . "';
    //     </script>
    //     ";
    // } else {
    //     // $hsisa = $jp - ($A + $I + $S);

    // }

    $ssq = mysqli_query($conn, "UPDATE absen_md SET alpha = '$A', sakit = '$S', izin = '$I', ket = '$ket'  WHERE id_absen = '$id_absen' ");
    if ($ssq) {
        echo "
            <script>
                window.location = '" . $link . "';
            </script>
            ";
    }
}
?>