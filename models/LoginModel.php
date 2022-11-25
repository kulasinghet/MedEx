<?php

namespace app\models;

use app\base\Database;

class LoginModel extends Model
{

    public string $username;
    public string $password;

    public function loginEmployee()
    {
//        try {
            $db = new Database();
//            $this->password = password_hash($this -> password, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM employee WHERE username = '$this->username';";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            echo $row['password'];
            echo $this->password;

            if ($row) {
                if (password_verify($this->password, $row['password'])) {
//                    session_start();
//                    $_SESSION['username'] = $row['username'];
//                    $_SESSION['id'] = $row['id'];
//                    $_SESSION['fname'] = $row['fname'];
//                    $_SESSION['lname'] = $row['lname'];
//                    $_SESSION['nic'] = $row['nic'];
//                    $_SESSION['age'] = $row['age'];
//                    $_SESSION['managerid'] = $row['managerid'];
//                    $_SESSION['regDate'] = $row['regDate'];
                    return true;
                }
            } else {
                return false;
            }


//        } catch (\Exception $e) {
//            echo $e->getMessage();
//        }

        return false;
    }



}