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

            if ($_POST['password'] != $_POST['confirmPassword']) {
                echo (new \app\core\ExceptionHandler)->passwordDoesNotMatch();
                return $this->render('registerPage/pharmacy/pharmacyRegister.php');
            }

            if ($_POST['userName'] == '' || $_POST['password'] == '' || $_POST['confirmPassword'] == '' || $_POST['email'] == '' || $_POST['pharmacyName'] == '' || $_POST['address'] == '' || $_POST['contactNumber'] == '') {
                echo (new \app\core\ExceptionHandler)->emptyFields();
                return $this->render('registerPage/pharmacy/pharmacyRegister.php');
            }

            if ($pharmacy->validate() && $pharmacy->registerPharmacy()) {
                return header("Location: /pharmacy/login");
            }

            return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
        }
        return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
    }
}
