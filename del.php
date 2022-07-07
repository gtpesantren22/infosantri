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
    $sq = mysqli_query($conn, "DELETE FROM kl_madin WHERE id_kl_madin = $id ");
    if ($sq) {
        echo "
        <script>
            window.location = 'dt_kelasMd.php';
        </script>
    ";
    }
}
