<?php 
require_once '../config/koneksi.php';

$filename = "pelanggan_excel-(". date('d-m-Y') .").xls";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

$ambilPelanggan = $conn->query("SELECT * FROM tb_pelanggan ORDER BY idpelanggan DESC") or die(mysqli_error($conn));

?>
<h2>Laporan Anggota</h2>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while ($pecahPelanggan = $ambilPelanggan->fetch_assoc()) {
        $jk = ($pecahPelanggan['jk'] == 'L') ? 'Laki-Laki' : 'Perempuan';
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $pecahPelanggan['nama_pelanggan']; ?></td>
            <td><?= $pecahPelanggan['alamat']; ?></td>
            <td><?= $pecahPelanggan['tgl_lahir']; ?></td>
            <td><?= $jk; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>