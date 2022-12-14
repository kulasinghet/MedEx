<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use DateTime;
use DateTimeZone;

class LabModel extends Model
{
    public string $id;
    public string $username;
    public string $password;
    public string $laboratory_name;
    public string $business_registration_id;
    public string $laboratory_certificate_id;
    public string $BusinessRegCertName;
    public string $LabCertName;
    public string $regDate;

    public function registerLab(): bool
    {
        $db = new Database();

        try {

            $regDate = new DateTime("now");
            $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
            $regDate = $regDate->format('Y/m/d');

            $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO laboratory (id, username, password, laboratory_name, business_registration_id, laboratory_certificate_id, BusinessRegCertName, LabCertName, reg_date) VALUES ('$this->id','$this->username', '$this->password', '$this->laboratory_name', '$this->business_registration_id', '$this->laboratory_certificate_id', '$this->BusinessRegCertName', '$this->LabCertName', '$regDate');";
//            $sql = "INSERT INTO laboratory (id, username, password, laboratory_name, business_registration_id, business_registration_id, laboratory_certificate_id, BusinessRegCertName, LabCertName, reg_date) VALUES ('$this->id','$this->username', '$this->password', '$this->laboratory_name', '$this->business_registration_id', '$this->laboratory_certificate_id', '$this->BusinessRegCertName', '$this->LabCertName', '$regDate');";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

}
