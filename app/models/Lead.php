<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Lead
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM leads ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO leads (name, email, phone, company, source, status, notes, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company'],
            $data['source'] ?? 'Website',
            $data['status'] ?? 'New',
            $data['notes'] ?? '',
            $_SESSION['user_id'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE leads SET name = ?, email = ?, phone = ?, company = ?, source = ?, status = ?, notes = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company'],
            $data['source'],
            $data['status'],
            $data['notes'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM leads WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function count()
    {
        return $this->pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn();
    }
}
