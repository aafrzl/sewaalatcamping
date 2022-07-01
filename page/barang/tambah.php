<?php 
if(isset($_POST['tambah'])) {
	$namabarang = htmlspecialchars($_POST['nama_barang']);
	$harga = htmlspecialchars($_POST['harga_barang']);
	$jumlah = htmlspecialchars($_POST['jumlah_barang']);

    if(empty($namabarang && $harga && $jumlah)) {
        echo "<script>swal('Data berhasil di tambahkan', {
            icon: 'error',
        }).then((willAdd) => {if(willAdd) {window.location='?p=barang';}} );</script>";
    }

	$sql = $conn->query("INSERT INTO tb_barang VALUES (null, '$namabarang', '$harga', '$jumlah')") or die(mysqli_error($conn));
	if($sql) {
        echo "<script>swal('Data berhasil di tambahkan', {
            icon: 'success',
        }).then((willAdd) => {if(willAdd) {window.location='?p=barang';}} );</script>";
	} else {
        echo "<script>swal('Data gagal di tambahkan', {
            icon: 'error',
        });</script>";
	}
}

?>

<h1 class="mt-4">Tambah Data Barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah nama barang</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="nama_barang">Nama Barang</label>
        <input class="form-control" id="nama_barang" name="nama_barang" type="text" placeholder="Masukan Nama Barang" required/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="harga_barang">Harga Barang</label>
        <input class="form-control" id="harga_barang" name="harga_barang" type="text" placeholder="Masukan Harga Barang" required/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="jumlah_barang">Jumlah Barang</label>
        <input class="form-control" id="jumlah_barang" name="jumlah_barang" type="number" min="1" placeholder="Masukan Jumlah Barang" required/>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>