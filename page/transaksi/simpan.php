<?php 
if(!isset($_SESSION['cart'])){
    header('Location: ?p=transaksi&aksi=pilih');
}

$cart = unserialize(serialize($_SESSION['cart']));
$total_item = 0;
$total_bayar = 0;
$denda = 0;
$iduser = $_SESSION['login']['iduser'];
$nama_pelanggan = $_POST['nama'];
$pecahN = explode('.', $nama_pelanggan);
$idpelanggan = $pecahN[0];
$namapelanggan = $pecahN[1];
$tgl_sewa = date('Y-m-d',strtotime($_POST['tgl_sewa']));
$tgl_kembali = date('Y-m-d',strtotime($_POST['tgl_kembali']));

for ($i=0; $i<count($cart); $i++){
    $total_item += $cart[$i]['jumlah'];
    $total_bayar += $cart[$i]['jumlah'] * $cart[$i]['harga'];
}

//save data penyewaan ke database
$conn->query("INSERT INTO tb_penyewaan (iduser, idpelanggan, tanggalsewa, tanggalkembali, denda, total, `status`) VALUES ('$iduser', '$idpelanggan','$tgl_sewa','$tgl_kembali',0,'$total_bayar','sewa')") or die(mysqli_error($conn));
$idsewa = mysqli_insert_id($conn);


for($i=0; $i<count($cart); $i++){
    $idbarang = $cart[$i]['idbarang'];
    $jumlah = $cart[$i]['jumlah'];
    $subharga = $cart[$i]['harga'] * $cart[$i]['jumlah'];

    $conn->query("INSERT INTO tb_detailsewa (idsewa, idbarang, jumlah, subharga) VALUES('$idsewa', '$idbarang', '$jumlah', '$subharga')")or die(mysqli_error($conn));
    $conn->query("UPDATE tb_barang SET jumlah_barang = (jumlah_barang-$jumlah) WHERE idbarang = '$idbarang'")or die(mysqli_error($conn));

}

//unset session keranjang
unset($_SESSION['cart']);
$_SESSION['pesan'] = "Data Transaksi sudah ditambahkan";
header('Location: ?p=transaksi');
?>