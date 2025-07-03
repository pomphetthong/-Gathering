<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/config.php';

$club = $_GET['club'] ?? $_POST['club'] ?? '';
try {
    if ($club) {
        $stmt = $pdo->prepare("SELECT * FROM applicants WHERE club = ? ORDER BY created_at DESC");
        $stmt->execute([$club]);
    } else {
        $stmt = $pdo->query("SELECT * FROM applicants ORDER BY created_at DESC");
    }
    $applicants = $stmt->fetchAll();
    echo json_encode(['success' => true, 'data' => $applicants]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการดึงข้อมูล']);
}
?> 