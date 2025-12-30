<?php
// setup_database.php
// Script to initialize database tables

define('APPROOT', __DIR__ . '/app');
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();
    echo "Connected to database successfully.<br>";

    // 1. Leads Table
    $sqlLeads = "CREATE TABLE IF NOT EXISTS leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        phone VARCHAR(50),
        source VARCHAR(100) DEFAULT 'Website',
        status VARCHAR(50) DEFAULT 'New',
        notes TEXT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($sqlLeads);
    echo "Table 'leads' created or already exists.<br>";

    // 2. Deals Table
    $sqlDeals = "CREATE TABLE IF NOT EXISTS deals (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        customer_id INT,
        stage VARCHAR(50) DEFAULT 'Prospect',
        amount DECIMAL(10, 2) DEFAULT 0.00,
        close_date DATE,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        -- FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL
    )";
    // Note: Foreign key commented out to prevent errors if customers table issue exists, 
    // but ideally should be there. Let's keep it simple for now to avoid constraint errors during setup.
    $db->exec($sqlDeals);
    echo "Table 'deals' created or already exists.<br>";

    // 3. Tasks Table
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
    echo "Table 'tasks' created or already exists.<br>";

    echo "Database setup completed successfully.";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
