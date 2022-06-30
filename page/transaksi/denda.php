<?php 
$id_sewa = $_GET['id'];
$idbarang = $_GET['idbarang'];

$conn->query("UPDATE tb_penyewaan SET denda = $denda WHERE nama_barang = '$idbarang'") or die(mysqli_error($conn));

?>