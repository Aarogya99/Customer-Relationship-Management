<?php
require_once __DIR__ . '/../config/database.php';

try {
    $config = require __DIR__ . '/../config/database.php';
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Hash for 'admin123'
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $email = 'admin@example.com';

    // Check if user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $exists = $stmt->fetch();

    if ($exists) {
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
        $stmt->execute([$hash, $email]);
        echo "<div style='font-family: sans-serif; padding: 20px; background: #dcfce7; color: #166534; border-radius: 8px; max-width: 500px; margin: 50px auto; border: 1px solid #86efac;'>
            <h2 style='margin-top:0'>Success!</h2>
            <p>Password for <strong>$email</strong> has been reset to: <strong>$password</strong></p>
            <p><a href='/login' style='color: #166534; font-weight: bold;'>Go to Login Page</a></p>
        </div>";
    } else {
        // Create user if deleted
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->execute(['Admin User', $email, $hash, 'admin']);
        echo "<div style='font-family: sans-serif; padding: 20px; background: #dcfce7; color: #166534; border-radius: 8px; max-width: 500px; margin: 50px auto; border: 1px solid #86efac;'>
            <h2 style='margin-top:0'>User Created!</h2>
            <p>User <strong>$email</strong> created with password: <strong>$password</strong></p>
            <p><a href='/login' style='color: #166534; font-weight: bold;'>Go to Login Page</a></p>
        </div>";
    }

} catch (PDOException $e) {
    echo "<div style='font-family: sans-serif; padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 8px; max-width: 500px; margin: 50px auto; border: 1px solid #fca5a5;'>
        <h2 style='margin-top:0'>Error</h2>
        <p>Database connection failed.</p>
        <pre>" . $e->getMessage() . "</pre>
    </div>";
}
