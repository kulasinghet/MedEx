<?php

namespace app\controllers\employee;

use app\core\Controller;
use app\core\Request;
use app\models\EmployeeModel;

class EmployeeDashboardController extends Controller
{
    const login = 'Location: /login';

    public function loadReports(Request $request)
    {
        if ($request->isGet()) {
            if ($_SESSION['userType'] == 'staff') {
                $this -> render("employee/inquiries.php");
            } else {
                return header(self::login);
            }
        } else {
            return header(self::login);
        }
    }

    public function loadConfigs(Request $request)
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