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
            return 'Accepted';
        } elseif ($orderStatus == '3') {
            return 'Rejected';
        } elseif ($orderStatus == '2') {
            return 'Delivered';
        } elseif ($orderStatus == '4') {
            return 'Cancelled';
        } elseif ($orderStatus == '5') {
            return 'Delivering';
        } else {
            return $orderStatus;
        }
    }

    public function transformDeliveryDate($deliveryDate): string
    {
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

    public function transformOrderTotal($orderTotal): string
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
