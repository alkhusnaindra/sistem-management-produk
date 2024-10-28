<?php
    $title = 'Tambah Produk';
    ob_start();
?>
<div class="container mt-5">
        <h1 class="mb-4">Edit Produk</h1>
        <form action="<?php echo site_url('produk/update/'.$produk->id_produk); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $produk->nama_produk; ?>" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $produk->harga; ?>" required>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $produk->stok; ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?php echo $produk->deskripsi; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Gambar:</label><br>
                <img src="<?php echo base_url('uploads/' . $produk->gambar); ?>" alt="<?php echo $produk->nama_produk; ?>" class="img-fluid" style="width: 100px; height: auto;"><br>
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar (Optional)</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo site_url('produk'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

<?php
    $content = ob_get_clean();
    include(APPPATH . 'views/layout.php'); 
?>