<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', 'localhost');
define('DB_USER', 'dbusr22360859027');
define('DB_PASS', 'X7hstvpqcohd');
define('DB_NAME', 'dbstorage22360859027');

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ));
} catch(PDOException $e) {
    echo "Veritabanı Bağlantı Hatası:<br>";
    echo "Hata Kodu: " . $e->getCode() . "<br>";
    echo "Hata Mesajı: " . $e->getMessage() . "<br>";
    echo "Bağlantı Detayları:<br>";
    echo "Host: " . DB_HOST . "<br>";
    echo "Database: " . DB_NAME . "<br>";
    echo "Kullanıcı: " . DB_USER . "<br>";
    exit;
}
?> 