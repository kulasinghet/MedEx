<?php

namespace app\controllers;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\Request;
use app\models\LoginModel;
use app\models\PharmacyModel;

class LoginAuthController extends Controller
{
    public function employeeLogin(Request $request)
    {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->loginEmployee()) {
                Logger::signInLog("employee ". $request->getBody()['username']);
                $_SESSION['isPharmacy'] = false;
                $_SESSION['isSupplier'] = false;
                $_SESSION['isLab'] = false;
                $_SESSION['isDelivery'] = false;
                $_SESSION['isEmployee'] = true;
                return header('Location: /dashboard');
            }
            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
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
                $_SESSION['isPharmacy'] = false;
                $_SESSION['isSupplier'] = false;
                $_SESSION['isLab'] = false;
                $_SESSION['isDelivery'] = true;
                $_SESSION['isEmployee'] = false;
                header('Location: /dashboard');
            }
            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
            return $this->render('loginPage/delivery/deliveryLogin.php');
        }
        return $this->render('loginPage/delivery/deliveryLogin.php');
    }

    public function labLogin(Request $request) {
        if ($request->isPost()) {
            $login = new LoginModel();
            $login->loadData($request->getBody());

            if ($login->validate() && $login->labLogin()) {
                Logger::signInLog("lab ".$request->getBody()['username']);
                $_SESSION['isPharmacy'] = false;
                $_SESSION['isSupplier'] = false;
                $_SESSION['isLab'] = true;
                $_SESSION['isDelivery'] = false;
                $_SESSION['isEmployee'] = false;
                return header('Location: /dashboard');
            }
            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
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
                $_SESSION['isPharmacy'] = false;
                $_SESSION['isSupplier'] = true;
                $_SESSION['isLab'] = false;
                $_SESSION['isDelivery'] = false;
                $_SESSION['isEmployee'] = false;
                return header('Location: /dashboard');
            }
            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
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
                // set isPharmacy session variable
                $_SESSION['isPharmacy'] = true;
                $_SESSION['isSupplier'] = false;
                $_SESSION['isLab'] = false;
                $_SESSION['isDelivery'] = false;
                $_SESSION['isEmployee'] = false;

                $pharmacyDetails = (new PharmacyModel())->getPharmacyByUsername($request->getBody()['username']);
                $_SESSION['pharmacyId'] = $pharmacyDetails['id'];
                $_SESSION['pharmacyUsername'] = $pharmacyDetails['username'];
                $_SESSION['pharmacyName'] = $pharmacyDetails['name'];
                $_SESSION['pharmacyCity'] = $pharmacyDetails['city'];
                $_SESSION['pharmacyRegno'] = $pharmacyDetails['pharmacyRegNo'];
                $_SESSION['pharmacyOwnerName'] = $pharmacyDetails['ownerName'];
                $_SESSION['pharmacyStatus'] = $pharmacyDetails['verified'];
                $_SESSION['pharmacyDeliveryTime'] = $pharmacyDetails['deliveryTime'];

                return header('Location: /dashboard');
            }

            echo (new \app\core\ExceptionHandler)->userNameOrPasswordIncorrect($request->getBody()['username']);
            $_SESSION['isPharmacy'] = false;
            return $this->render('loginPage/pharmacy/pharmacyLogin.php');
        }
        return $this->render('loginPage/pharmacy/pharmacyLogin.php');
    }
}