<?php
namespace App\Models;

use App\Core\Database;

class Deal
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        // Join with customers to get customer name
        $sql = "SELECT d.*, c.name as customer_name 
                FROM deals d 
                LEFT JOIN customers c ON d.customer_id = c.id 
                ORDER BY d.created_at DESC";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO deals (name, customer_id, stage, amount, close_date, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['customer_id'] ?: null, // Handle null if empty string
            $data['stage'] ?? 'Prospect',
            $data['amount'] ?? 0,
            $data['close_date'] ?? null,
            $_SESSION['user_id'] ?? null
        ]);
    }

    public function updateStage($id, $stage)
    {
        $sql = "UPDATE deals SET stage = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$stage, $id]);
    }

    public function count()
    {
        return $this->pdo->query("SELECT COUNT(*) FROM deals")->fetchColumn();
    }

    public function countActive()
    {
        return $this->pdo->query("SELECT COUNT(*) FROM deals WHERE stage NOT IN ('Won', 'Lost')")->fetchColumn();
    }
}
