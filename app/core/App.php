<?php

namespace App\Core;

class App
{
    protected $controller = 'DashboardController'; // Default controller
    protected $method = 'index';             // Default method
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. Controller
        // 1. Controller
        if (isset($url[0])) {
            // Manual Route Mapping for clearer URLs
            if ($url[0] == 'login') {
                $this->controller = 'AuthController';
                $this->method = 'login';
                unset($url[0]);
            } elseif ($url[0] == 'logout') {
                $this->controller = 'AuthController';
                $this->method = 'logout';
                unset($url[0]);
            } else {
                // Convert URL-slug to PascalCase Controller Name
                // e.g. "customer-service" -> "CustomerServiceController"
                $potentialController = ucfirst($url[0]) . 'Controller';

                if (file_exists('../app/controllers/' . $potentialController . '.php')) {
                    $this->controller = $potentialController;
                    unset($url[0]);
                }
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        // Namespace adjustment
        $this->controller = 'App\\Controllers\\' . $this->controller;
        $this->controller = new $this->controller;

        // 2. Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Safety Fallback: If method doesn't exist (e.g. logging into Dashboard which has no 'login' method), default to index
        if (!method_exists($this->controller, $this->method)) {
            $this->method = 'index';
        }

        // 3. Params
        $this->params = $url ? array_values($url) : [];

        // Call callback
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
