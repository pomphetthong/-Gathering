<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        $input = $_POST;
    }
    
    $name = trim($input['name'] ?? '');
    $room = trim($input['room'] ?? '');
    $sop = trim($input['sop'] ?? '');
    $club = trim($input['club'] ?? '');
    
    // ตรวจสอบข้อมูล
    if (empty($name) || empty($room) || empty($sop) || empty($club)) {
        echo json_encode(['success' => false, 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน']);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO applicants (name, room, sop, club, status, created_at) VALUES (?, ?, ?, ?, 0, NOW())");
        $stmt->execute([$name, $room, $sop, $club]);
        
        echo json_encode(['success' => true, 'message' => 'บันทึกข้อมูลสำเร็จ']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?> 