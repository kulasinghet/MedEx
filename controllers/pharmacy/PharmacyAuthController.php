<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\Request;
use app\models\PharmacyModel;

class PharmacyAuthController extends Controller
{
    public function pharmacyRegister(Request $request)
    {
        if ($request->isPost()) {

            $pharmacy = new PharmacyModel();
            $pharmacy->loadData($request->getBody());

            if (@$_POST['password'] != @$_POST['confirmPassword']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
            }

            if ($_POST['username'] == '' || $_POST['password'] == '' || $_POST['confirmPassword'] == '' || $_POST['email'] == '' || $_POST['name'] == '' || $_POST['address'] == '' || $_POST['contactnumber'] == '') {
                echo (new \app\core\ExceptionHandler)->emptyFields();
                return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
            }

            if ($pharmacy->validate() && $pharmacy->registerPharmacy()) {
                echo (new \app\core\ExceptionHandler)->userCreated();
                return $this->render("/general/login.php");
            }

            return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
        }
        return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
    }
}
