<?php

namespace app\models;

use app\core\Database;
use DateTime;
use DateTimeZone;

class SupplierModel extends Model
{
    public string $id;
    public string $username;
    public string $password;
    public string $name;
    public string $supplierRegNo;
    public string $BusinessRegId;
    public string $supplierCertId;
    public string $BusinessRegCertName;
    public string $supplierCertName;
    public string $verified;
    public string $regDate;

    public function registerSupplier() {

        $db = new Database();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');

        try {
            $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO supplier (id, username, password, name, supplierRegNo, BusinessRegId, supplierCertId, BusinessRegCertName, supplierCertName, verified, regDate) VALUES ('$this->id','$this->username', '$this->password', '$this->name', '$this->supplierRegNo', '$this->BusinessRegId', '$this->supplierCertId', '$this->BusinessRegCertName', '$this->supplierCertName', '0', '$regDate')";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

}