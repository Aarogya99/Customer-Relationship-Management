<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Core\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $customerModel = new Customer();
        $customers = $customerModel->getAll();
        $this->view('customers/index', ['customers' => $customers]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('customer');
        }

        $customerModel = new Customer();
        $customer = $customerModel->findById($id);

        if (!$customer) {
            die("Customer not found");
        }

        $this->view('customers/show', ['customer' => $customer]);
    }

    public function create()
    {
        // Restrict to Admin only
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            die('Access Denied: Only Admins can create customers.');
        }

        if ($this->isPost()) {
            Validator::verifyCsrf();

            $name = Validator::sanitize($_POST['name']);
            $email = Validator::sanitize($_POST['email']);
            $phone = Validator::sanitize($_POST['phone']);
            $company = Validator::sanitize($_POST['company']);
            $address = Validator::sanitize($_POST['address']);

            // Email Format Validation
            if (!Validator::email($email)) {
                $this->view('customers/create', [
                    'error' => 'Invalid email address format.',
                    'old' => $_POST
                ]);
                return;
            }

            // Phone Validation
            if (!preg_match('/^9\d{9}$/', $phone)) {
                $this->view('customers/create', [
                    'error' => 'Invalid Phone Number. Must be 10 digits and start with 9 (Nepali format).',
                    'old' => $_POST
                ]);
                return;
            }

            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'address' => $address
            ];

            $customerModel = new Customer();

            // Uniqueness Validation
            if ($customerModel->findByEmail($email)) {
                $this->view('customers/create', [
                    'error' => 'Email address already exists.',
                    'old' => $_POST
                ]);
                return;
            }

            if ($customerModel->findByPhone($phone)) {
                $this->view('customers/create', [
                    'error' => 'Phone number already exists.',
                    'old' => $_POST
                ]);
                return;
            }

            if ($customerModel->create($data)) {
                // Log activity
                (new User())->logActivity($_SESSION['user_id'], 'CREATE_CUSTOMER', "Created customer: {$data['name']}");
                $this->redirect('customer');
            } else {
                $this->view('customers/create', ['error' => 'Failed to create customer', 'old' => $_POST]);
            }
        } else {
            $this->view('customers/create');
        }
    }

    public function edit()
    {
        // Restrict to Admin only
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            die('Access Denied: Only Admins can edit customers.');
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('customer');
        }

        $customerModel = new Customer();
        $customer = $customerModel->findById($id);

        if (!$customer) {
            die("Customer not found");
        }

        $this->view('customers/edit', ['customer' => $customer]);
    }

    public function update()
    {
        // Restrict to Admin only
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            die('Access Denied: Only Admins can update customers.');
        }

        if ($this->isPost()) {
            Validator::verifyCsrf();

            $id = $_POST['id'];
            $name = Validator::sanitize($_POST['name']);
            $email = Validator::sanitize($_POST['email']);
            $phone = Validator::sanitize($_POST['phone']);
            $company = Validator::sanitize($_POST['company']);
            $address = Validator::sanitize($_POST['address']);

            // Email Format Validation
            if (!Validator::email($email)) {
                $customerModel = new Customer();
                $customer = $customerModel->findById($id);
                $this->view('customers/edit', [
                    'customer' => $customer,
                    'error' => 'Invalid email address format.'
                ]);
                return;
            }

            // Phone Validation
            if (!preg_match('/^9\d{9}$/', $phone)) {
                $customerModel = new Customer();
                $customer = $customerModel->findById($id);
                $this->view('customers/edit', [
                    'customer' => $customer,
                    'error' => 'Invalid Phone Number. Must be 10 digits and start with 9 (Nepali format).'
                ]);
                return;
            }

            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'address' => $address
            ];

            $customerModel = new Customer();

            // Uniqueness Validation
            $existingEmail = $customerModel->findByEmail($email);
            if ($existingEmail && $existingEmail['id'] != $id) {
                $customer = $customerModel->findById($id);
                $this->view('customers/edit', [
                    'customer' => $customer,
                    'error' => 'Email address already exists.'
                ]);
                return;
            }

            $existingPhone = $customerModel->findByPhone($phone);
            if ($existingPhone && $existingPhone['id'] != $id) {
                $customer = $customerModel->findById($id);
                $this->view('customers/edit', [
                    'customer' => $customer,
                    'error' => 'Phone number already exists.'
                ]);
                return;
            }

            if ($customerModel->update($id, $data)) {
                // Log activity
                (new User())->logActivity($_SESSION['user_id'], 'UPDATE_CUSTOMER', "Updated customer: {$name}");
                $this->redirect('customer');
            } else {
                $customer = $customerModel->findById($id);
                $this->view('customers/edit', ['customer' => $customer, 'error' => 'Failed to update customer']);
            }
        }
    }

    public function delete()
    {
        // Restrict to Admin only
        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            die('Access Denied: Only Admins can delete customers.');
        }

        if ($this->isPost()) {
            Validator::verifyCsrf();
            $id = $_POST['id'];

            $customerModel = new Customer();
            $customer = $customerModel->findById($id);

            if ($customer) {
                $customerModel->delete($id);
                // Log activity
                (new User())->logActivity($_SESSION['user_id'], 'DELETE_CUSTOMER', "Deleted customer: {$customer['name']}");
            }

            $this->redirect('customer');
        }
    }
}