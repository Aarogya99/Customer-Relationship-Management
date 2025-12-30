<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    public function read($id)
    {
        $notifModel = new Notification();
        $notifModel->markAsRead($id, $_SESSION['user_id']);

        // Redirect back (or to specific link if you want, but easier to just go back)
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('');
        }
        exit;
    }

    // AJAX Endpoint if needed later
    public function markAllRead()
    {
        $notifModel = new Notification();
        $notifModel->markAllAsRead($_SESSION['user_id']);

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('');
        }
        exit;
    }
}
