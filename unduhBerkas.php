<?php
include 'config/koneksi.php';
$nis = $_GET['nis'];
$zipFileName = 'berkas-' . $nis . '.zip';


// Query database untuk mengambil nama berkas
$sql = mysqli_query($psb24, "SELECT * FROM berkas_file JOIN foto_file ON berkas_file.nis=foto_file.nis WHERE berkas_file.nis = $nis ");
$hasil = mysqli_fetch_assoc($sql);
// $path = 'https://psb.ppdwk.com/assets/berkas/';
$path = '../psb/assets/berkas/';

// Daftar berkas yang akan dimasukkan ke dalam ZIP
$filesToZip = array(
    $path . 'kk/' . $hasil['kk'],
    $path . 'akta/' . $hasil['akta'],
    $path . 'ktp_ayah/' . $hasil['ktp_ayah'],
    $path . 'ktp_ibu/' . $hasil['ktp_ibu'],
    $path . 'foto/' . $hasil['diri'],
    // 'img/dwk.jpg',
);

// Buat objek ZipArchive
$zip = new ZipArchive();

if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    // Tambahkan berkas-berkas ke dalam ZIP
    foreach ($filesToZip as $file) {
        $zip->addFile($file, basename($file));
    }

    // Tutup ZIP
    $zip->close();

    // Atur header untuk mengaktifkan unduhan berkas ZIP
    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename=' . $zipFileName);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zipFileName));

    // Baca dan kirimkan berkas ZIP ke browser
    readfile($zipFileName);

    // Hapus berkas ZIP setelah diunduh
    unlink($zipFileName);
} else {
    echo 'Gagal membuat berkas ZIP.';
}
