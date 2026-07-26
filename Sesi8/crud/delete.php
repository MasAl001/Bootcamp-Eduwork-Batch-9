<?php
    require_once '../connect.php';

    //Delete data from products table based on prooduct id
    $productId = 1; //Id produk yang akan dihapus
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $productId]);
    echo "Product deleted successfully";
?>