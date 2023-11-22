<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App Info Santri</title>

  <!-- Custom fonts for this template-->
  <link href="vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Buat akun baru!</h1>
                  </div>
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input type="text" name="nama" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukan nama lengkap">
                    </div>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukan username">
                    </div>
                    <div class="form-group">
                      <input type="number" name="hp" class="form-control form-control-user" id="exampleInputEmail" placeholder="No. WA aktif">
                    </div>
                    <button type="submit" name="daftar" class="btn btn-primary btn-user btn-block">
                      Daftarkan Akun
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="login.php">Sudah punya akun? Login saja!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendors/jquery/jquery.min.js"></script>
  <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendors/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php

include 'config/koneksi.php';

if (isset($_POST['daftar'])) {
  $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtoupper($_POST['nama'])));
  $user = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
  $hp = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['hp']));
  $password = rand(0, 99999);

  $pesan = '
  *Pemberitahuan*
  
  Ada admin daftar baru atas :
  
  *Nama : ' . $nama . '*
  
  _Segera cek_';

  $sql = mysqli_query($conn, "SELECT * FROM user WHERE username  = '$username' ");
  $cek = mysqli_num_rows($sql);
  if ($cek >= 1) {
    echo "
        <script>
            alert('Maaf. Username sudah terpakai');
            window.location = 'register.php';
        </script>
        ";
  } else {
    $sql = mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama', '$user', '$password', '', 'T', '$hp') ");
    if ($sql) {
      echo "
        <script>
            alert('Anda berhasil mendaftar. Selanjutnya silahkan hubungi admin untuk mengaktifkan akun anda');
            window.location = 'login.php';
        </script>
        ";
    }
  }
  $curl = curl_init();
  curl_setopt_array(
    $curl,
    array(
      CURLOPT_URL => 'http://8.215.26.187:3000/api/sendMessage',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'apiKey=fb209be1f23625e43cbf285e57c0c0f2&phone=085236924510&message=' . $pesan,
    )
  );
  $response = curl_exec($curl);
  curl_close($curl);
}
?>