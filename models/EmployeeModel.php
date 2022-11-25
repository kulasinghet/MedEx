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



    public function tableName(): string
    {
        return 'employee';
    }

//    public function attributes(): array
//    {
//        return [
//            'firstName',
//            'lastName',
//            'email',
//            'password',
//            'phone',
//            'address',
//            'city',
//            'state',
//            'zip',
//            'country',
//            'role'
//        ];
//    }

//    public function rules(): array
//    {
//        return [
//            'firstName' => [self::RULE_REQUIRED],
//            'lastName' => [self::RULE_REQUIRED],
//            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
//            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
//            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
//            'phone' => [self::RULE_REQUIRED],
//            'address' => [self::RULE_REQUIRED],
//            'city' => [self::RULE_REQUIRED],
//            'state' => [self::RULE_REQUIRED],
//            'zip' => [self::RULE_REQUIRED],
//            'country' => [self::RULE_REQUIRED],
//            'role' => [self::RULE_REQUIRED]
//        ];
//    }

    public function registerEmployee()
    {

        $db = new Database();

        $regDate = new DateTime("now");
        $regDate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $regDate = $regDate->format('Y/m/d');
//        $regDate = $regDate -> date('Y-m-d');



        try {
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