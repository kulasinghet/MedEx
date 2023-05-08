<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use DateTime;
use DateTimeZone;

class LabModel extends Model
{
    public string $username;
    public string $laboratory_name;
    public string $business_registration_id;
    public string $laboratory_certificate_id;
    public string $BusinessRegCertName;
    public string $LabCertName;
    public string $reg_date;
    public string $email;
    public string $address;
    public string $mobile;

    public function registerLab()
    {

        $db = (new Database())->getConnection();

        $reg_date = new DateTime("now");
        $reg_date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $reg_date = $reg_date->format('Y/m/d');

        try {
            $sql = "INSERT INTO laboratory VALUES ('$this->username', '$this->laboratory_name', '$this->business_registration_id', '$this->laboratory_certificate_id', '$this->BusinessRegCertName', '$this->LabCertName', '$reg_date', '$this->email', '$this->address', '$this->mobile','0')";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            }

            $stmt->close();

            return true;
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function getLab($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from laboratory WHERE laboratory.username = '$uname'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->username = $row["username"];
                $this->laboratory_name = $row["laboratory_name"];
                $this->business_registration_id = $row["business_registration_id"];
                $this->laboratory_certificate_id = $row["laboratory_certificate_id"];
                $this->BusinessRegCertName = $row["BusinessRegCertName"];
                $this->LabCertName = $row["LabCertName"];
                $this->reg_date = $row["reg_date"];
                $this->email = $row["email"];
                $this->address = $row["address"];
                $this->mobile = $row["mobile"];
            }
        }

        $db->close();


    }

    public function getName($username)
    {

        $this->getLab($username);
        $_SESSION['name'] = $this->laboratory_name;
        return $_SESSION['name'];
    }
}