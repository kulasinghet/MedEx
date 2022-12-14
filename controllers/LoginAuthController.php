<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Logger;
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
                Logger::signInLog("employee ". $request->getBody()['username']);
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
                Logger::signInLog("delivery ".$request->getBody()['username']);
                header('Location: /dashboard');
            }

            return $this->render('loginPage/delivery/loginpage.php');
        }
        return $this->render('loginPage/delivery/loginpage.php');
    }

    public function labLogin(Request $request) {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->labLogin()) {
                Logger::signInLog("lab ".$request->getBody()['username']);
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
                Logger::signInLog("supplier ".$request->getBody()['username']);
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
                Logger::signInLog("pharmacy ".$request->getBody()['username']);
                return header('Location: /dashboard');
            }

            return $this->render('loginPage/pharmacy/pharmacyLogin.php');
        }
        return $this->render('loginPage/pharmacy/pharmacyLogin.php');
    }
}