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

        $this->setId($this->createRandomID($pharmacyId));
        $order_date = date("Y-m-d");

        $sql = "INSERT INTO pharmacyorder (id, pharmacyId, order_date, order_status, order_total) VALUES
                ('$this->getId()', '$pharmacyId', '$order_date', 0, '$order_total');";
        try {

            $db = new Database();

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->get_result()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getOrdersByUsername($username): false|array
    {
        try {
            $conn = (new Database())->getConnection();
            $sql = "SELECT * FROM pharmacyorder WHERE pharmacyName = '$username' ORDER BY order_status ASC;";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getNotAcceptedOrders()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id  from medicine";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }

        $db->close();
    }
}
