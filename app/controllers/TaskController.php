<?php
require_once __DIR__ . '/../../app/models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    // 📌 API: Lấy tất cả task
    public function index()
    {
        $tasks = $this->taskModel->getAll();
        $this->jsonSuccess($tasks, 'Lấy danh sách task thành công');
    }

    // 📌 API: Tạo task mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonError('Phương thức không được hỗ trợ', 405);
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = $_POST['status'] ?? 'pending';
        $due_date = $_POST['due_date'] ?? null;

        if (empty($title) || empty($description)) {
            return $this->jsonError('Tiêu đề và mô tả không được để trống', 400);
        }

        $success = $this->taskModel->create($title, $description, $status, $due_date);

        if ($success) {
            $this->jsonSuccess(null, 'Tạo task thành công', 201);
        } else {
            $this->jsonError('Không thể tạo task', 500);
        }
    }

    // 📌 API: Lấy chi tiết task theo ID
    public function show($id)
    {
        $task = $this->taskModel->find($id);

        if (!$task) {
            return $this->jsonError("Không tìm thấy task với ID = $id", 404);
        }

        $this->jsonSuccess($task, "Lấy chi tiết task ID = $id thành công");
    }

    // 📌 API: Cập nhật task theo ID
    public function update($id)
    {
        // Đọc dữ liệu từ PUT request
        parse_str(file_get_contents("php://input"), $_PUT);

        $title = trim($_PUT['title'] ?? '');
        $description = trim($_PUT['description'] ?? '');
        $status = $_PUT['status'] ?? 'pending';
        $due_date = $_PUT['due_date'] ?? null;

        if (empty($title) || empty($description)) {
            return $this->jsonError('Tiêu đề và mô tả không được để trống', 400);
        }

        $success = $this->taskModel->update($id, $title, $description, $status, $due_date);

        if ($success) {
            $this->jsonSuccess(null, "Cập nhật task ID = $id thành công");
        } else {
            $this->jsonError("Không thể cập nhật task ID = $id", 500);
        }
    }

    // 📌 API: Xóa task theo ID
    public function destroy($id)
    {
        $success = $this->taskModel->delete($id);

        if ($success) {
            $this->jsonSuccess(null, "Xóa task ID = $id thành công");
        } else {
            $this->jsonError("Không thể xóa task ID = $id", 500);
        }
    }

    // ✅ Trả kết quả thành công về dạng JSON
    private function jsonSuccess($data = null, $message = 'Thành công', $statusCode = 200)
    {
        $this->jsonResponse([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $statusCode);
    }

    // ❌ Trả lỗi về dạng JSON
    private function jsonError($message = 'Đã xảy ra lỗi', $statusCode = 400)
    {
        $this->jsonResponse([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }

    // ⚙️ Gửi dữ liệu JSON về client
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
