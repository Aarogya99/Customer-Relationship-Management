<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Lead;
use App\Core\Validator;

class LeadController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $leadModel = new Lead();
        $leads = $leadModel->getAll();
        $this->view('leads/index', ['leads' => $leads]);
    }

    public function create()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();

            $data = [
                'name' => Validator::sanitize($_POST['name']),
                'email' => Validator::sanitize($_POST['email']),
                'phone' => Validator::sanitize($_POST['phone']),
                'company' => Validator::sanitize($_POST['company']),
                'source' => Validator::sanitize($_POST['source']),
                'status' => 'New',
                'notes' => Validator::sanitize($_POST['notes'])
            ];

            $leadModel = new Lead();
            if ($leadModel->create($data)) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'New Lead Added',
                    'message' => "You added {$data['name']} from {$data['company']}",
                    'type' => 'success'
                ]);
                $this->redirect('lead');
            } else {
                $this->view('leads/create', ['error' => 'Failed to create lead']);
            }
        } else {
            $this->view('leads/create');
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('lead');
        }

        $leadModel = new Lead();
        $lead = $leadModel->findById($id);

        if (!$lead) {
            die("Lead not found");
        }

        $this->view('leads/edit', ['lead' => $lead]);
    }

    public function update()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();

            $id = $_POST['id'];
            $data = [
                'name' => Validator::sanitize($_POST['name']),
                'email' => Validator::sanitize($_POST['email']),
                'phone' => Validator::sanitize($_POST['phone']),
                'company' => Validator::sanitize($_POST['company']),
                'source' => Validator::sanitize($_POST['source']),
                'status' => Validator::sanitize($_POST['status']),
                'notes' => Validator::sanitize($_POST['notes'])
            ];

            $leadModel = new Lead();
            if ($leadModel->update($id, $data)) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'Lead Updated',
                    'message' => "Lead {$data['name']} was updated.",
                    'type' => 'info'
                ]);
                $this->redirect('lead');
            } else {
                $lead = $leadModel->findById($id);
                $this->view('leads/edit', ['lead' => $lead, 'error' => 'Failed to update lead']);
            }
        }
    }

    public function delete()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();
            $id = $_POST['id'];

            $leadModel = new Lead();
            $leadModel->delete($id);

            $this->redirect('lead');
        }
    }
}
