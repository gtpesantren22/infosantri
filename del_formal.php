<?php
include 'config/koneksi.php';

$klGet = $_GET['kls'];
$kls = explode('-', $klGet);
$kelas = $kls[0];
$jur = $kls[1];
$rmb = $kls[2];
$lmg = $kls[3];

$sql = mysqli_query($koneksi3, "UPDATE tb_santri SET k_formal = '', t_formal = '', r_formal = '', jurusan = '' WHERE k_formal = '$kelas' AND  t_formal = '$lmg' AND  r_formal = '$rmb' AND  jurusan = '$jur' ");
$sql2 = mysqli_query($koneksi3, "DELETE FROM kl_formal WHERE nm_kelas = '$klGet' ");

if ($sql2) {
    echo "
    <script>
        alert('Kelas Sudah dihapus');
        window.location = 'dt_kelas.php';
    </script>
    ";
}

?>