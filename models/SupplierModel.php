<?php

namespace app\models;
use app\core\Database;
use DateTime;
use DateTimeZone;

class SupplierModel extends Model
{
    public string $username;
    public string $name;
    public string $supplierRegNo;
    public string $BusinessRegId;
    public string $supplierCertId;
    public string $BusinessRegCertName;
    public string $supplierCertName;
    public string $verified;
    public string $regDate;
    public string $email;
    public string $address;
    public string $mobile;

    public function registerSupplier()
    {

        $db = (new Database())->getConnection();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');

        try {
            $sql = "INSERT INTO supplier (username, name, supplierRegNo, BusinessRegId, supplierCertId, BusinessRegCertName, supplierCertName, verified, regDate, email, address, mobile) VALUES ('$this->username', '$this->name', '$this->supplierRegNo', '$this->BusinessRegId', '$this->supplierCertId', '$this->BusinessRegCertName', '$this->supplierCertName', '0', '$regDate', '$this->email', '$this->address', '$this->mobile')";

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

    public function getSupplier($uname)
    {
        $db = (new Database())->getConnection();
        $sql = "SELECT * from supplier WHERE supplier.username = '$uname'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->username = $row["username"];
                $this->name = $row["name"];
                $this->supplierRegNo = $row["supplierRegNo"];
                $this->BusinessRegId = $row["BusinessRegId"];
                $this->supplierCertId = $row["supplierCertId"];
                $this->BusinessRegCertName = $row["BusinessRegCertName"];
                $this->supplierCertName = $row["supplierCertName"];
                $this->verified = $row["verified"];
                $this->regDate = $row["regDate"];
                $this->email = $row["email"];
                $this->address = $row["address"];
                $this->mobile = $row["mobile"];
            }

        }
        $db->close();


    }
    public function getStatus($uname)
    {
        $this->getSupplier($uname);
        $_SESSION['stat'] = $this->verified;
        return $_SESSION['stat'];
    }

    public function getName($uname)
    {
        $this->getSupplier($uname);
        $_SESSION['name'] = $this->name;
        return $_SESSION['name'];
    }

}