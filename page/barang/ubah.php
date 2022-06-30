<?php
// menangkap idbarang di url
$id_barang = $_GET['id'];

// menampilkan data db sesuai idbarang
$sql = $conn->query("SELECT * FROM tb_barang WHERE idbarang = $id_barang") or die(mysqli_error($conn));
$pecahSql = $sql->fetch_assoc();

if (isset($_POST['ubah'])) {
	$namabarang = htmlspecialchars($_POST['nama_barang']);
	$harga = htmlspecialchars($_POST['harga_barang']);
	$jumlah = htmlspecialchars($_POST['jumlah_barang']);

    if (empty($namabarang && $harga && $jumlah)) {
        echo "<script>swal('Pastikan anda sudah mengisi semua formulir.', {
            icon: 'error',
        }).then((willUpdate) => {if(willUpdate) {window.location='?p=barang';}} );</script>";
    }

    $sql = $conn->query("UPDATE tb_barang SET namabarang = '$namabarang', harga = '$harga', jumlah_barang = '$jumlah' WHERE idbarang = $id_barang") or die(mysqli_error($conn));
    if ($sql) {
        echo "<script>swal('Data berhasil di ubah', {
            icon: 'success',
        }).then((willUpdate) => {if(willUpdate) {window.location='?p=barang';}} );</script>";
    } else {
        echo "<script>swal('Data gagal di ubah', {
            icon: 'error',
        }).then((willUpdate) => {if(willUpdate) {window.location='?p=barang';}} );</script>";
    }
}

?>

<h1 class="mt-4">Ubah Data Barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">ubah data barang</li>
</ol>
<div class="card-header mb-5">

    <form action="" method="post">
        <div class="form-group">
            <label class="small mb-1" for="nama_barang">Nama barang</label>
            <input class="form-control" id="nama_barang" name="nama_barang" type="text" placeholder="Masukan nama barang" value="<?= $pecahSql['namabarang']; ?>" />
        </div>
        <div class="form-group">
            <label class="small mb-1" for="harga_barang">Harga barang</label>
            <input class="form-control" id="harga_barang" name="harga_barang" type="text" value="<?= $pecahSql['harga']; ?>" placeholder="Masukan harga barang" />
        </div>
        <div class="form-group">
            <label class="small mb-1" for="jumlah_barang">Jumlah barang</label>
            <input class="form-control" value="<?= $pecahSql['jumlah_barang']; ?>" id="jumlah_barang" name="jumlah_barang" type="number" placeholder="Masukan jumlah barang" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="ubah">Ubah Data</button>
        </div>
    </form>
</div>