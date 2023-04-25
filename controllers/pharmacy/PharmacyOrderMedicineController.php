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

    public function orderDetails(Request $request)
    {

        if ($request->isGet()) {

            $orderId = $request->getParams()['orderId'];

            $order = (new \app\models\PharmacyOrderModel())->getOrderDetails($orderId);

            $returnJSONObj = [
                'orderId' => $order['id'],
                'pharmacyId' => $order['pharmacyUsername'],
                'orderDate' => $order['order_date'],
                'totalPrice' => $this->orderTotalToFrontEnd($order['order_total']),
                'orderStatus' => $this->orderStatusToFrontEnd($order['order_status']),
                'deliveryDate' => $this->deliveryDateToFrontEnd($order['delivery_date']),
            ];

            header('Content-Type: application/json');

            // Echo the JSON-encoded response
            echo json_encode($returnJSONObj);


        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/orders');
        }
    }

    public function orderMedicineDetails(Request $request)
    {

        if ($request->isGet()) {

            $orderId = $request->getParams()['orderId'];

            $order = (new \app\models\PharmacyOrderModel())->getMedicineByOrderID($orderId);

            header('Content-Type: application/json');
            // Echo the JSON-encoded response
            echo json_encode($order);


        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/orders');
        }
    }

    public function deliveryDateToFrontEnd($deliveryDate) {
        if ($deliveryDate == "0000-00-00") {
            return 'Pending';
        } elseif ($deliveryDate == null) {
            return 'Pending';
        } else if ($deliveryDate == '1900-02-07') {
            return 'Cancelled';
        } else if ($deliveryDate == '1900-02-08') {
            return 'Rejected';
        } else {
            return $deliveryDate;
        }
    }

    public function orderStatusToFrontEnd($orderStatus) {
        if ($orderStatus == "0") {
            return 'Pending';
        } elseif ($orderStatus == '1') {
            return 'Accepted';
        } elseif ($orderStatus == '3') {
            return 'Rejected';
        } elseif ($orderStatus == '2') {
            return 'Delivered';
        } elseif ($orderStatus == '4') {
            return 'Cancelled';
        }
    }

    public function orderTotalToFrontEnd($orderTotal): string
    {
        if ($orderTotal == "0") {
            return 'Finalizing Order';
        } else if ($orderTotal == "99999999") {
            return 'Rejected';
        } else if ($orderTotal == "77777777") {
            return 'Cancelled';
        } else {
            return $orderTotal;
        }
    }

    public function cancelOrder(Request $request) {

        if ($request->isGet()) {

            $orderId = $request->getParams()['orderId'];

            $order = (new \app\models\PharmacyOrderModel())->cancelOrder($orderId);

            if ($order) {
                // reply data == 'Order Cancelled'
                header ('Content-Type: application/json');
                return json_encode('Order Cancelled');
            } else {
                header('Content-Type: application/json');
                return json_encode('Something went wrong');
            }

        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/orders');
        }

    }

}
