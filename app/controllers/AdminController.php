<?php
// Import model Task để sử dụng trong controller
require_once '../app/models/Task.php';

class AdminController
{
    private $taskModel;

    // Constructor: Khởi tạo đối tượng TaskModel
    public function __construct()
    {
        $this->taskModel = new Task();
    }

    // Hiển thị trang dashboard admin (không có dữ liệu truyền vào)
    public function dashboard()
    {
        $this->render('admin/dashboard');
    }

    // Hiển thị danh sách tất cả task (giao diện quản lý task)
    public function task_manager()
    {
        $tasks = $this->taskModel->getAll(); // Lấy toàn bộ task từ DB
        $this->render('admin/task_manager', ['tasks' => $tasks]); // Truyền vào view
    }
    // POST
    public function create_task()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'] ?? 'pending';
            $due_date = $_POST['due_date'] ?? null;

            // Gọi model để lưu vào DB
            if ($this->taskModel->create($title, $description, $status, $due_date)) {
                header("Location: admin.php?page=task_manager");
                exit;
            } else {
                echo "<p style='color:red;'>Lỗi khi thêm task</p>";
            }
        }

        // Hiển thị form tạo task (GET request)
        $this->render('admin/create_task');
    }
    // PUT
    public function edit_task()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID không hợp lệ";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'] ?? 'pending';
            $due_date = $_POST['due_date'] ?? null;

            // Gọi model để cập nhật
            if ($this->taskModel->update($id, $title, $description, $status, $due_date)) {
                header("Location: admin.php?page=task_manager");
                exit;
            } else {
                echo "<p style='color:red;'>Lỗi khi cập nhật task</p>";
            }
        }

        // Lấy dữ liệu task cần sửa để đổ vào form
        $task = $this->taskModel->find($id);
        $this->render('admin/edit_task', ['task' => $task]);
    }
    // DELETE
    public function delete_task()
    {
        $id = $_GET['id'] ?? null;
        if ($id && $this->taskModel->delete($id)) {
            header("Location: admin.php?page=task_manager");
            exit;
        } else {
            echo "<p style='color:red;'>Lỗi khi xóa task</p>";
        }
    }

    // Hàm render view tương tự như View::make()
    private function render($view, $data = [])
    {
        extract($data); // Tạo các biến từ array $data
        require "../app/views/{$view}.php"; // Load file view
    }
}
