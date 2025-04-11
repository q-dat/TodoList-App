<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo ucfirst($currentPage); ?> - TodoList</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <?php
    $menuItems = [
        '' => 'Home',
        'task' => 'Task',
    ];
    ?>
    <nav class="navbar">
        <ul class='menu-left'>
            <?php foreach ($menuItems as $link => $label): ?>
                <li>
                    <a href="/TodoList-App/<?php echo $link; ?>"
                        class="<?php echo $currentPage == $link ? 'active' : ''; ?>">
                        <?php echo $label; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul class='menu-right'>
            <li>
                <a href="/TodoList-App/admin/dashboard">Quản Lý Task</a>
            </li>
        </ul>
    </nav>
</body>

</html>