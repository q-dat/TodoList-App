<style>
    .form-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: Arial, sans-serif;
        color: #2c3e50;
        padding: 20px;
    }

    .task-form {
        width: 100%;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .task-form input[type="text"],
    .task-form input[type="date"],
    .task-form textarea,
    .task-form select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .task-form button {
        padding: 10px;
        background-color: #2ecc71;
        color: white;
        border: none;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
    }

    .task-form button:hover {
        background-color: #27ae60;
    }
</style>
<div class="form-wrapper">
    <h2>Thêm Task Mới</h2>

    <form method="POST" class="task-form">
        <div>
            <label for="title">Tiêu đề:</label><br>
            <input id="title" type="text" name="title" required>
        </div>

        <div>
            <label for="description">Mô tả:</label><br>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>

        <div>
            <label for="status">Trạng thái:</label><br>
            <select id="status" name="status">
                <option value="pending">Chưa hoàn thành</option>
                <option value="in_progress">Đang tiến hành</option>
                <option value="done">Đã hoàn thành</option>
            </select>
        </div>

        <div>
            <label for="due_date">Ngày hết hạn:</label><br>
            <input id="due_date" type="date" name="due_date">
        </div>

        <button type="submit">Thêm task</button>
    </form>
</div>