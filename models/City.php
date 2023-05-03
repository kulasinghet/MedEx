<?php

namespace app\models;

use app\core\Database;

class City extends Model
{
    public function getDeliveryTime($city)
    {
        $db = (new Database())->getConnection();

        $sql = "SELECT delivery_time FROM city WHERE city = '$city'";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['delivery_time'];
        } else {
            return false;
        }
    }

}
