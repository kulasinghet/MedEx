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

    public function getUserInfo($username)
    {
        $connection = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM login WHERE username = '$username';";
            $result = $connection->query($sql);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $userType = "unassigned";

            if ($result->num_rows == 1) {
                $result->close();

                for ($i = 2; $i < 7; $i++) {
                    if ($row['isPharmacy'] == 1) {
                        $userType = "pharmacy";
                        $sql = "SELECT * FROM pharmacy WHERE username = '$username';";
                        break;
                    } elseif ($row['isStaff'] == 1) {
                        $userType = "staff";
                        $sql = "SELECT * FROM employee WHERE username = '$username';";
                        break;
                    } elseif ($row['isDelivery'] == 1) {
                        $userType = "delivery";
                        $sql = "SELECT * FROM delivery_partner WHERE username = '$username';";
                        break;
                    } elseif ($row['isLab'] == 1) {
                        $userType = "lab";
                        $sql = "SELECT * FROM laboratory WHERE username = '$username';";
                        break;
                    } elseif ($row['isSupplier'] == 1) {
                        $userType = "supplier";
                        $sql = "SELECT * FROM supplier WHERE username = '$username';";
                        break;
                    }
                }

                $result = $connection->query($sql);
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $connection->close();
                return $row;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function generateOTP(mixed $username): mixed
    {
        $connection = (new Database())->getConnection();

        try {
            $otp = rand(100000, 999999);
            $sql = "UPDATE login SET otp = '$otp' WHERE username = '$username';";
            $result = $connection->query($sql);

            if ($result) {
                $connection->close();
                Logger::logDebug("OTP generated for $username" . " is $otp");
                return $otp;
            } else {
                $connection->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function changePassword(mixed $username, mixed $otp = null, mixed $password)
    {
        $connection = (new Database())->getConnection();

        try {
            $sql = "SELECT * FROM login WHERE username = '$username' AND otp = '$otp';";
            $result = $connection->query($sql);

            if ($result->num_rows == 1) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                // set otp to null
                $sql = "UPDATE login SET password = '$password', otp = null WHERE username = '$username';";
                $result = $connection->query($sql);

                if ($result) {
                    $connection->close();
                    return true;
                } else {
                    $connection->close();
                    return false;
                }
            } else {
                $connection->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function getUserEmail(mixed $username)
    {
        $userType = $this->getUserInfo($username);
        Logger::logDebug(print_r($userType, true));
        return $userType['email'];
    }


}
