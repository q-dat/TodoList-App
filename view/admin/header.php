<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - TodoList</title>
    <link rel="stylesheet" href="/TodoList/assets/css/style.css">
</head>

<body>
    <?php
    $menuItems = [
        'dashboard' => 'Dashboard',
        'task_manager' => 'Task Manager',
    ]
    ?>
    <nav class="navbar">
        <ul>
            <?php foreach ($menuItems as $link => $label): ?>
                <a href="/TodoList-App/admin/<?php echo $link; ?>"
                    class="<?php echo $currentPage == $link ? 'active' : ''; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="content">