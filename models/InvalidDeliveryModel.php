<?php

namespace app\models;
use app\core\Database;
use app\core\ExceptionHandler;
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
        parent::__construct();

        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }
}