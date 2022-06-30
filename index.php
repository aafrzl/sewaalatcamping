<?php
session_start();
require_once 'config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$page = @$_GET['p'];
$aksi = @$_GET['aksi'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?php
        if ($page == 'barang') {
            if ($aksi == 'tambah') {
                echo "Tambah Barang";
            } else if ($aksi == 'ubah') {
                echo "Ubah Barang";
            } else {
                echo "Halaman Barang";
            }
        } else if ($page == 'pelanggan') {
            if ($aksi == 'tambah') {
                echo "Tambah Pelanggan";
            } else if ($aksi == 'ubah') {
                echo "Ubah Pelanggan";
            } else {
                echo "Halaman Pelanggan";
            }
        } else if ($page == 'transaksi') {
            if ($aksi == 'tambah') {
                echo "Tambah Transaksi";
            } else {
                echo "Halaman Transaksi";
            }
        } else {
            echo "Dashboard";
        }
        ?>
    </title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/profile.css" rel="stylesheet" />
    <script src="js/fontawesomeall.min.js" crossorigin="anonymous"></script>
    <script src="js/sweetalert.min.js"></script>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">MOUNTAINESIA RENT</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0 pb-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="rounded-circle profil" src="<?php echo "assets/img/" . $_SESSION['login']['foto'] ?>"></img></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <p class="dropdown-item"><strong><?= $_SESSION['login']['nama']; ?></strong></p>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Keluar</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Data Penyewaan</div>
                        <a class="nav-link" href="?p=pelanggan">
                            <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                            Data Pelanggan
                        </a>
                        <a class="nav-link" href="?p=barang">
                            <div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                            Data Barang
                        </a>
                        <a class="nav-link" href="?p=transaksi">
                            <div class="sb-nav-link-icon"><i class="fa fa-handshake" aria-hidden="true"></i></div>
                            Transaksi Penyewaan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <b><?= $_SESSION['login']['nama']; ?></b>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <!-- <h1 class="mt-4">Static Navigation</h1> -->
                    <?php

                    if ($page == 'barang') {
                        if ($aksi == '') {
                            require_once 'page/barang/barang.php';
                        } else if ($aksi == 'tambah') {
                            require_once 'page/barang/tambah.php';
                        } else if ($aksi == 'ubah') {
                            require_once 'page/barang/ubah.php';
                        } else if ($aksi == 'hapus') {
                            require_once 'page/barang/hapus.php';
                        }
                    } else if ($page == 'pelanggan') {
                        if ($aksi == '') {
                            require_once 'page/pelanggan/pelanggan.php';
                        } else if ($aksi == 'tambah') {
                            require_once 'page/pelanggan/tambah.php';
                        } else if ($aksi == 'ubah') {
                            require_once 'page/pelanggan/ubah.php';
                        } else if ($aksi == 'hapus') {
                            require_once 'page/pelanggan/hapus.php';
                        }
                    } else if ($page == 'transaksi') {
                        if ($aksi == '') {
                            require_once 'page/transaksi/transaksi.php';
                        } else if ($aksi == 'tambah') {
                            require_once 'page/transaksi/tambah.php';
                        } else if ($aksi == 'kembali') {
                            require_once 'page/transaksi/kembali.php';
                        } else if ($aksi == 'perpanjang') {
                            require_once 'page/transaksi/perpanjang.php';
                        } else if ($aksi == 'pilih') {
                            require_once('page/transaksi/pilihbarang.php');
                        }
                    } else { ?>
                        <ol class="breadcrumb mb-4 mt-4">
                            <!-- <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active">
                                <h4>Selamat Datang <strong><?= $_SESSION['login']['nama']; ?></strong></h4>
                            </li>
                        </ol>
                        <div class="container-flud">
                            <div class="col-md-6">
                                <h6>Belum bisa transaksi</h6>
                                <a href="https://github.com/aafrzl/sewaalatcamping" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-arrow-down mr-1"></i>Download source codenya disini.</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Mountainesia Rent 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/deleteDialog.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>