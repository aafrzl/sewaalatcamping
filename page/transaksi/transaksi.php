<?php
require_once './config/functions.php';


$sql = $conn->query("SELECT * FROM tb_penyewaan INNER JOIN tb_pelanggan 
										ON tb_penyewaan.idpelanggan = tb_pelanggan.idpelanggan 
                                        INNER JOIN tb_user ON tb_penyewaan.iduser = tb_user.iduser
                                        WHERE status = 'sewa'
										") or die(mysqli_error($conn));

if (isset($_SESSION['pesan'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $_SESSION['pesan'] . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>';

    unset($_SESSION['pesan']);
}

?>

<h1 class="mt-4">Data Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Transaksi</li>
</ol>
<div class="col-md-6">
    <a href="?p=transaksi&aksi=pilih" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Transaksi</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Transaksi
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
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
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
                                <a href="?p=transaksi&aksi=kembali&idsewa=<?= $pecah['idsewa']; ?>&denda1=<?= $denda1?>" class="btn btn-info btn-sm"><i class="fas fa-undo mr-2"></i>Kembali Barang</a>

                                <a href="?p=transaksi&aksi=detail&idsewa=<?= $pecah["idsewa"]; ?>" class="btn btn-success btn-sm"><i class="fas fa-info mr-2"></i>Detail Penyewaan</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>