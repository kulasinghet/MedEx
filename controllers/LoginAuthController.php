<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\LoginModel;

class LoginAuthController extends Controller
{
    public function employeeLogin(Request $request)
    {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->loginEmployee()) {
                return header('Location: /employee/dashboard');
            }

            return $this->render('loginPage/employee/employeeLogin.php');
        }
        return $this->render('loginPage/employee/employeeLogin.php');
    }

    public function deliveryLogin(Request $request) {

    }

    public function labLogin(Request $request) {

    }

    public function supplierLogin(Request $request) {

    }

    public function pharmacyLogin(Request $request) {

    }
}