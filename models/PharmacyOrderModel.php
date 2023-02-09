<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    public $id;
    public $pharmacyName;
    public $medId;
    public $quantity;
    public $status;
    public $supName;


    public function getOrder($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from pharmacyorder WHERE pharmacyorder.id = '$id'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->id = $row["id"];
                $this->pharmacyName = $row['pharmacyName'];
                $this->medId = $row['medId'];
                $this->quantity = $row['quantity'];

            }
        }
        $db->close();
    }
    public function getPendingOrders()
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id from pharmacyorder WHERE pharmacyorder.order_status = '0'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();
    }

    public function getPendingMedId($id)
    {
        $this->getOrder($id);
        return $this->medId;
    }

    public function getPendingMedQuantiy($id)
    {
        $this->getOrder($id);
        return $this->quantity;
    }

    public function getPendingOrderPharm($id)
    {
        $this->getOrder($id);
        return $this->pharmacyName;
    }

    public function acceptOrder($supName, $id)
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
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE  pharmacyorder SET pharmacyorder.order_status = '1', pharmacyorder.supName='$supName' WHERE pharmacyorder.id = '$id' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
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

            $stmt->close();
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
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

    }

    public function getOrdersByUsernameForDashboard(mixed $username)
    {
        try {
            $conn = (new Database())->getConnection();
            $sql = "SELECT * FROM pharmacyorder WHERE pharmacyName = '$username' AND order_status <= 1 ORDER BY order_status ASC;";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }
}
