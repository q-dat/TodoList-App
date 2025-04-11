<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/controllers/TaskController.php';

$db = getDbConnection();
$controller = new TaskController($db);

$page = $_GET['page'] ?? 'tasks';
$action = $_GET['action'] ?? 'index';

if ($page === 'tasks' && method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "404 - Không tìm thấy chức năng";
}
