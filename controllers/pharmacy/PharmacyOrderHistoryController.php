<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
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
}
