<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use app\core\Request;
use DateTime;
use DateTimeZone;

class DeliveryModel extends Model
{
    public string $id;
    public string $username;
    public string $password;
    public string $name;
    public string $licenseId;
    public string $drivingLicenseName;
    public string $vehicleNo;
    public string $vehicleType;
    public string $deliveryLocations;
    public string $maxLoad;
    public string $regDate;
    public string $refrigeration;



    public function registerDeliveryPartner()
    {

            $db = new Database();

            $regDate = new DateTime("now");
            $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
            $regDate = $regDate->format('Y/m/d');

            try {
                $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO deliverypartner (id, username, password, name, license_id, driverLicenseName, vehicle_no, vehicle_type, delivery_location, max_load, reg_date, refrigerators) VALUES ('$this->id', '$this->username', '$this->password', '$this->name', '$this->licenseId', '$this->drivingLicenseName', '$this->vehicleNo', '$this->vehicleType', '$this->deliveryLocations', '$this->maxLoad', '$regDate', '$this->refrigeration')";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    $stmt->close();
                    return true;
                } else {
                    $stmt->close();
                    return false;
                }

            } catch (\Exception $e) {
                Logger::logError($e->getMessage());
                return false;
            }

    }

    public function toString()
    {
        return "username: " . $this->username . " password: " . $this->password . " name: " . $this->name . " licenseId: " . $this->licenseId . " vehicleNo: " . $this->vehicleNo . " deliveryLocations: " . $this->deliveryLocations . " deliveryCondition: " . $this->deliveryCondition . " maxLoad: " . $this->maxLoad . " regDate: " . $this->regDate . " refrigeration: " . $this->refrigeration;
    }

}
