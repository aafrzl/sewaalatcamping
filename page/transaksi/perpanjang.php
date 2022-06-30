<?php 
$idsewa = $_GET['id'];
$idbarang = $_GET['nama_barang'];
$tgl_kembali = $_GET['tanggal_kembali'];
$lambat = $_GET['lambat'];

// jika barang yang di pinjam tidak di kembalikan, lewat dari 1 hari (terlambat) tidak bisa meminjam barang lagi, sehingga kembalikan barangnya dulu.
if($lambat > 3) {
	echo "<script>swal('Pinjam barang tidak dapat di perpanjang, karena lebih dari 1 hari... kembalikan barangnya terlebih dahulu, lalu pinjam lagi.', {
        icon: 'info',
    }).then((willUpdate) => {if(willUpdate) {window.location='?p=transaksi';}} );</script>";
} else {
	$next1Hari = strtotime("+1 day", strtotime($tgl_kembali));
	$hari_next = date('Y-m-d', $next1Hari);

	$sql = $conn->query("UPDATE tb_penyewaan SET tanggal_kembali = '$hari_next' WHERE idsewa = $idsewa") or die(mysqli_error($conn));

	if($sql) {
        echo "<script>swal('Perpanjang jangka waktu barang berhasil.', {
            icon: 'success',
        }).then((willDelete) => {if(willDelete) {window.location='?p=transaksi';}} );</script>";
	} else {
		echo "<script>swal('Gagal memperpanjang masa pinjaman', {
            icon: 'error',
        }).then((willDelete) => {if(willDelete) {window.location='?p=transaksi';}} );</script>";
	}
}

?>