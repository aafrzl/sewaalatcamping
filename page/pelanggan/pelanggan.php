<?php 
// menampilkan DB pelanggan
$sqlPelanggan = $conn->query("SELECT * FROM tb_pelanggan ORDER BY nama_pelanggan DESC") or die(mysqli_error($conn));

?>
<h1 class="mt-4">Data Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">data pelanggan</li>
</ol>
<div class="col-md-12">
    <a href="?p=pelanggan&aksi=tambah" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Data Pelanggan</a>
    <a href="./laporan/laporan_pelanggan_excel.php" target="_blank" class="btn btn-success mb-3"><i class="fa fa-file-excel"></i>
 Export ke Excel</a>
 <a href="./laporan/laporan_pelanggan_pdf.php" target="_blank" class="btn btn-danger mb-3"><i class="fa fa-file-pdf"></i>
 Export ke PDF</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Pelanggan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($pecahPelanggan = $sqlPelanggan->fetch_assoc()) {
                    $jk = ($pecahPelanggan['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pecahPelanggan['nama_pelanggan']; ?></td>
                        <td><?= $pecahPelanggan['alamat']; ?></td>
                        <td><?= $pecahPelanggan['tgl_lahir']; ?></td>
                        <td><?= $jk; ?></td>
                        <td>
                            <a href="?p=pelanggan&aksi=ubah&id=<?= $pecahPelanggan['idpelanggan']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="confirmation('?p=pelanggan&aksi=hapus&id=<?= $pecahPelanggan['idpelanggan']; ?>')"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>