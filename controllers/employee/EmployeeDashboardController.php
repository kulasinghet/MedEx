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
                // TODO: add order medicine route in index php
                $this -> render("employee/reports.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function approvalPharmacy(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                // TODO: add order medicine route in index php
                $this -> render("employee/approve-pharmacy.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }
}