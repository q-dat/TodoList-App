<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($currentPage) ?> - TodoList</title>
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>
    <?php
    $menuItems = [
        'dashboard' => 'Dashboard',
        'task_manager' => 'Task Manager',
    ]
    ?>
    <nav class="navbar">
        <ul class='menu-left'>
            <?php foreach ($menuItems as $link => $label): ?>
                <a href="/TodoList-App/admin/<?php echo $link; ?>"
                    class="<?php echo $currentPage == $link ? 'active' : ''; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </ul>
        <ul class='menu-right'>
            <li>
                <a href="/TodoList-App">Trở Về Trang Chủ</a>
            </li>
        </ul>
    </nav>
    <div class="content">