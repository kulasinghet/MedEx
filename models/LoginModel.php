<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;
use DateTime;
use DateTimeZone;

class LoginModel extends Model
{

    public string $username;
    public string $password;
    public string $repassword;

    public string $isSupplier;

    public string $isPharmacy;
    public string $isStaff;
    public string $isLab;
    public string $isDelivery;



    public function login(): string
    {
        $connection = (new Database())->getConnection();
        try {
            $db = new Database();
            $sql = "SELECT * FROM employee WHERE username = '$this->username';";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $hash = $result->fetch_row()[2];

            //            $user = $result->fetch_row()[1];
//            $id = $result->fetch_row()[0];
//            $role = $result->fetch_row()[3];

            $isPasswordValid = password_verify($this->password, $hash);

            if ($isPasswordValid === true) {

                $row = $result->fetch_row();
                //                session_status() == PHP_SESSION_NONE ? session_start() : null;
//                $_SESSION['username'] = $user;
//                $_SESSION['fname'] = $id;
//                $_SESSION['lname'] = $result -> fetch_row()[4];
//                $_SESSION['nic'] = $row['nic'];
//                $_SESSION['age'] = $row['age'];
//                $_SESSION['managerid'] = $row['managerid'];
//                $_SESSION['id'] = $row['id'];
//                $_SESSION['regDate'] = $row['regDate'];
//                $_SESSION['isEmployee'] = true;

                $stmt->close();
                return true;
            } else {

                $stmt->close();
                return false;
            }
        } catch (\Exception $e) {
            //            echo $e->getMessage();
            return false;
        }

    }

    public function deliveryPartnerLogin(): bool
    {
        try {
            $db = new Database();
            $sql = "SELECT * FROM deliverypartner WHERE username = '$this->username';";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $hash = $result->fetch_row()[2];

            if ($result->num_rows == 1) {
                $user = $result->fetch_row()[1];
                $id = $result->fetch_row()[0];
                $isPasswordValid = password_verify($this->password, $hash);
                //                $isPasswordValid = $this->password == $hash;
                if ($isPasswordValid === true) {

                    $row = $result->fetch_row();
                    //                session_status() == PHP_SESSION_NONE ? session_start() : null;
                    $_SESSION['username'] = $user;
                    $_SESSION['fname'] = $id;
                    $_SESSION['lname'] = $result->fetch_row()[4];
                    $_SESSION['nic'] = $row['nic'];
                    $_SESSION['age'] = $row['age'];
                    $_SESSION['managerid'] = $row['managerid'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['regDate'] = $row['regDate'];
                    $_SESSION['isEmployee'] = false;

                    $stmt->close();
                    return true;
                } else {

                    $stmt->close();
                    return false;
                }
            } else {
                $stmt->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            //            echo $e->getMessage();
            return false;
        }
    }

    public function labLogin(): bool
    {

        try {

            $db = new Database();
            $sql = "SELECT * FROM laboratory WHERE username = '$this->username';";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $hash = $result->fetch_row()[2];

            Logger::logError($hash);

            if ($result->num_rows == 1) {
                $user = $result->fetch_row()[1];
                $id = $result->fetch_row()[0];
                $isPasswordValid = password_verify($this->password, $hash);
                //                $isPasswordValid = $this->password == $hash;
                if ($isPasswordValid === true) {
                    //
//                    $row = $result->fetch_row();
////                session_status() == PHP_SESSION_NONE ? session_start() : null;
//                    $_SESSION['username'] = $user;
//                    $_SESSION['fname'] = $id;
//                    $_SESSION['lname'] = $result -> fetch_row()[4];
//                    $_SESSION['nic'] = $row['nic'];
//                    $_SESSION['age'] = $row['age'];
//                    $_SESSION['managerid'] = $row['managerid'];
//                    $_SESSION['id'] = $row['id'];
//                    $_SESSION['regDate'] = $row['regDate'];
//                    $_SESSION['isEmployee'] = false;

                    $stmt->close();
                    return true;
                } else {
                    Logger::logError("Password is not valid" . $isPasswordValid);
                    $stmt->close();
                    return false;
                }
            } else {
                Logger::logError("No user found");
                $stmt->close();
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            //            echo $e->getMessage();
            return false;
        }
    }

    public function loginPharmacy()
    {
        $db = new Database();

        try {

            $sql = "SELECT * FROM login WHERE username = '$this->username';";
            $result = $connection->query($sql);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if ($result->num_rows == 1) {
                @$hash = $result->fetch_row()[1];
                @$user = $result->fetch_row()[0];
                $isPasswordValid = password_verify($this->password, $hash);
                //                $isPasswordValid = $this->password == $hash;
                if ($isPasswordValid === true) {
                    $stmt->close();
                    return true;
                } else {
                    $stmt->close();
                    return false;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            //            echo $e->getMessage();
            return false;
        }
    }

    public function loginSupplier()
    {
        $db = new Database();

        try {


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
                        } elseif ($row['supplier'] == 1) {
                            $userType = "supplier";
                            break;
                        }
                    }

                    echo "user type is ".$userType;

                    $connection->close();

                    return $userType;
                }
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            //            echo $e->getMessage();
            return false;
        }
    }

    public function registerActor()
    {

        $db = new Database();

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
            ErrorLog::logError($e->getMessage());
            echo $e->getMessage();
            return false;
        }

        $connection->close();
        return "unassigned";
    }


}