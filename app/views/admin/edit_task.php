<div style="display: flex; flex-direction: column; align-items: center; font-family: Arial; color: #2c3e50;">
    <h2>Chỉnh sửa Task</h2>

    <form method="POST" style="width: 100%; max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">

        <div>
            <label for="title">Tiêu đề:</label><br>
            <input id="title" type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label for="description">Mô tả:</label><br>
            <textarea id="description" name="description" rows="4" style="width: 100%; padding: 8px; box-sizing: border-box;"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>

        <div>
            <label for="status">Trạng thái:</label><br>
            <select id="status" name="status" style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Chưa xong</option>
                <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>Đang làm</option>
                <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Hoàn thành</option>
            </select>
        </div>

        <div>
            <label for="due_date">Ngày hết hạn (due_date):</label><br>
            <input id="due_date" type="date" name="due_date" value="<?= $task['due_date'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit" style="padding: 10px; background-color: #3498db; color: white; border: none; width: 100%;">Lưu thay đổi</button>
    </form>
</div>