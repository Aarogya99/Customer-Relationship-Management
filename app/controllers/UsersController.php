<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
        if ($_SESSION['user_role'] !== 'admin') {
            die('Access Denied: Admins Only');
        }
    }

    public function index()
    {
        $userModel = new User();
        // Since we might not have updated User.php, let's implement getAll locally logic or assume updated
        // For robustness, I'll provide the updated model code too.
        if (method_exists($userModel, 'getAll')) {
            $users = $userModel->getAll();
        } else {
            // Fallback if model not updated
            $users = [];
        }
        $this->view('users/index', ['users' => $users]);
    }

    public function create()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();
            $userModel = new User();
            if (
                $userModel->create(
                    Validator::sanitize($_POST['name']),
                    Validator::sanitize($_POST['email']),
                    $_POST['password'],
                    $_POST['role']
                )
            ) {
                $userModel->logActivity($_SESSION['user_id'], 'CREATE_USER', "Created user " . $_POST['email']);
                $this->redirect('users');
            } else {
                $this->view('users/create', ['error' => 'Failed to create user']);
            }
        } else {
            $this->view('users/create');
        }
    }
    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->findById($id);

        if (!$user) {
            die('User not found');
        }

        if ($this->isPost()) {
            Validator::verifyCsrf();

            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            if (
                $userModel->update(
                    $id,
                    Validator::sanitize($_POST['name']),
                    Validator::sanitize($_POST['email']),
                    $_POST['role'],
                    $password
                )
            ) {
                // Log activity
                $userModel->logActivity($_SESSION['user_id'], 'UPDATE_USER', "Updated user $id");
                $this->redirect('users');
            } else {
                $this->view('users/edit', ['user' => $user, 'error' => 'Failed to update user']);
            }
        } else {
            $this->view('users/edit', ['user' => $user]);
        }
    }

    public function delete($id)
    {
        // Prevent deleting own account
        if ($id == $_SESSION['user_id']) {
            die("You cannot delete your own account.");
        }

        $userModel = new User();
        if ($userModel->delete($id)) {
            $userModel->logActivity($_SESSION['user_id'], 'DELETE_USER', "Deleted user $id");
        }
        $this->redirect('users');
    }
}
