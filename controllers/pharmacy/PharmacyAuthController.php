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

            if ($pharmacy->validate() && $pharmacy->registerPharmacy()) {
                header("Location: /pharmacy/login");
            }

            return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
        }
        return $this->render('registrationPage/pharmacy_register_page/phr_register.php');
    }
}