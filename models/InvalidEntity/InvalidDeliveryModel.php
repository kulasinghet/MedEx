<?php

namespace app\models\InvalidEntity;

use app\core\Database;
use app\core\Logger;

class InvalidDeliveryModel extends InvalidEntityModel
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