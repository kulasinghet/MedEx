<?php

namespace app\models\HyperEntities;

use app\core\Database;
use app\core\Logger;

class HyperLabModel extends HyperEntityModel
{
    public string $business_reg_id;
    public string $business_cert_name;
    public string $lab_cert_id;
    public string $lab_cert_name;
    public string $reg_date;

    public function __construct($params = array()) {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function getByUsername(string $username): ?self
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "SELECT * FROM `laboratory` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new HyperLabModel(array(
                    'username' => $row["username"],
                    'name' => $row["laboratory_name"],
                    'business_reg_id' => $row["business_registration_id"],
                    'lab_cert_id' => $row["laboratory_certificate_id"],
                    'business_cert_name' => $row["BusinessRegCertName"],
                    'lab_cert_name' => $row["LabCertName"],
                    'reg_date' => $row["reg_date"],
                    'email' => $row["email"],
                    'address' => $row["address"],
                    'mobile' => $row["mobile"],
                ));
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return null;
    }

    public function verify(?bool $action): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "UPDATE `laboratory` SET `verified` = ".($action?? "NULL")." WHERE `username`='$this->username';";

            $stmt = $conn->prepare($sql);
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