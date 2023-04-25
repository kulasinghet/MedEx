<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmployeeModel;

class EmployeeDashboardController extends Controller
{
    const login = 'Location: /login';

    public function showReports(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/reports.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function approvePharmacy(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/pharmacy.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function approveSupplier(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/supplier.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function approveLab(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/lab.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function approveDelivery(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/delivery.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function configs(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/configs.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }
}