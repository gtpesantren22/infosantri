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
        $k_formal = $kls[0];
        $jurusan = $kls[1];
        $r_formal = $kls[2];
        $t_formal = $kls[3];

        $qr = mysqli_query($conn, "SELECT a.*, b.nama FROM absen a JOIN tb_santri b ON a.nis=b.nis WHERE a.tanggal = '$tgl' AND b.t_formal = '$t_formal' AND b.jurusan = '$jurusan' AND b.r_formal = '$r_formal' AND b.k_formal = '$k_formal' AND b.aktif = 'Y' ");

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