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

$sql = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' AND aktif = 'Y' ORDER BY nama ASC ");

$dtKls =  mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga = '$level'");


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
                    <h1 class="h3 mb-2 text-gray-800"><b>DATA SISWA KELAS FORMAL : <?= $_GET['kls']; ?></b></h1>
                    <hr>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Santri</button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-add"></i> Naik Kelas</button>
                            <?php if ($k_formal === 'XII' || $k_formal === 'IX') : ?>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal3"><i class="fa fa-times"></i> Luluskan</button>
                            <?php endif; ?>
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
                                                            <a href="<?= 'del.php?kd=out_for&id=' . $row['nis'] ?>" onclick="return confirm('Yakin siswa ini akan dikeluarkan ?')" class="btn btn-danger btn-icon-split btn-sm">
                                                                <span class="icon text-white-100">
                                                                    <i class="fas fa-times"></i>
                                                                </span>
                                                                <span class="text">Keluarkan</span>
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
                                            $santri = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE t_formal = '$level' AND aktif = 'Y' AND (r_formal = '' || jurusan = '' || k_formal = '') ");
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

                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Siswa dari kelas : <?= $_GET['kls'] ?> akan dinaikkan ke</h3>
                                <form action="" method="post">
                                    <input type="hidden" name="kelasAsal" value="<?= $_GET['kls'] ?>">
                                    <?php while ($dts = mysqli_fetch_assoc($dtKls)) : ?>
                                        <input type="radio" name="kelasPindah" value="<?= $dts['nm_kelas'] ?>"> <?= $dts['nm_kelas'] ?><br>
                                    <?php endwhile; ?>
                                    <br>
                                    <p style="color: red;"><i>Perhatian! <br> Jika data sudah dipindah maka tidak bisa dikembalikan lagi, kecuali dikembalikan satu persatu</i></p>
                                    <button class="btn btn-sm btn-success" type="submit" name="pindah">Pindahkan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Luluskan Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="kelas" value="<?= $kls ?>">
                                    <p style="color: red;"><i>Perhatian! <br> Fitur ini akan meluluskan semua siswa yang ada dikelas ini. Lanjutkan ?</i></p>
                                    <button class="btn btn-sm btn-success" type="submit" name="lulus">Luluskan</button>
                                </form>
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

if (isset($_POST['lulus'])) {
    // $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $sql = mysqli_query($koneksi3, "UPDATE tb_santri SET k_formal = '', r_formal = '', jurusan = '', t_formal = '' WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' ");

    $link = 'cek_formal.php?kls=' . $_GET['kls'];
    if ($sql) {
        echo "
        <script>
        window.location = '" . $link . "';
        </script>
        ";
    }
}

if (isset($_POST['pindah'])) {
    $kelasAsal = $_POST['kelasAsal'];
    $klsAsal = explode('-', $kelasAsal);
    $k_formalAsal = $klsAsal[0];
    $jurusanAsal = $klsAsal[1];
    $r_formalAsal = $klsAsal[2];
    $t_formalAsal = $klsAsal[3];

    $kelasPindah = $_POST['kelasPindah'];
    $klsPindah = explode('-', $kelasPindah);
    $k_formalPindah = $klsPindah[0];
    $jurusanPindah = $klsPindah[1];
    $r_formalPindah = $klsPindah[2];
    $t_formalPindah = $klsPindah[3];

    $cekIsi = mysqli_num_rows(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formalPindah' AND t_formal = '$t_formalPindah' AND jurusan = '$jurusanPindah' AND r_formal = '$r_formalPindah' AND aktif = 'Y' "));

    if ($cekIsi > 0) {
        $link = 'cek_formal.php?kls=' . $_GET['kls'];
        echo "
        <script>
            alert('Kelas Ini belum kosong. Harap dipindah dulu');
            window.location = '" . $link . "';
        </script>
        ";
    } else {
        $sqlPindah = mysqli_query($koneksi3, "UPDATE tb_santri SET k_formal = '$k_formalPindah', r_formal = '$r_formalPindah', jurusan = '$jurusanPindah', t_formal = '$t_formalPindah' WHERE k_formal = '$k_formalAsal' AND r_formal = '$r_formalAsal' AND jurusan = '$jurusanAsal' AND t_formal = '$t_formalAsal' AND aktif = 'Y' ");

        if ($sqlPindah) {
            $link = 'cek_formal.php?kls=' . $_GET['kls'];
            echo "
        <script>
            alert('Kelas berhasil dipindah');
            window.location = '" . $link . "';
        </script>
        ";
        }
    }
}

?>