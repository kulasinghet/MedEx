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

            echo '<pre>';
            var_dump($employee->validate());
            echo '</pre>';
//
            if ($employee->validate() && $employee->registerEmployee()) {
                echo "New record created successfully";
                return header('Location: /employee/login');
            }

            return $this->render('registrationPage/employee_register/employ_register.php');
        }
        return $this->render('registrationPage/employee_register/employ_register.php');
    }
}

