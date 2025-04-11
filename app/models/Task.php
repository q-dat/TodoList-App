<?php
class Task
{
    private $db;
    public function __construct()
    {
        $this->db = getDbConnection();
    }
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM tasks ORDER BY id DESC");
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }
    public function create($title, $description, $status = 'pending', $due_date = null)
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, status, due_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $status, $due_date]);
    }
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function update($id, $title, $description, $status, $due_date = null)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, due_date = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$title, $description, $status, $due_date, $id]);
    }
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
