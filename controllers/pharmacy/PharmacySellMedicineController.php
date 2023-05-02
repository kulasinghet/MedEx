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

class PharmacySellMedicineController extends Controller
{
    private $totalPrice = 0;
    private $medicineIds = [];

    public function sellMedicine(Request $request)
    {
        if ($request->isPost()) {

            $order = new \app\models\PharmacySellModel();

            if (isset($_SESSION['username'])) {

                $form = $request->getBody();
                $medicineIds = $this->getMedicineIds($form);

                if (count($medicineIds) > 0) {
                    foreach ($medicineIds as $medicineId) {
                        $this->totalPrice += $this->getPrice($medicineId->getMedicineId()) * $medicineId->getQuantity();
                    }
                }

                $flag = true;

                $result = $order->createSellOrder($_SESSION['username'], $this->totalPrice, $medicineIds);

                Logger::logDebug($result);

                if ($result) {

                    $qr = new \app\core\QR();
                    $api = $_ENV['BASE_URL'] . '/pdf/' . $result . '.pdf';
                    $qr->generateQRFromJSON($api, $result, 10, 'L');

                    $pdf = new \app\core\PDF();
                    $medicineIdsforPDF = (new \app\models\PharmacySellModel())->getMedicineSellsByOrderID($result);
                    $html = $pdf->invoiceToHTML($result, date("Y-m-d"), $this->totalPrice, $medicineIdsforPDF, $_SESSION['username']);

                    if ($pdf->generatePDF($html, $result)) {
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                } else {
                    $flag = false;
                }


                if ($flag) {
                    echo (new NotificationHandler())->orderCreatedSuccessfully($_SESSION['username']);
                    return header('Location: /pharmacy/invoices');
                } else {
                    echo (new ExceptionHandler)->somethingWentWrong();
                    Logger::logError('Something went wrong while creating order ' . $_SESSION['username']);
                    return header('Location: /pharmacy/sell-medicine');
                }

            } else {
                echo (new ExceptionHandler)->loginFirst();
                return header('Location: /login');
            }

        } else {
            echo (new ExceptionHandler)->somethingWentWrong();
            return header('Location: /pharmacy/sell-medicine');
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

    public function getPharmacySellOrders(mixed $username)
    {
        $orders = (new \app\models\PharmacySellModel())->getPharmacySellOrders($username);

        if (count($orders) > 0) {
            return $orders;
        } else {
            return [];
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

    public function salesOrder(Request $request) {

        $invoiceId = $request->getParams()['invoiceId'];
        $order = new \app\models\PharmacySellModel();
        $result = $order->getPharmacySellOrdersByInvoiceId($invoiceId);

        $returnJSONObj = [
            'invoiceId' => $result[0]['invoice_id'],
            'pharmacyUsername' => $result[0]['pharmacyUsername'],
            'invoiceDate' => $result[0]['invoice_date'],
            'billTotal' => $result[0]['bill_total'],
        ];

        header('Content-Type: application/json');
        echo json_encode($returnJSONObj);

    }

    public function salesOrderMedicines(Request $request) {

        $invoiceId = $request->getParams()['invoiceId'];
        $order = new \app\models\PharmacySellModel();
        $result = $order->getPharmacySellOrdersMedicinesByInvoiceId($invoiceId);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function salesByDay(Request $request) {

        $qr = new \app\core\QR();
        $qr_JSON = [
            "username" => $_SESSION['username'],
            "qrtype" => "pharmacy"
        ];
        $qr_name = $_SESSION['username'] . '_qr';
        if ($qr->generateQRForPersonal(json_encode($qr_JSON), $qr_name, 10, 'L')) {
            $flag = true;
        }


        $pharmacyUsername = $request->getParams()['pharmacyUsername'];
        $order = new \app\models\PharmacySellModel();
        $result = $order->getSalesOrdersPerDayLimitWeek($pharmacyUsername);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function salesAndCostForCurrentMonth(Request $request) {

        $pharmacyUsername = $request->getParams()['pharmacyUsername'];
        $order = new \app\models\PharmacySellModel();
        $sales = $order->getTotalSalesLimitMonth($pharmacyUsername);
        $cost = $order->getTotalCostLimitMonth($pharmacyUsername);

        $result = [
            'sales' => $sales,
            'cost' => $cost,
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

}
