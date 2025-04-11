<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$validPages = array_map(function ($file) {
    return basename($file, '.php');
}, glob(__DIR__ . '/pages/*.php'));
$pageFile = __DIR__ . '/pages/' . $page . '.php';
if (in_array($page, $validPages) && file_exists($pageFile)) {
    $currentPage = $page;
    require_once __DIR__ . '/view/header.php';
    require_once  $pageFile;
} else {
    $currentPage = 'home';
    require_once __DIR__ . '/view/header.php';
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
}
require_once __DIR__ . '/view/footer.php';
