<?php
    require_once '../connect.php';

    // Insert data into products table (nama, kategori, harga, deskripsi, stok, gambar)
    $nama = "Laptop Asus";
    $kategori = "Elektronik";
    $harga = 5000000;
    $deskripsi = "Laptop Asus seri terbaru ini sangat cocok untuk kalian yang bekerja sebagai programmer";
    $stok = 5;
    $gambar = "laptopasus.jpg";

    $sql = "INSERT INTO products (nama, kategori, harga, deskripsi, stok, gambar)
    VALUES (:nama, :kategori, :harga, :deskripsi, :stok, :gambar)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama' => $nama,
        ':kategori' => $kategori,
        ':harga' => $harga,
        ':deskripsi' => $deskripsi,
        ':stok' => $stok,
        ':gambar' => $gambar
    ]);

    echo "New product created successfully";
?>