<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\Request;

class PharmacyOrderMedicineController extends Controller
{

    public function createOrder(Request $request) {

        if ($request->isPost()) {
//            $data = $request->getBody();
            $order = new \app\models\PharmacyOrderModel();
//            $order->setPharmacyId($_SESSION['pharmacyId']);
//            $order->setOrderDate($_SESSION['orderDate']);
//            $order->setOrderStatus();
//            $order->setOrderTotal(1000);
//            $order->setDeliveryDate();

            if ($order->createOrder($_SESSION['pharmacyId'], 1000)) {
                Logger::orderLog("pharmacy order created");
                return header('Location: /pharmacy/orders');
            } else {
                echo (new ExceptionHandler)->somethingWentWrong();
                return header('Location: /pharmacy/order-medicine');
            }



//            $this->redirect('/pharmacy/order');
        }
    }

}