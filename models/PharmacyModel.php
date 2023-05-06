<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
use app\core\Logger;
use app\core\Request;
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

    public function registerPharmacy($formbody)
    {
        $username = $formbody['username'];
        $password = $formbody['password'];
        $email = $formbody['email'];
        $pharmacyname = $formbody['pharmacyname'];
        $address = $formbody['address'];
        $city = $formbody['city'];
        $ownerName = $formbody['ownerName'];
        $contactnumber = $formbody['contactnumber'];
        $pharmacyRegNo = $formbody['pharmacyRegNo'];
        $BusinessRegId = $formbody['BusinessRegId'];
        $pharmacyCertId = $formbody['pharmacyCertId'];

        $deliveryTime = (new City())->getDeliveryTime($city);

        $db = (new Database())->getConnection();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');

        try {
            if ($this->userExists($username)) {
                throw new \Exception("User already exists");
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            echo (new \app\core\ExceptionHandler)->userExists($this->username);

            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($this->registerPharmacyInLogin($username, $hashedPassword)) {

            try {

                $sql = "INSERT INTO pharmacy (username, name, ownerName, city, pharmacyRegNo, BusinessRegId, pharmacyCertId, verified, deliveryTime, email, address, mobile, reg_date) VALUES ('$username', '$pharmacyname', '$ownerName', '$city', '$pharmacyRegNo', '$BusinessRegId', '$pharmacyCertId', '0', '$deliveryTime', '$email', '$address', '$contactnumber', '$regDate')";

                $stmt = $db->prepare($sql);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    $stmt->close();
                    return true;
                } else {
                    $stmt->close();
                    Logger::logError("Pharmacy registration failed" . $db->error);
                    return false;
                }

            } catch (\Exception $e) {
                Logger::logError($e->getMessage());
                return false;
            } finally {
                $db->close();
            }
        } else {

            $this->deletePharmacyFromLogin($username);
            return false;
        }
    }

    public function userExists($username = null): bool
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM pharmacy WHERE username = '$username'";
            $result = $db->query($sql);

            if ($result->fetch_assoc()) {

                $sql = "SELECT * FROM login WHERE username = '$username'";
                $result = $db->query($sql);

                if ($result->fetch_assoc()) {
                    return true;
                } else {
                    return false;
                }

            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getPharmacyByUsername($username): false|array
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM pharmacy WHERE username = '$username'";
            $result = $db->query($sql);

            if ($result->num_rows == 1) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function validatePharmacy($formbody)
    {
        $username = $formbody['username'];
        $password = $formbody['password'];
        $email = $formbody['email'];
        $pharmacyname = $formbody['pharmacyname'];
        $address = $formbody['address'];
        $city = $formbody['city'];
        $ownerName = $formbody['ownerName'];
        $contactnumber = $formbody['contactnumber'];
        $pharmacyRegNo = $formbody['pharmacyRegNo'];
        $BusinessRegId = $formbody['BusinessRegId'];

//        any of these fields are empty
        if (empty($username) || empty($password) || empty($email) || empty($pharmacyname) || empty($address) || empty($city) || empty($ownerName) || empty($contactnumber) || empty($pharmacyRegNo) || empty($BusinessRegId)) {
            echo (new \app\core\ExceptionHandler)->emptyFields();
            return false;
        }

        // username cannot have spaces, special characters
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            echo (new \app\core\ExceptionHandler)->invalidUsername();
            return false;
        }

        // password must be at least 8 characters long
        if (strlen($password) < 8) {
            echo (new \app\core\ExceptionHandler)->invalidPassword();
            return false;
        }

        // email must be valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo (new \app\core\ExceptionHandler)->invalidEmail();
            return false;
        }


        // phone number must be valid
        if (!preg_match("/^[0-9]*$/", $contactnumber)) {
            echo (new \app\core\ExceptionHandler)->invalidPhoneNumber();
            return false;
        }

        if (strlen($contactnumber) != 10) {
            echo (new \app\core\ExceptionHandler)->invalidPhoneNumber();
            return false;
        }

        return true;
    }

    public function registerPharmacyInLogin($username, $hashedpassword)
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "INSERT INTO login (username, password, isDelivery, isPharmacy, isLab, isStaff, isSupplier) VALUES ('$username', '$hashedpassword', '0', '1', '0', '0', '0')";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError(print_r($stmt->error_list, true) . " " . $stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    private function deletePharmacyFromLogin($username)
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "DELETE FROM login WHERE username = '$username'";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError(print_r($stmt->error_list, true) . " " . $stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getPharmacyProfile(mixed $username)
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM pharmacy WHERE username = '$username'";
            $result = $db->query($sql);

            if ($result->num_rows == 1) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function isVerified(mixed $username)
    {
        $db = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM pharmacy WHERE username = '$username'";
            $result = $db->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($row['verified'] == 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function reportPurchase(array $form)
    {
        $db = (new Database())->getConnection();

        $orderID = $form['orderID'];
        $rating = $form['rating'];
        $comment = $form['comment'];
        $reportTime = date("Y-m-d H:i:s");

        try {
            $sql = "INSERT INTO purchaseReport (orderID, rating, comment, reportTime) VALUES ('$orderID', '$rating', '$comment', '$reportTime')";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError(print_r($stmt->error_list, true) . " " . $stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }

    }


}
