<?php 
$id_pelanggan = $_GET['id'];

$conn->query("DELETE FROM tb_pelanggan WHERE idpelanggan = $id_pelanggan") or die(mysqli_error($conn));
echo "<script>swal('Data berhasil di hapus', {
    icon: 'success',
});window.location='?p=pelanggan';</script>";

?>