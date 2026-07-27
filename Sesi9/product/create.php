<?php 
    $page_title = "Tambah Produk - Toko AL";
    include_once '../template/header.php';
?>
<style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang abu-abu terang */
        }
        .form-container {
            background-color: #ffffff; /* Latar belakang form putih */
            padding: 30px;
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Bayangan halus */
            max-width: 600px;
            margin: auto;
        }
        .form-title {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
</style>

<div class="container">
    <div class="form-container">
        <h2 class="form-title text-center">Tambah Produk Baru</h2>
        
        <!-- Form action menunjuk ke file PHP yang akan memproses data, menggunakan method POST dan enctype untuk file upload -->
        <form action="db_action/create_process.php" method="POST" enctype="multipart/form-data">
            
            <!-- Input Nama Produk -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama produk" required>
                <div class="form-text text-muted">Contoh: Sepatu Sneakers, Kaos Polos.</div>
            </div>

            <!-- Input Kategori -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="" selected disabled>Pilih Kategori...</option>
                    <option value="pakaian">Pakaian</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Baris untuk Harga dan Stok agar terlihat rapi (Grid system) -->
            <div class="row">
                <!-- Input Harga -->
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="0" min="0" required>
                </div>
                
                <!-- Input Stok -->
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label">Stok Awal</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="0" min="0" required>
                </div>
            </div>

            <!-- Input Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail produk secara singkat..."></textarea>
            </div>

            <!-- Input Gambar Produk -->
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*" required>
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