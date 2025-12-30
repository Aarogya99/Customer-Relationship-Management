<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, name, email, role FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function create($name, $email, $password, $role)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hash, $role]);
    }

    public function update($id, $name, $email, $role, $password = null)
    {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = ?, email = ?, role = ?, password_hash = ? WHERE id = ?";
            $params = [$name, $email, $role, $hash, $id];
        } else {
            $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
            $params = [$name, $email, $role, $id];
        }
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // For logging
    public function logActivity($userId, $action, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO activity_logs (user_id, action, description, ip_address) VALUES (?, ?, ?, ?)");
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $stmt->execute([$userId, $action, $description, $ip]);
    }
}
