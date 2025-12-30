<?php
namespace App\Models;

use App\Core\Database;

class Notification
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getUnread($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 10");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getUnreadCount($userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function create($data)
    {
        $sql = "INSERT INTO notifications (user_id, title, message, type, link) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['user_id'],
            $data['title'],
            $data['message'] ?? null,
            $data['type'] ?? 'info',
            $data['link'] ?? null
        ]);
    }

    public function markAsRead($id, $userId)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = ? AND user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id, $userId]);
    }

    public function markAllAsRead($userId)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$userId]);
    }
}
