<?php
// menampilkan nama barang di tb_barang di bagian option pilih barang
$tampilBarang = $conn->query("SELECT * FROM tb_barang ORDER BY jumlah_barang DESC") or die(mysqli_error($conn));

?>

<h1 class="mt-4">Pilih barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="?p=transaksi">Data Transaksi</a></li>
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
                        <th>Jumlah</th>
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
                            <td><?= $data['jumlah_barang']; ?></td>
                            <td width="106">
                                <form name="form" method="POST" action="?p=transaksi&aksi=tambah">
                                    <input type="hidden" name="idbarang" value="<?= $data['idbarang']; ?>"></input>
                                    <input class="form-control form-control-sm" type="number" id="jumlah" name="jumlah" value="1" min="1" max="<?= $data['jumlah_barang']; ?>">
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" type="submit" name="submit">
                                    <i class="fa fa-plus"></i>
                            </td>
                        </tr>
                        </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>