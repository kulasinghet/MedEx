<?php

namespace app\controllers;

use app\controllers\pharmacy\PharmacyOrderHistoryController;
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
                $pharmacyOrderHistoryController = new PharmacyOrderHistoryController();
                return $this->render('pharmacy/dashboard.php', [
                    'pendingOrders' => $pharmacyOrderHistoryController->getPendingOrdersCount($_SESSION['username']),
                    'acceptedOrders' => $pharmacyOrderHistoryController->getAcceptedOrdersCount($_SESSION['username']),
                    'rejectedOrders' => $pharmacyOrderHistoryController->getRejectedOrdersCount($_SESSION['username']),
                    'deliveredOrders' => $pharmacyOrderHistoryController->getDeliveredOrdersCount($_SESSION['username']),
                    'cancelledOrders' => $pharmacyOrderHistoryController->getCancelledOrdersCount($_SESSION['username']),
                    'totalOrders' => $pharmacyOrderHistoryController->getTotalOrdersCount($_SESSION['username']),
                ]);
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
