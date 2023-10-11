<?php

include 'config/koneksi.php';

$api_url = 'https://dpontren.ppdwk.com/api-dataAll.php';
// $api_url = 'http://localhost/dpontren/api-dataAll.php';

// Token API yang akan dikirimkan
$api_token = '2y10bMXpw6ajVkXVjP6nEjg4pus6rw5cZy0fBcukr614aS88CBsbna7YK';

// Data yang akan dikirimkan ke API (jika ada)
$data = array(
    'api_token' => $api_token
);

// Membuat context HTTP
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    )
));

// Mengirim permintaan ke API
$response = file_get_contents($api_url, false, $context);

// Menampilkan hasil dari API
$data = json_decode($response, true);
// return $data;

if ($data !== null) {
    mysqli_query($conn, "TRUNCATE tb_santri");

    foreach ($data as $item) {
        $nis = mysqli_real_escape_string($conn, $item['nis']);
        $nisn = mysqli_real_escape_string($conn, $item['nisn']);
        $nik = mysqli_real_escape_string($conn, $item['nik']);
        $no_kk = mysqli_real_escape_string($conn, $item['no_kk']);
        $email = mysqli_real_escape_string($conn, $item['email']);
        $nama = mysqli_real_escape_string($conn, $item['nama']);
        $tempat = mysqli_real_escape_string($conn, $item['tempat']);
        $tanggal = mysqli_real_escape_string($conn, $item['tanggal']);
        $jkl = mysqli_real_escape_string($conn, $item['jkl']);
        $jln = mysqli_real_escape_string($conn, $item['jln']);
        $rt = mysqli_real_escape_string($conn, $item['rt']);
        $rw = mysqli_real_escape_string($conn, $item['rw']);
        $kd_pos = mysqli_real_escape_string($conn, $item['kd_pos']);
        $desa = mysqli_real_escape_string($conn, $item['desa']);
        $kec = mysqli_real_escape_string($conn, $item['kec']);
        $kab = mysqli_real_escape_string($conn, $item['kab']);
        $prov = mysqli_real_escape_string($conn, $item['prov']);
        $k_formal = mysqli_real_escape_string($conn, $item['k_formal']);
        $t_formal = mysqli_real_escape_string($conn, $item['t_formal']);
        $r_formal = mysqli_real_escape_string($conn, $item['r_formal']);
        $jurusan = mysqli_real_escape_string($conn, $item['jurusan']);
        $k_madin = mysqli_real_escape_string($conn, $item['k_madin']);
        $r_madin = mysqli_real_escape_string($conn, $item['r_madin']);
        $komplek = mysqli_real_escape_string($conn, $item['komplek']);
        $kamar = mysqli_real_escape_string($conn, $item['kamar']);
        $anak_ke = mysqli_real_escape_string($conn, $item['anak_ke']);
        $jml_sdr = mysqli_real_escape_string($conn, $item['jml_sdr']);
        $bapak = mysqli_real_escape_string($conn, $item['bapak']);
        $nik_a = mysqli_real_escape_string($conn, $item['nik_a']);
        $tempat_a = mysqli_real_escape_string($conn, $item['tempat_a']);
        $tanggal_a = mysqli_real_escape_string($conn, $item['tanggal_a']);
        $pend_a = mysqli_real_escape_string($conn, $item['pend_a']);
        $pkj_a = mysqli_real_escape_string($conn, $item['pkj_a']);
        $status_a = mysqli_real_escape_string($conn, $item['status_a']);
        $foto_a = mysqli_real_escape_string($conn, $item['foto_a']);
        $ibu = mysqli_real_escape_string($conn, $item['ibu']);
        $nik_i = mysqli_real_escape_string($conn, $item['nik_i']);
        $tempat_i = mysqli_real_escape_string($conn, $item['tempat_i']);
        $tanggal_i = mysqli_real_escape_string($conn, $item['tanggal_i']);
        $pend_i = mysqli_real_escape_string($conn, $item['pend_i']);
        $pkj_i = mysqli_real_escape_string($conn, $item['pkj_i']);
        $status_i = mysqli_real_escape_string($conn, $item['status_i']);
        $foto_i = mysqli_real_escape_string($conn, $item['foto_i']);
        $wali = mysqli_real_escape_string($conn, $item['wali']);
        $nik_w = mysqli_real_escape_string($conn, $item['nik_w']);
        $tempat_w = mysqli_real_escape_string($conn, $item['tempat_w']);
        $tanggal_w = mysqli_real_escape_string($conn, $item['tanggal_w']);
        $pend_w = mysqli_real_escape_string($conn, $item['pend_w']);
        $pkj_w = mysqli_real_escape_string($conn, $item['pkj_w']);
        $hp = mysqli_real_escape_string($conn, $item['hp']);
        $pass = mysqli_real_escape_string($conn, $item['pass']);
        $foto = mysqli_real_escape_string($conn, $item['foto']);
        $stts = mysqli_real_escape_string($conn, $item['stts']);
        $t_kos = mysqli_real_escape_string($conn, $item['t_kos']);
        $ket = mysqli_real_escape_string($conn, $item['ket']);
        $aktif = mysqli_real_escape_string($conn, $item['aktif']);

        $dts = mysqli_query($conn, " INSERT INTO tb_santri  
            (nis,
            nisn,
            nik,
            no_kk,
            email,
            nama,
            tempat,
            tanggal,
            jkl,
            jln,
            rt,
            rw,
            kd_pos,
            desa,
            kec,
            kab,
            prov,
            k_formal,
            t_formal,
            r_formal,
            jurusan,
            k_madin,
            r_madin,
            komplek,
            kamar,
            anak_ke,
            jml_sdr,
            bapak,
            nik_a,
            tempat_a,
            tanggal_a,
            pend_a,
            pkj_a,
            status_a,
            foto_a,
            ibu,
            nik_i,
            tempat_i,
            tanggal_i,
            pend_i,
            pkj_i,
            status_i,
            foto_i,
            wali,
            nik_w,
            tempat_w,
            tanggal_w,
            pend_w,
            pkj_w,
            hp,
            pass,
            foto,
            stts,
            t_kos,
            ket,
            aktif ) VALUES (
            '$nis',
            '$nisn',
            '$nik',
            '$no_kk',
            '$email',
            '$nama',
            '$tempat',
            '$tanggal',
            '$jkl',
            '$jln',
            '$rt',
            '$rw',
            '$kd_pos',
            '$desa',
            '$kec',
            '$kab',
            '$prov',
            '$k_formal',
            '$t_formal',
            '$r_formal',
            '$jurusan',
            '$k_madin',
            '$r_madin',
            '$komplek',
            '$kamar',
            '$anak_ke',
            '$jml_sdr',
            '$bapak',
            '$nik_a',
            '$tempat_a',
            '$tanggal_a',
            '$pend_a',
            '$pkj_a',
            '$status_a',
            '$foto_a',
            '$ibu',
            '$nik_i',
            '$tempat_i',
            '$tanggal_i',
            '$pend_i',
            '$pkj_i',
            '$status_i',
            '$foto_i',
            '$wali',
            '$nik_w',
            '$tempat_w',
            '$tanggal_w',
            '$pend_w',
            '$pkj_w',
            '$hp',
            '$pass',
            '$foto',
            '$stts',
            '$t_kos',
            '$ket',
            '$aktif') ");
    }

    if ($dts) {
        echo "
        <script>
            window.location = 'santri.php?jk=Laki-laki';
        </script>
        ";
    } else {
        echo "Sinkron Gagal";
    }

    // echo count($data);
} else {
    // Menampilkan pesan jika data tidak dapat diubah menjadi array asosiatif
}
