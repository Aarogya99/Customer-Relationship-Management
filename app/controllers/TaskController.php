<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;
use App\Core\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $taskModel = new Task();
        $tasks = $taskModel->getAll();
        $this->view('tasks/index', ['tasks' => $tasks]);
    }

    public function create()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();

            $data = [
                'title' => Validator::sanitize($_POST['title']),
                'description' => Validator::sanitize($_POST['description']),
                'priority' => Validator::sanitize($_POST['priority']),
                'due_date' => $_POST['due_date'],
                'status' => 'Pending'
            ];

            // Date validation
            if ($data['due_date'] < date('Y-m-d')) {
                $this->view('tasks/create', ['error' => 'Due date cannot be in the past']);
                return;
            }

            $taskModel = new Task();
            if ($taskModel->create($data)) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'New Task Assigned',
                    'message' => "Task: {$data['title']}",
                    'type' => 'info'
                ]);
                $this->redirect('task');
            } else {
                $this->view('tasks/create', ['error' => 'Failed to create task']);
            }
        } else {
            $this->view('tasks/create');
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('task');
        }

        $taskModel = new Task();
        $task = $taskModel->findById($id);

        if (!$task) {
            die("Task not found");
        }

        $this->view('tasks/edit', ['task' => $task]);
    }

    public function update()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();

            $id = $_POST['id'];
            $data = [
                'title' => Validator::sanitize($_POST['title']),
                'description' => Validator::sanitize($_POST['description']),
                'priority' => Validator::sanitize($_POST['priority']),
                'due_date' => $_POST['due_date'],
                'status' => Validator::sanitize($_POST['status'])
            ];

            // Date validation
            if ($data['due_date'] < date('Y-m-d')) {
                $taskModel = new Task();
                $task = $taskModel->findById($id);
                $this->view('tasks/edit', ['task' => $task, 'error' => 'Due date cannot be in the past']);
                return;
            }

            $taskModel = new Task();
            if ($taskModel->update($id, $data)) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'Task Updated',
                    'message' => "Task: {$data['title']} updated",
                    'type' => 'info'
                ]);
                $this->redirect('task');
            } else {
                $task = $taskModel->findById($id);
                $this->view('tasks/edit', ['task' => $task, 'error' => 'Failed to update task']);
            }
        }
    }

    public function delete()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();
            $id = $_POST['id'];

            $taskModel = new Task();
            $taskModel->delete($id);

            $this->redirect('task');
        }
    }

    public function complete()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();
            $id = $_POST['id'];

            $taskModel = new Task();
            if ($taskModel->updateStatus($id, 'Completed')) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'Task Completed',
                    'message' => "Task marked as completed",
                    'type' => 'success'
                ]);
            }
            $this->redirect('task');
        }
    }
}
