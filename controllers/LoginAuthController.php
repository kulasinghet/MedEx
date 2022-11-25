<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;
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
}