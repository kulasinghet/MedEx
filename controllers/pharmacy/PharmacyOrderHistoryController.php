<?php

namespace app\controllers\pharmacy;

use app\core\Controller;
use app\core\ExceptionHandler;
use app\models\PharmacyOrderModel;

class PharmacyOrderHistoryController extends Controller
{
    public function getOrdersByPharmacyId($pharmacyId): false|array
    {
        $pharmacyOrder = new PharmacyOrderModel();
        $pharmacyOrder->setPharmacyId($pharmacyId);

        $results = $pharmacyOrder->getOrdersByPharmacyId($pharmacyId);



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
        } else if ($orderStatus == '1') {
            return 'Accepted';
        } else if ($orderStatus == '2') {
            return 'Rejected';
        } else if ($orderStatus == '3') {
            return 'Delivered';
        } else if ($orderStatus == '4') {
            return 'Cancelled';
        }
    }

    public function transformDeliveryDate($deliveryDate): string
    {
        if ($deliveryDate == "0000-00-00") {
            return 'Pending';
        }
    }




}