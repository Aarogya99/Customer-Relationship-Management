<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class LoginController extends AuthController
{
    public function index()
    {
        $this->login();
    }
}
