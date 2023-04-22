<?php

namespace app\models\InvalidEntity;

use app\core\Database;
use app\core\Logger;

class InvalidPharmacyModel extends InvalidEntityModel
{
    public string $ownerName;
    public string $city;
    public string $phar_reg_no;
    public string $business_reg_id;
    public string $business_cert_name;
    public string $phar_cert_id;
    public string $phar_cert_name;
    public string $delivery_time;

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
            $sql = "SELECT * FROM `pharmacy` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new InvalidPharmacyModel(array(
                    'username' => $row["username"],
                    'name' => $row["name"],
                    'ownerName' => $row["ownerName"],
                    'city' => $row["city"],
                    'phar_reg_no' => $row["pharmacyRegNo"],
                    'business_reg_id' => $row["BusinessRegId"],
                    'phar_cert_id' => $row["pharmacyCertId"],
                    'business_cert_name' => $row["BusinessRegCertName"],
                    'delivery_time' => $row["deliveryTime"],
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

    public function verify(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "INSERT INTO `pharmacy` (verified) VALUES ('1');";

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

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}