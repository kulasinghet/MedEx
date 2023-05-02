<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class ReportModel extends Model
{
    public string $inquiry_id;
    public string $username;
    public string $user_type;
    public ?string $subject;
    public ?string $message;
    public bool $is_resolved;
    public bool $is_employee_noticed;


    public function __construct($params = array()) {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function getUserType(array $query_row): string
    {
        if ($query_row["isPharmacy"] == 1) {
            return "pharmacy";
        } else if ($query_row["isSupplier"] == 1) {
            return "supplier";
        } else if ($query_row["isDelivery"] == 1) {
            return "delivery";
        } else if ($query_row["isLab"] == 1) {
            return "lab";
        } else {
            return "";
        }
    }

    public static function getByID(string $id): ?self
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "SELECT `r`.*, `l`.`isPharmacy`, `l`.`isSupplier`, `l`.`isDelivery`, `l`.`isLab`
                FROM `report` `r`
                INNER JOIN `login` `l` 
                on `r`.`username` = `l`.`username`
                WHERE `r`.`inquiry_id` = '$id';";


            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new ReportModel(array(
                    'inquiry_id' => $row["inquiry_id"],
                    'username' => $row["username"],
                    'user_type' => ReportModel::getUserType($row),
                    'subject' => $row["subject"],
                    'message' => $row["message"],
                    'is_resolved' => $row["is_resolved"]
                ));
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return null;
    }

    public function resolve(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "UPDATE `report` SET `is_resolved` = '1' WHERE `inquiry_id`='$this->inquiry_id';";
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

    public function seenBy(string $emp_username): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "INSERT INTO `report_seen_by` (`inquiry_id`, `emp_username`) VALUES ('$this->inquiry_id', '$emp_username');";
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