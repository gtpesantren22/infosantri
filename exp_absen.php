<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Teplate Export Absen Madin.xls");

    include 'config/koneksi.php';

    $kls = explode('-', $_GET['kls']);
    $tgl = $_GET['tgl'];
    $k_madin = $kls[0];
    $r_madin = $kls[1];
    $jkl = $_GET['jkl'];

    $qr = mysqli_query($conn, "SELECT a.*, b.nama, b.nis FROM absen_md a JOIN tb_santri b ON a.nis=b.nis WHERE a.tanggal = '$tgl' AND b.k_madin = '$k_madin' AND b.r_madin = '$r_madin' AND a.jkl = '$jkl' AND b.aktif = 'Y' ORDER BY b.nama ASC ");

    $qr2 = mysqli_query($conn, "SELECT a.*, b.nama , b.nis FROM absen_md a JOIN tb_santri b ON a.nis=b.nis WHERE a.tanggal = '$tgl' AND b.k_madin = '$k_madin' AND b.r_madin = '$r_madin' AND a.jkl = '$jkl' AND b.aktif = 'Y' ORDER BY b.nama ASC ");

    ?>

    <table border="1">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Mg</th>
            <th rowspan="2">Bln</th>
            <th rowspan="2">Thn</th>
            <th rowspan="2">NIS</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Kelas</th>
            <th colspan="4">Keterangan </th>
        </tr>
        <tr>
            <th>Izin</th>
            <th>Sakit</th>
            <th>Alpha</th>
            <th>Ket</th>
        </tr>
        <?php
        $no = 1;
        while ($r = mysqli_fetch_assoc($qr)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r['minggu'] ?></td>
                <td><?= $r['bulan'] ?></td>
                <td><?= $r['ta'] ?></td>
                <td><?= $r['nis'] ?></td>
                <td><?= $r['nama'] ?></td>
                <td><?= $_GET['kls'] ?></td>
                <td><?= $r['izin'] ?></td>
                <td><?= $r['sakit'] ?></td>
                <td><?= $r['alpha'] ?></td>
                <td><?= $r['ket'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>