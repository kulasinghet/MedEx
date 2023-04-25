<?php

namespace app\models\HyperEntities;

use app\core\Database;
use app\core\Logger;

class HyperDeliveryModel extends HyperEntityModel
{
    public string $city;
    public int $age;
    public string $license_id;
    public string $license_name;
    public string $license_photo;
    public string $vehicle_no;
    public string $vehicle_type;
    public string $vehicle_reg_photo;
    public string $vehicle_photo;
    public string $delivery_location;
    public int $max_load;
    public string $reg_date;
    public bool $refrigerators;


    public function __construct($params = array()) {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public static function getByUsername(string $username): ?self
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "SELECT * FROM `delivery_partner` WHERE `username` = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new HyperDeliveryModel(array(
                    'username' => $row["username"],
                    'name' => $row["name"],
                    'city' => $row["city"],
                    'age' => $row["age"],
                    'licence_id' => $row["licence_id"],
                    'licence_name' => $row["driver_license_name"],
                    'vehicle_no' => $row["vehicle_no"],
                    'vehicle_type' => $row["vehicle_type"],
                    'delivery_location' => $row["delivery_location"],
                    'max_load' => $row["max_load"],
                    'reg_date' => $row["reg_date"],
                    'refrigerators' => $row["refrigerators"],
                    'license_photo' => $row["license_photo"],
                    'vehicle_reg_photo' => $row["vehicle_reg_photo"],
                    'vehicle_photo' => $row["vehicle_photo"],
                    'email' => $row["email"],
                    'address' => $row["address"],
                    'mobile' => $row["mobile"],
                ));
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            $conn->close();
        }

        return null;
    }

    public function verify(): bool
    {
        //loading the database
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $sql = "INSERT INTO `delivery_partner` (verified) VALUES ('1');";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                return true;
            } else {
                Logger::logError($stmt->error);
                return false;
            }
        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}