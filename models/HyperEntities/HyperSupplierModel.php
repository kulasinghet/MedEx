<?php

namespace app\models\HyperEntities;

use app\core\Database;
use app\core\Logger;
use app\stores\EmployeeStore;
use Exception;

class HyperSupplierModel extends HyperEntityModel
{
    public ?string $supp_reg_no;
    public ?string $business_reg_id;
    public ?string $business_cert_name;
    public ?string $supp_cert_id;
    public ?string $supp_cert_name;
    public string $reg_date;

    public function __construct($params = array())
    {
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
        } catch (Exception $e) {
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

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        try {
            $sql = "UPDATE `supplier` SET `verified` = " . ($action ?? "NULL") . " WHERE `username`='$this->username';";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $store->setNotification('Supplier is '.($action? 'verified' : 'ignored').'!', $this->username . ' is '.($action? 'verified' : 'ignored').' successfully.', 'success');
                return true;
            } else {
                $store->setNotification('Supplier verification error!', $this->username . ' couldn\'t do the operation (see logs).', 'error');
                Logger::logError($stmt->error);
                return false;
            }
        } catch (Exception $e) {
            $store->setNotification('Supplier verification error!', $this->username . ' couldn\'t do the operation (see logs).', 'error');
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function push(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();
        $date = date("Y-m-d");

        try {
            $sql = "INSERT INTO `supplier` (
                        username,
                        name,
                        supplierRegNo,
                        BusinessRegId,
                        supplierCertId,
                        BusinessRegCertName,
                        supplierCertName,
                        verified,
                        regDate,
                        email,
                        address,
                        mobile)
            VALUES (
                    '$this->username',
                    '$this->name',
                    '$this->supp_reg_no',
                    '$this->business_reg_id',
                    '$this->supp_cert_id',
                    '$this->business_cert_name',
                    '$this->supp_cert_name',
                    '0',
                    '$date',
                    '$this->email',
                    '$this->address',
                    '$this->mobile)';";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function update(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "UPDATE `supplier`
            SET `name` = '$this->name',
                `supplierRegNo` = '$this->supp_reg_no',
                `BusinessRegId` = '$this->business_reg_id',
                `supplierCertId` = '$this->supp_cert_id',
                `BusinessRegCertName` = '$this->business_cert_name',
                `supplierCertName` = '$this->supp_cert_name',
                `email` = '$this->email',
                `address` = '$this->address',
                `mobile` = '$this->mobile'
            WHERE `username`='$this->username';";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function delete(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "DELETE FROM `supplier` WHERE `username`='$this->username';";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }
}