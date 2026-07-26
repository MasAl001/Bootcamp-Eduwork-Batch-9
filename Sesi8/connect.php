<?php
//php database connection with PDO
$host = 'localhost';
$dbname = 'bootcamp_eduwork_9';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    // echo "Connected to database succesfully";
} catch (PDOException $e) {
    // echo "Connected failed :".$e->getMessage();
    die('Database connection failed: ' . $e->getMessage());
}
?>