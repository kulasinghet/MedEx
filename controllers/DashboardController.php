<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class DashboardController extends Controller
{

    public function redirectDashboard(Request $request)
    {


        if ($request->isGet()) {


            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'pharmacy') {
                return $this->render('pharmacy/dashboard.php');
            } elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 'supplier') {
                return $this->render('supplier/dashboard.php');
            } elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 'lab') {
                return $this->render('lab/dashboard.php');
            } elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 'delivery') {
                return $this->render('delivery/dashboard.php');
            } elseif (isset($_SESSION['userType']) && $_SESSION['userType'] == 'employee') {
                return $this->render('employee/dashboard.php');
            } else {
                session_abort();
                return header('Location: /login');
            }
        }
    }
}
