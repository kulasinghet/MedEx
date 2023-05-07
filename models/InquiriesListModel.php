<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\stores\EmployeeStore;
use mysqli;

class InquiriesListModel extends Model
{
    private function createConnection(): ?\mysqli
    {
        //loading the database
        $db = new Database();
        return $db->getConnection();
    }

    public function getAllReports(): array
    {
        $conn = $this->createConnection();

        // generating the output with sorted by unseen reports first
        $output = array_merge($this->queryAllUnseenReports($conn), $this->queryAllSeenReports($conn));

        $conn->close();
        return $output;
    }

    private function queryAllUnseenReports(mysqli $conn): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $output = array();
        $sql = "SELECT `r`.*, `l`.`isPharmacy`, `l`.`isSupplier`, `l`.`isDelivery`, `l`.`isLab`
                FROM `report` `r`
                INNER JOIN `login` `l` 
                on `r`.`username` = `l`.`username`
                LEFT JOIN `report_seen_by` `rsb`
                ON `r`.`inquiry_id` = `rsb`.`inquiry_id`
                WHERE `r`.`is_resolved` = '0' 
                  AND (`rsb`.`emp_username` != '$store->username' OR `rsb`.`emp_username` IS NULL) 
                  AND `l`.`isStaff` = 0;";

        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InquiryModel(array(
                        'inquiry_id' => $row["inquiry_id"],
                        'username' => $row["username"],
                        'user_type' => InquiryModel::getUserType($row),
                        'subject' => $row["subject"],
                        'message' => $row["message"],
                        'is_resolved' => $row["is_resolved"],
                        'is_employee_noticed' => false
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }

    private function queryAllSeenReports(mysqli $conn): array
    {
        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();
        $output = array();
        $sql = "SELECT `r`.*, `l`.`isPharmacy`, `l`.`isSupplier`, `l`.`isDelivery`, `l`.`isLab`
                FROM `report` `r`
                INNER JOIN `login` `l` 
                on `r`.`username` = `l`.`username`
                LEFT JOIN `report_seen_by` `rsb`
                ON `r`.`inquiry_id` = `rsb`.`inquiry_id`
                WHERE `r`.`is_resolved` = '0' 
                  AND `rsb`.`emp_username` = '$store->username' 
                  AND `l`.`isStaff` = 0;";

        try {
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tmp = new InquiryModel(array(
                        'inquiry_id' => $row["inquiry_id"],
                        'username' => $row["username"],
                        'user_type' => InquiryModel::getUserType($row),
                        'subject' => $row["subject"],
                        'message' => $row["message"],
                        'is_resolved' => $row["is_resolved"],
                        'is_employee_noticed' => true
                    ));

                    // pushing tmp into the array
                    $output[] = $tmp;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return $output;
    }
}