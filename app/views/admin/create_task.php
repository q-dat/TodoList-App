<div style="display: flex; flex-direction: column; align-items: center; font-family: Arial; color: #2c3e50;">
    <h2>Thêm Task Mới</h2>

    <form method="POST" style="width: 100%; max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
        <div>
            <label for="title">Tiêu đề:</label><br>
            <input id="title" type="text" name="title" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label for="description">Mô tả:</label><br>
            <textarea id="description" name="description" rows="4" style="width: 100%; padding: 8px; box-sizing: border-box;"></textarea>
        </div>

        <div>
            <label for="status">Trạng thái:</label><br>
            <select id="status" name="status" style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="pending">Chưa hoàn thành</option>
                <option value="in_progress">Đang tiến hành</option>
                <option value="done">Đã hoàn thành</option>
            </select>
        </div>

        <div>
            <label for="due_date">Ngày hết hạn:</label><br>
            <input id="due_date" type="date" name="due_date" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit" style="padding: 10px; background-color: #2ecc71; color: white; border: none; width: 100%;">Thêm task</button>
    </form>
</div>
