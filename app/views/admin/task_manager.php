<style>
    .page-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .add-task-btn {
        margin-bottom: 10px;
        display: inline-block;
        text-decoration: none;
        background-color: #2ecc71;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .add-task-btn:hover {
        background-color: #27ae60;
    }

    .task-table {
        width: 100%;
        border-collapse: collapse;
    }

    .task-table th,
    .task-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .task-table th {
        background-color: #f2f2f2;
    }

    .center {
        text-align: center;
    }

    .task-table .center button {
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-edit {
        background-color: #3498db;
        color: white;
    }

    .btn-edit:hover {
        background-color: #2980b9;
    }

    .btn-delete {
        background-color: #e74c3c;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .task-table .center button+button {
        margin-left: 8px;
    }
</style>
<h1 class="page-title">Task Manager</h1>
<a href="create_task" class="add-task-btn">Thêm Task</a>

<table class="task-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th>Ngày hết hạn</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td class="center"><?= $task['id'] ?></td>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td>
                    <?= htmlspecialchars($task['description']) ?>
                </td>
                <td>
                    <?php if (!empty($task['status']) && $task['status'] === 'done'): ?>
                        Hoàn thành
                    <?php elseif ($task['status'] === 'in_progress'): ?>
                        Đang làm
                    <?php else: ?>
                        Chưa làm
                    <?php endif; ?>
                </td>
                <td class="center">
                    <?= $task['due_date'] ?? '<em>Không đặt</em>' ?>
                </td>
                <td class="center">
                    <form action="edit_task&id=<?= $task['id'] ?>" method="GET" style="display:inline;">
                        <button type="submit" class="btn btn-edit">Sửa</button>
                    </form>
                    <form action="delete_task&id=<?= $task['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Xác nhận xoá task này?')">
                        <button type="submit" class="btn btn-delete">Xoá</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>