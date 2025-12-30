<?php
// public/fix_tasks.php
define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    // Check TASKS schema
    // We look for 'priority' column. If missing, it's the wrong schema.
    $stmt = $db->query("SHOW COLUMNS FROM tasks LIKE 'priority'");
    $hasPriority = $stmt->fetch();

    if (!$hasPriority) {
        $backupName = "tasks_backup_" . time();
        $db->exec("RENAME TABLE tasks TO $backupName");
        echo "Renamed legacy 'tasks' to '$backupName'.<br>";

        $sqlTasks = "CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            status VARCHAR(50) DEFAULT 'Pending',
            priority VARCHAR(50) DEFAULT 'Medium',
            due_date DATE,
            created_by INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($sqlTasks);
        echo "Created correct 'tasks' table.<br>";

        // Optional: Seed some data so it's not empty
        $stmt = $db->prepare("INSERT INTO tasks (title, description, priority, due_date) VALUES (?, ?, ?, ?)");
        $stmt->execute(['Review Q4 Budget', 'Analyze spending and prepare report', 'High', date('Y-m-d', strtotime('+3 days'))]);
        echo "Seeded 1 sample task.<br>";

    } else {
        echo "Tasks table schema appears correct.<br>";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
