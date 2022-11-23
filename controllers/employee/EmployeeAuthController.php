<?php

namespace app\controllers\employee;

use app\base\Controller;
use app\base\Request;
use app\models\EmployeeModel;

class EmployeeAuthController extends Controller
{
    public function employeeRegister(Request $request)
    {
        if ($request->isPost()) {

            $employee = new EmployeeModel();
            $employee->loadData($request->getBody());

            if ($employee->validate() && $employee->registerEmployee()) {
                return header('Location: /employee/login');
            }

            return $this->render('registrationpage/employee_register/employ_register.php');
        }
        return $this->render('registrationpage/employee_register/employ_register.php');
    }

    public function employeeLogin(Request $request)
    {
        if ($request->isPost()) {
            return 'Handling auth data';
        }
        return $this->render('loginPage/loginPage.php');
    }
}