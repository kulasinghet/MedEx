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
                return header('Location: /dashboard');
            }

            return $this->render('loginPage/employee/employeeLogin.php');
        }
        return $this->render('loginPage/employee/employeeLogin.php');
    }

    public function deliveryLogin(Request $request) {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->deliveryPartnerLogin()) {
                header('Location: /dashboard');
            }

            return $this->render('loginPage/delivery/deliveryLogin.php');
        }
        return $this->render('loginPage/delivery/deliveryLogin.php');
    }

    public function labLogin(Request $request) {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->labLogin()) {
                return header('Location: /dashboard');
            }

            return $this->render('loginPage/lab/labLogin.php');
        }
        return $this->render('loginPage/lab/labLogin.php');
    }

    public function supplierLogin(Request $request) {

        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->loginSupplier()) {
                return header('Location: /dashboard');
            }

            return $this->render('loginPage/supplier/supplierLogin.php');
        }
        return $this->render('loginPage/supplier/supplierLogin.php');
    }

    public function pharmacyLogin(Request $request) {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->loginPharmacy()) {
                return header('Location: /dashboard');
            }

            return $this->render('loginPage/pharmacy/pharmacyLogin.php');
        }
        return $this->render('loginPage/pharmacy/pharmacyLogin.php');
    }
}