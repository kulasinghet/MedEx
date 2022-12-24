<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    private $id;
    private $pharmacyId;
    private $order_date;
    private $order_status;
    private $order_total;
    private $delivery_date;
//    private $getId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPharmacyId()
    {
        return $this->pharmacyId;
    }

    /**
     * @param mixed $pharmacyId
     */
    public function setPharmacyId($pharmacyId): void
    {
        $this->pharmacyId = $pharmacyId;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @param mixed $order_date
     */
    public function setOrderDate($order_date): void
    {
        $this->order_date = $order_date;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @param mixed $order_status
     */
    public function setOrderStatus($order_status): void
    {
        $this->order_status = $order_status;
    }

    /**
     * @return mixed
     */
    public function getOrderTotal()
    {
        return $this->order_total;
    }

    /**
     * @param mixed $order_total
     */
    public function setOrderTotal($order_total): void
    {
        $this->order_total = $order_total;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * @param mixed $delivery_date
     */
    public function setDeliveryDate($delivery_date): void
    {
        $this->delivery_date = $delivery_date;
    }




    public function createOrder($pharmacyId, $order_total): bool
    {
        // generate random order id with time stamp and pharmacy id

        $this->id = $this->createRandomID($pharmacyId);
        $order_date = date("Y-m-d");

        $sql = "INSERT INTO pharmacy_order (id, pharmacyId, order_date, order_status, order_total) VALUES
                ('$this->id', '$pharmacyId', '$order_date', 0, '$order_total');";
        try {

            $db = new Database();

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($stmt->get_result()) {
                (new \app\core\Logger)->orderCreated($this->getId() . $this->getPharmacyId()) ;
                return true;
            } else {
                Logger::logError($result->num_rows);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getOrdersByPharmacyId($pharmacyId): false|array
    {
//        Logger::logError("Pharmacy order history fetched");
        $sql = "SELECT * FROM pharmacy_order WHERE pharmacyId = '$pharmacyId' ORDER BY order_date DESC;";

        try {
            $db = new Database();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $result = $result->fetch_all(MYSQLI_ASSOC);

//            if (@$result['order_status'] == 0) {
//                $result['order_status'] = "Pending";
//            } else if ($result['order_status'] == 1) {
//                $result['order_status'] = "Approved";
//            } else if ($result['order_status'] == 2) {
//                $result['order_status'] = "Rejected";
//            } else if ($result['order_status'] == 3) {
//                $result['order_status'] = "Delivered";
//            } else {
//                $result['order_status'] = "Unknown";
//            }
//
//            if (@$result['delivery_date'] == null) {
//                $result['delivery_date'] = "Pending";
//            }

            return $result;


        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    private function setQuantity($quantity)
    {
    }


}
