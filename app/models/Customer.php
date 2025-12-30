<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Customer
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM customers ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findByPhone($phone)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM customers WHERE phone = ?");
        $stmt->execute([$phone]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO customers (name, email, phone, company, address, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company'],
            $data['address'],
            $_SESSION['user_id'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE customers SET name = ?, email = ?, phone = ?, company = ?, address = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['company'],
            $data['address'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM customers WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function count()
    {
        return $this->pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
    }
}
