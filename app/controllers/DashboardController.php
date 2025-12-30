<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Deal;
use App\Models\Task;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Protected route
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        // Fetch Stats
        $customerModel = $this->model('Customer');
        $totalCustomers = $customerModel->count();

        // Lead Stats
        $leadModel = $this->model('Lead');
        $totalLeads = $leadModel->count();

        // Deal Stats
        $dealModel = $this->model('Deal');
        $activeDeals = $dealModel->countActive(); // Only open deals

        // Task Stats
        $taskModel = $this->model('Task');
        $pendingTasks = $taskModel->countPending();

        $stats = [
            'total_customers' => $totalCustomers,
            'total_leads' => $totalLeads,
            'active_deals' => $activeDeals,
            'pending_tasks' => $pendingTasks
        ];

        $this->view('dashboard/index', [
            'name' => $_SESSION['user_name'] ?? 'User',
            'stats' => $stats
        ]);
    }
}