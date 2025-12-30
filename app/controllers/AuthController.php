<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        if ($this->isPost()) {
            // Validator::verifyCsrf(); 

            $email = Validator::sanitize($_POST['email']);
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if (!$user) {
                $this->view('auth/login', ['error' => 'Invalid email or password']);
                return;
            }

            if (password_verify($password, $user['password_hash'])) {
                // Login Success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['name'];

                $this->redirect('dashboard');
            } else {
                $this->view('auth/login', ['error' => 'Invalid email or password']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('login');
    }
}