<?php
namespace App\Models;

use App\Core\Database;

class Task
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY due_date ASC");
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tasks (title, description, status, priority, due_date, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'] ?? '',
            $data['status'] ?? 'Pending',
            $data['priority'] ?? 'Medium',
            $data['due_date'],
            $_SESSION['user_id'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tasks SET title = ?, description = ?, status = ?, priority = ?, due_date = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority'],
            $data['due_date'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE tasks SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function countPending()
    {
        return $this->pdo->query("SELECT COUNT(*) FROM tasks WHERE status != 'Completed'")->fetchColumn();
    }
}
