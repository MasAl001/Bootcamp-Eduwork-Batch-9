<?php
/**
 * Script untuk memproses data dari form tambah produk.
 * Melakukan validasi sederhana sebelum data (simulasi) disimpan.
 */

// Memeriksa apakah request berasal dari form submission (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dan membersihkannya untuk mencegah masalah keamanan dasar (seperti XSS)
    $namaProduk = htmlspecialchars(trim($_POST["productName"]));
    $kategori = htmlspecialchars(trim($_POST["productCategory"]));
    $harga = htmlspecialchars(trim($_POST["productPrice"]));
    $stok = htmlspecialchars(trim($_POST["productStock"]));
    $deskripsi = htmlspecialchars(trim($_POST["productDescription"])); // Deskripsi bisa opsional tergantung kebutuhan

    // Array untuk menyimpan pesan error validasi
    $errors = [];

    // Validasi Sederhana: Memastikan field penting tidak kosong
    if (empty($namaProduk)) {
        $errors[] = "Nama produk tidak boleh kosong.";
    }
    if (empty($kategori)) {
        $errors[] = "Kategori harus dipilih.";
    }
    
    // Validasi harga dan stok: pastikan tidak kosong dan merupakan angka (numeric)
    if (empty($harga) && $harga !== '0') { // Perlu cek '0' karena empty('0') itu bernilai true di PHP
        $errors[] = "Harga tidak boleh kosong.";
    } elseif (!is_numeric($harga) || $harga < 0) {
        $errors[] = "Harga harus berupa angka positif.";
    }

    if (empty($stok) && $stok !== '0') {
        $errors[] = "Stok tidak boleh kosong.";
    } elseif (!is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok harus berupa angka positif.";
    }

    // Cek apakah ada error
    if (count($errors) > 0) {
        // Jika ada error, tampilkan pesan error
        echo "<h2>Terjadi Kesalahan:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li style='color:red;'>$error</li>";
        }
        echo "</ul>";
        echo "<a href='form-product.html'>Kembali ke Form</a>";
    } else {
        // Jika tidak ada error, proses penyimpanan ke database dilakukan di sini
        
        /* 
        // Contoh kode untuk menyimpan ke database (PDO)
        // Pastikan Anda sudah membuat koneksi database ($conn)
        
        $sql = "INSERT INTO produk (nama, kategori, harga, stok, deskripsi) VALUES (:nama, :kategori, :harga, :stok, :deskripsi)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nama', $namaProduk);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':deskripsi', $deskripsi);
        
        if ($stmt->execute()) {
             // Berhasil disimpan
        }
        */

        // Simulasi sukses
        echo "<div style='font-family: sans-serif; padding: 20px; border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 5px; max-width: 500px; margin: 20px auto;'>";
        echo "<h3>Berhasil!</h3>";
        echo "<p>Data produk berhasil divalidasi dan (disimulasikan) disimpan ke database.</p>";
        echo "<strong>Data yang diterima:</strong><br>";
        echo "Nama: " . $namaProduk . "<br>";
        echo "Kategori: " . $kategori . "<br>";
        echo "Harga: Rp" . number_format((float)$harga, 0, ',', '.') . "<br>";
        echo "Stok: " . $stok . "<br>";
        echo "Deskripsi: " . (!empty($deskripsi) ? $deskripsi : "<em>Tidak ada deskripsi</em>") . "<br>";
        echo "<br><a href='form-product.html'>Tambah Produk Lain</a>";
        echo "</div>";
    }

} else {
    // Jika file diakses langsung tanpa melalui form POST
    echo "Akses tidak sah. Silakan gunakan form untuk mengirim data.";
}
?>