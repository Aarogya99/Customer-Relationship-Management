<?php

namespace App\Core;

class Controller
{
    public function model($model)
    {
        // Require model file
        $modelClass = 'App\\Models\\' . $model;
        // Instantiate model
        return new $modelClass();
    }

    public function view($view, $data = [])
    {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            // Extract data for view to use
            extract($data);
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die("View does not exist: " . $view);
        }
    }

    protected function redirect($url)
    {
        if (defined('BASE_URL')) {
            $target = BASE_URL . '/' . ltrim($url, '/');
        } else {
            // Dynamic Base URL detection for subdirectories (e.g. /professional-crm/public)
            $base = dirname($_SERVER['SCRIPT_NAME']);
            // If we want to hide 'public', we should strip it here too, but BASE_URL is safer
            $base = rtrim($base, '/');
            $target = $base . '/' . ltrim($url, '/');
        }

        header("Location: " . $target);
        exit;
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
