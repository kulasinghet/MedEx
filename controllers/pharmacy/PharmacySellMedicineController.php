<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\NotificationHandler;
use app\core\Request;
use app\models\MedicineOrderModel;
use Dotenv\Dotenv;
use http\Exception\InvalidArgumentException;

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

                Logger::logDebug('*****************************');

                $form = $request->getBody();

                $total = $form['total'];
                $customerPayment = $form['customerPayment'];
                $customerChange = $form['customerChange'];
                $medicineIds = $form['medicineIds'];
                $medicineQuantities = $form['medicineQuantities'];

                Logger::logDebug(print_r($form, true));

                Logger::logDebug('/////////Total price ' . $this->totalPrice);
                $flag = true;

                $result = $order->createSellOrder($_SESSION['username'], $total, $medicineIds, $medicineQuantities, $customerPayment, $customerChange);

                Logger::logDebug('Order ID ' . $result);

                if ($result) {

                    $qr = new \app\core\QR();
                    $api = $_ENV['BASE_URL'] . '/report/medicine-order?orderId=' . $result;
                    $qr->generateQRFromJSON($api, $result, 10, 'L');

                    $pdf = new \app\core\PDF();
                    $medicineIdsforPDF = (new \app\models\PharmacySellModel())->getMedicineSellsByOrderID($result);
                    $html = $pdf->invoiceToHTML($result, date("Y-m-d H:i:s"), $total, $medicineIdsforPDF, $_SESSION['username'], $customerPayment, $customerChange);

                    if ($pdf->generatePDF($html, $result)) {
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                } else {
                    $flag = false;
                }


                if ($flag) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Order placed successfully']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Something went wrong']);
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

        if ($price > 0) {
            return $price;
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
                // remove $customer_money from array
                if ($key != 'customer_money') {
                    $medicineOrder = new MedicineOrderModel($key, $value);
                    $medicineIds[] = $medicineOrder;
                }
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
            'customer_money' => $result[0]['customer_money'],
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

        $pharmacyUsername = $request->getParams()['pharmacyUsername'];
        $order = new \app\models\PharmacySellModel();
        $result = $order->getSalesOrdersPerDayLimitWeek($pharmacyUsername);

        Logger::logDebug('salesByDay');
        Logger::logDebug(print_r($result, true));

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
