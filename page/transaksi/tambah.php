<?php
$tampilkanNamaPelanggan = $conn->query("SELECT * FROM tb_pelanggan ORDER BY nama_pelanggan") or die(mysqli_error($conn));

if (isset($_POST['idbarang'], $_POST['jumlah'])) {

    $idbarang = $_POST['idbarang'];
    $jumlah = $_POST['jumlah'];
    $denda = 0;

    $produk = mysqli_query($conn, "SELECT * FROM tb_barang WHERE idbarang = '$idbarang'");
    $dt_produk = $produk->fetch_assoc();

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    $index = -1;
    $cart = unserialize(serialize($_SESSION['cart']));

    // jika produk sudah ada dalam cart maka pembelian akan diupdate
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['idbarang'] == $idbarang) {
            $index = $i;
            $_SESSION['cart'][$i]['jumlah'] = $jumlah;
            break;
        }
    }

    // jika produk belum ada dalam cart
    if ($index == -1) {
        $_SESSION['cart'][] = [
            'idbarang' => $idbarang,
            'namabarang' => $dt_produk['namabarang'],
            'harga' => $dt_produk['harga'],
            'jumlah' => $jumlah
        ];
    }
}

if (!empty($_SESSION['cart'])) {
?>

    <h1 class="mt-4">Tambah Barang</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="?p=transaksi">Transaksi</a></li>
        <li class="breadcrumb-item"><a href="?p=transaksi&aksi=pilih">Pilih Barang</a></li>
        <li class="breadcrumb-item active">Tambah Barang</li>
    </ol>
    <div class="row row-col-2">
        <div class="col-2">
            <a href="?p=transaksi&aksi=pilih" class="btn btn-warning mb-3" name="update"><i class="fa fa-plus"></i> Pilih Barang Lagi</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa fa-table mr-1"></i>
            Barang Terpilih
        </div>
        <div class="card-body">
            <form method="POST" action="?p=transaksi&aksi=simpan">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>

                        <?php
                        if (isset($_SESSION['cart'])) {
                            $cart = unserialize(serialize($_SESSION['cart']));
                            $index = 0;
                            $no = 1;
                            $total = 0;
                            $total_bayar = 0;

                            for ($i = 0; $i < count($cart); $i++) {
                                $total = $_SESSION['cart'][$i]['harga'] * $_SESSION['cart'][$i]['jumlah'];
                                $total_bayar += $total;
                        ?>

                                <tr>
                                    <td align="center"><?= $no++; ?></td>
                                    <td><?= $cart[$i]['namabarang']; ?></td>
                                    <td align="center"><?= $cart[$i]['jumlah']; ?></td>
                                    <td><?= $cart[$i]['harga']; ?></td>
                                    <td>Rp. <?= number_format($total); ?></td>
                                    <td align="center">
                                        <a href="?p=transaksi&aksi=tambah&index=<?= $index; ?>">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>

                        <?php
                                $index++;
                            }
                            // hapus produk dalam cart
                            if (isset($_GET['index'])) {
                                $cart = unserialize(serialize($_SESSION['cart']));
                                unset($cart[$_GET['index']]);
                                $cart = array_values($cart);
                                $_SESSION['cart'] = $cart;
                            }
                        }
                        ?>

                        <tr>
                            <td colspan="4" align="right"><strong>Total Bayar</strong></td>
                            <td colspan="2" align="left"><strong>Rp. <?= number_format($total_bayar); ?></strong></td>
                        </tr>
                        <div class="form-group">
                            <label class="small mb-1" for="nama_pelanggan">Nama Pelanggan</label>
                            <select name="nama" id="nama_pelanggan" class="form-control" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php
                                while ($dataPelanggan = $tampilkanNamaPelanggan->fetch_assoc()) {
                                    echo "<option value='$dataPelanggan[idpelanggan].$dataPelanggan[nama_pelanggan]'>$dataPelanggan[nama_pelanggan]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_sewa">Tanggal Sewa</label>
                            <input type="date" name="tgl_sewa" id="tgl_sewa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                        </div>
                    </table>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-sm">Simpan Data Penyewaan</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
// if (isset($_GET['index'])) {
//     header('Location: ?p=transaksi&aksi=tambah');
// }
?>