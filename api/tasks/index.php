<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/controllers/TaskController.php';

// Kết nối cơ sở dữ liệu (nếu bạn cần truyền vào constructor)
$db = getDbConnection();

$controller = new TaskController();

// Nhận thông tin route
$page = $_GET['page'] ?? 'tasks';
$action = $_GET['action'] ?? 'index';
$id     = $_GET['id'] ?? null;

// Gọi hàm controller tương ứng
if ($page === 'tasks' && method_exists($controller, $action)) {
    if ($id !== null) {
        $controller->$action($id); 
    } else {
        $controller->$action();   
    }
} else {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => '404 - Không tìm thấy chức năng yêu cầu'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
