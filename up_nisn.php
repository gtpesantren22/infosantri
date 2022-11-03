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

for ($i = 2; $i <= $jumbar; $i++) {

    $nis = $data->val($i, 2);
    $nisn = $data->val($i, 6);

    mysqli_query($koneksi3, "UPDATE tb_santri SET nisn = '$nisn' WHERE nis = '$nis' ");

    $success++;
}

unlink($_FILES['file']['name']);

if ($success > 0) {
    echo "
        <script>
            alert('Upload OK');
            window.location = 'cek_nisn.php?kls=".$_POST['kls']."';
        </script>
    ";
}
