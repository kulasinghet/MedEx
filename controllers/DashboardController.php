<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class DashboardController extends Controller
{

    public function redirectDashboard(Request $request)
    {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['isEmployee'])) {
                if ($_SESSION['isEmployee']) {
                    return $this->render('employee/dashboard.php');
                }
            }
            return header('Location: /dashboard');

    }

}