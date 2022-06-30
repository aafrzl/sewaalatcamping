<?php
require_once('item.php');
// require './config/koneksi.php';

if (isset($_GET["idbarang"]) && !isset($_POST['update'])) {
    $sql = "SELECT * FROM tb_barang WHERE idbarang=" . $_GET["idbarang"];
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_object($result);
    $item = new Item();
    $item->idbarang = $product->idbarang;
    $item->namabarang = $product->namabarang;
    $item->harga = $product->harga;
    $iteminstock = $product->jumlah_barang;
    $item->jumlah = 1;
    // Check product is existing in cart
    $index = -1;
    $cart = unserialize(serialize($_SESSION['cart']));
    for ($i = 0; $i < count($cart); $i++)
        if ($cart[$i]->idbarang == $_GET['idbarang']) {
            $index = $i;
            break;
        }
    if ($index == -1)
        $_SESSION['cart'][] = $item; // $_SESSION['cart']: set $cart as session variable
    else {

        if (($cart[$index]->jumlah) < $iteminstock)
            $cart[$index]->jumlah++;
        $_SESSION['cart'] = $cart;
    }
}

// Delete product in cart
if (isset($_GET['index']) && !isset($_POST['update'])) {
    $cart = unserialize(serialize($_SESSION['cart']));
    unset($cart[$_GET['index']]);
    $cart = array_values($cart);
    $_SESSION['cart'] = $cart;
}
// Update quantity in cart
if (isset($_POST['update'])) {
    $arrQuantity = $_POST['quantity'];
    $cart = unserialize(serialize($_SESSION['cart']));
    for ($i = 0; $i < count($cart); $i++) {
        $cart[$i]->jumlah = $arrQuantity[$i];
    }
    $_SESSION['cart'] = $cart;
}

if(isset($_POST['simpan'])){
    $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']);
    $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']);
}
?>

<h1 class="mt-4">Tambah Barang</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="?p=transaksi&aksi=pilih">Pilih Barang</a></li>
    <li class="breadcrumb-item active">Tambah Barang</li>
</ol>
<form method="POST" id='myForm'>
    <div class="row row-col-2">
        <div class="col-2">
            <a href="?p=transaksi&aksi=pilih" class="btn btn-warning mb-3" name="update"><i class="fa fa-plus"></i> Pilih Barang Lagi</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Barang Terpilih
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableBarang" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th width="1%">QYT</th>
                            <th>Sub total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $cart = unserialize(serialize($_SESSION['cart']));
                        $s = 0;
                        $index = 0;
                        for ($i = 0; $i < count($cart); $i++) {
                            $s += $cart[$i]->harga * $cart[$i]->jumlah;
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $cart[$i]->namabarang ?></td>
                                <td>Rp. <?php echo number_format($cart[$i]->harga); ?></td>
                                <!-- <td><input type="number" min="1" value="<?php echo $cart[$i]->jumlah; ?>" name="jumlah[]" readonly="readonly" /></td> -->
                                <td><?php echo $cart[$i]->jumlah; ?></td>
                                <td>Rp. <?php echo number_format($cart[$i]->harga * $cart[$i]->jumlah); ?></td>
                                <td>
                                    <a href="?p=transaksi&aksi=tambah&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $index++;
                        }
                        ?>
                    </tbody>
                    <tr>
                        <td colspan="5" style="text-align:right; font-weight:bold;">Total Harga</td>
                        <td>Rp. <?php echo number_format($s); ?></td>
                    </tr>
                </table>
                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control">
                </div>
                <div class="form-group">
                    <a href="?p=transaksi&aksi=pilih" class="btn btn-primary mb-3" name="simpan"><i class="fa fa-save"></i> Simpan</a>
                </div>
            </form>
        </div>
    </div>
</div>