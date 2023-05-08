<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\NotificationHandler;
use app\core\Request;
use app\models\MedicineOrderModel;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
                $this->totalPrice = number_format($this->totalPrice, 2);

                $result = $order->createOrder($_SESSION['username'], $this->totalPrice, $medicineIds);
                if ($result) {

                    $qr = new \app\core\QR();
//                    $api = $_ENV '/delivery/api/update-medicine-details?orderId=' . $result;

                    $qr_JSON = [
                        "orderId" => $result,
                        "username" => $_SESSION['username'],
                        "totalPrice" => $this->totalPrice,
                        "qrtype" => "order"
                    ];
                    $qr->generateQRFromJSON(json_encode($qr_JSON), $result, 10, 'L');

                    $pdf = new \app\core\PDF();
                    $medicineIdsforPDF = (new \app\models\PharmacyOrderModel())->getMedicineByOrderID($result);
                    $html = $pdf->formBodyToHTML($result, date("Y-m-d"), $this->totalPrice, $medicineIdsforPDF, $_SESSION['username']);
                    $pdf->generatePDF($html, $result);

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

    public function getPriceForOrder(mixed $id)
    {
        $price =  (new \app\models\MedicineModel())->getMedicinePriceForOrder($id);

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
                'totalPrice' => $this->orderTotalToFrontEnd($order['order_total'], $order['order_status']),
                'orderStatus' => $this->orderStatusToFrontEnd($order['order_status']),
                'deliveryDate' => $this->deliveryDateToFrontEnd($order['delivery_date'], $order['order_status']),
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
            echo json_encode($order);


        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/orders');
        }
    }

    public function deliveryDateToFrontEnd($deliveryDate, $orderStatus = null): string {
        if ($orderStatus == "0" || $orderStatus == "4" || $orderStatus == "6") {
            return '-';
        } else if (is_null($deliveryDate)) {
            return '-';
        } else {
            return date('d-m-Y', strtotime($deliveryDate));
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
        } else if ($orderStatus == '5') {
            return 'Delivering';
        } else if ($orderStatus == '6') {
            return 'Processed by Admin';
        } else {
            return 'Unknown';
        }
    }

    public function orderTotalToFrontEnd($orderTotal, $orderStatus = null): string
    {
       return $orderTotal;
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

    public function getLocation(Request $request) {

            if ($request->isGet()) {

                $orderId = $request->getParams()['orderId'];

                $order = (new \app\models\PharmacyOrderModel())->getLocation($orderId);

                if ($order) {
                    // reply data == 'Order Cancelled'
                    header ('Content-Type: application/json');
                    return json_encode($order);
                } else {
                    header('Content-Type: application/json');
                    return json_encode('Order Not Found');
                }

            } else {
                echo (new ExceptionHandler)->somethingWentWrong();
                return header('Location: /pharmacy/orders');
            }

    }

}
