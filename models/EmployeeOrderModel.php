<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\models\HyperEntities\HyperPharmacyModel;

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

    public function getAll(): array
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
}