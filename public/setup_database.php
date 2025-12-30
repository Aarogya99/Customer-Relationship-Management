<?php
// public/setup_database.php

define('APPROOT', dirname(__DIR__) . '/app');
require_once dirname(__DIR__) . '/app/config/config.php';
require_once dirname(__DIR__) . '/app/core/Database.php';

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
        company VARCHAR(255),
        source VARCHAR(100) DEFAULT 'Website',
        status VARCHAR(50) DEFAULT 'New',
        notes TEXT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($sqlLeads);
    echo "Table 'leads' created.<br>";

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
    )";
    $db->exec($sqlDeals);
    echo "Table 'deals' created.<br>";

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
    echo "Table 'tasks' created.<br>";

    echo "Done.";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
