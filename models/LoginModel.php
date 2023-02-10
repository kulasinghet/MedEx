<?php

namespace app\models;
use app\core\Database;
use app\core\Logger;

class LoginModel extends Model
{

    public string $username;
    public string $password;

    public string $isSupplier;

    public string $isPharmacy;
    public string $isStaff;
    public string $isLab;
    public string $isDelivery;


    public function login(): string
    {
        $connection = (new Database())->getConnection();

        try {

            $sql = "SELECT * FROM login WHERE username = '$this->username';";
            $result = $connection->query($sql);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if ($result->num_rows == 1) {

                $hash = $row['password'];
                $userType = "unassigned";

                if (password_verify($this->password, $hash)) {

                    for ($i = 2; $i < 7; $i++) {
                        if ($row['isPharmacy'] == 1) {
                            $userType = "pharmacy";
                            break;
                        } elseif ($row['isStaff'] == 1) {
                            $userType = "staff";
                            break;
                        } elseif ($row['isDelivery'] == 1) {
                            $userType = "delivery";
                            break;
                        } elseif ($row['isLab'] == 1) {
                            $userType = "lab";
                            break;
                        } elseif ($row['isSupplier'] == 1) {
                            $userType = "supplier";
                            break;
                        }
                    }

                    echo "user type is " . $userType;

                    $connection->close();

                    return $userType;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }

        $connection->close();
        return "unassigned";
    }

    public function registerActor()
    {

        $db = (new Database())->getConnection();

        try {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO login(username, password, isSupplier, isPharmacy, isStaff, isLab, isDelivery) VALUES ('$this->username' , '$this->password', '$this->isSupplier',' $this->isPharmacy', '$this->isStaff', '$this->isLab', '$this->isDelivery' )";

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



}