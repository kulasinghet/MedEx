<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\NotificationHandler;
use app\core\Request;

class PharmacyOrderMedicineController extends Controller
{

    public function createOrder(Request $request)
    {

        if ($request->isPost()) {

            $order = new \app\models\PharmacyOrderModel();

            if ($_SESSION['pharmacyId']) {
                if ($order->createOrder($_SESSION['pharmacyId'], 1000)) {
                    echo (new NotificationHandler())->orderCreatedSuccessfully($_SESSION['pharmacyId']);
                    return header('Location: /pharmacy/orders');
                } else {
                    echo (new ExceptionHandler)->somethingWentWrong();
                    return header('Location: /pharmacy/order-medicine');
                }

            } else {
                echo (new ExceptionHandler)->loginFirst();
                return header('Location: /pharmacy/login');
            }

        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/order-medicine');
        }
    }

}
