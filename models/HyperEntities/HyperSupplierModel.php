<?php

namespace app\models\HyperEntities;

use app\core\Database;
use app\core\Logger;

class HyperSupplierModel extends HyperEntityModel
{
    public string $supp_reg_no;
    public string $business_reg_id;
    public string $business_cert_name;
    public string $supp_cert_id;
    public string $supp_cert_name;
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
            $sql = "SELECT * FROM `supplier` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new HyperSupplierModel(array(
                    'username' => $row["username"],
                    'name' => $row["name"],
                    'supp_reg_no' => $row["supplierRegNo"],
                    'business_reg_id' => $row["BusinessRegId"],
                    'supp_cert_id' => $row["supplierCertId"],
                    'business_cert_name' => $row["BusinessRegCertName"],
                    'supp_cert_name' => $row["supplierCertName"],
                    'reg_date' => $row["regDate"],
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
            $sql = "INSERT INTO `supplier` (verified) VALUES ('1');";

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