<?php
 require_once '../connect.php';

 //Mendapatkan produk id dari query parameter
 $productId = $_GET['id'];
 //Mengambil data produk dari database
 $sql = "SELECT * FROM products WHERE id = :id";
 $stmt = $pdo->prepare($sql);
 $stmt->execute([':id' => $productId]);
 $product = $stmt->fetch(PDO::FETCH_ASSOC);
 if (!$product) {
    echo "Product not found!";
    exit;
 }

    $page_title = "Edit Produk - Toko AL";
    include_once '../template/header.php';
?>
<div class="container">
    <div class="form-container">
        <h2 class="form-title text-center">Edit Produk</h2>
        
        <!-- Form action menunjuk ke file PHP yang akan memproses data, menggunakan method POST dan enctype untuk file upload -->
        <form action="db_action/update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']); ?>">
            <!-- Input Nama Produk -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($product['nama']); ?>" required>
                <div class="form-text text-muted">Contoh: Sepatu Sneakers, Kaos Polos.</div>
            </div>

            <!-- Input Kategori -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="<?= htmlspecialchars($product['kategori']); ?>"><?= htmlspecialchars($product['kategori']); ?></option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Baris untuk Harga dan Stok agar terlihat rapi (Grid system) -->
            <div class="row">
                <!-- Input Harga -->
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($product['harga']); ?>" min="0" required>
                </div>
                
                <!-- Input Stok -->
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok Awal</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($product['stok']); ?>" min="0" required>
                </div>
            </div>

            <!-- Input Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?= htmlspecialchars($product['deskripsi']); ?></textarea>
            </div>

            <!-- Input Gambar Produk -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
                <?php if (!empty($product['gambar'])): ?>
                <img src="../uploads/<?= htmlspecialchars($product['gambar']); ?>" alt="<?= htmlspecialchars($product['nama']); ?>">
                <?php endif; ?>
                <div class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
<?php include_once '../template/footer.php';?>