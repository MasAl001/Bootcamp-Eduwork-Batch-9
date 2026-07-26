<?php
    require_once '../connect.php';

    // Read data from products table
    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display data products
    foreach ($products as $product) {
        echo "ID : " . $product['id'] . "<br>";
        echo "Nama Produk: " . $product['nama'] . "<br>";
        echo "Harga : " . $product['harga'] . "<br>";
        echo "Deskripsi : " . $product['deskripsi'] . "<br>";
        echo "Gambar : " . $product['gambar'] . "<br>";
        echo "Stok : " . $product['stok'] . "<br>";
        echo "Kategori : " . $product['kategori'] . "<br>";
        echo "<hr>";
    }
?>