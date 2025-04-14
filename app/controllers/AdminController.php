<?php
require_once '../app/models/Task.php';

class AdminController
{
    private $taskModel;

    public function __construct()
    {
        // Khởi tạo model Task để thao tác với cơ sở dữ liệu
        $this->taskModel = new Task();
    }

    // Hiển thị trang dashboard cho admin
    public function dashboard()
    {
        // Gọi view: /app/views/admin/dashboard.php
        $this->render('admin/dashboard');
    }

    // Quản lý danh sách task
    public function task_manager()
    {
        // Lấy tất cả các task từ database thông qua model
        $tasks = $this->taskModel->getAll();

        // Gọi view và truyền dữ liệu task vào view
        $this->render('admin/task_manager', compact('tasks'));
    }

    // Tạo task mới
    public function create_task()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gọi hàm create trong model Task để tạo task mới
            $success = $this->taskModel->create(
                $_POST['title'],                        // Tiêu đề task
                $_POST['description'],                  // Mô tả
                $_POST['status'] ?? 'pending',          // Trạng thái mặc định nếu không có
                $_POST['due_date'] ?? null              // Ngày đến hạn (có thể null)
            );

            // Điều hướng hoặc hiển thị lỗi tùy thuộc vào kết quả
            return $this->redirectOrError($success, 'task_manager', 'Lỗi khi thêm task');
        }

        // Nếu là GET request, hiển thị form tạo task
        $this->render('admin/create_task');
    }

    // Chỉnh sửa task
    public function edit_task()
    {
        // Lấy ID task từ query string
        $id = $_GET['id'] ?? null;
        if (!$id) return $this->error("ID không hợp lệ");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Cập nhật thông tin task
            $success = $this->taskModel->update(
                $id,
                $_POST['title'],
                $_POST['description'],
                $_POST['status'] ?? 'pending',
                $_POST['due_date'] ?? null
            );
            return $this->redirectOrError($success, 'task_manager', 'Lỗi khi cập nhật task');
        }

        // Nếu là GET request, tìm thông tin task để hiển thị lên form
        $task = $this->taskModel->find($id);
        $this->render('admin/edit_task', compact('task'));
    }

    // Xoá task
    public function delete_task()
    {
        // Lấy ID task từ query string và gọi hàm xoá
        $id = $_GET['id'] ?? null;
        $success = $id ? $this->taskModel->delete($id) : false;

        // Điều hướng hoặc hiển thị lỗi
        return $this->redirectOrError($success, 'task_manager', 'Lỗi khi xóa task');
    }

    // Hàm dùng chung để render view
    private function render($view, $data = [])
    {
        extract($data); // Biến hoá mảng $data thành biến đơn để sử dụng trong view
        require "../app/views/{$view}.php"; // Nhúng file view tương ứng
    }

    // Hàm điều hướng sau khi thao tác xong hoặc hiển thị lỗi
    private function redirectOrError($success, $targetPage, $errorMessage)
    {
        if ($success) {
            // Chuyển hướng nếu thao tác thành công
            header("Location: admin.php?page=$targetPage");
            exit;
        } else {
            // Hiển thị lỗi nếu thao tác thất bại
            echo "<p style='color:red;'>$errorMessage</p>";
        }
    }

    // Hàm hiển thị lỗi chung
    private function error($message)
    {
        echo "<p style='color:red;'>$message</p>";
    }
}
