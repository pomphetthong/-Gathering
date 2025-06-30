<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = intval($input['id'] ?? 0);
    $name = trim($input['name'] ?? '');
    $room = trim($input['room'] ?? '');
    $sop = trim($input['sop'] ?? '');
    $club = trim($input['club'] ?? '');
    if ($id <= 0 || !$name || !$room || !$sop || !$club) {
        echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ถูกต้อง']);
        exit;
    }
    try {
        $stmt = $pdo->prepare('UPDATE applicants SET name=?, room=?, sop=?, club=? WHERE id=?');
        $stmt->execute([$name, $room, $sop, $club, $id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลหรือไม่มีการเปลี่ยนแปลง']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการแก้ไข']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
} 