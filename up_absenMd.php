<?php
include 'config/koneksi.php';
require_once 'excel_reader2.php';


// $tahun_ajaran = $_SESSION['tahun'];

$target = basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $target);

chmod($_FILES['file']['name'], 07777);

$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'], false);

$jumbar = $data->rowcount($sheet_index = 0);

$success = 0;

for ($i = 3; $i <= $jumbar; $i++) {

    $mg = $data->val($i, 2);
    $bln = $data->val($i, 3);
    $ta = $data->val($i, 4);
    $izin = $data->val($i, 8);
    $sakit = $data->val($i, 9);
    $alpha = $data->val($i, 10);
    $ket = $data->val($i, 11);

    mysqli_query($conn, "UPDATE absen_md SET alpha = '$alpha', izin = '$izin', sakit = '$sakit' WHERE nis = '$nis' AND minggu = $mg AND bulan = $mg AND ta = '$ta'  ");

    $success++;
}

unlink($_FILES['file']['name']);
// $link = 'cek_absenMd.php?kls='.$_POST['kls'].'&tgl='. $_POST['tgl'] . '&jkl=' . $_POST['jkl'];
if ($success > 0) {
    echo "
        <script>
            alert('Upload OK');
            window.location = '".$link."';
        </script>
    ";
}
