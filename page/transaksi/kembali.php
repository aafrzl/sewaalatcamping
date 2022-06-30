<?php 
$id_sewa = $_GET['id'];
$idbarang = $_GET['idbarang'];

$conn->query("UPDATE tb_penyewaan SET status = 'kembali' WHERE id_sewa = $id_transaksi") or die(mysqli_error($conn));

$conn->query("UPDATE tb_barang SET jumlah_barang = (jumlah_barang+1) WHERE nama_barang = '$idbarang'") or die(mysqli_error($conn));

echo "<script>swal('Proses, pengembalian barang berhasil', {
    icon: 'success',
}).then((willDelete) => {if(willDelete) {window.location='?p=transaksi';}} );</script>";

?>