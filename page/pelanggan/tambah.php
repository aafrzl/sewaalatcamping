<?php 
if(isset($_POST['tambah'])) {
	$nama = htmlspecialchars($_POST['nama_pelanggan']);
	$alamat = htmlspecialchars($_POST['alamat']);
	$tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
	$jk = htmlspecialchars($_POST['jk']);

    if(empty($nama && $alamat && $tgl_lahir && $jk)) {
        echo "<script>swal('Pastikan anda sudah mengisi semua formulir', {
            icon: 'error',
        }).then((willUpdate) => {if(willUpdate) {window.location='?p=pelanggan';}} );</script>";
    }

	$sql = $conn->query("INSERT INTO tb_pelanggan VALUES (null, '$nama', '$alamat', '$tgl_lahir', '$jk')") or die(mysqli_error($conn));
	if($sql) {
        echo "<script>swal('Data berhasil ditambahkan', {
            icon: 'success',
        }).then((willUpdate) => {if(willUpdate) {window.location='?p=pelanggan';}} );</script>";
	} else {
        echo "<script>swal('Data gagal ditambahkan', {
            icon: 'error',
        });</script>";
	}
}

?>

<h1 class="mt-4">Tambah Data Pelanggan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">tambah data pelanggan</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
    <div class="form-group">
        <label class="small mb-1" for="nama_pelanggan">Nama Pelanggan</label>
        <input class="form-control" id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="Masukkan nama pelanggan" required/>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat pelanggan" required/></textarea>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="jk">Jenis Kelamin</label>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="jk" value="L" class="custom-control-input" required>
          <label class="custom-control-label" for="customRadio1">Laki-Laki</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="jk" class="custom-control-input" value="P" required>
          <label class="custom-control-label" for="customRadio2">Perempuan</label>
        </div>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>