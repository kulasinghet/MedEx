<?php

namespace app\models;

use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;
use mysqli;

class EmployeeOrderModel extends Model
{
    private function createConnection(): ?\mysqli
    {
        //loading the database
        $db = new Database();
        return $db->getConnection();
    }

    private function statusToString($orderStatus): string
    {
        return match($orderStatus) {
            '0' => 'Pending',
            '1' => 'Accepted',
            '3' => 'Rejected',
            '2' => 'Delivered',
            '4' => 'Cancelled',
            '5' => 'Delivering',
            '6' => 'Processed by Admin',
            default => 'Unknown',
        };
    }

    private function statusToInt($orderStatus): string
    {
        return match($orderStatus) {
            'Pending' => 0,
            'Accepted' => 1,
            'Rejected' => 3,
            'Delivered' => 2,
            'Cancelled' => 4,
            'Delivering' => 5,
            'Processed by Admin' => 6,
            default => null,
        };
    }

    private function insertDeliveryReq(string $oderID, ?mysqli $conn = null): bool
    {
        if ($conn == null) {
            $conn = $this->createConnection();
        }

        // generates random id for the delivery request
        $req_id = $this->createRandomID('deliveryreq');
        // gets the pharmacy username and city
        $pharmacy = $this->getPharmacyByOrderID($oderID, $conn);

        $sql = "INSERT INTO `deliveryreq` (`id`, `location`, `pharmacyName`, `orderId`, `status`, `payment`) 
                VALUES ('$req_id', '".$pharmacy['username']."', '".$pharmacy['city']."', '$oderID', '0', ".($pharmacy['distance'] * 300).");";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    private function getPharmacyByOrderID(string $oderID, ?mysqli $conn = null): array|null
    {
        if ($conn == null) {
            $conn = $this->createConnection();
        }

        $sql = "SELECT p.username, p.city, c.distance
                FROM pharmacy p
                JOIN pharmacyorder po ON p.username = po.pharmacyUsername
                JOIN city c ON p.city = c.city
                WHERE po.id = '$oderID';";

        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }
        return null;
    }

    public function getAllOrders(): array
    {
        $conn = $this->createConnection();

        try {
            $output = array();
            $sql = "SELECT * from `pharmacyorder` WHERE `order_status` = 0 OR `order_status` = 6";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new PharmacyOrderModel();
                    $tmp->id = $row["id"];
                    $tmp->pharmacyUsername = $row['pharmacyUsername'];
                    $tmp->status = $this->statusToString($row['status']);
                    $tmp->supName = $row['supName'];
                    $tmp->order_date = $row['order_date'];
                    $tmp->delivery_date = $row['delivery_date'];
                    $tmp->order_total = $row['order_total'];
                    $tmp->order_status = $row['order_status'];

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        $conn->close();
        return $output;
    }

    public function changeOrderStatus(string $oderID, string $status): bool
    {
        $conn = $this->createConnection();

        $sql = "UPDATE `pharmacyorder` SET `status` = '".$this->statusToInt($status)."' WHERE `id`='$oderID';";
        $stmt = $conn->prepare($sql);
        try {
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                if ($status == 'Accepted') {
                    return $this->insertDeliveryReq($oderID, $conn);
                } else if ($status == 'Rejected') {
                    return true;
                }
                return false;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getMedicineByOrderID(mixed $orderId): false|array
    {
        $conn = $this->createConnection();

        $sql = "SELECT `order`.medId, `med`.medName, `order`.supName, `order`.quantity, `supp`.unitPrice 
                FROM `pharmacyordermedicine` `order`
                    LEFT JOIN `medicine` `med` ON `order`.medid = `med`.id
                    LEFT JOIN `supplier_medicine` `supp` ON `med`.id = `supp`.medid WHERE orderid = '$orderId'";

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
}