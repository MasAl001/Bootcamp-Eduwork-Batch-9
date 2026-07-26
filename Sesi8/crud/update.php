<?php
    require_once '../connect.php';

    // Update data in products table (nama, kategori, harga, deskripsi, stok, gambar) based on product id
    $productId = 1; //Id produk yang akan diupdate
    $newNama = "Update Laptop Lenovo";
    $newKategori = "Elektronik";
    $newHarga = 10000000;
    $newDeskripsi = "Laptop Lenovo ini sangat cocok untuk kalian yang suka bermain game";
    $newStok = 10;
    $newGambar = "laptoplenovo.jpg";

    $sql = "UPDATE products SET nama = :nama, kategori = :kategori, harga = :harga, deskripsi = :deskripsi,
    stok = :stok, gambar = :gambar WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nama' => $newNama,
        ':kategori' => $newKategori,
        ':harga' => $newHarga,
        ':deskripsi' => $newDeskripsi,
        ':stok' => $newStok,
        ':gambar' => $newGambar,
        ':id' => $productId
    ]);
    echo "Product updated successfully"
?>