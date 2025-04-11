<h1>Task Manager</h1>
<a href="admin.php?page=create_task" style="margin-bottom: 10px; display:inline-block;">Thêm Task</a>

<table style="width: 100%; border-collapse: collapse; ">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Tiêu đề</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Trạng thái</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Ngày hết hạn</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><?= $task['id'] ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($task['title']) ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <?php if (!empty($task['status']) && $task['status'] === 'done'): ?>
                        Hoàn thành
                    <?php elseif ($task['status'] === 'in_progress'): ?>
                        Đang làm
                    <?php else: ?>
                        Chưa làm
                    <?php endif; ?>
                </td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                    <?= $task['due_date'] ?? '<em>Không đặt</em>' ?>
                </td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                    <a href="admin.php?page=edit_task&id=<?= $task['id'] ?>"> Sửa</a> |
                    <a href="admin.php?page=delete_task&id=<?= $task['id'] ?>" onclick="return confirm('Xác nhận xoá task này?')">Xoá</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>