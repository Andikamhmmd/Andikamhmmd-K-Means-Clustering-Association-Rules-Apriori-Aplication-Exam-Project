<?php

include 'conn.php';

session_start();

if (isset($_POST['login'])) {// menangkap post yang berisi login
    $username=$_POST['username'];
    $password=$_POST['password'];
    
   
    if ($username&&$password) {
        
        $password=md5($password);
        $sql_get = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
        $num_row = mysqli_num_rows($sql_get);
        $data = mysqli_fetch_assoc($sql_get);

          if ($num_row == 1) {
            $password=md5($password);

            $_SESSION['username']=$data['username'];
            $_SESSION['login']=TRUE;
            //membuat variable nama bertipe session

            echo"
            <script>
            alert('Login Berhasil');
            window.location='index.php?pg=produk';
            </script>
            ";

          } else{
            echo"
            <script>
            alert('Maaf, Login Gagal, Silahkan coba lagi');
            </script>
            "; 
        }

    } else{
        echo"
        <script>
        alert('Maaf, Form tidak boleh kosong');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="assets/index2.html" class="h1"><b>Aplikasi Berbasis Web</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"></p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <a href="register.php" class="text-center">Tidak punya akun?</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-0">
        
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
