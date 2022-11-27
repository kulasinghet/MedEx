<?php

namespace app\models;

use app\core\Database;

class LoginModel extends Model
{

    public string $username;
    public string $password;

    public function loginEmployee()
    {
        try {
            $db = new Database();
            $sql = "SELECT * FROM employee WHERE username = '$this->username';";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $hash = $result -> fetch_row()[2];

            $isPasswordValid = password_verify($this->password, $hash);

            if ($isPasswordValid) {

                $row = $result->fetch_assoc();
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['nic'] = $row['nic'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['managerid'] = $row['managerid'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['regDate'] = $row['regDate'];
                $_SESSION['isEmployee'] = true;

                $stmt->close();
                return true;
            } else {

                $stmt->close();
                return false;
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        }

    }