<?php
class Task
{
    private $db;

    public function __construct()
    {
        // Gọi hàm kết nối database, lưu đối tượng kết nối vào $this->db
        $this->db = getDbConnection();
    }

    // Lấy tất cả các task, sắp xếp theo id giảm dần
    public function getAll()
    {
        /*
         * SQL: SELECT * FROM tasks ORDER BY id DESC
         * Giải thích: Lấy toàn bộ dữ liệu từ bảng tasks, sắp xếp theo id từ cao đến thấp.
         * Ví dụ:
         * +--------+------------------+
         * | id     | title            |
         * +--------+------------------+
         * | 5      | Fix bug A        |
         * | 4      | Design UI        |
         */
        return $this->db->query("SELECT * FROM tasks ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    }

    // Tạo mới một task
    public function create($title, $description, $status = 'pending', $due_date = null)
    {
        /*
         * SQL: INSERT INTO tasks (title, description, status, due_date) VALUES (?, ?, ?, ?)
         * Giải thích: Thêm một dòng mới vào bảng tasks với các giá trị title, description, status, due_date.
         * Ví dụ:
         * title: "Test chức năng login", description: "Kiểm tra login page", status: "pending", due_date: "2025-04-30"
         */
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, status, due_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $status, $due_date);
        return $stmt->execute();
    }

    // Tìm một task theo ID
    public function find($id)
    {
        /*
         * SQL: SELECT * FROM tasks WHERE id = ?
         * Giải thích: Truy vấn để lấy task có id bằng với tham số truyền vào.
         * Ví dụ: Nếu id = 3 => truy vấn trả về task có id là 3.
         */
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Cập nhật một task theo ID
    public function update($id, $title, $description, $status, $due_date = null)
    {
        /*
         * SQL: UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ?, updated_at = NOW() WHERE id = ?
         * Giải thích: Cập nhật thông tin task gồm title, description, status, due_date, và thời gian cập nhật.
         * Ví dụ:
         * id = 2, title = "Fix bug B", updated_at = tự động ghi nhận thời gian hiện tại của hệ thống.
         */
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $status, $due_date, $id);
        return $stmt->execute();
    }

    // Xoá một task theo ID
    public function delete($id)
    {
        /*
         * SQL: DELETE FROM tasks WHERE id = ?
         * Giải thích: Xoá task có id tương ứng khỏi bảng tasks.
         * Ví dụ: Nếu id = 4 thì dòng có id=4 sẽ bị xoá khỏi cơ sở dữ liệu.
         */
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
