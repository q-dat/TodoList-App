<?php
require_once __DIR__ . '/../../app/models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();
    }

    // Danh sách task (ví dụ cho API)
    public function index()
    {
        $tasks = $this->taskModel->getAll();
        header('Content-Type: application/json');
        echo json_encode($tasks);
    }

    // Tạo task mới (ví dụ cho API)
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';

            $success = $this->taskModel->create($title, $description);

            echo json_encode([
                'success' => $success,
                'message' => $success ? 'Task created' : 'Error creating task'
            ]);
        }
    }
}
