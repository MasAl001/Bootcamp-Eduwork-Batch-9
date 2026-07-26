<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Validate the form data
    $errors = [];
    if (empty($nama)) {
        $errors['nama'] = 'Nama produk harus diisi.';
    }
    if (empty($kategori)) {
        $errors['kategori'] = 'Kategori produk harus dipilih.';
    }
    if (empty($harga) || !is_numeric($harga) || $harga < 0) {
        $errors['harga'] = 'Harga produk harus berupa angka positif.';
    }
    if (empty($stok) || !is_numeric($stok) || $stok < 0) {
        $errors['stok'] = 'Stok produk harus berupa angka positif.';
    }
    if (!empty($errors)) {
        // Handle the errors, e.g., redirect back to the edit form with error messages
        // You can store the errors in the session or display them directly
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header('Location: ../edit.php?id=' . $id);
        exit();
    }

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Move the uploaded image to the desired directory
        $upload_dir = '../../uploads/';
        // remove space from the image name and replace it with underscore
        $image = str_replace(' ', '_', $image);
        $image = time() . '_' . basename($image); // Rename the image to avoid conflicts
        $image_path = $upload_dir . $image;
        move_uploaded_file($image_tmp, $image_path);

        // delete the old image if it exists
        $sql = "SELECT image FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $oldImage = $stmt->fetchColumn();
        if ($oldImage && file_exists($upload_dir . $oldImage)) {
            unlink($upload_dir . $oldImage);
        }

        // Update the product with the new image
        $sql = "UPDATE products SET nama = :nama, kategori = :kategori, harga = :harga, stok = :stok, deskripsi = :deskripsi, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama' => $nama,
            ':kategori' => $kategori,
            ':harga' => $harga,
            ':stok' => $stok,
            ':deskripsi' => $deskripsi,
            ':image' => $image,
            ':id' => $id
        ]);
    } else {
        // Update the product without changing the image
        $sql = "UPDATE products SET nama = :nama, kategori = :kategori, harga = :harga, stok = :stok, deskripsi = :deskripsi WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama' => $nama,
            ':kategori' => $kategori,
            ':harga' => $harga,
            ':stok' => $stok,
            ':deskripsi' => $deskripsi,
            ':id' => $id
        ]);
    }

    // Redirect to the product list page after successful update
    header('Location: ../index.php');
    exit();
}