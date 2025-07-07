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
    $id = intval($input['id'] ?? 0);
    $status = intval($input['status'] ?? 0);
    if ($id <= 0 || $status < 0 || $status > 2) {
        echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ถูกต้อง']);
        exit;
    }
    try {
        if ($status == 1) { // ถ้าจะเปลี่ยนเป็น "ผ่าน"
            // ดึง club ของผู้สมัครคนนี้
            $stmt = $pdo->prepare("SELECT club FROM applicants WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if (!$row) {
                echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลผู้สมัคร']);
                exit;
            }
            $club = $row['club'];
            // นับจำนวนผู้ที่ผ่านในชมรมนี้
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM applicants WHERE club = ? AND status = 1");
            $stmt->execute([$club]);
            $count = $stmt->fetchColumn();
            if ($count >= 5) {
                echo json_encode(['success' => false, 'message' => 'จำนวนผู้ผ่านในชมรมนี้ครบ 5 คนแล้ว']);
                exit;
            }
        }
        $stmt = $pdo->prepare("UPDATE applicants SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'อัปเดตสถานะสำเร็จ']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลผู้สมัคร']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตสถานะ']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?> 