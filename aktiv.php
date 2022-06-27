<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App Info santri</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Input token</h1>
                  </div>
                  <form class="user" action="" method="post">
                    <div class="form-group row">
                      <div class="col-sm-10 mb-3 mb-sm-0">
                        <input type="password" name="token" class="form-control form-control-user" id="exampleFirstName" placeholder="Masukaan token">
                      </div>
                      <div class="col-sm-2">
                        <button type="submit" name="cek" class="btn btn-primary btn-user btn-block">
                          Tampilkan
                        </button>
                      </div>
                    </div>
                  </form>
                  <?php
                  include 'config/koneksi.php';
                  if (isset($_POST['cek'])) {
                    $token = $_POST['token'];
                    if ($token == 'tokensudahbenar') {

                      $dt = mysqli_query($conn, "SELECT * FROM user");
                  ?>
                      <table class="table table-sm table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>User</th>
                            <th>Pass</th>
                            <th>Level</th>
                            <th>Aktif</th>
                            <th>Act</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          while ($r = mysqli_fetch_assoc($dt)) { ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $r['nama']; ?></td>
                              <td><?= $r['username']; ?></td>
                              <td><?= $r['password']; ?></td>
                              <td><?= $r['level']; ?></td>
                              <td><?= $r['aktif']; ?></td>
                              <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?= $r['id_user']; ?>">
                                  Aksi
                                </button>
                              </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $r['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit aksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form action="" method="post">
                                    <div class="modal-body">
                                      <input type="hidden" name="id" value="<?= $r['id_user']; ?>">
                                      <input type="hidden" name="nama" value="<?= $r['nama']; ?>">
                                      <input type="hidden" name="hp" value="<?= $r['hp']; ?>">
                                      <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?= $r['username']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="password" class="form-control" value="<?= $r['password']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Level</label>
                                        <input type="text" name="level" class="form-control" value="<?= $r['level']; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Aktif</label>
                                        <input type="text" name="aktif" class="form-control" value="<?= $r['aktif']; ?>">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </tbody>
                      </table>
                  <?php } else {
                      echo "Token salah";
                    }
                  } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
if (isset($_POST['save'])) {

  $id_user = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['id']));
  $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
  $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
  $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
  $level = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['level']));
  $aktif = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['aktif']));
  $hp = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['hp']));

  $pesan = '
  *Terimakasih*
  Akun anda 

  Nama : ' . $nama . '
  Username : ' . $username . '
  Password : ' . $password . '

  telah diaktifkan oleh admin pada *' . date('d-m-Y H:i') . '*
  silahkan bisa di gunakan di https://infosantri.ppdwk.com .

  by : @admin DWK 2022
  ';

  $sql1 = mysqli_query($conn, "UPDATE user SET username = '$username', password = '$password', level = '$level', aktif = '$aktif' WHERE id_user = '$id_user' ");

  if ($sql1) {
    echo "
                <script>
                alert('Akun sudah diaktifkan');
                window.location = 'aktiv.php';
                </script>
                ";

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
            CURLOPT_POSTFIELDS => 'apiKey=fb209be1f23625e43cbf285e57c0c0f2&phone=' . $hp . '&message=' . $pesan,
        )
    );
    $response = curl_exec($curl);
    curl_close($curl);
  }
}

?>