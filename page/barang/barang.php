<?php
// menampilkan DB Barang
$ambilBarang = $conn->query("SELECT * FROM tb_barang ORDER BY jumlah_barang DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">data barang</li>
</ol>
<div class="col-md-6">
    <a href="?p=barang&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Barang</a>
</div>
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
                    while ($pecahBarang = $ambilBarang->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pecahBarang['namabarang']; ?></td>
                            <td>Rp. <?= number_format($pecahBarang['harga']); ?></td>
                            <td><?= $pecahBarang['jumlah_barang'];?>
                            </td>
                            <td>
                                <a href="?p=barang&aksi=ubah&id=<?= $pecahBarang['idbarang']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="javascript:;" class="btn btn-danger btn-sm" onclick="confirmation('?p=barang&aksi=hapus&id=<?= $pecahBarang['idbarang']; ?>')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>