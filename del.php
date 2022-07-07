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

$kd = $_GET['kd'];
$id = $_GET['id'];

if ($kd == 'kmd') {
    $sq = mysqli_query($koneksi3, "DELETE FROM kl_madin WHERE id_kl_madin = $id ");
    if ($sq) {
        echo "
        <script>
            window.location = 'dt_kelasMd.php';
        </script>
    ";
    }
}
if ($kd == 'hps_md') {
    $snn = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE nis = '$id' "));
    $sq = mysqli_query($koneksi3, "UPDATE tb_santri SET k_madin = '' , r_madin = '' WHERE nis = '$id' ");

    $link = 'cek_madin.php?kls=' . $snn['k_madin'] . '-' . $snn['r_madin'] . '&jkl=' . $snn['jkl'];
    if ($sq) {
        echo "
        <script>
            window.location = '" . $link . "';
        </script>
    ";
    }
}
