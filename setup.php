<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Ana veritabanına bağlan
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Veritabanını oluştur
    $sql = "CREATE DATABASE IF NOT EXISTS subscription_tracker CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    echo "Veritabanı başarıyla oluşturuldu.<br>";
    
    // Veritabanını seç
    $pdo->exec("USE subscription_tracker");
    
    // Users tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Users tablosu başarıyla oluşturuldu.<br>";
    
    // Subscriptions tablosunu oluştur
    $sql = "CREATE TABLE IF NOT EXISTS subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        service_name VARCHAR(100) NOT NULL,
        category VARCHAR(50),
        price DECIMAL(8,2),
        renewal_day INT,
        auto_renew BOOLEAN DEFAULT 1,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Subscriptions tablosu başarıyla oluşturuldu.<br>";
    
    echo "<br>Kurulum tamamlandı! <a href='index.php'>Ana sayfaya git</a>";
    
} catch(PDOException $e) {
    die("HATA: " . $e->getMessage());
}
?> 