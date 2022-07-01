<?php

$id_sewa = $_GET['idsewa'];
$denda1 = $_GET['denda1'];

$conn->query("UPDATE tb_penyewaan SET status = 'kembali', denda = '$denda1', total = (total + $denda1) WHERE idsewa = $id_sewa") or die(mysqli_error($conn));

$mysql = $conn->query("SELECT * FROM tb_detailsewa WHERE idsewa = $id_sewa") or die(mysqli_error($conn));

while ($data = mysqli_fetch_array($mysql)) {
    $jumlah = $data['jumlah'];
    $idbarang = $data['idbarang'];

    $conn->query("UPDATE tb_barang SET jumlah_barang = (jumlah_barang+$jumlah) WHERE idbarang = '$idbarang'") or die(mysqli_error($conn));
}
echo "<script>swal('Proses, pengembalian barang berhasil', {
    icon: 'success',
}).then((willDelete) => {if(willDelete) {window.location='?p=transaksi';}} );</script>";
