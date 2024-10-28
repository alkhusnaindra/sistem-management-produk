<?php
$title = 'Daftar Produk';
ob_start();
?>

<h1>Daftar Produk</h1>
<a href="<?php echo site_url('produk/tambah'); ?>" class="btn btn-primary mb-3">Tambah Produk</a>

<form action="<?php echo site_url('produk'); ?>" method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search'], ENT_QUOTES) : ''; ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </div>
</form>

<?php if(empty($produk)): ?>
    <div class="alert alert-warning" role="alert">Produk tidak ditemukan.</div>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($produk as $index => $item): ?>
        <tr>
            <td><?php echo $i + $offset; ?></td>
            <td><?php echo htmlspecialchars($item->nama_produk, ENT_QUOTES); ?></td>
            <td><?php echo 'Rp. ' . number_format($item->harga, 0, ',', '.'); ?></td>
            <td><?php echo $item->stok; ?></td>
            <td><?php echo htmlspecialchars($item->deskripsi, ENT_QUOTES); ?></td>
            <td>
                <img src="<?php echo base_url('uploads/' . $item->gambar); ?>" alt="<?php echo htmlspecialchars($item->nama_produk, ENT_QUOTES); ?>" style="width: 100px; height: auto;">
            </td>
            <td>
                <a href="<?php echo site_url('produk/edit/'.$item->id_produk); ?>" class="btn btn-warning">Edit</a>
                <a href="<?php echo site_url('produk/hapus/'.$item->id_produk); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
            <li class="page-item <?php echo ($this->input->get('page') == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo site_url('produk?page=' . $i . '&search=' . urlencode($search ?? '')); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>



<?php endif; ?>

<?php
$content = ob_get_clean(); 
include(APPPATH . 'views/layout.php'); 
?>
