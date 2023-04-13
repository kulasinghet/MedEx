<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    private $id;
    private $pharmacyUsername;
    private $medId;
    private $quantity;
    private $status;
    private $supName;
    private $delivery_date;
    private $order_status;
    private $order_date;
    private $order_total;


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


    public function createOrder($pharmacyUsername, $order_total, $medicineIds): bool
    {
        // generate random order id with time stamp and pharmacy id

        $this->setId($this->createRandomID($pharmacyUsername));
        $order_date = date("Y-m-d");

        $sql = "INSERT INTO pharmacyorder (id, pharmacyUsername, status, supName, order_date, delivery_date, order_total) VALUES ('$this->id', '$pharmacyUsername', '0', null, '$order_date', null, '$order_total')";

        Logger::logDebug($sql);

        $db = (new Database())->getConnection();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
//                $pharmacyUsername, $order_total, $medicineIds, $order_date
                if ($this->updateMedicineQuantity($pharmacyUsername, $order_total, $medicineIds, $order_date)) {
                    return true;
                }

            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }

        return false;
    }

    public function getOrdersByUsername($username): false|array
    {
        try {
            $conn = (new Database())->getConnection();
            $sql = "SELECT * FROM pharmacyorder WHERE pharmacyUsername = '$username' ORDER BY order_status ASC;";
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
            $sql = "SELECT * FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status <= 1 ORDER BY order_status ASC;";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    private function setId(string $createRandomID)
    {
        $this->id = $createRandomID;
    }

    private function updateMedicineQuantity($pharmacyUsername, $order_total, $medicineIds, $order_date): bool
    {
        $db = (new Database())->getConnection();

        $flag = true;

        foreach ($medicineIds as $medicine) {

            $medicineID = $medicine->getMedicineId();
            $quantity = $medicine->getQuantity();

            $sql = "INSERT INTO pharmacyordermedicine (orderid, pharmacyUsername, medId, quantity, status, supName, order_date, delivery_date, order_total) VALUES ('$this->id', '$pharmacyUsername', '$medicineID', '$quantity', '0', null, '$order_date', null, '$order_total')";

            Logger::logDebug($sql);

            try {
                $stmt = $db->prepare($sql);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    $stmt->close();
                } else {
                    $flag = false;
                }
            } catch (\Exception $e) {
                Logger::logError($e->getMessage());
                return false;
            }
        }

        return $flag;
    }
}
