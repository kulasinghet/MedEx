<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class EmployeeDashboardModel extends Model
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

    public function readCounters(): array
    {
        $conn = $this->createConnection();
        $output = [];

        // getting pharmacy count
        $sql = "SELECT COUNT(*) AS pharmacy_count FROM `pharmacy` WHERE verified = '1';";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $output['pharmacy'] = $row['pharmacy_count'];
        } else {
            $output['pharmacy'] = 0;
        }

        // getting supplier count
        $sql = "SELECT COUNT(*) AS supplier_count FROM `supplier` WHERE verified = '1';";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $output['supplier'] = $row['supplier_count'];
        } else {
            $output['supplier'] = 0;
        }

        // getting delivery partner count
        $sql = "SELECT COUNT(*) AS delivery_partner_count FROM `delivery_partner` WHERE verified = '1';";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $output['delivery'] = $row['delivery_partner_count'];
        } else {
            $output['delivery'] = 0;
        }

        // getting laboratory count
        $sql = "SELECT COUNT(*) AS laboratory_count FROM `laboratory` WHERE verified = '1';";
        $result = $conn->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            $output['lab'] = $row['laboratory_count'];
        } else {
            $output['lab'] = 0;
        }

        return $output;
    }

    public function selectDailyRevenue(): array
    {
        $conn = $this->createConnection();
        $output = [];

        $sql = "SELECT revenue_date, daily_revenue FROM daily_revenue";

        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // pushing tmp into the array
                    $output[] = $row;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }

    public function selectPharmacyOrders(): array
    {
        $conn = $this->createConnection();

        try {
            $output = array();
            $sql = "SELECT * FROM `pharmacyorder` WHERE `order_status` = '0'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new PharmacyOrderModel();
                    $tmp->id = $row["id"];
                    $tmp->pharmacyUsername = $row['pharmacyUsername'];
                    $tmp->status = $this->statusToString($row['order_status']);
                    $tmp->order_date = $row['order_date'];

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
}