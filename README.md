# Professional CRM System

A PHP MVC-based CRM system developed for BCA internship practice. This project is designed to help manage customer relationships, tracking leads, deals, and tasks efficiently.

## Features

- **Leads Management**: Add, view, and track potential clients.
- **Deals Management**: Monitor deals through various stages and track revenue.
- **Tasks Management**: Create and manage tasks with priorities and deadlines.
- **MVC Architecture**: Clean and scalable codebase utilizing the Model-View-Controller pattern.

## Requirements

- PHP 7.4 or higher
- MySQL / MariaDB

## Installation & Setup

1. **Clone the repository:**
   Clone this project into your local server directory or a preferred folder.

   ```bash
   git clone <repository-url>
   cd professional-crm
   ```

2. **Database Configuration:**
   Ensure you have a database created. Check `app/config/` for database configuration settings (e.g., `database.php` or `config.php`) and update your credentials.

3. **Initialize the Database:**
   Run the `setup_database.php` script to create the necessary tables (`leads`, `deals`, `tasks`).

   ```bash
   php setup_database.php
   ```

4. **Run the Application:**
   You can serve the application using PHP's built-in server utilizing the included `router.php` script:

   ```bash
   php -S localhost:8000 router.php
   ```

5. **Access the CRM:**
   Open your browser and navigate to:
   ```
   http://localhost:8000/
   ```

## Daily Progress

This repository is updated daily with improvements, fixes, and documentation as part of an ongoing internship project.
