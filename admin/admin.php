<?php
require_once '../config/db.php';
require_once '../app/controllers/AdminController.php';

$page = $_GET['page'] ?? 'dashboard';
$page = preg_replace('/[^a-z_]/', '', strtolower($page));
$currentPage = $page;
require_once '../view/admin/header.php';

$controller = new AdminController();

if (method_exists($controller, $page)) {
    $controller->$page();
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
}

require_once '../view/admin/footer.php';
