<?php 

$id_barang = $_GET['id'];

$conn->query("DELETE FROM tb_barang WHERE idbarang = $id_barang") or die(mysqli_error($conn));
echo "<script>swal('Data berhasil di hapus', {
    icon: 'success',
}).then((willDelete) => {if(willDelete) {window.location='?p=barang';}} );</script>";

?>