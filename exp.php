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

$id_user = $_SESSION['id'];
$dt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id_user "));
$level = $dt['level'];
$tkos = ['', 'Ny. Jamilah/Kantin', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naily Zulfa', 'Ny. Lathifah', 'Ny. Ummi Kultsum'];

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


$spreadsheet = new Spreadsheet();

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = [
    'font' => ['bold' => true], // Set font nya jadi bold
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = [
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ],
    'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];

$dataKelas = mysqli_query($koneksi3, "SELECT * FROM kl_formal WHERE lembaga = '$level'");
while ($dtsk = mysqli_fetch_assoc($dataKelas)) {
    $sheet = $spreadsheet->createSheet();

    $nmKelas = $dtsk['nm_kelas'];

    $sheet->setCellValue('A1', "DATA SANTRI"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('A1:BA1'); // Set Merge Cell pada kolom A1 sampai E1

    $sheet->setCellValue('A2', "PONDOK PESANTREN DARUL LUGHAH WAL KAROMAH"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('A2:BA2'); // Set Merge Cell pada kolom A1 sampai E1

    $sheet->setCellValue('A3', ""); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('A3:BA3'); // Set Merge Cell pada kolom A1 sampai E1

    $sheet->setCellValue('H4', "TANGGAL LAHIR"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('H4:J4'); // Set Merge Cell pada kolom A1 sampai E1
    $sheet->getStyle('H4:J4')->applyFromArray($style_col);

    $sheet->setCellValue('N4', "ALAMAT LENGKAP"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('N4:U4'); // Set Merge Cell pada kolom A1 sampai E1
    $sheet->getStyle('N4:U4')->applyFromArray($style_col);

    $sheet->setCellValue('V4', "DATA BAPAK"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('V4:AE4'); // Set Merge Cell pada kolom A1 sampai E1
    $sheet->getStyle('V4:AE4')->applyFromArray($style_col);

    $sheet->setCellValue('AF4', "DATA IBU"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('AF4:AO4'); // Set Merge Cell pada kolom A1 sampai E1
    $sheet->getStyle('AF4:AO4')->applyFromArray($style_col);

    $spreadsheet->getActiveSheet()->getStyle('A4:BA4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('F7EF00');
    $spreadsheet->getActiveSheet()->getStyle('A5:BA5')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('F7EF00');

    $sheet->mergeCells('A4:A5');
    $sheet->mergeCells('B4:B5');
    $sheet->mergeCells('C4:C5');
    $sheet->mergeCells('D4:D5');
    $sheet->mergeCells('E4:E5');
    $sheet->mergeCells('F4:F5');
    $sheet->mergeCells('G4:G5');
    $sheet->mergeCells('K4:K5');
    $sheet->mergeCells('L4:L5');
    $sheet->mergeCells('M4:M5');
    $sheet->mergeCells('AP4:AP5');
    $sheet->mergeCells('AQ4:AQ5');
    $sheet->mergeCells('AR4:AR5');
    $sheet->mergeCells('AS4:AS5');
    $sheet->mergeCells('AT4:AT5');
    $sheet->mergeCells('AU4:AU5');
    $sheet->mergeCells('AV4:AV5');
    $sheet->mergeCells('AW4:AW5');
    $sheet->mergeCells('AX4:AX5');
    $sheet->mergeCells('AY4:AY5');
    $sheet->mergeCells('AZ4:AZ5');
    $sheet->mergeCells('BA4:BA5');
    // $sheet->mergeCells('BB4:BB5');

    $sheet->getStyle('A4:A5')->applyFromArray($style_col);
    $sheet->getStyle('B4:B5')->applyFromArray($style_col);
    $sheet->getStyle('C4:C5')->applyFromArray($style_col);
    $sheet->getStyle('D4:D5')->applyFromArray($style_col);
    $sheet->getStyle('E4:E5')->applyFromArray($style_col);
    $sheet->getStyle('F4:F5')->applyFromArray($style_col);
    $sheet->getStyle('G4:G5')->applyFromArray($style_col);
    $sheet->getStyle('K4:K5')->applyFromArray($style_col);
    $sheet->getStyle('L4:L5')->applyFromArray($style_col);
    $sheet->getStyle('M4:M5')->applyFromArray($style_col);
    $sheet->getStyle('AP4:AP5')->applyFromArray($style_col);
    $sheet->getStyle('AQ4:AQ5')->applyFromArray($style_col);
    $sheet->getStyle('AR4:AR5')->applyFromArray($style_col);
    $sheet->getStyle('AS4:AS5')->applyFromArray($style_col);
    $sheet->getStyle('AT4:AT5')->applyFromArray($style_col);
    $sheet->getStyle('AU4:AU5')->applyFromArray($style_col);
    $sheet->getStyle('AV4:AV5')->applyFromArray($style_col);
    $sheet->getStyle('AW4:AW5')->applyFromArray($style_col);
    $sheet->getStyle('AX4:AX5')->applyFromArray($style_col);
    $sheet->getStyle('AY4:AY5')->applyFromArray($style_col);
    $sheet->getStyle('AZ4:AZ5')->applyFromArray($style_col);
    $sheet->getStyle('BA4:BA5')->applyFromArray($style_col);
    // $sheet->getStyle('BB4:BB5')->applyFromArray($style_col);

    // Buat header tabel nya pada baris ke 3
    $sheet->setCellValue('A4', "NO");
    $sheet->setCellValue('B4', "NIS");
    $sheet->setCellValue('C4', "NISN");
    $sheet->setCellValue('D4', "NIK");
    $sheet->setCellValue('E4', "NO KK");
    $sheet->setCellValue('F4', "NAMA LENGKAP");
    $sheet->setCellValue('G4', "TMP LAHIR");

    $sheet->setCellValue('H5', "TGL LAHIR");
    $sheet->setCellValue('I5', "BLN LAHIR");
    $sheet->setCellValue('J5', "THN LAHIR");
    $sheet->setCellValue('K4', "JKL");
    $sheet->setCellValue('L4', "");
    $sheet->setCellValue('M4', "");

    $sheet->setCellValue('N5', "JLN/DSN");
    $sheet->setCellValue('O5', "RT");
    $sheet->setCellValue('P5', "RW");
    $sheet->setCellValue('Q5', "DESA");
    $sheet->setCellValue('R5', "KECAMATAN");
    $sheet->setCellValue('S5', "KABUPATEN");
    $sheet->setCellValue('T5', "PROVINSI");
    $sheet->setCellValue('U5', "KODE POS");
    $sheet->setCellValue('V5', "NAMA BAPAK");
    $sheet->setCellValue('W5', "NIK");
    $sheet->setCellValue('X5', "TMP LAHIR");
    $sheet->setCellValue('Y5', "TGL LAHIR");
    $sheet->setCellValue('Z5', "BLN LAHIR");
    $sheet->setCellValue('AA5', "THN LAHIR");
    $sheet->setCellValue('AB5', "PEKERJAAN");
    $sheet->setCellValue('AC5', "PENDIDIKAN");
    $sheet->setCellValue('AD5', "");
    $sheet->setCellValue('AE5', "STATUS");
    $sheet->setCellValue('AF5', "NAMA IBU");
    $sheet->setCellValue('AG5', "NIK");
    $sheet->setCellValue('AH5', "TMP LAHIR");
    $sheet->setCellValue('AI5', "TGL LAHIR");
    $sheet->setCellValue('AJ5', "BLN LAHIR");
    $sheet->setCellValue('AK5', "THN LAHIR");
    $sheet->setCellValue('AL5', "PEKERJAAN");
    $sheet->setCellValue('AM5', "PENDIDIKAN");
    $sheet->setCellValue('AN5', "");
    $sheet->setCellValue('AO5', "STATUS");

    $sheet->setCellValue('AP4', "NO HP");
    $sheet->setCellValue('AQ4', "KOMPLEK");
    $sheet->setCellValue('AR4', "KAMAR");
    $sheet->setCellValue('AS4', "LEMARI");
    $sheet->setCellValue('AT4', "WALI ASUH");
    $sheet->setCellValue('AU4', "ANAK KE");
    $sheet->setCellValue('AV4', "JML SDR");
    $sheet->setCellValue('AW4', "TEMPAT KOS");
    $sheet->setCellValue('AX4', "SEKOLAH");
    $sheet->setCellValue('AY4', "KELAS");
    $sheet->setCellValue('AZ4', "ROMBEL");
    $sheet->setCellValue('BA4', "JURUSAN");
    // $sheet->setCellValue('BB4', "STTS SANTRI");


    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $sheet->getStyle('A1')->applyFromArray($style_col);
    $sheet->getStyle('B1')->applyFromArray($style_col);

    $sheet->getStyle('A4')->applyFromArray($style_col);
    $sheet->getStyle('B4')->applyFromArray($style_col);
    $sheet->getStyle('C4')->applyFromArray($style_col);
    $sheet->getStyle('D4')->applyFromArray($style_col);
    $sheet->getStyle('E4')->applyFromArray($style_col);
    $sheet->getStyle('F4')->applyFromArray($style_col);
    $sheet->getStyle('G4')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);
    $sheet->getStyle('I5')->applyFromArray($style_col);
    $sheet->getStyle('J5')->applyFromArray($style_col);
    $sheet->getStyle('K4')->applyFromArray($style_col);
    $sheet->getStyle('L4')->applyFromArray($style_col);
    $sheet->getStyle('M4')->applyFromArray($style_col);
    $sheet->getStyle('N5')->applyFromArray($style_col);
    $sheet->getStyle('O5')->applyFromArray($style_col);
    $sheet->getStyle('P5')->applyFromArray($style_col);
    $sheet->getStyle('Q5')->applyFromArray($style_col);
    $sheet->getStyle('R5')->applyFromArray($style_col);
    $sheet->getStyle('S5')->applyFromArray($style_col);
    $sheet->getStyle('T5')->applyFromArray($style_col);
    $sheet->getStyle('U5')->applyFromArray($style_col);
    $sheet->getStyle('V5')->applyFromArray($style_col);
    $sheet->getStyle('W5')->applyFromArray($style_col);
    $sheet->getStyle('X5')->applyFromArray($style_col);
    $sheet->getStyle('Y5')->applyFromArray($style_col);
    $sheet->getStyle('Z5')->applyFromArray($style_col);
    $sheet->getStyle('AA5')->applyFromArray($style_col);
    $sheet->getStyle('AB5')->applyFromArray($style_col);
    $sheet->getStyle('AC5')->applyFromArray($style_col);
    $sheet->getStyle('AD5')->applyFromArray($style_col);
    $sheet->getStyle('AE5')->applyFromArray($style_col);
    $sheet->getStyle('AF5')->applyFromArray($style_col);
    $sheet->getStyle('AG5')->applyFromArray($style_col);
    $sheet->getStyle('AH5')->applyFromArray($style_col);
    $sheet->getStyle('AI5')->applyFromArray($style_col);
    $sheet->getStyle('AJ5')->applyFromArray($style_col);
    $sheet->getStyle('AK5')->applyFromArray($style_col);
    $sheet->getStyle('AL5')->applyFromArray($style_col);
    $sheet->getStyle('AM5')->applyFromArray($style_col);
    $sheet->getStyle('AN5')->applyFromArray($style_col);
    $sheet->getStyle('AO5')->applyFromArray($style_col);
    $sheet->getStyle('AP4')->applyFromArray($style_col);
    $sheet->getStyle('AQ4')->applyFromArray($style_col);
    $sheet->getStyle('AR4')->applyFromArray($style_col);
    $sheet->getStyle('AS4')->applyFromArray($style_col);
    $sheet->getStyle('AT4')->applyFromArray($style_col);
    $sheet->getStyle('AU4')->applyFromArray($style_col);
    $sheet->getStyle('AV4')->applyFromArray($style_col);
    $sheet->getStyle('AW4')->applyFromArray($style_col);
    $sheet->getStyle('AX4')->applyFromArray($style_col);
    $sheet->getStyle('AY4')->applyFromArray($style_col);
    $sheet->getStyle('AZ4')->applyFromArray($style_col);
    $sheet->getStyle('BA4')->applyFromArray($style_col);
    // $sheet->getStyle('BB4')->applyFromArray($style_col);

    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    // if ($lmb === 'all') {
    //     $siswa =  $this->model->baru()->result();
    // } else {
    //     $siswa =  $this->model->baruLmb($lmb)->result();
    // }

    $kls = explode('-', $nmKelas);
    $k_formal = $kls[0];
    $jurusan = $kls[1];
    $r_formal = $kls[2];
    $t_formal = $kls[3];

    $siswa = mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE k_formal = '$k_formal' AND r_formal = '$r_formal' AND jurusan = '$jurusan' AND t_formal = '$t_formal' AND aktif = 'Y' ORDER BY nama ASC ");

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
    while ($data = mysqli_fetch_assoc($siswa)) { // Lakukan looping pada variabel siswa

        $id_sakit = $data['nis'];
        $dom = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM lemari_data WHERE nis = $id_sakit"));

        // $nmwl = $dom['wali'];

        // $dtwali = mysqli_fetch_assoc(mysqli_query($koneksi3, "SELECT * FROM tb_santri WHERE nama = '$nmwl"));
        if ($dom) {
            $komplek = $dom['komplek'];
            $kamar = $dom['kamar'];
            $lemari = $dom['lemari'] . ', Loker : ' . $dom['loker'];
            $waliAsuh = $dom['wali'];
        } else {
            $komplek = '';
            $kamar = '';
            $lemari = '' . ', Loker : ' . '';
            $waliAsuh = '';
        }

        $tglA = $data['tanggal_a'] == '' ? '00-00-0000' : $data['tanggal_a'];
        $tglI = $data['tanggal_i'] == '' ? '00-00-0000' : $data['tanggal_i'];

        $split = explode('-', $data['tanggal']);
        $tgl = $split[0];
        $bln =  $split[1];
        $thn = $split[2];

        $splitA = explode('-', $tglA);
        $tgl_a = $splitA[0];
        $bln_a =  $splitA[1];
        $thn_a = $splitA[2];

        $spliti = explode('-', $tglI);
        $tgl_i = $spliti[0];
        $bln_i = $spliti[1];
        $thn_i = $spliti[2];

        $sheet->setCellValue('A' . $numrow, $no);
        $sheet->setCellValue('B' . $numrow, $data['nis']);
        $sheet->setCellValue('C' . $numrow, $data['nisn']);
        $sheet->setCellValue('D' . $numrow, $data['nik']);
        $sheet->setCellValue('E' . $numrow, $data['no_kk']);
        $sheet->setCellValue('F' . $numrow, $data['nama']);
        $sheet->setCellValue('G' . $numrow, $data['tempat']);
        $sheet->setCellValue('H' . $numrow, $tgl);
        $sheet->setCellValue('I' . $numrow, $bln);
        $sheet->setCellValue('J' . $numrow, $thn);
        $sheet->setCellValue('K' . $numrow, $data['jkl']);
        $sheet->setCellValue('L' . $numrow, '');
        $sheet->setCellValue('M' . $numrow, '');
        $sheet->setCellValue('N' . $numrow, $data['jln']);
        $sheet->setCellValue('O' . $numrow, $data['rt']);
        $sheet->setCellValue('P' . $numrow, $data['rw']);
        $sheet->setCellValue('Q' . $numrow, $data['desa']);
        $sheet->setCellValue('R' . $numrow, $data['kec']);
        $sheet->setCellValue('S' . $numrow, $data['kab']);
        $sheet->setCellValue('T' . $numrow, $data['prov']);
        $sheet->setCellValue('U' . $numrow, $data['kd_pos']);
        $sheet->setCellValue('V' . $numrow, $data['bapak']);
        $sheet->setCellValue('W' . $numrow, $data['nik_a']);
        $sheet->setCellValue('X' . $numrow, $data['tempat_a']);
        $sheet->setCellValue('Y' . $numrow, $tgl_a);
        $sheet->setCellValue('Z' . $numrow, $bln_a);
        $sheet->setCellValue('AA' . $numrow, $thn_a);
        $sheet->setCellValue('AB' . $numrow, $data['pkj_a']);
        $sheet->setCellValue('AC' . $numrow, $data['pend_a']);
        $sheet->setCellValue('AD' . $numrow, '');
        $sheet->setCellValue('AE' . $numrow, $data['status_a']);
        $sheet->setCellValue('AF' . $numrow, $data['ibu']);
        $sheet->setCellValue('AG' . $numrow, $data['nik_i']);
        $sheet->setCellValue('AH' . $numrow, $data['tempat_i']);
        $sheet->setCellValue('AI' . $numrow, $tgl_i);
        $sheet->setCellValue('AJ' . $numrow, $bln_i);
        $sheet->setCellValue('AK' . $numrow, $thn_i);
        $sheet->setCellValue('AL' . $numrow, $data['pkj_i']);
        $sheet->setCellValue('AM' . $numrow, $data['pend_i']);
        $sheet->setCellValue('AN' . $numrow, '');
        $sheet->setCellValue('AO' . $numrow, $data['status_i']);
        $sheet->setCellValue('AP' . $numrow, $data['hp']);
        $sheet->setCellValue('AQ' . $numrow, $komplek);
        $sheet->setCellValue('AR' . $numrow, $kamar);
        $sheet->setCellValue('AS' . $numrow, $lemari);
        $sheet->setCellValue('AT' . $numrow, $waliAsuh);
        $sheet->setCellValue('AU' . $numrow, $data['anak_ke']);
        $sheet->setCellValue('AV' . $numrow, $data['jml_sdr']);
        $sheet->setCellValue('AW' . $numrow, $tkos[$data['t_kos']]);

        $sheet->setCellValue('AX' . $numrow, $data['t_formal']);
        $sheet->setCellValue('AY' . $numrow, $data['k_formal']);
        $sheet->setCellValue('AZ' . $numrow, $data['r_formal']);
        $sheet->setCellValue('BA' . $numrow, $data['jurusan']);
        // $sheet->setCellValue('BB' . $numrow, $data['tinggal']);

        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('V' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('W' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('X' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('Y' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('Z' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AA' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AB' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AC' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AD' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AE' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AF' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AG' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AH' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AI' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AJ' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AK' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AL' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AM' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AN' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AO' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AP' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AQ' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AR' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AS' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AT' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AU' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AV' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AW' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AX' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AY' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('AZ' . $numrow)->applyFromArray($style_row);
        $sheet->getStyle('BA' . $numrow)->applyFromArray($style_row);
        // $sheet->getStyle('BB' . $numrow)->applyFromArray($style_row);

        $sheet->setCellValueExplicit('D' . $numrow, $data['nik'], DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('E' . $numrow, $data['no_kk'], DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('W' . $numrow, $data['nik_a'], DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('AG' . $numrow, $data['nik_i'], DataType::TYPE_STRING);

        $numberFormat = new NumberFormat();
        $numberFormat->setFormatCode(NumberFormat::FORMAT_TEXT);

        $sheet->getStyle('D' . $numrow)->getNumberFormat()->setFormatCode($numberFormat->getFormatCode());
        $sheet->getStyle('E' . $numrow)->getNumberFormat()->setFormatCode($numberFormat->getFormatCode());
        $sheet->getStyle('W' . $numrow)->getNumberFormat()->setFormatCode($numberFormat->getFormatCode());
        $sheet->getStyle('AG' . $numrow)->getNumberFormat()->setFormatCode($numberFormat->getFormatCode());


        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
    }

    // Set width kolom
    $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
    $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('AP')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('H')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('I')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('J')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('X')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('Y')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('Z')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('AH')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('AI')->setWidth(20); // Set width kolom E
    $sheet->getColumnDimension('AJ')->setWidth(20); // Set width kolom E

    // $sheet = $spreadsheet->getActiveSheet();
    foreach ($sheet->getColumnIterator() as $column) {
        $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
    }

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $sheet->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $sheet->setTitle($nmKelas);
}
// Proteksi
// $protection = $sheet->getProtection();
// $protection->setPassword('psb2023');
// $protection->setSheet(true);
// $protection->setSort(true);
// $protection->setInsertRows(true);
// $protection->setFormatCells(true);

$fileName = 'Data Santri ' . $level . ' DWK';

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=' . $fileName . '.xlsx'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
