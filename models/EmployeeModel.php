<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use DateTime;
use DateTimeZone;

class EmployeeModel extends Model
{
    public string $username;
    public string $fname;
    public string $lname;
    public int $age;
    public bool $is_manager;
    public string $nic;
    public string $reg_date;
    // public string $regDate = new DateTime("now",'Y-m-d');
    public string $email;
    public string $address;
    public string $mobile;
    public ?string $profile_pic;

    public function __construct($params = array()) {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function getByUsername(string $username): ?EmployeeModel
    {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM `employee` WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new EmployeeModel(array(
                'username' => $row['username'],
                'fname' => $row['fName'],
                'lname' => $row['lName'],
                'age' => $row['age'],
                'is_manager' => $row['is_manager'],
                'nic' => $row['nic'],
                'reg_date' => $row['reg_date'],
                'email' => $row['email'],
                'address' => $row['address'],
                'mobile' => $row['mobile'],
                'profile_pic' => $row['profile_pic']
            ));
        } else {
            return null;
        }
    }


//    public function registerEmployee()
//    {
//
//        $db = new Database();
//
//        $regDate = new DateTime("now");
//        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
//        $regDate = $regDate->format('Y/m/d');
////        $regDate = $regDate -> date('Y-m-d');
//
//        try {
////            echo "string";
//            $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);
//            $sql = "INSERT INTO employee (id, username, password, fName, lName, nic, age, managerId, regDate) VALUES ('$this->id','$this->username', '$this->password', '$this->fname', '$this->lname', '$this->nic', '$this->age', null, '$regDate')";
//            $stmt = $db->prepare($sql);
//            $stmt->execute();
//
//            if ($stmt->affected_rows == 1) {
//                return true;
//            }
//
//            $stmt->close();
//
//            return true;
//        } catch (\Exception $e) {
//            Logger::logError($e->getMessage());
//            echo $e->getMessage();
//            return false;
//        }
//
//    }
}