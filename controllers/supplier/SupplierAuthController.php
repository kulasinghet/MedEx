<?php

namespace app\controllers\supplier;

use app\core\Controller;
use app\core\Request;
use app\models\SupplierModel;

class SupplierAuthController extends Controller
{
    public function supplierRegister(Request $request)
    {
        if ($request->isPost()) {

            $supplier = new SupplierModel();
            $supplier->loadData($request->getBody());

            if ($supplier->validate() && $supplier->registerSupplier()) {
                header("Location: /supplier/login");
            }

            return $this->render('registerPage/supplier/register.php');
        }
        return $this->render('registerPage/supplier/register.php');
    }


}
