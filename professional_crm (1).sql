-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 08:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `professional_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `created_at`) VALUES
(1, 1, 'LOGIN', 'Admin logged in', NULL, '2025-12-28 07:50:52'),
(2, 1, 'CREATE_CUSTOMER', 'Created customer Acme Corp', NULL, '2025-12-28 07:50:52'),
(3, NULL, 'LOGIN', 'John Sales logged in', NULL, '2025-12-28 07:50:52'),
(4, NULL, 'UPDATE_LEAD', 'Changed status to Qualified for Security Upgrade', NULL, '2025-12-28 07:50:52'),
(5, 1, 'CREATE_USER', 'Created new staff member Sarah', NULL, '2025-12-28 07:50:52'),
(6, NULL, 'LOGIN', 'Sarah Support logged in', NULL, '2025-12-28 07:50:52'),
(7, 1, 'LOGIN', 'User logged in successfully.', '::1', '2025-12-28 08:11:04'),
(8, 1, 'CREATE_CUSTOMER', 'Created customer: Aarogya Adhikari', '::1', '2025-12-28 08:12:24'),
(9, 1, 'LOGIN', 'User logged in successfully.', '::1', '2025-12-28 08:33:21'),
(10, 1, 'DELETE_USER', 'Deleted user 2', '::1', '2025-12-28 14:23:54'),
(11, 1, 'UPDATE_USER', 'Updated user 7', '::1', '2025-12-28 15:08:39'),
(12, 1, 'DELETE_USER', 'Deleted user 3', '::1', '2025-12-28 15:08:50'),
(13, 1, 'UPDATE_USER', 'Updated user 7', '::1', '2025-12-28 15:11:27'),
(14, 1, 'CREATE_CUSTOMER', 'Created customer: Sanjit Lama', '::1', '2025-12-29 13:35:54'),
(15, 1, 'DELETE_CUSTOMER', 'Deleted customer: Sanjit Lama', '::1', '2025-12-29 13:42:11'),
(16, 1, 'CREATE_CUSTOMER', 'Created customer: Sanjit Lama', '::1', '2025-12-29 13:42:55'),
(17, 1, 'DELETE_CUSTOMER', 'Deleted customer: CyberDyne', '::1', '2025-12-29 13:43:03'),
(18, 1, 'DELETE_CUSTOMER', 'Deleted customer: Acme Corp', '::1', '2025-12-29 13:43:08'),
(19, 1, 'DELETE_CUSTOMER', 'Deleted customer: Wayne Ent', '::1', '2025-12-29 13:43:11'),
(20, 1, 'DELETE_CUSTOMER', 'Deleted customer: LexCorp', '::1', '2025-12-29 13:43:15'),
(21, 1, 'DELETE_CUSTOMER', 'Deleted customer: Stark Ind', '::1', '2025-12-29 13:43:18'),
(22, 1, 'DELETE_CUSTOMER', 'Deleted customer: Umbrella Corp', '::1', '2025-12-29 13:43:21'),
(23, 1, 'CREATE_CUSTOMER', 'Created customer: Abhinav Bhattarai', '::1', '2025-12-29 13:45:05'),
(24, 1, 'UPDATE_CUSTOMER', 'Updated customer: Abhinav Bhattarai', '::1', '2025-12-29 13:45:12'),
(25, 1, 'CREATE_CUSTOMER', 'Created customer: Suroz Bhandari', '::1', '2025-12-29 13:48:39'),
(26, 1, 'CREATE_CUSTOMER', 'Created customer: Rashik Moktan', '::1', '2025-12-29 13:49:55'),
(27, 1, 'UPDATE_CUSTOMER', 'Updated customer: Rashik Moktan', '::1', '2025-12-29 13:50:08'),
(28, 1, 'UPDATE_CUSTOMER', 'Updated customer: Suroz Bhandari', '::1', '2025-12-29 13:52:28'),
(29, 1, 'UPDATE_CUSTOMER', 'Updated customer: Suroz Bhandari', '::1', '2025-12-29 13:52:35'),
(30, 1, 'UPDATE_USER', 'Updated user 7', '::1', '2026-01-02 14:33:57'),
(31, 1, 'UPDATE_USER', 'Updated user 4', '::1', '2026-01-04 07:51:42'),
(32, 1, 'DELETE_USER', 'Deleted user 5', '::1', '2026-01-04 07:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `company`, `address`, `created_by`, `created_at`, `updated_at`) VALUES
(7, 'Aarogya Adhikari', 'arogyaadhikari@gmail.com', '9876543210', 'Adhikari Traders', 'Budhanilkantha', 1, '2025-12-28 08:12:24', '2025-12-28 08:12:24'),
(9, 'Sanjit Lama', 'sanjit@gmail.com', '9841783452', 'Shivamaya Cosmetics', 'Thali', 1, '2025-12-29 13:42:55', '2025-12-29 13:42:55'),
(10, 'Abhinav Bhattarai', 'abhinav543@gmail.com', '9878987766', 'Bhattarai Garments', 'Banasthali', 1, '2025-12-29 13:45:05', '2025-12-29 13:45:12'),
(11, 'Suroz Bhandari', 'bhandari11@gmail.com', '9861876533', 'Tiger Eyewears', 'Tinchuli', 1, '2025-12-29 13:48:39', '2025-12-29 13:52:35'),
(12, 'Rashik Moktan', 'rashik96@gmail.com', '9841893543', 'Moktan Jwellers', 'Boudha', 1, '2025-12-29 13:49:55', '2025-12-29 13:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `stage` varchar(50) DEFAULT 'Prospect',
  `amount` decimal(10,2) DEFAULT 0.00,
  `close_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `name`, `customer_id`, `stage`, `amount`, `close_date`, `created_by`, `created_at`) VALUES
(1, 'Website Project', 7, 'Won', 9000.00, '2026-01-01', 1, '2025-12-28 14:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `deals_backup_1766930835`
--

CREATE TABLE `deals_backup_1766930835` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `amount` decimal(15,2) DEFAULT 0.00,
  `stage` enum('Prospect','Negotiation','Closed-Won','Closed-Lost') DEFAULT 'Prospect',
  `expected_close_date` date DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `source` varchar(100) DEFAULT 'Website',
  `status` varchar(50) DEFAULT 'New',
  `notes` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `email`, `phone`, `company`, `source`, `status`, `notes`, `created_by`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', '555-0123', 'Acme Corp', 'Website', 'New', NULL, NULL, '2025-12-28 14:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `leads_backup_1766930759`
--

CREATE TABLE `leads_backup_1766930759` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `status` enum('New','Contacted','Qualified','Lost','Converted') DEFAULT 'New',
  `source` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `assigned_to` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(50) DEFAULT 'info',
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `link`, `is_read`, `created_at`) VALUES
(1, 1, 'Welcome to Pro CRM', 'This is your first notification.', 'success', '#', 1, '2025-12-28 14:12:36'),
(2, 1, 'Deal Created', 'New deal \'Website Project\' in Won stage', 'success', NULL, 0, '2025-12-28 14:17:06'),
(3, 1, 'Task Updated', 'Task: Review Q5 Budget updated', 'info', NULL, 0, '2025-12-29 14:01:59'),
(4, 7, 'Task Updated', 'Task: Review the A15 Budget updated', 'info', NULL, 1, '2025-12-29 14:20:45'),
(5, 7, 'Task Updated', 'Task: Review the A15 Budget updated', 'info', NULL, 1, '2025-12-29 14:20:58'),
(6, 7, 'Task Updated', 'Task: Review the A15 Budget updated', 'info', NULL, 1, '2025-12-29 14:21:08'),
(7, 1, 'New Task Assigned', 'Task: Verify the website Project', 'info', NULL, 0, '2026-01-04 07:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `priority` varchar(50) DEFAULT 'Medium',
  `due_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `priority`, `due_date`, `created_by`, `created_at`) VALUES
(1, 'Review the A15 Budget', 'Show the reports', 'In Progress', 'Medium', '2025-12-31', NULL, '2025-12-28 14:09:39'),
(2, 'Verify the website Project', 'ASAP', 'Pending', 'Medium', '2026-01-20', 1, '2026-01-04 07:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `tasks_backup_1766930979`
--

CREATE TABLE `tasks_backup_1766930979` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('Pending','In-Progress','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks_backup_1766930979`
--

INSERT INTO `tasks_backup_1766930979` (`id`, `title`, `description`, `assigned_to`, `due_date`, `status`, `created_at`) VALUES
(1, 'Follow up with Wayne Ent', 'Send updated contract draft', NULL, '2025-12-28', 'Pending', '2025-12-28 07:50:52'),
(2, 'Prepare Q3 Report', 'Gather all sales data', 1, '2026-01-02', 'In-Progress', '2025-12-28 07:50:52'),
(3, 'Call LexCorp', 'Discuss hosting requirements', NULL, '2025-12-29', 'Pending', '2025-12-28 07:50:52'),
(4, 'Invoice Stark Ind', 'Send final invoice for equipment', 4, '2025-12-27', 'Completed', '2025-12-28 07:50:52'),
(5, 'Update CRM details', 'Clean up lead sources', NULL, '2025-12-28', 'Pending', '2025-12-28 07:50:52'),
(6, 'Schedule Demo with CyberDyne', 'Show new AI features', NULL, '2025-12-31', 'Pending', '2025-12-28 07:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', '$2y$10$BUo/Ihgx1vvTNZazkCNIRu6SluOXNn9Jxs6RheutI4FFTOawOSCv2', 'admin', '2025-12-28 07:50:52'),
(4, 'Adhikari Manager', 'adhikari@example.com', '$2y$10$yET5ycnH/V7tqBNt0PQrPO9XYZhjPsWefc7TDykPUy.NMzZyNfkaG', 'admin', '2025-12-28 07:50:52'),
(7, 'Test Sales', 'staff@example.com', '$2y$10$LYzXalRYGJa7OlOsxlYJb.JJUIb4z43yvxxh/GnUp9PfSHi2/no2y', 'staff', '2025-12-28 14:57:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals_backup_1766930835`
--
ALTER TABLE `deals_backup_1766930835`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads_backup_1766930759`
--
ALTER TABLE `leads_backup_1766930759`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_backup_1766930979`
--
ALTER TABLE `tasks_backup_1766930979`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deals_backup_1766930835`
--
ALTER TABLE `deals_backup_1766930835`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads_backup_1766930759`
--
ALTER TABLE `leads_backup_1766930759`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks_backup_1766930979`
--
ALTER TABLE `tasks_backup_1766930979`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `deals_backup_1766930835`
--
ALTER TABLE `deals_backup_1766930835`
  ADD CONSTRAINT `deals_backup_1766930835_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deals_backup_1766930835_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `leads_backup_1766930759`
--
ALTER TABLE `leads_backup_1766930759`
  ADD CONSTRAINT `leads_backup_1766930759_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_backup_1766930759_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tasks_backup_1766930979`
--
ALTER TABLE `tasks_backup_1766930979`
  ADD CONSTRAINT `tasks_backup_1766930979_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
