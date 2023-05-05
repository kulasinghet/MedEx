<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;

class PharmacyOrderModel extends Model
{
    public $id;
    public $pharmacyUsername;
    public $medId;
    public $quantity;
    public $status;
    public $supName;
    public $batchNo;
    public $expDate;
    public $delivery_date;
    public $order_status;
    public $order_date;
    public $order_total;


    public function getOrder($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT pharmacyUsername,medId,quantity from pharmacyorder WHERE pharmacyorder.id = '$id'";
        $result = $db->query($sql);
        Logger::logDebug($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->pharmacyUsername = $row['pharmacyUsername'];
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
        Logger::logDebug($sql);
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();
    }
    public function getSupOrders($name)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT id from pharmacyorder WHERE pharmacyorder.order_status = '1' && pharmacyorder.supName = '$name'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        $db->close();
    }

    public function getMedId($id)
    {
        $this->getOrder($id);
        return $this->medId;
    }

    public function getMedQuantiy($id)
    {
        $this->getOrder($id);
        return $this->quantity;
    }

    public function getOrderPharm($id)
    {
        $this->getOrder($id);
        return $this->pharmacyUsername;
    }

    public function acceptOrder($id)
    {
        $db = (new Database())->getConnection();
        try {
            $sql = "UPDATE pharmacyorder SET pharmacyorder.order_status = '1' WHERE pharmacyorder.id = '$id'";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @param mixed $delivery_date
     */
    public function setDeliveryDate($delivery_date): void
    {
        $this->delivery_date = $delivery_date;
    }


    public function createOrder($pharmacyUsername, $order_total, $medicineIds): bool|string
    {
        // generate random order id with time stamp and pharmacy id

        $this->setId($this->createRandomID('pharmacyorder'));
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
                    return $this->id;
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
            $sql = "SELECT * FROM pharmacyorder WHERE pharmacyUsername = '$username' ORDER BY order_status ASC, order_date DESC;";
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

    public function getOrderDetails($id)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from pharmacyorder WHERE pharmacyorder.id = '$id'";

        try {

            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->pharmacyUsername = $row['pharmacyUsername'];
                    $this->status = $row['status'];
                    $this->supName = $row['supName'];
                    $this->order_date = $row['order_date'];
                    $this->delivery_date = $row['delivery_date'];
                    $this->order_total = $row['order_total'];
                    $this->order_status = $row['order_status'];

                    //                Logger::logDebug($this->id . " " . $this->pharmacyUsername . " " . $this->status . " " . $this->supName . " " . $this->order_date . " " . $this->delivery_date . " " . $this->order_total . " " . $this->order_status);
                }
            }
            $db->close();

            // create an associative array using the data
            $order = array(
                "id" => $this->id,
                "pharmacyUsername" => $this->pharmacyUsername,
                "status" => $this->status,
                "supName" => $this->supName,
                "order_date" => $this->order_date,
                "delivery_date" => $this->delivery_date,
                "order_total" => $this->order_total,
                "order_status" => $this->order_status
            );

            return $order;

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getMedicineByOrderID(mixed $orderId)
    {
        $conn = (new Database())->getConnection();

        $sql = "SELECT pharmacyordermedicine.medId, pharmacyordermedicine.quantity, medicine.medName, medicine.sciName, medicine.weight, supplier_medicine.unitPrice FROM pharmacyordermedicine LEFT JOIN medicine ON pharmacyordermedicine.medid = medicine.id LEFT JOIN supplier_medicine ON medicine.id = supplier_medicine.medid WHERE orderid = '$orderId'";

        try {
            $result = $conn->query($sql);
            Logger::logDebug($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function cancelOrder(mixed $orderId)
    {
        $conn = (new Database())->getConnection();
        //        $deliveryDate == '1900-02-07'
//        $orderTotal == "77777777"
        $sql = "UPDATE pharmacyorder SET order_status = 4, delivery_date = '1900-02-07', order_total = 77777777 WHERE id = '$orderId'";

        try {
            $result = $conn->query($sql);

            if ($result) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }


    public function getPendingOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 0 = pending for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status = 0 AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }


    //if ($orderStatus == "0") {
//return 'Pending';
//} elseif ($orderStatus == '1') {
//            return 'Accepted';
//        } elseif ($orderStatus == '3') {
//            return 'Rejected';
//        } elseif ($orderStatus == '2') {
//            return 'Delivered';
//        } elseif ($orderStatus == '4') {
//            return 'Cancelled';
//        }
//    }

    public function getAcceptedOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 1 = accepted for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status = 1 AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getRejectedOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 2 = rejected for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status = 3 AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getDeliveredOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 3 = delivered for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status = 2 AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getCancelledOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 4 = cancelled for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND order_status = 4 AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getTotalOrdersCount(mixed $username)
    {
        $conn = (new Database())->getConnection();
        // order status 4 = cancelled for current month
        $sql = "SELECT COUNT(*) AS count FROM pharmacyorder WHERE pharmacyUsername = '$username' AND MONTH(order_date) = MONTH(CURRENT_DATE()) AND YEAR(order_date) = YEAR(CURRENT_DATE());";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'];
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }

    public function getLocation(mixed $orderId)
    {
        $conn = (new Database())->getConnection();
        $sql = "SELECT delivery_partner.longitude, delivery_partner.latitude FROM pharmacyorder LEFT JOIN delivery_partner ON pharmacyorder.delivary_partner_id = delivery_partner.username WHERE pharmacyorder.id = '$orderId'";

        try {
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            return $row;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new ExceptionHandler)->somethingWentWrong();
            return false;
        }
    }
}

