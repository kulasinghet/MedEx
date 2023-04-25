<?php

namespace app\models\InvalidEntity;

use app\core\Database;
use app\core\Logger;

class InvalidPharmacyModel extends InvalidEntityModel
{
    public string $ownerName;
    public string $city;
    public string $phar_reg_no;
    public string $business_reg_id;
    public string $business_cert_name;
    public string $phar_cert_id;
    public string $phar_cert_name;
    public string $delivery_time;

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
            $sql = "INSERT INTO `pharmacy` (verified) VALUES ('1');";

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