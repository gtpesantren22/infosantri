<?php

$page = (@$_GET['page']);
$aksi = (@$_GET['aksi']);

if ($page == "admin") {
  if ($aksi == "") {
    include "page/admin/admin.php";
  } elseif ($aksi == "tambah") {
    include "page/admin/tambah.php";
  } elseif ($aksi == "ubah") {
    include "page/admin/ubah.php";
  } elseif ($aksi == "hapus") {
    include "page/admin/hapus.php";
  }
} elseif ($page == "siswa") {
  if ($aksi == "") {
    include "page/siswa/siswa.php";
  } elseif ($aksi == "tambah") {
    include "page/siswa/tambah.php";
  } elseif ($aksi == "ubah") {
    include "page/siswa/ubah.php";
  } elseif ($aksi == "hapus") {
    include "page/siswa/hapus.php";
  }
} elseif ($page == "merek") {
  if ($aksi == "") {
    include "page/merek/merek.php";
  } elseif ($aksi == "tambah") {
    include "page/merek/tambah.php";
  } elseif ($aksi == "ubah") {
    include "page/merek/ubah.php";
  } elseif ($aksi == "hapus") {
    include "page/merek/hapus.php";
  }
} elseif ($page == "rak") {
  if ($aksi == "") {
    include "page/rak/rak.php";
  } elseif ($aksi == "tambah") {
    include "page/rak/tambah.php";
  } elseif ($aksi == "ubah") {
    include "page/rak/ubah.php";
  } elseif ($aksi == "hapus") {
    include "page/rak/hapus.php";
  }
} elseif ($page == "data") {
  if ($aksi == "") {
    include "page/data/data.php";
  } elseif ($aksi == "tambah") {
    include "page/data/tambah.php";
  } elseif ($aksi == "ubah") {
    include "page/data/ubah.php";
  } elseif ($aksi == "hapus") {
    include "page/data/hapus.php";
  }
} elseif ($page == "") {
  include "home.php";
}
