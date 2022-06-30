<?php
// menampilkan nama barang di tb_barang di bagian option pilih barang
$tampilBarang = $conn->query("SELECT * FROM tb_barang ORDER BY jumlah_barang DESC") or die(mysqli_error($conn));

?>

<h1 class="mt-4">Pilih barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Pilih Barang</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data barang
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = $tampilBarang->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['namabarang']; ?></td>
                            <td>Rp. <?= number_format($data['harga']); ?></td>
                            <td><?= $data['jumlah_barang'];?>
                            </td>
                            <td>
                                <a href="?p=transaksi&aksi=tambah&idbarang=<?= $data['idbarang'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>