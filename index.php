<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['login'])) {
    //jika variable login bernilai FALSE maka akan dikembalikan ke halaman login
    echo "<script>
    alert('Silahkan login terlebih dahulu !');
    window.location='login.php';
    </script>";
    exit;
}
?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
--> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>K-Means Clustering & Association Apriori</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?pg=produk" class="brand-link">
      
      <span class="brand-text font-weight-light">K-Means & Apriori</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="index.php?pg=produk" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Data Obat</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./transaksi/index.php" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>

              <li class="nav-item">
            <a href="index.php?pg=clustering" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>K-Means Clustering</p>
            </a>
          </li>
          
      </li>
          <li class="nav-item">
            <a href="index.php?pg=apriori" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Association Rules Apriori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

  </aside>

  <?php

  $pg=$_GET['pg'];
  switch ($pg) {
    case 'produk':
        include 'produk/produk.php';
    break;

    case 'add':
      include 'produk/add.php';
  break;

  case 'edit':
    include 'produk/edit.php';
break;

case 'delete':
  include 'produk/delete.php';
break;

case 'transaksi':
  include 'transaksi/index.php';
break;

case 'transaksi_add':
  include 'transaksi/add.php';
break;
    
    case'clustering':
      include 'clustering/index.php';
      break;
      
      case'apriori':
          include 'apriori/index.php';
          break;

    default:
    break;
  }

  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>