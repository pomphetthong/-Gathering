<?php
// การตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = 'mysql'; // ชื่อ service ใน docker-compose
$dbname = 'mydatabase';
$username = 'club_user';
$password = 'club_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?> 