<?php 
    $page_title = "Beranda - Toko AL";
    include_once '../template/header.php';

    //Show all product from database in html table format
    require_once '../connect.php';

    // Get search and filter parameters
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

    // Get all categories for filter dropdown
    $sql_categories = "SELECT DISTINCT kategori FROM products ORDER BY kategori";
    $stmt_categories = $pdo->query($sql_categories);
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    // Build SQL query with search and filter
    $sql = "SELECT * FROM products WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND nama LIKE ?";
        $params[] = "%{$search}%";
    }

    if (!empty($kategori)) {
        $sql .= " AND kategori = ?";
        $params[] = $kategori;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="container my-5">
    <h1 class="mb-4">Daftar Produk</h1>
    <a href="create.php" class="btn btn-primary mb-3">Tambah Produk</a>
    <!-- Search and filter form -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['kategori']); ?>" <?= $cat['kategori'] === $kategori ? 'selected' : ''; ?>><?= htmlspecialchars($cat['kategori']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered table-stripped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']); ?></td>
                <td><?= htmlspecialchars($product['nama']); ?></td>
                <td><?= htmlspecialchars($product['kategori']); ?></td>
                <td><?= htmlspecialchars($product['harga']); ?></td>
                <td><?= htmlspecialchars($product['deskripsi']); ?></td>
                <td><?= htmlspecialchars($product['stok']); ?></td>
                <td><img src="../uploads/<?= htmlspecialchars($product['gambar']); ?>" alt="<?= htmlspecialchars($product['nama']); ?>" width="100"</td>
                <td>
                    <a href="edit.php?id=<?= htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="db_action/delete.php" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Apakah kamu yakin ingin menghapus produk ini?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']); ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada produk ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<?php include_once '../template/footer.php'; ?>