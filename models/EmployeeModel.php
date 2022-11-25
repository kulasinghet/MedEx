<?php

namespace app\models;

use app\base\Database;
use DateTime;
use DateTimeZone;

class EmployeeModel extends Model
{
    public string $id;
    public string $username;
    public string $password;
    public string $fname;
    public string $lname;
    public string $nic;
    public int $age;
    public string $managerid;
//    public string $regDate = new DateTime("now",'Y-m-d');


    public function registerEmployee()
    {

        $db = new Database();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');
//        $regDate = $regDate -> date('Y-m-d');

        try {
//            echo "string";
            $this -> password = password_hash($this -> password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO employee (id, username, password, fName, lName, nic, age, managerId, regDate) VALUES ('$this->id','$this->username', '$this->password', '$this->fname', '$this->lname', '$this->nic', '$this->age', null, '$regDate')";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt->close();

            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

    }



}