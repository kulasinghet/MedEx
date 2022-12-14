<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class DashboardController extends Controller
{

    public function redirectDashboard(Request $request)
    {


        if ($request -> isGet()) {


            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
//
            if (isset($_SESSION['isPharmacy']) && $_SESSION['isPharmacy']) {
                return $this->render('pharmacy/dashboard.php');
            } elseif (isset($_SESSION['isSupplier']) && $_SESSION['isSupplier']) {
                return $this->render('supplier/dashboard.php');
            } elseif (isset($_SESSION['isLab']) && $_SESSION['isLab']) {
                return $this->render('lab/dashboard.php');
            } elseif (isset($_SESSION['isDelivery']) && $_SESSION['isDelivery']) {
                return $this->render('delivery/dashboard.php');
            } elseif (isset($_SESSION['isEmployee']) && $_SESSION['isEmployee']) {
                return $this->render('employee/dashboard.php');
            } else {
                session_abort();
                header('Location: /login');

            }
        }
    }

}