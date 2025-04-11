<?php
require_once '../app/models/Task.php';

class AdminController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }
    // 
    public function dashboard()
    {
        $this->render('admin/dashboard');
    }
    // 
    public function task_manager()
    {
        $tasks = $this->taskModel->getAll();
        $this->render('admin/task_manager', ['tasks' => $tasks]);
    }
    // POST
    public function create_task()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'] ?? 'pending';
            $due_date = $_POST['due_date'] ?? null;

            if ($this->taskModel->create($title, $description, $status, $due_date)) {
                header("Location: admin.php?page=task_manager");
                exit;
            } else {
                echo "<p style='color:red;'>Lỗi khi thêm task</p>";
            }
        }

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
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'] ?? 'pending';
            $due_date = $_POST['due_date'] ?? null;

            if ($this->taskModel->update($id, $title, $description, $status, $due_date)) {
                header("Location: admin.php?page=task_manager");
                exit;
            } else {
                echo "<p style='color:red;'>Lỗi khi cập nhật task</p>";
            }
        }

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
    // 
    private function render($view, $data = [])
    {
        extract($data);
        require "../app/views/{$view}.php";
    }
}
