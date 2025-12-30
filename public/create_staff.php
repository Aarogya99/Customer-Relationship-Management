<?php
// public/create_staff.php
define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    $email = 'staff@example.com';
    $password = 'password123';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        // Update password just in case
        $update = $db->prepare("UPDATE users SET password_hash = ?, role = 'user' WHERE email = ?");
        $update->execute([$hash, $email]);
        echo "Updated existing user '$email' with password '$password'";
    } else {
        // Create
        $stmt = $db->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, 'user')");
        if ($stmt->execute(['Staff Member', $email, $hash])) {
            echo "Created new user '$email' with password '$password'";
        } else {
            echo "Failed to create user.";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
