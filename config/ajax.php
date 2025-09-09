<?php
include 'koneksi.php';

// $id_user = $_SESSION['id'];

$ket = isset($_GET['ket']) ? $_GET['ket'] : '';

if ($ket == 'allData') {
    $santri = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND (r_formal = '' || jurusan = '' || k_formal = '' || t_formal = '') ");


    $data = [];
    $no = 1;

    while ($row = mysqli_fetch_assoc($santri)) {
        $nis = $row["nis"];
        $t_formal = $row["t_formal"];
        $r_formal = $row["r_formal"];
        $k_formal = $row["k_formal"];
        $jurusan = $row["jurusan"];
        $data[] = [
            "no"     => $no,
            "nama"   => $row['nama'],
            "alamat" => $row['desa'] . ' ' . $row['kec'] . ' ' . $row['kab'],
            "formal" => $k_formal . '-' . $jurusan . '-' . $r_formal . '-' . $t_formal,
            "aksi"   => "
                <button class='btn-pindah btn btn-sm btn-primary' data-nis='{$nis}'><i class='fas fa-plus'></i></button>
            " // nanti bisa isi tombol edit/hapus
        ];
        $no++;
    }

    echo json_encode($data);
}
if ($ket == 'kelasData') {
    // $santri = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND (r_formal = '' || jurusan = '' || k_formal = '' || t_formal = '') ");
    $t_formal = $_GET["t_formal"];
    $r_formal = $_GET["r_formal"];
    $k_formal = $_GET["k_formal"];
    $jurusan = $_GET["jurusan"];

    $santri = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' AND aktif = 'Y' ORDER BY nama ASC ");


    $data = [];
    $no = 1;

    while ($row = mysqli_fetch_assoc($santri)) {
        $nis = $row["nis"];
        $t_formal = $row["t_formal"];
        $r_formal = $row["r_formal"];
        $k_formal = $row["k_formal"];
        $jurusan = $row["jurusan"];
        $data[] = [
            "no"     => $no,
            "nama"   => $row['nama'],
            "alamat" => $row['desa'] . ' ' . $row['kec'] . ' ' . $row['kab'],
            "formal" => $k_formal . '-' . $jurusan . '-' . $r_formal . '-' . $t_formal,
            "aksi"   => "
                <button class='btn-out btn btn-sm btn-danger' data-nis='{$nis}'><i class='fas fa-times'></i></button>
            " // nanti bisa isi tombol edit/hapus
        ];
        $no++;
    }

    echo json_encode($data);
}

if ($ket == 'out') {
    $nis = $_POST['nis'] ?? 0;
    $query = mysqli_query($koneksi3, "UPDATE tb_santri SET t_formal = '', k_formal = '', r_formal = '', jurusan = '' WHERE nis = '$nis' ");

    echo json_encode([
        "status" => $query ? "success" : "error",
        "message" => $query ? "Data berhasil dihapus" : "Gagal hapus data"
    ]);
    exit;
}
if ($ket == 'pindah') {
    $nis      = mysqli_real_escape_string($koneksi3, $_POST["nis"] ?? "");
    $t_formal = mysqli_real_escape_string($koneksi3, $_POST["t_formal"] ?? "");
    $r_formal = mysqli_real_escape_string($koneksi3, $_POST["r_formal"] ?? "");
    $k_formal = mysqli_real_escape_string($koneksi3, $_POST["k_formal"] ?? "");
    $jurusan  = mysqli_real_escape_string($koneksi3, $_POST["jurusan"] ?? "");

    $query = mysqli_query($koneksi3, "UPDATE tb_santri SET t_formal = '$t_formal', k_formal = '$k_formal', r_formal = '$r_formal', jurusan = '$jurusan' WHERE nis = '$nis' ");

    echo json_encode([
        "status" => $query ? "success" : "error",
        // "status" => "Hasil : " . $jurusan,
        "message" => $query ? "Data berhasil dihapus" : "Gagal hapus data"
    ]);
    exit;
}
