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
    header("Content-Disposition: attachment; filename=Teplate Export NISN.xls");

    include 'config/koneksi.php';
    $kls = explode('-', $_GET['kls']);

    $kelas = $kls[0];
    $jur = $kls[1];
    $rmb = $kls[2];
    $lmg = $kls[3];

    $sql = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$kelas' AND  t_formal = '$lmg' AND  r_formal = '$rmb' AND  jurusan = '$jur' AND aktif = 'Y' ORDER BY nama ASC ");

    ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th>KELAS</th>
            <th>NISN</th>
        </tr>
        <?php
        $no = 1;
        while ($ar = mysqli_fetch_assoc($sql)){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $ar['nis'] ?></td>
            <td><?= $ar['nama'] ?></td>
            <td><?= $ar['desa'] ?></td>
            <td><?= $_GET['kls'] ?></td>
            <td><?= $ar['nisn'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>

</html>