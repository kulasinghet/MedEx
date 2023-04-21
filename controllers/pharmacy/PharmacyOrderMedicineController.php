<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\NotificationHandler;
use app\core\Request;
use app\models\MedicineOrderModel;

class PharmacyOrderMedicineController extends Controller
{
    private $totalPrice = 0;
    private $medicineIds = [];

    public function createOrder(Request $request)
    {
        if ($request->isPost()) {

            $order = new \app\models\PharmacyOrderModel();

            if (isset($_SESSION['username'])) {

                $form = $request->getBody();
                $medicineIds = $this->getMedicineIds($form);

                if (count($medicineIds) > 0) {
                    foreach ($medicineIds as $medicineId) {
                        $this->totalPrice += $this->getPrice($medicineId->getMedicineId()) * $medicineId->getQuantity();
                    }
                }

                $flag = true;

                if ($order->createOrder($_SESSION['username'], $this->totalPrice, $medicineIds)) {
                    $flag = true;
                } else {
                    $flag = false;
                }


                if ($flag) {
                    echo (new NotificationHandler())->orderCreatedSuccessfully($_SESSION['username']);
                    return header('Location: /pharmacy/orders');
                } else {
                    echo (new ExceptionHandler)->somethingWentWrong();
                    return header('Location: /pharmacy/order-medicine');
                }

            } else {
                echo (new ExceptionHandler)->loginFirst();
                return header('Location: /login');
            }

        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/order-medicine');
        }
    }

    public function getPrice(mixed $id)
    {
        $price =  (new \app\models\MedicineModel())->getMedicinePrice($id);

        if ($price['price'] > 0) {
            return $price['price'];
        } else {
            return 0;
        }
    }

    private function array_to_string(mixed $v)
    {
        $str = '';
        foreach ($v as $key => $value) {
            $str .= $key . ' => ' . $value . ', ';
        }
        Logger::logError($str);
    }

    private function getMedicineIds(array $form): array
    {
        $medicineIds = [];
        foreach ($form as $key => $value) {
            if ($value > 0) {
                $medicineOrder = new MedicineOrderModel($key, $value);
                $medicineIds[] = $medicineOrder;
            }
        }
        return $medicineIds;
    }

}
