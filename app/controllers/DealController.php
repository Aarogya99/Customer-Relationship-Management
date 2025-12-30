<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Deal;
use App\Models\Customer;
use App\Core\Validator;

class DealController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $dealModel = new Deal();
        $deals = $dealModel->getAll();

        // Group by stage for Kanban
        $pipeline = [
            'Prospect' => [],
            'Negotiation' => [],
            'Won' => [],
            'Lost' => []
        ];

        foreach ($deals as $deal) {
            $stage = $deal['stage'];
            if (isset($pipeline[$stage])) {
                $pipeline[$stage][] = $deal;
            } else {
                // Fallback for custom or unknown stages
                $pipeline['Prospect'][] = $deal;
            }
        }

        $this->view('deals/index', ['pipeline' => $pipeline]);
    }

    public function create()
    {
        if ($this->isPost()) {
            Validator::verifyCsrf();

            $data = [
                'name' => Validator::sanitize($_POST['name']),
                'customer_id' => $_POST['customer_id'],
                'amount' => str_replace(',', '', $_POST['amount']), // Remove commas
                'stage' => Validator::sanitize($_POST['stage']),
                'close_date' => $_POST['close_date']
            ];

            // Date Validation
            if ($data['close_date'] < date('Y-m-d')) {
                $customerModel = new Customer();
                $customers = $customerModel->getAll();
                $this->view('deals/create', ['error' => 'Expected close date cannot be in the past.', 'customers' => $customers]);
                return;
            }

            $dealModel = new Deal();
            if ($dealModel->create($data)) {
                // Notify User
                $notif = new \App\Models\Notification();
                $notif->create([
                    'user_id' => $_SESSION['user_id'],
                    'title' => 'Deal Created',
                    'message' => "New deal '{$data['name']}' in {$data['stage']} stage",
                    'type' => 'success'
                ]);
                $this->redirect('deal');
            } else {
                $customerModel = new Customer();
                $customers = $customerModel->getAll();
                $this->view('deals/create', ['error' => 'Failed to create deal', 'customers' => $customers]);
            }
        } else {
            $customerModel = new Customer();
            $customers = $customerModel->getAll();
            $this->view('deals/create', ['customers' => $customers]);
        }
    }
}
