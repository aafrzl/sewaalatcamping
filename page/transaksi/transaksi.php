<?php
require_once 'function.php';

// menampilkan DB buku
// $ambilTransaksi = $conn->query("SELECT * FROM tb_penyewaan WHERE status = 'pinjam'") or die(mysqli_error($conn));

$sql = $conn->query("SELECT * FROM tb_penyewaan INNER JOIN tb_pelanggan 
										ON tb_penyewaan.idpelanggan = tb_pelanggan.idpelanggan 
                                        INNER JOIN tb_user ON tb_penyewaan.iduser = tb_user.iduser
                                        WHERE status = 'disewakan'
										") or die(mysqli_error($conn));

?>

<h1 class="mt-4">Data Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">data transaksi</li>
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
                            <td><?= $pecah['tgl_pinjam']; ?></td>
                            <td><?= $pecah['tgl_kembali']; ?></td>
                            <td>
                                <?php

                                $denda = 5000;
                                $tgl_dateline = $pecah['tgl_kembali'];
                                $tgl_kembali = date('Y-m-d');

                                $lambat = terlambat($tgl_dateline, $tgl_kembali);
                                $denda1 = $lambat * $denda;
                                ?>
                                <?php
                                if ($lambat > 0) { 
                                    setDenda($denda1, $idsewa); ?>
                                    <div style='color:red;'><?= $lambat ?> hari<br> (Rp. <?= number_format($denda1) ?>)</div>
                                    <?php
                                } else {
                                    echo "Tidak terlambat";
                                }
                                ?>
                            </td>
                            <td><?= $pecah['total']; ?></td>
                            <td><?= $pecah['status']; ?></td>
                            <td>
                                <a href="?p=transaksi&aksi=kembali&id=<?= $pecah['id_transaksi']; ?>&judul=<?= $pecah['judul_buku']; ?>" class="btn btn-info btn-sm">Kembalikan Barang</a>
                                <a href="?p=transaksi&aksi=perpanjang&id=<?= $pecah['id_transaksi']; ?>&judul=<?= $pecah['judul_buku']; ?>&lambat=<?= $lambat ?>&tgl_kembali=<?= $pecah['tgl_kembali']; ?>" class="btn btn-success btn-sm">Perpanjang 1 hari</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>