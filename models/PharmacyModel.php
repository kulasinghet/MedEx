<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use DateTime;
use DateTimeZone;

class PharmacyModel extends Model
{
    public string $id;
    public string $username;
    public string $password;
    public string $name;
    public string $ownerName;
    public string $city;
    public string $pharmacyRegNo;
    public string $BusinessRegId;
    public string $pharmacyCertId;
    public string $BusinessRegCertName;
    public string $pharmacyCertName;
    public string $verified;
    public string $deliveryTime;

    public function registerPharmacy() {

        $db = new Database();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');

        //todo: add verified function
        //todo: add delivery time function

        try {
            $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO pharmacy (id, username, password, name, ownerName, city, pharmacyRegNo, BusinessRegId, pharmacyCertId, BusinessRegCertName, pharmacyCertName, verified, deliveryTime, regDate) VALUES ('$this->id','$this->username', '$this->password', '$this->name', '$this->ownerName', '$this->city', '$this->pharmacyRegNo', '$this->BusinessRegId', '$this->pharmacyCertId', '$this->BusinessRegCertName', '$this->pharmacyCertName', '0', '10:00:00', '$regDate');";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error->__toString());
                return false;
            }

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

}