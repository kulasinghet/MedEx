<?php

namespace app\models\HyperEntities;

use app\core\Database;
use app\core\Logger;
use app\stores\EmployeeStore;

class HyperDeliveryModel extends HyperEntityModel
{
    public string $city;
    public int $age;
    public string $license_id;
    public string $license_name;
    public string $license_photo;
    public string $vehicle_no;
    public string $vehicle_type;
    public string $vehicle_reg_photo;
    public string $vehicle_photo;
    public string $delivery_location;
    public string $reg_date;
    public bool $refrigerators;


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
            $sql = "SELECT * FROM `delivery_partner` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new HyperDeliveryModel(array(
                    'username' => $row["username"],
                    'name' => $row["name"],
                    'city' => $row["city"],
                    'age' => $row["age"],
                    'license_id' => $row["license_id"],
                    'license_name' => $row["driver_license_name"],
                    'vehicle_no' => $row["vehicle_no"],
                    'vehicle_type' => $row["vehicle_type"],
                    'delivery_location' => $row["delivery_location"],
                    'reg_date' => $row["reg_date"],
                    'refrigerators' => $row["refrigerators"],
                    'license_photo' => $row["license_photo"],
                    'vehicle_reg_photo' => $row["vehicle_reg_photo"],
                    'vehicle_photo' => $row["vehicle_photo"],
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

        // retrieving the employee store
        $store = EmployeeStore::getEmployeeStore();

        try {
            $sql = "UPDATE `delivery_partner` SET `verified` = ".($action?? "NULL")." WHERE `username`='$this->username';";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $store->setNotification('Delivery Partner is '.($action? 'verified' : 'ignored').'!', $this->username . ' is verified successfully.', 'success');
                return true;
            } else {
                $store->setNotification('Delivery Partner verification error!', $this->username . ' couldn\'t be verified (see logs).', 'error');
                Logger::logError($stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            $store->setNotification('Delivery Partner verification error!', $this->username . ' couldn\'t be verified (see logs).', 'error');
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
            $sql = "INSERT INTO `delivery_partner` (
                                `username`,
                                `name`,
                                `city`,
                                `age`,
                                `license_id`,
                                `driver_license_name`,
                                `vehicle_no`,
                                `vehicle_type`,
                                `delivery_location`,
                                `reg_date`,
                                `refrigerators`,
                                `license_photo`,
                                `vehicle_reg_photo`,
                                `vehicle_photo`,
                                `email`,
                                `address`,
                                `mobile`,
                                `verified`) 
        VALUES (
                '$this->username',
                '$this->name',
                '$this->city',
                '$this->age',
                '$this->license_id',
                '$this->license_name',
                '$this->vehicle_no',
                '$this->vehicle_type',
                '$this->delivery_location',
                '$date',
                '$this->refrigerators',
                '$this->license_photo',
                '$this->vehicle_reg_photo',
                '$this->vehicle_photo',
                '$this->email',
                '$this->address',
                '$this->mobile',
                '0');";

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

    public function update(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "UPDATE `delivery_partner`
            SET `name`='$this->name',
                `city`='$this->city',
                `age`='$this->age',
                `license_id`='$this->license_id',
                `driver_license_name`='$this->license_name',
                `vehicle_no`='$this->vehicle_no',
                `vehicle_type`='$this->vehicle_type',
                `delivery_location`='$this->delivery_location',
                `refrigerators`='$this->refrigerators',
                `license_photo`='$this->license_photo',
                `vehicle_reg_photo`='$this->vehicle_reg_photo',
                `vehicle_photo`='$this->vehicle_photo',
                `email`='$this->email',
                `address`='$this->address',
                `mobile`='$this->mobile'
            WHERE `username`='$this->username';";

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

    public function delete(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "DELETE FROM `delivery_partner` WHERE `username`='$this->username';";

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