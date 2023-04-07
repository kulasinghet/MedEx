<?php

namespace app\controllers\supplier;
use app\core\Controller;
use app\core\Request;

class SupplierDashboardController extends Controller
{
    const login = 'Location: /login';

    public function addMedicine(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {
            if ($request->isGet()) {
                $this->render("supplier/add-medicine.php");
            } elseif ($request->isPost()) {
                $this->render("supplier/add-medicine.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function updateInventory(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {

            if ($request->isGet()) {
                $this->render("supplier/update-inventory.php");
            } elseif ($request->isPost()) {
                $this->render("supplier/update-inventory.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }
    public function medicineRequests(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {

            if ($request->isGet()) {
                $this->render("supplier/medicine-requests.php");
            } elseif ($request->isPost()) {
                $this->render("supplier/medicine-requests.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function acceptOrders(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {

            if ($request->isGet()) {
                $this->render("supplier/accept-orders.php");
            } else if ($request->isPost()) {
                $this->render("supplier/accept-orders.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function inventory(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {

            if ($request->isGet()) {
                $this->render("supplier/inventory.php");
            } else if ($request->isPost()) {
                $this->render("supplier/inventory.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function contactUs(Request $request)
    {
        if ($_SESSION['userType'] == 'supplier') {

            if ($request->isGet()) {
                $this->render("supplier/contact-us.php");
            } else if ($request->isPost()) {
                $this->render("supplier/contact-us.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

}