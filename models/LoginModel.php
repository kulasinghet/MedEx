<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class LoginModel extends Model
{

    public string $username;
    public string $password;

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
            return false;
        }

        $connection->close();
        return "unassigned";
    }


}
