<?php
// debug_login.php in public folder
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Login</h1>";

// 1. Check Config
try {
    $config_path = __DIR__ . '/../config/database.php';
    if (!file_exists($config_path)) {
        die("❌ Config file not found at: $config_path");
    }
    $config = require $config_path;
    echo "✅ Config loaded.<br>";
} catch (Exception $e) {
    die("❌ Error checking config: " . $e->getMessage());
}

// 2. Check DB Connection
try {
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Database connection successful.<br>";
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage() . "<br>Check your config/database.php");
}

// 3. Check User
$email = 'admin@example.com';
$password_input = 'admin123';

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "❌ User '$email' NOT FOUND in database.<br>";
    echo "Please run: <code>INSERT INTO users (name, email, password_hash, role) VALUES ('Admin', 'admin@example.com', '" . password_hash('admin123', PASSWORD_BCRYPT) . "', 'admin');</code>";
} else {
    echo "✅ User '$email' found.<br>";
    echo "Stored Hash: " . htmlspecialchars($user['password_hash']) . "<br>";

    // 4. Verify Password
    if (password_verify($password_input, $user['password_hash'])) {
        echo "✅ password_verify() PASSED for '$password_input'.<br>";
        echo "<strong>Login should work.</strong> If it fails on the real page, it might be Sessions or CSRF.<br>";

        // Check Session
        session_start();
        $_SESSION['test'] = 'test_value';
        echo "Session Status: " . session_status() . "<br>";
        echo "Session ID: " . session_id() . "<br>";
    } else {
        echo "❌ password_verify() FAILED.<br>";
        echo "Updating password now...<br>";

        // Auto-fix
        $new_hash = password_hash($password_input, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $update->execute([$new_hash, $user['id']]);
        echo "✅ Password updated to match '$password_input'. Try logging in now.";
    }
}
?>