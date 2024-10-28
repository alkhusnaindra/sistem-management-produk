<?php
    $title = 'Tambah Produk';
    ob_start();
?>

<div class="container mt-5">
    <h1 class="mb-4">Tambah Produk</h1>
    <form action="<?php echo site_url('produk/simpan'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
    </div>

    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="number" class="form-control" id="harga" name="harga" required>
    </div>

    <div class="form-group">
        <label for="stok">Stok:</label>
        <input type="number" class="form-control" id="stok" name="stok" required>
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi:</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="gambar">Gambar:</label>
        <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?php echo site_url('produk'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
    $content = ob_get_clean();
    include(APPPATH . 'views/layout.php'); 
?>