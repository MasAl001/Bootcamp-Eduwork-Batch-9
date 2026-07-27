<?php
    require_once '../../connect.php';
/**
 * Script untuk memproses data dari form tambah produk.
 * Melakukan validasi sederhana sebelum data (simulasi) disimpan.
 */

// Memeriksa apakah request berasal dari form submission (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dan membersihkannya untuk mencegah masalah keamanan dasar (seperti XSS)
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $kategori = htmlspecialchars(trim($_POST["kategori"]));
    $harga = htmlspecialchars(trim($_POST["harga"]));
    $stok = htmlspecialchars(trim($_POST["stok"]));
    $deskripsi = htmlspecialchars(trim($_POST["deskripsi"])); // Deskripsi bisa opsional tergantung kebutuhan

    // Array untuk menyimpan pesan error validasi
    $errors = [];

    // Validasi Sederhana: Memastikan field penting tidak kosong
    if (empty($nama)) {
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

    // Validasi Gambar
    $namagambar = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['gambar']['tmp_name'];
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        
        // Mendapatkan ekstensi file
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Ekstensi yang diizinkan
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Validasi ukuran file (contoh: maksimal 2MB)
            if ($fileSize < 2000000) {  
                // Kode asli untuk menyimpan gambar ke folder server (Uncomment jika ingin digunakan)
                $uploadFileDir = '../../uploads/';
                // Pastikan folder di atas sudah dibuat!
                $dest_path = $uploadFileDir . $fileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                   $namagambar = $fileName;
                } else {
                   $errors[] = "Terjadi kesalahan saat memindahkan file gambar.";
                }
                
                // Simulasi: kita hanya menyimpan nama filenya saja
                // $gambar = htmlspecialchars($fileName); 
            } else {
                $errors[] = "Ukuran gambar terlalu besar. Maksimal 2MB.";
            }
        } else {
            $errors[] = "Format gambar tidak valid. Gunakan: " . implode(', ', $allowedfileExtensions);
        }
    } else {
        $errors[] = "Gambar produk harus diunggah.";
    }

    // Cek apakah ada error
    if (count($errors) > 0) {
        // Jika ada error, tampilkan pesan error
        echo "<h2>Terjadi Kesalahan:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li style='color:red;'>$error</li>";
        }
        echo "</ul>";
        echo "<a href='../create.php'>Kembali ke Form</a>";
    } else {
        // Jika tidak ada error, proses penyimpanan ke database dilakukan di sini
        
        // Contoh kode untuk menyimpan ke database (PDO)
        // Pastikan Anda sudah membuat koneksi database ($conn)
        
        $sql = "INSERT INTO products (nama, kategori, harga, stok, deskripsi, gambar) VALUES (:nama, :kategori, :harga, :stok, :deskripsi, :gambar)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama' => $nama,
            ':kategori' => $kategori,
            ':harga' => $harga,
            ':deskripsi' => $deskripsi,
            ':stok' => $stok,
            ':gambar' => $namagambar
        ]);

        header('Location:../index.php');
        exit();

        // Simulasi sukses
        // echo "<div style='font-family: sans-serif; padding: 20px; border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 5px; max-width: 500px; margin: 20px auto;'>";
        // echo "<h3>Berhasil!</h3>";
        // echo "<p>Data produk berhasil divalidasi dan (disimulasikan) disimpan ke database.</p>";
        // echo "<strong>Data yang diterima:</strong><br>";
        // echo "Nama: " . $nama . "<br>";
        // echo "Kategori: " . $kategori . "<br>";
        // echo "Harga: Rp" . number_format((float)$harga, 0, ',', '.') . "<br>";
        // echo "Stok: " . $stok . "<br>";
        // echo "Deskripsi: " . (!empty($deskripsi) ? $deskripsi : "<em>Tidak ada deskripsi</em>") . "<br>";
        // echo "Gambar Produk: " . $gambar . "<br>";
        // echo "<br><a href='../create.php'>Tambah Produk Lain</a>";
        // echo "</div>";
    }

} else {
    // Jika file diakses langsung tanpa melalui form POST
    echo "Akses tidak sah. Silakan gunakan form untuk mengirim data.";
}
?>