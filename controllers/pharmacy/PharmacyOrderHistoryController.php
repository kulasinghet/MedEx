<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\Logger;
use app\models\PharmacyOrderModel;

class PharmacyOrderHistoryController extends Controller
{
    public function getOrdersByUsername($username): false|array
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getOrdersByUsername($username);

        if ($results) {
            return $results;
        } else {
            return false;
        }
    }

    public function transformOrderStatus($orderStatus): string
    {
        if ($orderStatus == "0") {
            return 'Pending';
        } elseif ($orderStatus == '1') {
            return 'Accepted by Delivery Partner';
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

    public function transformDeliveryDate($deliveryDate, $orderStatus = null): string
    {
        if ($orderStatus == "0" || $orderStatus == "4" || $orderStatus == "6" || $orderStatus == "3") {
            return '-';
        } else if (is_null($deliveryDate)) {
            return '-';
        } else {
            return date('d-m-Y', strtotime($deliveryDate));
        }
    }

    public function transformOrderTotal($orderTotal, $orderStatus = null): string
    {

        if ($orderStatus == "0" || $orderStatus == "4" || $orderStatus == "6" || $orderStatus == "3") {
            return '-';
        } else {
            return $orderTotal;
        }

    }

    public function getOrdersByUsernameForDashboard(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getOrdersByUsernameForDashboard($username);

        if ($results) {
            return $results;
        } else {
            return 0;
        }
    }

    public function     getPendingOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getPendingOrdersCount($username);

        if ($results) {
            Logger::logDebug("getPendingOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }

    public function getAcceptedOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getAcceptedOrdersCount($username);

        if ($results) {
            Logger::logDebug("getAcceptedOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }

    public function getRejectedOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getRejectedOrdersCount($username);

        if ($results) {
            Logger::logDebug("getRejectedOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }

    public function getDeliveredOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getDeliveredOrdersCount($username);

        if ($results) {
            Logger::logDebug("getDeliveredOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }

    public function getCancelledOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getCancelledOrdersCount($username);

        if ($results) {
            Logger::logDebug("getCancelledOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }

    public function getTotalOrdersCount(mixed $username)
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $results = $pharmacyOrder->getTotalOrdersCount($username);

        if ($results) {
            Logger::logDebug("getTotalOrdersCount() returned: " . $results);
            return $results;
        } else {
            return 0;
        }
    }
}
