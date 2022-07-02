<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/functions.php';

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
            } else if ($aksi == 'pilih') {
                echo "Pilih barang";
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
        <a class="navbar-brand" href="index.php"><i class="fas fa-mountain mr-2"></i>MOUNTAINESIA RENT</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 ml-5" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0 pb-2">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white-600 small"><?= $_SESSION['login']['nama']; ?></span>
                    <img class="img-profile rounded-circle profil" src="<?php echo "assets/img/" . $_SESSION['login']['foto'] ?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-users" aria-hidden="true"></i></div>
                            Data Pelanggan
                        </a>
                        <a class="nav-link" href="?p=barang">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes" aria-hidden="true"></i></div>
                            Data Barang
                        </a>
                        <a class="nav-link" href="?p=transaksi">
                            <div class="sb-nav-link-icon"><i class="fas fa-hands-helping" aria-hidden="true"></i></div>
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
                        } else if ($aksi == 'detail') {
                            require_once 'page/transaksi/detailtransaksi.php';
                        } else if ($aksi == 'pilih') {
                            require_once('page/transaksi/pilihbarang.php');
                        } else if ($aksi == 'simpan') {
                            require_once('page/transaksi/simpan.php');
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
                                <a href="https://github.com/aafrzl/sewaalatcamping" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-arrow-down mr-1"></i>Download source codenya disini.</a>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4 mt-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-gray-600 text-uppercase mb-1">
                                                        Jumlah Pelanggan Penyewaan</div>
                                                    <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $jumlahPelanggan = $conn->query("SELECT count(idpelanggan) FROM tb_pelanggan") or die(mysqli_error($conn));
                                                        $dataPelanggan = mysqli_fetch_row($jumlahPelanggan);
                                                        echo "$dataPelanggan[0]";
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4 mt-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-gray-600 text-uppercase mb-1">
                                                        Jumlah Barang Tersedia</div>
                                                    <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $jumlahBarang = $conn->query("SELECT count(idbarang) FROM tb_barang WHERE jumlah_barang > 0") or die(mysqli_error($conn));
                                                        $dataBarang = mysqli_fetch_row($jumlahBarang);
                                                        echo "$dataBarang[0]";
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-4 mt-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-gray-600 text-uppercase mb-1">
                                                        Total Seluruh Pendapatan</div>
                                                    <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $total = $conn->query("SELECT SUM(total) FROM tb_penyewaan") or die(mysqli_error($conn));
                                                        $dataTotal = mysqli_fetch_row($total);
                                                        $totalPendapatanformat = number_format($dataTotal[0]);
                                                        echo "Rp. $totalPendapatanformat";
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4 p-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                    Data Transaksi Selesai
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Petugas</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Keterlambatan</th>
                                                    <th>Status</th>
                                                    <th>Total Bayar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;

                                                $sql = $conn->query("SELECT * FROM tb_penyewaan INNER JOIN tb_pelanggan 
                                                ON tb_penyewaan.idpelanggan = tb_pelanggan.idpelanggan 
                                                INNER JOIN tb_user ON tb_penyewaan.iduser = tb_user.iduser
                                                WHERE status = 'kembali'
                                                ") or die(mysqli_error($conn));

                                                while ($pecah = $sql->fetch_assoc()) {
                                                    $idsewa = $pecah['idsewa'];
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $pecah['nama']; ?></td>
                                                        <td><?= $pecah['nama_pelanggan']; ?></td>
                                                        <td><?= $pecah['tanggalsewa']; ?></td>
                                                        <td><?= $pecah['tanggalkembali']; ?></td>
                                                        <td>
                                                            <?php

                                                            $denda = 5000;
                                                            $tgl_dateline = $pecah['tanggalkembali'];
                                                            $tgl_kembali = date('Y-m-d');

                                                            //hitung selisih hari
                                                            $lambat = terlambat($tgl_dateline, $tgl_kembali);
                                                            $denda1 = $lambat * $denda;
                                                            ?>
                                                            <?php
                                                            if ($lambat > 0) {
                                                            ?>
                                                                <div style='color:red;'><?= $lambat ?> hari<br> (Rp. <?= number_format($denda1) ?>)</div>
                                                            <?php
                                                            } else {
                                                                echo "Tidak terlambat";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $pecah['status']; ?></td>
                                                        <td><?= $pecah['total'] + $denda1; ?></td>
                                                        <td>
                                                            <a href="?p=transaksi&aksi=detail&idsewa=<?= $pecah["idsewa"]; ?>" class="btn btn-success btn-sm"><i class="fas fa-info mr-2"></i>Detail Penyewaan</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/deleteDialog.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script src="js/datepicker.js"></script>
</body>

</html>